<?php

// YAHOO WEATHER DATA


// CLEAR THE TRANSIENT
if( isset($_GET['clear_awesome_widget']) ) delete_transient( $weather->transient_name );


// GET WEATHER DATA FROM CACHE
if( get_transient( $weather->transient_name ) ) $weather_data = get_transient( $weather->transient_name );


// IF APPID, WE USE IT
$appid_string = '';
$appid = get_option( 'yahoo-weather-key' );
if($appid) $appid_string = '&appid=' . $appid;


// IF WE DON'T HAVE ANYTHING, GRAB NEW DATA
if( !$weather_data AND $weather->woeid )
{
	$weather_data['current'] 	= array();
	$weather_data['forecast']	= array();
	$weather->pings				= array();
	
				
	// PING YAHOO		
	$yahoo_ping = "http://query.yahooapis.com/v1/public/yql?format=json&q=";
	$yahoo_select = "select * from weather.forecast where woeid={$weather->woeid} and u='" . strtolower($weather->units_query) . "'";
	$yahoo_ping = $yahoo_ping . urlencode($yahoo_select) . $appid_string;

	$yahoo_ping_get = wp_remote_get( $yahoo_ping );
	$weather->pings[] = $yahoo_ping;
		
	if( is_wp_error( $yahoo_ping_get ) ) 
	{
		return awesome_weather_error( $yahoo_ping_get->get_error_message()  ); 
	}	

	// PARSE UP THE GOODS
	$y_weather 		= json_decode($yahoo_ping_get['body']);
	
	
	
	if( !$y_weather->query->count )
	{
		return awesome_weather_error( __('No results found for this request', 'awesome-weather-pro') ); 
	}
	

	// SET SOME HELPERS FOR SMALLER VARIABLES
	$yw_channel 	= $y_weather->query->results->channel;
	$item_yweather 	= $y_weather->query->results->channel->item;
	$yw_forecast 	= $item_yweather->forecast;
	
	// SET A NAME
	if( $yw_channel->location->city ) $weather_data['name'] = $yw_channel->location->city;


	// GET CURRENT TIMESTAMP IN THE CORRECT TIMEZONE
	// USED TO BLOCK OUT THE FIRST DAY OF THE FORECAST AT THE RIGHT TIME
	$current_timezone = date_default_timezone_get();
	date_default_timezone_set( get_option('timezone_string') );

	$awesome_weather_timezone_ymd 	= date( 'Ymd', current_time( 'timestamp', 0 ) );
	$dt_today_d 					= date( 'D', current_time( 'timestamp', 0 ) );
	
	if( class_exists('DateTime') AND get_option('timezone_string'))
	{
		try 
		{
			$awesome_weather_timezone_obj	 		= new DateTimeZone( get_option('timezone_string') );
			$awesome_weather_timestamp_obj 			= new DateTime("now", $awesome_weather_timezone_obj);
	
			$awesome_weather_timezone_ymd 			= date('Ymd', $awesome_weather_timestamp_obj->getTimestamp());
			$dt_today_d 							= date( 'D', $awesome_weather_timestamp_obj->getTimestamp() );
		} 
		catch (Exception $e) { }
	}

	
	// CONVERT NEW OBJECTS TO ARRAY FOR BACKWARD COMPAT.
	foreach( $yw_forecast as $c => $yw_forecast_day ) $yw_forecast[$c] = (array) $yw_forecast_day;
	
	// NORMALIZE WEATHER DATA VARIABLES,
	// SO THEY ARE THE SAME FOR ALL WEATHER PROVIDERS
	$weather_forecast_first_day 			= $yw_forecast[0];
	
	$weather_data['current']['temp']		= $item_yweather->condition->temp;
	$weather_data['current']['high']		= $weather_forecast_first_day['high'];
	$weather_data['current']['low']			= $weather_forecast_first_day['low'];
	
	$weather_data['current']['humidity'] 	= $yw_channel->atmosphere->humidity;
	$weather_data['current']['pressure'] 	= $yw_channel->atmosphere->pressure;
	
	// SUN
	$weather_data['current']['sunrise'] 	= $yw_channel->astronomy->sunrise;
	$weather_data['current']['sunset'] 		= $yw_channel->astronomy->sunset;
		
	// WIND
	$wind_direction = apply_filters('awesome_weather_wind_direction', fmod((($yw_channel->wind->direction + 11) / 22.5),16));
	$weather_data['current']['wind_speed'] 			= apply_filters('awesome_weather_wind_speed', round($yw_channel->wind->speed));		
	$weather_data['current']['wind_direction'] 		= $awe_wind_label[ $wind_direction ];
	$weather_data['current']['wind_speed_text'] 	= apply_filters('awesome_weather_wind_speed_text', $yw_channel->units->speed);	
		
	// CODE
	$weather_data['current']['condition_code'] 	= $item_yweather->condition->code;
	$weather_data['current']['description'] 	= awesome_weather_get_desc_from_id_yahoo( $item_yweather->condition->code );
	$weather_data['current']['icon'] 			= awesome_weather_get_icon_from_id_yahoo( $item_yweather->condition->code );


	// REMOVE TODAY FROM FORECAST
	if( $weather->forecast_days != "hide" )
	{
		$day_count = 1;
		$forecast = array();
		
		foreach( $yw_forecast as $forecast_day )
		{
			$day = new stdclass;
			$day->timestamp 		= strtotime( $forecast_day['date'] );
			$day_timestamp_ymd 		= date('Ymd', $day->timestamp);
			
			if( $awesome_weather_timezone_ymd >= $day_timestamp_ymd ) continue;

			$day->day_of_week 	= $days_of_week[ date('w', $day->timestamp ) ];
			$day->temp 			= $forecast_day['high'];
			$day->high 			= $forecast_day['high'];
			$day->low 			= $forecast_day['low'];
			
			$day->condition_code 	= $forecast_day['code'];
			$day->description 		= awesome_weather_get_desc_from_id_yahoo( $forecast_day['code'] );
			$day->icon 				= awesome_weather_get_icon_from_id_yahoo( $forecast_day['code'] );

			$forecast[] = $day;
			if($day_count == $weather->forecast_days) break;
			$day_count++;
		}
		
		$weather_data['forecast'] = $forecast;
	}
	
	date_default_timezone_set( $current_timezone );
	
	// SET THE TRANSIENT, CACHE FOR 30 MINUTES
	if($weather_data['current'] AND $weather_data['forecast'])
	{
		set_transient( $weather->transient_name, $weather_data, apply_filters( 'awesome_weather_cache', 1800 ) ); 
	}
}



// SET THE WEATHER DATA
$weather->data = $weather_data;
