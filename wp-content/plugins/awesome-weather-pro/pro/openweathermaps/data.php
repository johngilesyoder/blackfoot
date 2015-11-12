<?php

// OPENWEATHERMAPS WEATHER DATA


// FIND AND CACHE CITY ID
if( is_numeric($weather->owm_city_id) )
{
	$weather->api_query	= "id=" . $weather->owm_city_id;
}
else if( is_numeric($weather->location) )
{
	$weather->api_query	= "id=" . $weather->location;
}
else
{
	$weather->api_query	= "q=" . $weather->location;
}


// CLEAR THE TRANSIENT
if( isset($_GET['clear_awesome_widget']) ) delete_transient( $weather->transient_name );


// IF APPID, WE USE IT
$appid_string = '';
$appid = get_option( 'open-weather-key' );
if($appid) $appid_string = '&APPID=' . $appid;



// GET WEATHER DATA FROM CACHE
if( get_transient( $weather->transient_name ) ) $weather_data = get_transient( $weather->transient_name );


// IF WE DON'T HAVE ANYTHING, GRAB NEW DATA
if( !$weather_data )
{
	$weather_data['current'] 	= array();
	$weather_data['forecast']	= array();
	$weather->pings				= array();
	
	// NOW
	$now_ping = "http://api.openweathermap.org/data/2.5/weather?" . $weather->api_query . "&lang=en&units=" . $weather->units_query . $appid_string;
	$now_ping_get = wp_remote_get( $now_ping );
	$weather->pings[] = $now_ping;

	if( is_wp_error( $now_ping_get ) ) 
	{
		return awesome_weather_error( $now_ping_get->get_error_message()  ); 
	}	
	
	$city_data = json_decode( $now_ping_get['body'] );
	
	if( isset($city_data->cod) AND $city_data->cod == 404 )
	{
		return awesome_weather_error( $city_data->message ); 
	}
	else
	{
		// MAIN
		$weather_data['name'] = $city_data->name;
		if( $city_data->main )
		{
			$weather_data['current']['temp'] 		= round($city_data->main->temp);
			$weather_data['current']['high'] 		= round($city_data->main->temp_max);
			$weather_data['current']['low'] 		= round($city_data->main->temp_min);
			$weather_data['current']['humidity'] 	= round($city_data->main->humidity);
			$weather_data['current']['pressure'] 	= round($city_data->main->pressure);
			
			// CITY ID
			if( $city_data->id )
			{
				$weather->owm_city_id = $weather->city_id = $city_data->id;
			}
		}
		
		// SYS
		if( $city_data->sys )
		{
			$weather_data['current']['sunrise'] = $city_data->sys->sunrise;
			$weather_data['current']['sunset'] = $city_data->sys->sunset;
		}

		// WIND
		if( $city_data->wind )
		{
			$wind_speed 		= apply_filters('awesome_weather_wind_speed', round($city_data->wind->speed));
			$wind_direction 	= apply_filters('awesome_weather_wind_direction', fmod((($city_data->wind->deg + 11) / 22.5),16));
			$wind_speed_text 	= ($weather->units_query == "metric") ? __('km/h', 'awesome-weather-pro') : __('mph', 'awesome-weather-pro');
			
			$weather_data['current']['wind_speed'] = $wind_speed;		
			$weather_data['current']['wind_direction'] = $awe_wind_label[ $wind_direction ];
			$weather_data['current']['wind_speed_text'] = apply_filters('awesome_weather_wind_speed_text', $wind_speed_text);
		}
		
		// WEATHER
		if( $city_data->weather[0] )
		{
			$current_weather_details 					= $city_data->weather[0];
			$weather_data['current']['condition_code'] 	= $current_weather_details->id;
			$weather_data['current']['description'] 	= awesome_weather_get_desc_from_id_openweathermaps($current_weather_details->id);
			$weather_data['current']['icon'] 			= awesome_weather_get_icon_from_id_openweathermaps($current_weather_details->id);
		}
	}
	
	
	// FORECAST
	if( $weather->forecast_days != "hide" )
	{
		$forecast_ping = "http://api.openweathermap.org/data/2.5/forecast/daily?" . $weather->api_query . "&lang=en&units=" . $weather->units_query ."&cnt=" . ($weather->forecast_days + 1) . $appid_string;
		$forecast_ping_get = wp_remote_get( $forecast_ping );
		$weather->pings[] = $forecast_ping;
	
		if( is_wp_error( $forecast_ping_get ) ) 
		{
			return awesome_weather_error( $forecast_ping_get->get_error_message()  ); 
		}	
		
		$forecast_data = json_decode( $forecast_ping_get['body'] );
		
		if( isset($forecast_data->cod) AND $forecast_data->cod == 404 )
		{
			return awesome_weather_error( $forecast_data->message ); 
		}
		elseif( isset($forecast_data->list) )
		{
			$day_count = 1;
			$forecast = array();
			$dt_today = date( 'Ymd', current_time( 'timestamp', 0 ) );
			
			foreach( (array) $forecast_data->list as $forecast_day )
			{
				// IF TODAY, RESET CURRENT HIGH LOW, 
				// SEEMS TO BE MORE ACCURATE FROM FORECAST THAN DAY VIEW
				if( $dt_today == date('Ymd', $forecast_day->dt))
				{
					$weather_data['current']['high'] 		= round($forecast_day->temp->max);
					$weather_data['current']['low'] 		= round($forecast_day->temp->min);
					continue;
				}
				elseif( $dt_today > date('Ymd', $forecast_day->dt)) continue; // IF OLDER THAN TODAY, SKIP
			
				$day = new stdclass;
				$day->timestamp 			= $forecast_day->dt;
				$day->day_of_week 			= $days_of_week[ date('w', $forecast_day->dt) ];
				
				// TEMPS
				if( isset($forecast_day->temp) )
				{
					$day->temp 		= round($forecast_day->temp->day);
					$day->high 		= round($forecast_day->temp->max);
					$day->low 		= round($forecast_day->temp->min);
					$day->night 	= round($forecast_day->temp->night);
					$day->evening 	= round($forecast_day->temp->eve);
					$day->morning 	= round($forecast_day->temp->morn);
				}
				
				// PRESSURE AND HUMIDITY
				$day->pressure 	= round($forecast_day->pressure);
				$day->humidity 	= round($forecast_day->humidity);
				
				// WIND
				$day->wind_speed 			= $forecast_day->speed;
				$day->wind_direction 		= $awe_wind_label[ fmod((($forecast_day->deg + 11) / 22.5),16) ];
				
				// ICON AND DESC
				$weather_for_day = new stdclass;
				if(isset($forecast_day->weather[0]))
				{
					$weather_for_day = $forecast_day->weather[0];
					
					$day->condition_code 	= $weather_for_day->id;
					$day->description 		= awesome_weather_get_desc_from_id_openweathermaps($weather_for_day->id);
					$day->icon 				= awesome_weather_get_icon_from_id_openweathermaps($weather_for_day->id);
					
				}				
				$forecast[] = $day;
				
				if($day_count == $weather->forecast_days) break;
				$day_count++;
			}
			$weather_data['forecast'] = $forecast;
		}
	}	
	
	// SET THE TRANSIENT, CACHE FOR 30 MINUTES
	if($weather_data['current'] AND $weather_data['forecast'])
	{
		set_transient( $weather->transient_name, $weather_data, apply_filters( 'awesome_weather_cache', 1800 ) ); 
	}
}


// SET THE WEATHER DATA
$weather->data = $weather_data;


