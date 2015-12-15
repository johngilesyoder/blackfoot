<?php
/* 
 * License: GPLv3
 * License URI: http://www.gnu.org/licenses/gpl.txt
 * Copyright 2012-2015 - Jean-Sebastien Morisset - http://surniaulula.com/
 */

if ( ! defined( 'ABSPATH' ) ) 
	die( 'These aren\'t the droids you\'re looking for...' );

if ( ! class_exists( 'SucomUpdate' ) ) {

	class SucomUpdate {
	
		private $p;
		private $cron_hook;
		private $sched_hours;
		private $sched_name;
		private $text_dom = 'sucom';
		private static $c = array();

		public function __construct( &$plugin, &$ext, $text_dom = 'sucom' ) {
			$this->p =& $plugin;
			if ( $this->p->debug->enabled )
				$this->p->debug->mark( 'update setup' );
			$lca = $this->p->cf['lca'];					// ngfb
			$this->cron_hook = 'plugin_updates-'.$ext[$lca]['slug'];	// plugin_updates-nextgen-facebook
			$this->sched_hours = $this->p->cf['update_check_hours'];	// 24
			$this->sched_name = 'every'.$this->sched_hours.'hours';		// every24hours
			$this->text_dom = $text_dom;					// nextgen-facebook-um
			$this->set_config( $ext );
			$this->install_hooks();
			if ( $this->p->debug->enabled )
				$this->p->debug->mark( 'update setup' );
		}

		public static function get_umsg( $lca ) {
			if ( ! isset( self::$c[$lca]['umsg'] ) ) {
				$val = get_option( $lca.'_umsg' );
				if ( $val !== false && $val !== true )
					$val = base64_decode( $val );
				if ( empty( $val ) )
					self::$c[$lca]['umsg'] = false;
				else self::$c[$lca]['umsg'] = $val;
			}
			return self::$c[$lca]['umsg'];
		}

		public static function get_option( $lca, $idx = false ) {
			if ( ! empty( self::$c[$lca]['opt_name'] ) ) {
				$opt_data = self::get_option_data( $lca );
				if ( $idx !== false ) {
					if ( is_object( $opt_data->update ) &&
						isset( $opt_data->update->$idx ) )
							return $opt_data->update->$idx;
				} else return $opt_data;
			}
			return false;
		}

		private static function get_option_data( $lca, $default = false ) {
			if ( ! isset( self::$c[$lca]['opt_data'] ) ) {
				if ( ! empty( self::$c[$lca]['opt_name'] ) )
					self::$c[$lca]['opt_data'] = get_option( self::$c[$lca]['opt_name'], $default );
				else self::$c[$lca]['opt_data'] = $default;
			}
			return self::$c[$lca]['opt_data'];
		}

		private static function update_option_data( $lca, $opt_data ) {
			self::$c[$lca]['opt_data'] = $opt_data;
			if ( ! empty( self::$c[$lca]['opt_name'] ) )
				return update_option( self::$c[$lca]['opt_name'], $opt_data );
			return false;
		}

		public function set_config( &$ext ) {
			foreach ( $ext as $lca => $info ) {
				$auth_type = isset( $this->p->cf['plugin'][$lca]['update_auth'] ) ?	// allow for empty value
					$this->p->cf['plugin'][$lca]['update_auth'] : 'tid';		// default to tid auth
				$auth_key = 'plugin_'.$lca.'_'.$auth_type;				// plugin_ngfb_tid

				if ( $auth_type === 'tid' && empty( $this->p->options[$auth_key] ) ) {
					if ( $this->p->debug->enabled )
						$this->p->debug->log( $lca.' plugin: skipping update config - empty '.$auth_key.' option value' );
				} elseif ( empty( $info['slug'] ) || empty( $info['base'] ) || empty( $info['url']['update'] ) ) {
					if ( $this->p->debug->enabled )
						$this->p->debug->log( $lca.' plugin: skipping update checks - incomplete config array' );
				} else {
					if ( $this->p->debug->enabled )
						$this->p->debug->log( $lca.' plugin: update config defined (auth_type = '.
							( empty( $auth_type ) ? 'none' : $auth_type ).')' );
					self::$c[$lca] = array(
						'name' => $info['name'],
						'slug' => $info['slug'],				// nextgen-facebook
						'base' => $info['base'],				// nextgen-facebook/nextgen-facebook.php
						'opt_name' => 'external_updates-'.$info['slug'],	// external_updates-nextgen-facebook
						'json_url' => $info['url']['update'].
							( empty( $auth_type ) ? '' : '?'.$auth_type.'='.$this->p->options[$auth_key] ),
						'expire' => 86100,					// almost 24 hours
					);
				}
			}
		}

		public static function is_enabled() {
			return empty( self::$c ) ? false : true;
		}

		public static function is_configured() {
			return count( self::$c );
		}

		public function install_hooks() {
			if ( $this->p->debug->enabled )
				$this->p->debug->mark();

			if ( empty( self::$c ) ) {
				if ( $this->p->debug->enabled )
					$this->p->debug->log( 'skipping all update checks - empty update config array' );
				return;
			}

			add_filter( 'plugins_api', array( &$this, 'inject_data' ), 100, 3 );
			add_filter( 'transient_update_plugins', array( &$this, 'inject_update' ), 1000, 1 );
			add_filter( 'site_transient_update_plugins', array( &$this, 'inject_update' ), 1000, 1 );
			add_filter( 'pre_site_transient_update_plugins', array( &$this, 'enable_update' ), 1000, 1 );
			add_filter( 'http_headers_useragent', array( &$this, 'check_wpua' ), 9000, 1 );
			add_filter( 'http_request_host_is_external', array( &$this, 'allow_host' ), 1000, 3 );

			if ( $this->sched_hours > 0 && ! empty( $this->sched_name ) ) {
				if ( $this->p->debug->enabled )
					$this->p->debug->log( 'adding schedule '.$this->cron_hook.' for '.$this->sched_name );
				add_action( $this->cron_hook, array( &$this, 'check_for_updates' ) );
				add_filter( 'cron_schedules', array( &$this, 'custom_schedule' ) );

				$schedule = wp_get_schedule( $this->cron_hook );
				if ( ! empty( $schedule ) && $schedule !== $this->sched_name ) {
					if ( $this->p->debug->enabled )
						$this->p->debug->log( 'changing '.$this->cron_hook.' schedule from '.
							$schedule.' to '.$this->sched_name );
					wp_clear_scheduled_hook( $this->cron_hook );
				}
				if ( ! defined('WP_INSTALLING') &&
					! wp_next_scheduled( $this->cron_hook ) )
						wp_schedule_event( time(), $this->sched_name, $this->cron_hook );
			} else wp_clear_scheduled_hook( $this->cron_hook );
		}

		public function check_wpua( $current_wpua ) {
			global $wp_version;
			$default_wpua = 'WordPress/'.$wp_version.'; '.$this->home_url();
			if ( $default_wpua !== $current_wpua ) {
				if ( $this->p->debug->enabled )
					$this->p->debug->log( 'incorrect wpua found: '.$current_wpua );
				return $default_wpua;
			} else return $current_wpua;
		}
	
		public function allow_host( $allow, $ip, $url ) {
			if ( strpos( $url, '/'.$this->p->cf['allow_update_host'].'/' ) !== false ) {
				foreach ( self::$c as $lca => $info ) {
					$plugin_data = $this->get_json( $lca );
					if ( $url == $plugin_data->download_url ) {
						if ( $this->p->debug->enabled )
							$this->p->debug->log( 'allowing external host url: '.$url );
						return true;
					}
				}
			}
			return $allow;
		}

		public function inject_data( $result, $action = null, $args = null ) {
		    	if ( $action == 'plugin_information' && isset( $args->slug ) ) {
				foreach ( self::$c as $lca => $info ) {
					if ( ! empty( $info['slug'] ) && 
						$args->slug === $info['slug'] ) {
						$plugin_data = $this->get_json( $lca );
						if ( ! empty( $plugin_data ) ) 
							return $plugin_data->json_to_wp();
					}
				}
			}
			return $result;
		}

		// if updates have been disabled and/or manipulated (ie. $updates is not false), 
		// then re-enable by including our update data (if a new version is present)
		public function enable_update( $updates = false ) {
			if ( $updates !== false )
				$updates = $this->inject_update( $updates );
			return $updates;
		}

		public function inject_update( $updates = false ) {

			foreach ( self::$c as $lca => $info ) {
				if ( empty( $info['base'] ) ) {
					if ( $this->p->debug->enabled )
						$this->p->debug->log( $lca.' plugin: missing base value in configuration' );
					continue;
				}

				// remove existing information to make sure it is correct (not from wordpress.org)
				if ( isset( $updates->response[$info['base']] ) )
					unset( $updates->response[$info['base']] );		// nextgen-facebook/nextgen-facebook.php

				if ( isset( self::$c[$lca]['inject_update'] ) ) {
					// only return update information when an update is required
					if ( self::$c[$lca]['inject_update'] !== false )	// false when installed version is current
						$updates->response[$info['base']] = self::$c[$lca]['inject_update'];
					if ( $this->p->debug->enabled ) {
						$this->p->debug->log( $lca.' plugin: mark', 5 );	// show calling method/function
						$this->p->debug->log( $lca.' plugin: using saved update status' );
					}
					continue;	// get the next plugin
				}
				
				$option_data = self::get_option_data( $lca );

				if ( empty( $option_data ) ) {
					if ( $this->p->debug->enabled )
						$this->p->debug->log( $lca.' plugin: update option is empty' );
				} elseif ( empty( $option_data->update ) ) {
					if ( $this->p->debug->enabled )
						$this->p->debug->log( $lca.' plugin: no update information' );
				} elseif ( ! is_object( $option_data->update ) ) {
					if ( $this->p->debug->enabled )
						$this->p->debug->log( $lca.' plugin: update property is not an object' );
				} elseif ( version_compare( $option_data->update->version, $this->get_installed_version( $lca ), '>' ) ) {
					// save to local static cache as well
					self::$c[$lca]['inject_update'] = $updates->response[$info['base']] = $option_data->update->json_to_wp();
					if ( $this->p->debug->enabled ) {
						$this->p->debug->log( $lca.' plugin: update version ('.$option_data->update->version.')'.
							' is different than installed ('.$this->get_installed_version( $lca ).')' );
						$this->p->debug->log( $updates->response[$info['base']], 5 );
					}
				} else {
					self::$c[$lca]['inject_update'] = false;	// false when installed version is current
					if ( $this->p->debug->enabled ) {
						$this->p->debug->log( $lca.' plugin: installed version is current - no update required' );
						$this->p->debug->log( $option_data->update->json_to_wp(), 5 );
					}
				}
			}
			return $updates;
		}
	
		public function custom_schedule( $schedule ) {
			if ( $this->sched_hours > 0 ) {
				$schedule[$this->sched_name] = array(
					'interval' => $this->sched_hours * 3600,
					'display' => sprintf( 'Every %d hours', $this->sched_hours )
				);
			}
			return $schedule;
		}
	
		public function check_for_updates( $lca = null, $notice = false, $use_cache = true ) {
			if ( empty( $lca ) )
				$plugins = self::$c;				// check all plugins defined
			elseif ( isset( self::$c[$lca] ) )
				$plugins = array( $lca => self::$c[$lca] );	// check only one specific plugin
			else {
				if ( $this->p->debug->enabled )
					$this->p->debug->log( 'no plugins to check' );
				return;
			}
			foreach ( $plugins as $lca => $info ) {
				if ( $this->p->debug->enabled )
					$this->p->debug->log( 'checking for '.$lca.' plugin update' );

				$option_data = self::get_option_data( $lca );
				if ( empty( $option_data ) ) {
					$option_data = new StdClass;
					$option_data->lastCheck = 0;
					$option_data->checkedVersion = 0;
					$option_data->update = null;
				}
				$option_data->lastCheck = time();
				$option_data->checkedVersion = $this->get_installed_version( $lca );
				$option_data->update = $this->get_update_data( $lca, $use_cache );

				if ( self::update_option_data( $lca, $option_data ) ) {
					if ( $this->p->debug->enabled )
						$this->p->debug->log( $lca.' plugin: update information saved in '.$info['opt_name'].' option' );
					if ( $notice === true || $this->p->debug->enabled )
						$this->p->notice->inf( sprintf( __( 'Plugin update information for %s has been retrieved and saved.',
							$this->text_dom ), $info['name'] ), true );
				} elseif ( $this->p->debug->enabled ) {
					$this->p->debug->log( $lca.' plugin: failed saving update information in '.$info['opt_name'].' option' );
					$this->p->debug->log( $option_data );
				}
			}
		}
	
		public function get_update_data( $lca, $use_cache = true ) {
			$plugin_data = $this->get_json( $lca, $use_cache );
			if ( empty( $plugin_data ) ) {
				if ( $this->p->debug->enabled )
					$this->p->debug->log( $lca.' plugin: update data from get_json() is empty' );
				return null;
			} else return SucomPluginUpdate::from_plugin_data( $plugin_data );
		}
	
		public function get_json( $lca, $use_cache = true ) {
			if ( empty( self::$c[$lca]['slug'] ) )
				return null;

			global $wp_version;
			$home_url = $this->home_url();
			if ( $this->p->debug->enabled )
				$this->p->debug->log( 'home_url = '.$home_url );
			$json_url = empty( self::$c[$lca]['json_url'] ) ? '' : self::$c[$lca]['json_url'];
			$query = array( 'installed_version' => $this->get_installed_version( $lca ) );

			if ( empty( $json_url ) ) {
				if ( $this->p->debug->enabled )
					$this->p->debug->log( $lca.' plugin: exiting early - empty json_url' );
				return null;
			}
			
			if ( ! empty( $query ) ) 
				$json_url = add_query_arg( $query, $json_url );

			$cache_salt = __METHOD__.'(json_url:'.$json_url.'_home_url:'.$home_url.')';
			$cache_id = $this->p->cf['lca'].'_'.md5( $cache_salt );
			$cache_type = 'object cache';

			if ( $use_cache ) {
				$last_utime = get_option( $lca.'_utime' );
				if ( $this->p->is_avail['cache']['transient'] && $last_utime ) {
					$plugin_data = get_transient( $cache_id );
				} elseif ( $this->p->is_avail['cache']['object'] && $last_utime ) {
					$plugin_data = wp_cache_get( $cache_id, __METHOD__ );
				} elseif ( isset( self::$c[$lca]['plugin_data'] ) )
					$plugin_data = self::$c[$lca]['plugin_data'];
				if ( $plugin_data !== false )
					return $plugin_data;
			}

			$ua_plugin = self::$c[$lca]['slug'].'/'.$query['installed_version'];
			if ( has_filter( $lca.'_ua_plugin' ) )
				$ua_plugin = apply_filters( $lca.'_ua_plugin', $ua_plugin );
			else $ua_plugin = apply_filters( 'sucom_ua_plugin', $ua_plugin, $lca );
			$ua_wpid = 'WordPress/'.$wp_version.' ('.$ua_plugin.'); '.$home_url;

			$options = array(
				'timeout' => 10, 
				'user-agent' => $ua_wpid,
				'headers' => array( 
					'Accept' => 'application/json',
					'X-WordPress-Id' => $ua_wpid,
				),
			);

			$plugin_data = null;
			if ( $this->p->debug->enabled )
				$this->p->debug->log( $lca.' plugin: calling wp_remote_get() for '.$json_url );
			$result = wp_remote_get( $json_url, $options );
			if ( is_wp_error( $result ) ) {

				if ( isset( $this->p->notice ) && is_object( $this->p->notice ) )
					$this->p->notice->err( sprintf( __( 'Update error: %s',
						$this->text_dom ), $result->get_error_message() ) );
				if ( $this->p->debug->enabled )
					$this->p->debug->log( 'update error: '.$result->get_error_message() );

			} elseif ( isset( $result['response']['code'] ) && 
				$result['response']['code'] == 200 && ! empty( $result['body'] ) ) {

				if ( ! empty( $result['headers']['x-smp-error'] ) ) {
					self::$c[$lca]['umsg'] = json_decode( $result['body'] );
					update_option( $lca.'_umsg', base64_encode( self::$c[$lca]['umsg'] ) );
				} else {
					self::$c[$lca]['umsg'] = false;
					delete_option( $lca.'_umsg' );
					$plugin_data = SucomPluginData::from_json( $result['body'] );

					if ( empty( $plugin_data->plugin ) ) {
						if ( $this->p->debug->enabled )
							$this->p->debug->log( 'missing data: plugin property missing from json' );
					} elseif ( $plugin_data->plugin !== self::$c[$lca]['base'] ) {
						if ( $this->p->debug->enabled )
							$this->p->debug->log( 'incorrect data: plugin property '.$plugin_data->plugin.
								' does not match '.self::$c[$lca]['base'] );
						$plugin_data = null;
					}
				}
			}

			self::$c[$lca]['utime'] = time();
			update_option( $lca.'_utime', self::$c[$lca]['utime'] );

			if ( $this->p->is_avail['cache']['transient'] )
				set_transient( $cache_id, ( $plugin_data === null ?
					'' : $plugin_data ), self::$c[$lca]['expire'] );
			elseif ( $this->p->is_avail['cache']['object'] )
				wp_cache_set( $cache_id, ( $plugin_data === null ?
					'' : $plugin_data ), __METHOD__, self::$c[$lca]['expire'] );
			else self::$c[$lca]['plugin_data'] = $plugin_data;

			return $plugin_data;
		}
	
		public function get_installed_version( $lca ) {
			$version = 0;
			if ( isset( self::$c[$lca]['base'] ) ) {
				$base = self::$c[$lca]['base'];
				if ( ! function_exists( 'get_plugins' ) ) 
					require_once( ABSPATH.'/wp-admin/includes/plugin.php' );
				$plugins = get_plugins();
				if ( isset( $plugins[$base] ) ) {
					if ( isset( $plugins[$base]['Version'] ) ) {
						$version = $plugins[$base]['Version'];
						if ( $this->p->debug->enabled )
							$this->p->debug->log( $lca.' plugin: installed version is '.$version );
					} elseif ( $this->p->debug->enabled )
						$this->p->debug->log( $base.' does not have a Version key' );
				} elseif ( $this->p->debug->enabled )
					$this->p->debug->log( $base.' missing from the plugins array' );
			}
			if ( has_filter( $lca.'_installed_version' ) )
				return apply_filters( $lca.'_installed_version', $version );
			else return apply_filters( 'sucom_installed_version', $version, $lca );
		}

		// an unfiltered version of the same wordpress function
		private function home_url( $path = '', $scheme = null ) {
			return $this->get_home_url( null, $path, $scheme );
		}

		// an unfiltered version of the same wordpress function
		private function get_home_url( $blog_id = null, $path = '', $scheme = null ) {

			if ( empty( $blog_id ) || ! is_multisite() )
				$url = get_option( 'home' );
			else {
				switch_to_blog( $blog_id );
				$url = get_option( 'home' );
				restore_current_blog();
			}

			if ( ! in_array( $scheme, array( 'http', 'https', 'relative' ) ) ) {
				if ( is_ssl() && ! is_admin() && 'wp-login.php' !== $GLOBALS['pagenow'] )
					$scheme = 'https';
				else $scheme = parse_url( $url, PHP_URL_SCHEME );
			}

			$url = $this->set_url_scheme( $url, $scheme );

			if ( $path && is_string( $path ) )
				$url .= '/'.ltrim( $path, '/' );

			return $url;
		}

		// an unfiltered version of the same wordpress function
		private function set_url_scheme( $url, $scheme = null ) {

			if ( ! $scheme )
				$scheme = is_ssl() ? 'https' : 'http';
			elseif ( $scheme === 'admin' || $scheme === 'login' || $scheme === 'login_post' || $scheme === 'rpc' )
				$scheme = is_ssl() || force_ssl_admin() ? 'https' : 'http';
			elseif ( $scheme !== 'http' && $scheme !== 'https' && $scheme !== 'relative' )
				$scheme = is_ssl() ? 'https' : 'http';

			$url = trim( $url );
			if ( substr( $url, 0, 2 ) === '//' )
				$url = 'http:' . $url;

			if ( 'relative' == $scheme ) {
				$url = ltrim( preg_replace( '#^\w+://[^/]*#', '', $url ) );
				if ( $url !== '' && $url[0] === '/' )
					$url = '/'.ltrim( $url, "/ \t\n\r\0\x0B" );
			} else $url = preg_replace( '#^\w+://#', $scheme . '://', $url );

			return $url;
		}
	}
}
	
