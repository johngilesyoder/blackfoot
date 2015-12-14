<?php

// CREATE THE SETTINGS PAGE
function awesome_weather_setting_page_menu()
{
	add_options_page( 'Awesome Weather', 'Awesome Weather', 'manage_options', 'awesome-weather', 'awesome_weather_page' );
}

function awesome_weather_page()
{
?>
<div class="wrap">
    <h2><?php _e('Awesome Weather Widget', 'awesome-weather-pro'); ?></h2>
    
    <?php if( isset($_GET['awesome-weather-cached-cleared']) ) { ?>
    <div id="setting-error-settings_updated" class="updated settings-error"> 
		<p><strong><?php _e('Weather Widget Cache Cleared', 'awesome-weather-pro'); ?></strong></p>
	</div>
	<?php } ?>
    
    <form action="options.php" method="POST">
        <?php settings_fields( 'awe-basic-settings-group' ); ?>
        <?php do_settings_sections( 'awesome-weather' ); ?>
        <?php submit_button(); ?>
    </form>
	<hr>
	<p>
		<a href="options-general.php?page=awesome-weather&action=awesome-weather-clear-transients" class="button"><?php _e('Clear all Awesome Weather Widget Cache', 'awesome-weather-pro'); ?></a>
	</p> 
</div>
<?php
}


// SET SETTINGS LINK ON PLUGIN PAGE
function awesome_weather_plugin_action_links( $links, $file ) 
{
	$settings_link = '<a href="' . admin_url( 'options-general.php?page=awesome-weather' ) . '">' . esc_html__( 'Settings', 'awesome-weather-pro' ) . '</a>';
	
	if ( $file == 'awesome-weather-pro/awesome-weather.php' )
	{
		array_unshift( $links, $settings_link );
	}
	
	if( !get_option('edd-auto-updater-email-account') )
	{
		$register_link = '<a href="' . admin_url( 'options-general.php?page=awesome-weather' ) . '">' . esc_html__( 'Register', 'awesome-weather-pro' ) . '</a>';
	
		if ( $file == 'awesome-weather-pro/awesome-weather.php' )
		{
			array_unshift( $links, $register_link );
		}
	}
	

	return $links;
}
add_filter( 'plugin_action_links', 'awesome_weather_plugin_action_links', 10, 2 );


add_action( 'admin_init', 'awesome_weather_setting_init' );
function awesome_weather_setting_init()
{
    register_setting( 'awe-basic-settings-group', 'edd-auto-updater-email-account' );
    register_setting( 'awe-basic-settings-group', 'aw-weather-provider' );
    register_setting( 'awe-basic-settings-group', 'open-weather-key' );
    register_setting( 'awe-basic-settings-group', 'aw-error-handling' );
    register_setting( 'awe-basic-settings-group', 'yahoo-weather-key' );
    //register_setting( 'awe-basic-settings-group', 'aw-location-url' );

    add_settings_section( 'awe-basic-settings', '', 'awesome_weather_api_keys_description', 'awesome-weather' );
	add_settings_field( 'edd-auto-updater-email-account', __('Register for Updates', 'awesome-weather-pro'), 'awesome_weather_updater_email', 'awesome-weather', 'awe-basic-settings' );
	add_settings_field( 'aw-weather-provider', __('Weather Provider', 'awesome-weather-pro'), 'awesome_weather_weather_provider', 'awesome-weather', 'awe-basic-settings' );
	add_settings_field( 'open-weather-key', __('OpenWeatherMaps APPID', 'awesome-weather-pro'), 'awesome_weather_openweather_key', 'awesome-weather', 'awe-basic-settings' );
	add_settings_field( 'yahoo-weather-key', __('Yahoo! Application ID', 'awesome-weather-pro'), 'awesome_weather_yahoo_key', 'awesome-weather', 'awe-basic-settings' );
	//add_settings_field( 'aw-location-url', __('Location Lookup URL', 'awesome-weather-pro'), 'awesome_weather_location_url', 'awesome-weather', 'awe-basic-settings' );
	add_settings_field( 'aw-error-handling', __('Error Handling', 'awesome-weather-pro'), 'awesome_weather_error_handling_setting', 'awesome-weather', 'awe-basic-settings' );


	if( isset($_GET['action']) AND $_GET['action'] == "awesome-weather-clear-transients")
	{
		awesome_weather_delete_all_transients();
		wp_redirect( "options-general.php?page=awesome-weather&awesome-weather-cached-cleared=true" );
		die;
	}

}




// DELETE ALL AWESOME WEATHER WIDGET TRANSIENTS
function awesome_weather_delete_all_transients_save( $value )
{
	awesome_weather_delete_all_transients();
	return $value;
}

