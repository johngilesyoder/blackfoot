<?php
/*
Plugin Name: Awesome Weather Widget - PRO!
Plugin URI: https://halgatewood.com/awesome-weather
Description: A weather widget that actually looks cool and does amazing stuff.
Author: Hal Gatewood
Author URI: https://www.halgatewood.com
Text Domain: awesome-weather-pro
Domain Path: /languages
Version: 1.1.3


FILTERS AVAILABLE:
awesome_weather_cache 						= How many seconds to cache weather: default 1800 (half hour)
awesome_weather_ip_cache 					= How many seconds to cache ip location: default 15552000 (six months)
awesome_weather_ip_ping_data 				= Allows for custom IP Location ping results
awesome_weather_error 						= Error message if weather is not found
awesome_weather_sizes 						= array of sizes for widget
awesome_weather_extended_forecast_text 		= Change text of footer link
awesome_weather_location_lookup_url			= Change IP location lookup URL

*/

define( 'AWESOME_WEATHER_PRO_VERSION', '1.1.3' );
define( 'AWESOME_WEATHER_LOOKUP_URL', 'http://ipinfo.io/[[IP]]/json' );
define( 'AWESOME_WEATHER_PLUGIN_BASE', plugin_dir_url( __FILE__ ) );


// SETTINGS
$awesome_weather_sizes = apply_filters( 'awesome_weather_sizes' , array( 'tall' => __('Tall', 'awesome-weather-pro'), 'wide' => __('Wide', 'awesome-weather-pro'), 'micro' => __('Micro', 'awesome-weather-pro'), 'showcase' => __('Showcase', 'awesome-weather-pro'), 'long' => __('Long', 'awesome-weather-pro'), 'custom' => __('Custom', 'awesome-weather-pro') ) );