if ( ! class_exists( 'SucomPluginData' ) ) {

	class SucomPluginData {
	
		public $id = 0;
		public $name;
		public $slug;
		public $plugin;
		public $version;
		public $banners;
		public $homepage;
		public $sections;
		public $download_url;
		public $author;
		public $author_homepage;
		public $requires;
		public $tested;
		public $upgrade_notice;
		public $rating;
		public $num_ratings;
		public $downloaded;
		public $last_updated;
	
		public function __construct() {
		}

		public static function from_json( $json ) {
			$json_data = json_decode( $json );
			if ( empty( $json_data ) || 
				! is_object( $json_data ) ) 
					return null;
			if ( isset( $json_data->name ) && 
				! empty( $json_data->name ) && 
				isset( $json_data->version ) && 
				! empty( $json_data->version ) ) {

				$plugin_data = new SucomPluginData();
				foreach( get_object_vars( $json_data ) as $key => $value)
					$plugin_data->$key = $value;
				return $plugin_data;
			} else return null;
		}
	
		public function json_to_wp(){

			$fields = array(
				'name', 
				'slug', 
				'plugin', 
				'version', 
				'tested', 
				'num_ratings', 
				'homepage', 
				'download_url',
				'author_homepage',
				'requires', 
				'upgrade_notice',
				'rating', 
				'downloaded', 
				'last_updated',
			);
			$data = new StdClass;

			foreach ( $fields as $field ) {
				if ( isset( $this->$field ) ) {
					if ( $field == 'download_url' ) {
						$data->download_link = $this->download_url; }
					elseif ( $field == 'author_homepage' ) {
						$data->author = strpos( $this->author, '<a href=' ) === false ?
							sprintf( '<a href="%s">%s</a>', $this->author_homepage, $this->author ) :
							$this->author;
					} else { $data->$field = $this->$field; }
				} elseif ( $field == 'author_homepage' )
					$data->author = $this->author;
			}

			if ( is_array( $this->sections ) ) 
				$data->sections = $this->sections;
			elseif ( is_object( $this->sections ) ) 
				$data->sections = get_object_vars( $this->sections );
			else $data->sections = array( 'description' => '' );

			if ( is_array( $this->banners ) ) 
				$data->banners = $this->banners;
			elseif ( is_object( $this->banners ) ) 
				$data->banners = get_object_vars( $this->banners );

			return $data;
		}
	}
}
	