function awesome_weather_delete_all_transients()
{
	global $wpdb;
	
	@setcookie("awe_city_id",0,time() - 3600);
	
	// DELETE TRANSIENTS
	$sql = "DELETE FROM $wpdb->options WHERE option_name LIKE '%_transient_awe_%'";
	$clean = $wpdb->query( $sql );
	return true;
}

function awesome_weather_api_keys_description() { }

function awesome_weather_openweather_key()
{
	$setting = esc_attr( get_option( 'open-weather-key' ) );
	echo "<input type='text' name='open-weather-key' value='$setting' style='width:70%;' />";
	echo "<p>";
	echo __("According to the OpenWeatherMaps website this key 'guarantees availability and accuracy of weather data.' ", 'awesome-weather-pro');
	echo "<a href='http://openweathermap.org/appid' target='_blank'>";
	echo __('Get your APPID', 'awesome-weather-pro');
	echo "</a>";
	echo "</p>";
}

function awesome_weather_yahoo_key()
{
	$setting = esc_attr( get_option( 'yahoo-weather-key' ) );
	echo "<input type='text' name='yahoo-weather-key' value='$setting' style='width:70%;' />";
	echo "<p>";
	echo __("To increase your API limits create a new project in the Yahoo Developer Network and post the application id here.", 'awesome-weather-pro');
	echo "<a href='https://developer.apps.yahoo.com/dashboard/createKey.html' target='_blank'>";
	echo __('Request an API Key', 'awesome-weather-pro');
	echo "</a>";
	echo "</p>";
}

function awesome_weather_location_url()
{
	$setting = esc_attr( get_option( 'aw-location-url' ) );
	if(!$setting) $setting = AWESOME_WEATHER_LOOKUP_URL;
	echo "<input type='text' name='aw-location-url' value='$setting' style='width:70%;' />";
	echo "<p>";
	echo __("Advanced Users: This is the URL to ping for location lookup services. Include [[IP]] where you want the IP to be swapped.", 'awesome-weather-pro');
	echo __("The return value needs to be a string of 'City, State' or an JSON object with variables like 'city' and/or 'state'.", 'awesome-weather-pro');
	echo "</p>";
}

function awesome_weather_weather_provider()
{
	if( defined('AWESOME_WEATHER_PRO_PROVIDER') )
	{
		echo "<em>" . __('Defined in wp-config', 'awesome-weather-pro') . "</em>";
	}
	else 
	{
		$setting = esc_attr( get_option( 'aw-weather-provider' ) );
		if(!$setting) $setting = "openweathermaps";
	
		echo "<input type='radio' name='aw-weather-provider' value='openweathermaps' " . checked( $setting, 'openweathermaps', false ) . " /> OpenWeatherMap &nbsp; &nbsp; ";
		echo "<input type='radio' name='aw-weather-provider' value='yahoo' " . checked( $setting, 'yahoo', false ) . " /> Yahoo!";
		echo "<p>";
		echo __("Where do you want your weather data to be provided from. If you change this, it's a good idea to clear the cache below.", 'awesome-weather-pro');
		echo "</p>";
	}
}

function awesome_weather_error_handling_setting()
{
	$setting = esc_attr( get_option( 'aw-error-handling' ) );
	if(!$setting) $setting = "source";
	
	echo "<input type='radio' name='aw-error-handling' value='source' " . checked( $setting, 'source', false ) . " /> " . __('Hidden in Source', 'awesome-weather-pro') . " &nbsp; &nbsp; ";
	echo "<input type='radio' name='aw-error-handling' value='display-admin' " . checked( $setting, 'display-admin', false ) . " /> " . __('Display if Admin', 'awesome-weather-pro') . " &nbsp; &nbsp; ";
	echo "<input type='radio' name='aw-error-handling' value='display-all' " . checked( $setting, 'display-all', false ) . " /> " . __('Display for Anyone', 'awesome-weather-pro') . " &nbsp; &nbsp; ";
	
	echo "<p>";
	echo __("What should the plugin do when there is an error?", 'awesome-weather-pro');
	echo "</p>";
}

function awesome_weather_updater_email()
{
	if( defined('AWESOME_WEATHER_PRO_LICENSE') )
	{
		echo "<em>" . __('Defined in wp-config', 'awesome-weather-pro') . "</em>";
	}
	else 
	{
		echo "<input type='text' name='edd-auto-updater-email-account' value='" . esc_attr( get_option( 'edd-auto-updater-email-account' ) ) . "' style='width:70%;' />";
		echo "<p>";
		echo __("This is used to update your plugin when new versions become available.", 'awesome-weather-pro');
		echo "&nbsp;";
		echo __("Insert the email address you used to purchase this plugin.", 'awesome-weather-pro');
		echo "</p>";
	}
}