// SETUP
function awesome_weather_setup()
{
	load_plugin_textdomain( 'awesome-weather-pro', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	add_action(	'admin_menu', 'awesome_weather_setting_page_menu' );
}
add_action('plugins_loaded', 'awesome_weather_setup', 99999);



// ENQUEUE CSS
function awesome_weather_wp_head( ) 
{
	wp_enqueue_script( 'awesome_weather_pro', plugin_dir_url( __FILE__ ) . 'js/awesome-weather-widget-frontend.js', array('jquery'), '1.1', add_filter('awesome_weather_js_in_footer', false) );
	wp_enqueue_script( 'js-cookie', plugin_dir_url( __FILE__ ) . 'js/js-cookie.js', array('jquery'), '1.1', add_filter('awesome_weather_js_in_footer', false) );
	wp_enqueue_style( 'awesome-weather', plugins_url( '/awesome-weather.css', __FILE__ ) );
	wp_enqueue_style( 'opensans-googlefont', 'https://fonts.googleapis.com/css?family=Open+Sans:400,300' );
}
add_action('wp_enqueue_scripts', 'awesome_weather_wp_head');


//THE SHORTCODE
add_shortcode( 'awesome-weather', 'awesome_weather_shortcode' );
function awesome_weather_shortcode( $atts )
{
	return awesome_weather_logic( $atts );	
}


// THE LOGIC
function awesome_weather_logic( $atts )
{
	global $awesome_weather_sizes;
	
	$rtn 						= "";
	$add_to_transient			= "";
	$weather 					= new stdclass;
	$weather_data				= array();
	
	// DEFAULT SETTINGS
	$weather 	= new stdclass;
	$weather->transient_name 			= '';
	$weather->city_slug 				= '';
	$weather->api_query 				= '';
	$weather->units_query				= '';
	$weather->location					= isset($atts['location']) ? $atts['location'] : false;
	$weather->woeid						= isset($atts['woeid']) ? $atts['woeid'] : false;
	$weather->owm_city_id				= isset($atts['owm_city_id']) ? $atts['owm_city_id'] : false;
	$weather->user_location				= isset($atts['user_location']) ? $atts['user_location'] : false;
	$weather->widget_js_var				= isset($atts['widget_js_var']) ? $atts['widget_js_var'] : false;
	$weather->longlat_location			= isset($atts['longlat_location']) ? $atts['longlat_location'] : false;
	$weather->longlat_triggered			= isset($atts['longlat_triggered']) ? $atts['longlat_triggered'] : 0;

	$weather->template 					= isset($atts['size']) ? $atts['size'] : 'wide';
	$weather->template 					= isset($atts['template']) ? $atts['template'] : $weather->template;
	$weather->custom_template_name 		= isset($atts['custom_template_name']) ? $atts['custom_template_name'] : '';
	$weather->inline_style				= isset($atts['inline_style']) ? $atts['inline_style'] : '';

	$weather->units 					= (isset($atts['units']) AND $atts['units'] != "") ? $atts['units'] : false;
	$weather->override_title 			= isset($atts['override_title']) ? $atts['override_title'] : false;
	$weather->forecast_days 			= isset($atts['forecast_days']) ? $atts['forecast_days'] : 5;
	$weather->show_stats 				= (isset($atts['hide_stats']) AND $atts['hide_stats'] == 1) ? false : true;
	$weather->show_link 				= (isset($atts['show_link']) AND $atts['show_link'] == 1) ? true : false;
	$weather->show_icons 				= (isset($atts['show_icons']) AND $atts['show_icons'] == 1) ? 1 : 0;
	$weather->use_user_location 		= (isset($atts['use_user_location']) AND $atts['use_user_location'] == 1) ? 1 : 0;
	$weather->allow_user_to_change 		= (isset($atts['allow_user_to_change']) AND $atts['allow_user_to_change'] == 1) ? 1 : 0;
	
	$weather->extended_url 				= isset($atts['extended_url']) ? $atts['extended_url'] : '';
	$weather->extended_text 			= isset($atts['extended_text']) ? $atts['extended_text'] : '';
	
	$weather->background_classes 		= array();
	$weather->background_image 			= isset($atts['background']) ? $atts['background'] : false;
	$weather->background_image 			= isset($atts['background_image']) ? $atts['background_image'] : $weather->background_image;
	$weather->background_color 			= isset($atts['custom_bg_color']) ? $atts['custom_bg_color'] : false;
	$weather->background_color 			= isset($atts['background_color']) ? $atts['background_color'] : $weather->background_color;
	$weather->background_by_weather 	= (isset($atts['background_by_weather']) AND $atts['background_by_weather'] == 1) ? 1 : 0;
	$weather->text_color				= isset($atts['text_color']) ? $atts['text_color'] : '#ffffff';
	
	$weather->data 						= array();
	$weather->provider 					= (get_option( 'aw-weather-provider' ) != "") ? get_option( 'aw-weather-provider' ) : add_filter('awesome_weather_proivder', 'openweathermaps');

	
	// WEATHER PROVIDER CHECKS
	if( defined('AWESOME_WEATHER_PRO_PROVIDER') ) $weather->provider = AWESOME_WEATHER_PRO_PROVIDER;
	if( isset($atts['provider']) AND $atts['provider'] != $weather->provider ) $weather->provider = $atts['provider'];


	// SET AN ID
	$city_id = $weather->owm_city_id ? $weather->owm_city_id : $weather->woeid;
	
	
	// WEATHER UNITS
	if( !$weather->units ) $weather->units = "imperial";
	else if( strtoupper($weather->units) == "C" ) $weather->units = "metric";
	else if( strtoupper($weather->units) == "F" ) $weather->units = "imperial";
	$weather->units_display = ($weather->units == "metric") ? __('C', 'awesome-weather-pro') : __('F', 'awesome-weather-pro');
	
	
	// WEATHER UNITS TO QUERY APIs WITH
	if( $weather->provider == "yahoo")
	{
		$weather->units_query = ( $weather->units == "imperial" ) ? "f" : "c";
	}
	else
	{
		$weather->units_query = ( $weather->units == "imperial" ) ? "imperial" : "metric";
	}
	
	
	// USE CHANGE LOCATION CODE
	$weather->user_provided = false;
	$weather->show_bubble = true;
	
	if( $weather->allow_user_to_change )
	{
		if( $weather->longlat_triggered ) 
		{
			// IF TRIGGERED ( FROM LONG/LAT )
			$long_lat_city_id = awe_get_long_lat_city_id ( $weather );
			if( $long_lat_city_id )
			{
				$city_id = $weather->city_id = $long_lat_city_id;
				if( $weather->provider == "yahoo" )
				{
					$weather->woeid = $city_id;
				}
				else
				{
					$weather->owm_city_id = $city_id;
				}
				$weather->show_bubble = false;
				$weather->user_provided = true; 
			}	
		}
		elseif ( $weather->user_location )
		{
			// ELSEIF SEARCHED
			$weather->location = $weather->user_location;
			$local_id = awe_get_location_city_id ( $weather );
			if( $local_id )
			{
				$city_id = $weather->city_id = $local_id;
				if( $weather->provider == "yahoo" )
				{
					$weather->woeid = $local_id;
				}
				else
				{
					$weather->owm_city_id = $local_id;
				}
				$weather->show_bubble = false;
				$weather->user_provided = true; 
			}
			else
			{
				return "false";
			}
		}
		else if ( isset($_COOKIE['awe_city_id']) )
		{
			// ELSEIF COOKIE
			$city_id = $weather->city_id = (int) $_COOKIE['awe_city_id'];
			if( $weather->provider == "yahoo" )
			{
				$weather->woeid = $city_id;
			}
			else
			{
				$weather->owm_city_id = $city_id;
			}
			$weather->show_bubble = false;
			$weather->user_provided = true; 
		}
	}
	
	// IF NO WEATHER FROM USER, AND WITH CAN USE THE IP
	if( !$weather->user_provided AND $weather->use_user_location )
	{
		$weather->location_url = apply_filters( 'awesome_weather_location_lookup_url', AWESOME_WEATHER_LOOKUP_URL );
		$ip_city_id = awe_get_ip_city_id ( $weather );

		if( $ip_city_id )
		{
			$city_id = $weather->city_id = $ip_city_id;
			if( $weather->provider == "yahoo" )
			{
				$weather->woeid = $city_id;
			}
			else
			{
				$weather->owm_city_id = $city_id;
			}
			$weather->user_provided = true; 
		}	
	}
	
	
	// FILTER TO SHOW OR HIDE THE CHANGE YOUR WEATHER BUBBLE
	$weather->show_bubble = apply_filters('awesome_weather_show_bubble', $weather->show_bubble, $weather );
	
	
	// NEED SOMETHING TO WORK WITH, IF NOT, RETURN ERROR
	if( !$weather->location AND !$city_id ) { return awesome_weather_error( __('City Not Found','awesome-weather-pro') ); }
	

	// IF AUTO UNITS, CHECK CITY FOR LOCATION
	if( $weather->units == "auto" ) awe_get_units_from_city_id( $weather );

	
	// DEFAULT SETTINGS
	$weather->city_slug 				= $weather->location ? sanitize_title( $weather->location ) : $city_id;
	$weather->city_id					= $city_id;
	if(!$weather->widget_js_var) $weather->widget_js_var	= "awe_" . uniqid();
	
	
	// CONDITION CODES
	$days_of_week = apply_filters( 'awesome_weather_days_of_week', array( __('Sun' ,'awesome-weather-pro'), __('Mon' ,'awesome-weather-pro'), __('Tue' ,'awesome-weather-pro'), __('Wed' ,'awesome-weather-pro'), __('Thu' ,'awesome-weather-pro'), __('Fri' ,'awesome-weather-pro'), __('Sat' ,'awesome-weather-pro') ) );
	include_once( dirname(__FILE__) . "/pro/awesome-weather-codes.php");
	
	
	// FORECAST DAYS IN TRANSIENT
	if( $weather->forecast_days != "hide" ) $add_to_transient = "_f" . $weather->forecast_days;


	// WIND LABELS
	$awe_wind_label = array ( __('N', 'awesome-weather-pro'),__('NNE', 'awesome-weather-pro'),__('NE', 'awesome-weather-pro'),__('ENE', 'awesome-weather-pro'),__('E', 'awesome-weather-pro'),__('ESE', 'awesome-weather-pro'),__('SE', 'awesome-weather-pro'),__('SSE', 'awesome-weather-pro'),__('S', 'awesome-weather-pro'),__('SSW', 'awesome-weather-pro'),__('SW', 'awesome-weather-pro'),__('WSW', 'awesome-weather-pro'),__('W', 'awesome-weather-pro'),__('WNW', 'awesome-weather-pro'),__('NW', 'awesome-weather-pro'),__('NNW', 'awesome-weather-pro') );
			

	// TRANSIENT NAME
	$weather->transient_name 		= 'awe_' . $weather->city_id . '_' . strtolower($weather->units_display) . '_' . substr(get_locale(), 0 ,2)  . $add_to_transient;

	
	// WEATHER DATA
	$weather->data = apply_filters( 'awesome_weather_data', $weather->data, $weather);
	if( !$weather->data )
	{
		$awe_weather_functions 		= dirname(__FILE__) . "/pro/" . $weather->provider . "/funcs.php";
		$awe_weather_data 			= dirname(__FILE__) . "/pro/" . $weather->provider . "/data.php";
		
		// INCLUDE FUNCTIONS
		if( file_exists( $awe_weather_functions )) include_once( $awe_weather_functions );
		
		// INCLUDE FUNCTIONS
		if( file_exists( $awe_weather_data )) include( $awe_weather_data );
	}
	
	
	// IF USER INITIATED THE WEATHER, GET NEW OVERRIDE TITLE
	if( $weather->user_provided ) $weather->override_title =  $weather->data['name'];

	
	// EXTENDED FORECAST LINK
	if( !$weather->extended_url AND $weather->show_link AND $weather->provider == "openweathermaps") $weather->extended_url = "http://openweathermap.org/city/" . $weather->city_id;	

	
	// ESCAPE THE WEATHER URL IF WE HAVE IT
	if( $weather->extended_url ) $weather->extended_url = esc_url($weather->extended_url);

	
	// IF NOT EXTENDED FORECAST TEXT, SET DEFAULT
	if( !$weather->extended_text ) $weather->extended_text = apply_filters('awesome_weather_extended_forecast_text' , __('extended forecast', 'awesome-weather-pro'));

	
	// BACKGROUND COLORS
	if( $weather->background_color )
	{
		if( substr(trim($weather->background_color), 0, 1) != "#" AND substr(trim(strtolower($weather->background_color)), 0, 3) != "rgb" AND $weather->background_color != "transparent" ) { $weather->background_color = "#" . $weather->background_color; }
		$weather->inline_style .= " background-color: {$weather->background_color};";
		$weather->background_classes[] = "custom-bg-color";
	}
	elseif( isset($weather->data['current']) )
	{
		// COLOR OF WIDGET
		$today_temp = $weather->data['current']['temp'];
		if($weather->units_query == "f" OR $weather->units_query == "imperial" )
		{
			if($today_temp < 31) $weather->background_classes[] = "temp1";
			if($today_temp > 31 AND $today_temp < 40) $weather->background_classes[] = "temp2";
			if($today_temp >= 40 AND $today_temp < 50) $weather->background_classes[] = "temp3";
			if($today_temp >= 50 AND $today_temp < 60) $weather->background_classes[] = "temp4";
			if($today_temp >= 60 AND $today_temp < 80) $weather->background_classes[] = "temp5";
			if($today_temp >= 80 AND $today_temp < 90) $weather->background_classes[] = "temp6";
			if($today_temp >= 90) $weather->background_classes[] = "temp7";
		}
		else
		{
			if($today_temp < 1) $weather->background_classes[] = "temp1";
			if($today_temp > 1 AND $today_temp < 4) $weather->background_classes[] = "temp2";
			if($today_temp >= 4 AND $today_temp < 10) $weather->background_classes[] = "temp3";
			if($today_temp >= 10 AND $today_temp < 15) $weather->background_classes[] = "temp4";
			if($today_temp >= 15 AND $today_temp < 26) $weather->background_classes[] = "temp5";
			if($today_temp >= 26 AND $today_temp < 32) $weather->background_classes[] = "temp6";
			if($today_temp >= 32) $weather->background_classes[] = "temp7";
		}
	}

	// DATA
	$header_title = $weather->override_title ? $weather->override_title : $weather->location;
	
	$weather->background_classes[] = "awesome-weather-wrap";
	$weather->background_classes[] = "awecf";
	$weather->background_classes[] = ($weather->show_stats) ? "awe_with_stats" : "awe_without_stats";
	$weather->background_classes[] = ($weather->show_icons) ? "awe_with_icons" : "awe_without_icons";
	$weather->background_classes[] = ($weather->forecast_days == "hide") ? "awe_without_forecast" : "awe_with_forecast";
	$weather->background_classes[] = ($weather->extended_url) ? "awe_extended" : "";
	$weather->background_classes[] = "awe_" . $weather->template;
	
	
	// BACKGROUND IMAGE, ADD DARKEN CLASS
	if($weather->background_image) $weather->background_classes[] = "darken";
	if($weather->allow_user_to_change) $weather->background_classes[] = "awe_changeable";

	
	// WEATHER CONDITION CSS
	$weather_code = $weather_description_slug = ''; 
	if( isset($weather->data['current']) )
	{
		$weather_code = $weather->data['current']['condition_code'];
		$weather_description_slug = sanitize_title( $weather->data['current']['description'] );
		
		$weather->background_classes[] = "awe-code-" . $weather_code;
		$weather->background_classes[] = "awe-desc-" . sanitize_title( $weather_description_slug );
	}
	
	
	// CHECK FOR BACKGROUND BY WEATHER
	if( $weather->background_by_weather AND ( $weather_code OR $weather_description_slug ) )
	{
		if( file_exists( get_stylesheet_directory() . "/awe-backgrounds" ) )
		{
			$bg_ext = apply_filters('awesome_weather_bg_ext', 'jpg' );
			
			// CHECK FOR CODE
			if( $weather_code AND file_exists( get_stylesheet_directory() . "/awe-backgrounds/" . $weather_code . "." . $bg_ext))
			{
				$weather->background_image = get_stylesheet_directory_uri() . "/awe-backgrounds/" . $weather_code . "." . $bg_ext;
			}
			else if( $weather_description_slug AND file_exists( get_stylesheet_directory() . "/awe-backgrounds/" . $weather_description_slug . "." . $bg_ext))
			{
				$weather->background_image = get_stylesheet_directory_uri() . "/awe-backgrounds/" . $weather_description_slug . "." . $bg_ext;
			}
			else
			{
				// PRESET WEATHER NAMES
				if( $weather->provider == "openweathermaps" )
				{
					$preset_background_img_name = awesome_weather_preset_condition_names_openweathermaps($weather_code);
				}
				else if ( $weather->provider == "yahoo" ) 
				{
					$preset_background_img_name = awesome_weather_preset_condition_names_yahoo($weather_code);
				}
				
				if( $preset_background_img_name )
				{
					$weather->background_classes[] = "awe-preset-" . $preset_background_img_name;
					if( file_exists( get_stylesheet_directory() . "/awe-backgrounds/" . $preset_background_img_name . "." . $bg_ext) ) $weather->background_image = get_stylesheet_directory_uri() . "/awe-backgrounds/" . $preset_background_img_name . "." . $bg_ext;
				}
			}
		}
		else
		{
			// USE LOCAL PRESET IMAGES
			if( $weather->provider == "openweathermaps" )
			{
				$preset_background_img_name = awesome_weather_preset_condition_names_openweathermaps($weather_code);
			}
			else if ( $weather->provider == "yahoo" ) 
			{
				$preset_background_img_name = awesome_weather_preset_condition_names_yahoo($weather_code);
			}

			if( $preset_background_img_name )
			{
				$weather->background_classes[] = "awe-preset-" . $preset_background_img_name;
				if( file_exists( dirname(__FILE__) . "/img/awe-backgrounds/" . $preset_background_img_name . ".jpg") ) $weather->background_image = AWESOME_WEATHER_PLUGIN_BASE . "/img/awe-backgrounds/" . $preset_background_img_name . ".jpg";
			}
		}
	}
	
	
	// TEXT COLOR
	if( substr(trim($weather->text_color), 0, 1) != "#" ) $weather->text_color = "#" . $weather->text_color;
	$weather->inline_style .= " color: {$weather->text_color}; ";
	
	
	// PREP INLINE STYLE
	$inline_style = "";
	if($weather->inline_style != "") { $inline_style = " style=\"{$weather->inline_style}\""; }
	
	
	// PREP BACKGROUND CLASSES
	$background_classes = @implode( " ", apply_filters( 'awesome_weather_background_classes', $weather->background_classes ));
	
	
	// CREATE SHORT VARIABLES TO WORK WITH IN TEMPLATES
	$weather_forecast = array();
	if( isset($weather->data['forecast']) ) $weather_forecast = (array) $weather->data['forecast'];

	
	// GET TEMPLATE 
	ob_start();
	
	
	// IF USER CAN CHANGE, SET JSON OBJECT OF WEATHER
	if( $weather->allow_user_to_change AND !isset($atts['via_ajax']) )
	{
		$json = clone $weather;
		$json->action = "awesome_weather_refresh";
		$json->longlat_location = '0';
		$json->user_location = '0';
		$json->via_ajax = '1';
		$json->data = false;
		echo "<script>
					if( typeof awe == 'undefined') { var awe = []; }
					awe['ajaxurl'] = '" . admin_url('admin-ajax.php') . "'; 
					awe['awe_weather_widget_json_" . $weather->widget_js_var . "'] = " . json_encode($json) . ";
			</script>";
	}
	
	if( $weather->template != "custom")
	{
		$awe_weather_template = dirname(__FILE__) . "/templates/" . $weather->template . ".php";
		
		if( file_exists( $awe_weather_template ) )
		{
			include( $awe_weather_template );
		}
		else
		{
			return awesome_weather_error( __('Weather template not found:', 'awesome-weather-pro') . " " . $weather->template );
		}
	}
	else
	{
		// GET CUSTOM TEMPLATE
		$custom_template_name = $weather->custom_template_name;
		$template = locate_template( array( "awe-{$custom_template_name}.php" ) );
		
		if($template)
		{
			include( $template );
		}
		else
		{
			return awesome_weather_error( __('Custom template file not found. Please add a file to your theme folder with this name:', 'awesome-weather-pro' ) . " awe-" . $custom_template_name . ".php" ); 
		}
	}
	
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}


// RETURN ERROR
function awesome_weather_error( $msg = false )
{
	$error_handling = get_option( 'aw-error-handling' );
	if(!$error_handling) $error_handling = "source";
	if(!$msg) $msg = __('No weather information available', 'awesome-weather-pro');
	
	if( $error_handling == "display-admin")
	{
		// DISPLAY ADMIN
		if ( current_user_can( 'manage_options' ) ) 
		{
			echo "<div class='awesome-weather-error'>" . $msg . "</div>";
		}
	}
	else if( $error_handling == "display-all")
	{
		// DISPLAY ALL
		echo "<div class='awesome-weather-error'>" . $msg . "</div>";
	}
	else
	{
		return apply_filters( 'awesome_weather_error', "<!-- AWESOME WEATHER ERROR: " . $msg . " -->" );
	}
}


// ENQUEUE ADMIN SCRIPTS
function awesome_weather_admin_scripts( $hook )
{
	if( 'widgets.php' != $hook ) return;
	
	wp_enqueue_style('jquery');
	wp_enqueue_style('underscore');
    wp_enqueue_script( 'awesome_weather_admin_script', plugin_dir_url( __FILE__ ) . '/js/awesome-weather-widget-admin.js', array('jquery', 'underscore') );
	wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('wp-color-picker');
    
	wp_localize_script( 'awesome_weather_admin_script', 'awe_script', array(
			'no_owm_city'				=> esc_attr(__("No city found in OpenWeatherMap.", 'awesome-weather-pro')),
			'one_city_found'			=> esc_attr(__('Only one location found. The ID has been set automatically above.', 'awesome-weather-pro')),
			'confirm_city'				=> esc_attr(__('Please confirm your city: &nbsp;', 'awesome-weather-pro')),
			'no_yahoo_city'				=> esc_attr(__("No city found in Yahoo Weather.", 'awesome-weather-pro')),
		)
	);
}
add_action( 'admin_enqueue_scripts', 'awesome_weather_admin_scripts' );



// WIDGET CODE
require_once(dirname(__FILE__) . "/widget.php");



// PING YAHOO FOR WOEID
add_action( 'wp_ajax_awe_ping_yahoo_for_woeid', 'awe_ping_yahoo_for_woeid');
function awe_ping_yahoo_for_woeid( )
{
	$location = urlencode($_GET['location']);
	$yahoo_ping = "https://query.yahooapis.com/v1/public/yql?q=select%20woeid,name,state,admin1.content,country.code%20from%20geo.places%20where%20text%3D%22" . $location . "%22%20&diagnostics=false&format=json";
	$yahoo_ping_get = wp_remote_get( $yahoo_ping );
	echo $yahoo_ping_get['body'];
	die;
}

function awe_ping_yahoo_for_woeid_return( $location ) 
{
	$yahoo_ping = "https://query.yahooapis.com/v1/public/yql?q=select%20woeid,name,state,admin1.content,country.code%20from%20geo.places%20where%20text%3D%22" . urlencode($location) . "%22%20&diagnostics=false&format=json";
	$yahoo_ping_get = wp_remote_get( $yahoo_ping );
	return json_decode( $yahoo_ping_get['body'] );
}

function awe_ping_yahoo_first_results( $location )
{
	$results = awe_ping_yahoo_for_woeid_return( $location );
	
	if( !isset($results->query) ) return false;
	if( !isset($results->query->count)  AND $results->query->count > 0 ) return false;
	
	if( $results->query->count == 1 AND isset($results->query->results->place->woeid) )
	{
		// OBJECT
		return $results->query->results->place;
	}
	
	if( $results->query->count > 1)
	{
		// ARRAY OF OBJS
		if( isset($results->query->results->place[0]) )
		{
			$first = $results->query->results->place[0];
			
			if( isset( $first->woeid ))
			{
				return $first;
			}
		}
	}
	
	return false;
}



// PING OPENWEATHER FOR OWMID
add_action( 'wp_ajax_awe_ping_owm_for_id', 'awe_ping_owm_for_id');
function awe_ping_owm_for_id( )
{
	$appid_string = '';
	$appid = get_option( 'open-weather-key' );
	if($appid) $appid_string = '&APPID=' . $appid;
	$location = urlencode($_GET['location']);
	$units = $_GET['location'] == "C" ? "metric" : "imperial";
	$owm_ping = "http://api.openweathermap.org/data/2.5/find?q=" . $location ."&units=" . $units . "&mode=json" . $appid_string;
	$owm_ping_get = wp_remote_get( $owm_ping );
	echo $owm_ping_get['body'];
	die;
}

function awe_ping_owm_first_results( $location, $units )
{
	$appid_string = '';
	$appid = get_option( 'open-weather-key' );
	if($appid) $appid_string = '&APPID=' . $appid;	
		
	$owm_ping = "http://api.openweathermap.org/data/2.5/find?q=" . urlencode($location) ."&units=" . $units . "&mode=json" . $appid_string;
	$owm_ping_get = wp_remote_get( $owm_ping );
	$body = json_decode($owm_ping_get['body']);
	
	if( !$body->count )
	{
		return false;
	}
	else
	{
		return $body->list[0];
	}
}


// GET CITY ID BY LOCATION
function awe_get_location_city_id ( $weather )
{
	if( $weather->provider == "yahoo" )
	{
		$local = awe_ping_yahoo_first_results( $weather->location ); 
		if( $local->woeid ) return $local->woeid;
	}
	else
	{
		$local = awe_ping_owm_first_results( $weather->location, $weather->units );
		if( $local->id ) return $local->id;
	}
	return false;
}


// GET CITY ID BY LONG LAT
function awe_get_long_lat_city_id ( $weather )
{
	if( $weather->provider == "yahoo" )
	{
		$longlat_ping_url = "https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20geo.placefinder%20where%20text%3D%22" . urlencode($weather->longlat_location). "%22%20and%20gflags%3D%22R%22&format=json";
		$longlat_ping_get = wp_remote_get( $longlat_ping_url );
		if( !is_wp_error( $longlat_ping_get ) AND isset($longlat_ping_get['body']) AND $longlat_ping_get['body'] != "" ) 
		{
			$ping_data = json_decode( $longlat_ping_get['body'] );
			if( $ping_data->query->count == 1 AND isset($ping_data->query->results->Result->woeid) )
			{
				return $ping_data->query->results->Result->woeid;
			}
		}
	}
	else
	{
		$appid_string = '';
		$appid = get_option( 'open-weather-key' );
		if($appid) $appid_string = '&APPID=' . $appid;	
		
		$lat_lon = explode(",",$weather->longlat_location);
		$api_query	= "lat=" . $lat_lon[0] . "&lon=" . $lat_lon[1];
		$longlat_ping_url = "http://api.openweathermap.org/data/2.5/weather?" . $api_query . $appid_string;
		$longlat_ping_get = wp_remote_get( $longlat_ping_url );
		if( !is_wp_error( $longlat_ping_get ) AND isset($longlat_ping_get['body']) AND $longlat_ping_get['body'] != "" ) 
		{
			$ping_data = json_decode( $longlat_ping_get['body'] );
			if( $ping_data AND $ping_data->id )
			{
				return $ping_data->id;
			}
		}
	}
	return false;
}


// GET CITY ID FROM IP
function awe_get_ip_city_id( &$weather )
{
	$ip = $_SERVER['REMOTE_ADDR'];
	//$ip = "68.12.196.42"; // OKC
	//$ip = "72.229.28.185"; // NYC
	$ip_hash = str_replace(".","_", $ip);
	$ip_transient_name = $weather->ip_transient_name = 'awe_ip_' . $ip_hash;
	
	
	// CLEAR CACHE
    if( isset($_GET['clear_awesome_widget']) ) delete_transient( $ip_transient_name );


	// CHECK TRANSIENT
	if( get_transient( $ip_transient_name ) )
	{
		$location = get_transient( $ip_transient_name );	
		if( $location->id )
		{
			$weather->show_bubble = false;
			return $location->id;
		}
	}
	
	
	// GET CITY ID
	$location_ping_url = str_replace('[[IP]]', $ip, $weather->location_url );
	$location_ping_get = wp_remote_get( $location_ping_url );
	if( !is_wp_error( $location_ping_get ) AND isset($location_ping_get['body']) AND $location_ping_get['body'] != "" ) 
	{	
		$ping_data = json_decode( apply_filters('awesome_weather_ip_ping_data', $location_ping_get['body']) );
		
		$cached_obj = new stdclass;
		$cached_obj->id = false;

		// USE LONG/LAT
		if( isset($ping_data->loc) AND $ping_data->loc != "" )
		{
			$weather->longlat_location = $ping_data->loc;
			$loc_id = awe_get_long_lat_city_id( $weather );
			if( $loc_id ) 
			{
				$cached_obj->id = $loc_id;
				set_transient( $ip_transient_name, $cached_obj, apply_filters( 'awesome_weather_ip_cache', 15552000 ) );
				return $loc_id;
			}
		}
		
		// IF REGION AND CITY USE THAT
		if( isset($ping_data->region) AND $ping_data->region != "" AND isset($ping_data->city) )
		{
			$weather->location 	= $ping_data->city . ", " . $ping_data->region;
		}
		else if( isset($ping_data->city) )
		{
			// IF JUST CITY USE IT
			$weather->location 	= $ping_data->city;
		}
		
		if( $weather->location )
		{
			$local_id = awe_get_location_city_id ( $weather );
			if( $local_id )
			{
				$cached_obj->id = $local_id;
				set_transient( $ip_transient_name, $cached_obj, apply_filters( 'awesome_weather_ip_cache', 31104000 ) );
				return $local_id;	
			}
		}
	}
	return false;
}


// GET CITY ID FROM IP
function awe_get_units_from_city_id( &$weather )
{
	
	// CACHE TRANSIENT
	$transient_name = 'awe_city_u_' . $weather->provider . '_' . $weather->city_id;

	// CLEAR CACHE
    if( isset($_GET['clear_awesome_widget']) ) delete_transient( $transient_name );


	// CHECK TRANSIENT
	if( get_transient( $transient_name ) ) 
	{
		$cached_obj = get_transient( $transient_name );
		
		if( $cached_obj->units_query AND $cached_obj->units_display )
		{
			$weather->units_query 		= $cached_obj->units_query;
			$weather->units_display 	= $cached_obj->units_display;
			return get_transient( $transient_name );
		}
	}

	
	// GET UNITS
	$cached_obj = new stdclass;
	$cached_obj->units = $weather->units;
	$cached_obj->units_query = $weather->units_query;
	
	if( $weather->provider == "yahoo" )
	{
		$yahoo_ping = "https://query.yahooapis.com/v1/public/yql?format=json&q=";
		$yahoo_select = "select * from geo.placefinder where woeid={$weather->woeid}";
		$yahoo_ping = $yahoo_ping . urlencode($yahoo_select) . $appid_string;
		
		$ping_get = wp_remote_get( $yahoo_ping );
		if( !is_wp_error( $ping_get ) AND isset($ping_get['body']) AND $ping_get['body'] != "" ) 
		{
			$ping_data = json_decode( $ping_get['body'] );
			if( $ping_data->query->count == 1 AND isset($ping_data->query->results->Result->countrycode) )
			{
				if( $ping_data->query->results->Result->countrycode == "US" )
				{
					$weather->units_query 		= $cached_obj->units_query 		= "f";
					$weather->units_display 	= $cached_obj->units_display 	= "F";
				}
				else
				{
					$weather->units_query 		= $cached_obj->units_query 		= "c";
					$weather->units_display 	= $cached_obj->units_display 	= "C";
				}
			}
		}
	}
	else
	{
		$ping = "http://api.openweathermap.org/data/2.5/weather?id=" . $weather->owm_city_id . "&lang=en&units=" . $weather->units_query . $appid_string;
		$ping_get = wp_remote_get( $ping );
		
		if( !is_wp_error( $ping_get ) AND isset($ping_get['body']) AND $ping_get['body'] != "" ) 
		{
			$ping_data = json_decode( $ping_get['body'] );
			if( isset($ping_data->sys) AND isset($ping_data->sys->country) )
			{
				if( $ping_data->sys->country == "US" )
				{
					$weather->units_query 		= $cached_obj->units_query 		= "imperial";
					$weather->units_display 	= $cached_obj->units_display 	= "F";
				}
				else
				{
					$weather->units_query 		= $cached_obj->units_query 		= "metric";
					$weather->units_display 	= $cached_obj->units_display 	= "C";
				}
			}
		}
	}
	
	set_transient( $transient_name, $cached_obj, apply_filters( 'awesome_weather_result_auto_units_cache', 31104000 ) );
	return $cached_obj;
}



// CONVERSIONS
function awe_c_to_f( $c )
{
	return round( ( $c * 1.8 ) + 32);
}

function awe_f_to_c( $f )
{
	return round(($f- 32) / 1.8);
}


// CHANGE WEATHER FORM
function awe_change_weather_form( $weather )
{
	if( ! $weather->allow_user_to_change ) return "";
	
	$template = locate_template( array( "awesome-weather-form.php" ) );
	if($template)
	{
		include( $template );
	}
	else
	{
		include(dirname(__FILE__) . "/pro/awesome-weather-form.php");
	}
}

function awe_change_weather_trigger( $weather )
{
	if( ! $weather->allow_user_to_change ) return "";
	
	$template = locate_template( array( "awesome-weather-trigger.php" ) );
	if($template)
	{
		include( $template );
	}
	else
	{
		include(dirname(__FILE__) . "/pro/awesome-weather-trigger.php");
	}
}


function awesome_weather_refresh()
{
	echo awesome_weather_logic( $_POST );
	wp_die();
}
add_action( 'wp_ajax_awesome_weather_refresh', 'awesome_weather_refresh' );
add_action( 'wp_ajax_nopriv_awesome_weather_refresh', 'awesome_weather_refresh' );



// SETTINGS
require_once(dirname(__FILE__) . "/pro/awesome-weather-settings.php");


// EDD AUTO UPLOADER
if( is_admin() AND ( get_option('edd-auto-updater-email-account') OR defined('AWESOME_WEATHER_PRO_LICENSE') ) )
{
	$edd_auto_updater_script = dirname(__FILE__) . "/edd-remote-auto-updater.php";
	
	if( !class_exists('edd_remote_auto_updater') AND file_exists($edd_auto_updater_script) )
	{
		include_once($edd_auto_updater_script);
	}
	
	$updater_email = get_option('edd-auto-updater-email-account');
	if( defined('AWESOME_WEATHER_PRO_LICENSE') ) $updater_email = AWESOME_WEATHER_PRO_LICENSE;

	
	if( class_exists('edd_remote_auto_updater') )
	{
		// vars
		$settings = array(
			'version' 		=> AWESOME_WEATHER_PRO_VERSION,
			'remote' 		=> 'https://halgatewood.com/',
			'slug' 			=> 'awesome-weather-widget-pro',
			'email'			=> $updater_email,
			'basename' 		=> plugin_basename(__FILE__)
		);
		
		new edd_remote_auto_updater( $settings );
	}
}