if ( ! class_exists( 'SucomPluginUpdate' ) ) {

	class SucomPluginUpdate {
	
		public $id = 0;
		public $slug;
		public $plugin;
		public $qty_used;
		public $version = 0;
		public $homepage;
		public $download_url;
		public $upgrade_notice;

		public function __construct() {
		}

		public function from_json( $json ) {
			$plugin_data = SucomPluginData::from_json( $json );
			if ( $plugin_data !== null ) 
				return self::from_plugin_data( $plugin_data );
			else return null;
		}
	
		public static function from_plugin_data( $data ){
			$plugin_update = new SucomPluginUpdate();
			$fields = array(
				'id', 
				'slug', 
				'plugin', 
				'qty_used', 
				'version', 
				'homepage', 
				'download_url', 
				'upgrade_notice'
			);
			foreach( $fields as $field )
				if ( isset( $data->$field ) )
					$plugin_update->$field = $data->$field;
			return $plugin_update;
		}
	
		public function json_to_wp() {
			$data = new StdClass;
			$fields = array(
				'id' => 'id',
				'slug' => 'slug',
				'plugin' => 'plugin',
				'qty_used' => 'qty_used',
				'new_version' => 'version',
				'url' => 'homepage',
				'package' => 'download_url',
				'upgrade_notice' => 'upgrade_notice'
			);
			foreach ( $fields as $new_field => $old_field ) {
				if ( isset( $this->$old_field ) )
					$data->$new_field = $this->$old_field;
			}
			return $data;
		}
	}
}

?>
