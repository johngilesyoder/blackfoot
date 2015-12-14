<?php

// WEATHER DESCRIPTION MAPPING
function awesome_weather_get_desc_from_id_openweathermaps($c)
{
	$codes = awesome_weather_condition_code_descriptions();
	
	// THUNDERSTORMS
	if($c == 210) { return $codes['isolated-thunderstorms']; }
	if($c == 212) { return $codes['severe-thunderstorms']; }
	if($c >= 200 AND $c < 300)  { return $codes['thunderstorms']; }
	
	// DRIZZLE
	if($c >= 300 AND $c < 400) { return $codes['drizzle']; }
	
	// RAIN
	if($c == 500 OR $c == 502 OR $c == 503 OR $c == 504 OR $c == 520 OR $c == 521 OR $c == 522) { return $codes['showers']; }
	if($c == 501) { return $codes['scattered-showers']; }
	if($c == 511) { return $codes['freezing-rain']; }
	
	// SNOW
	if($c == 600) { return $codes['light-snow-showers']; }
	if($c == 601) { return $codes['snow']; }
	if($c == 602) { return $codes['heavy-snow']; }
	if($c == 611) { return $codes['sleet']; }
	if($c == 621) { return $codes['snow-showers']; }
	
	// ATMOSPHERE
	if($c == 701) { return ''; }
	if($c == 711) { return $codes['smoky']; }
	if($c == 721) { return $codes['haze']; }
	if($c == 731) { return $codes['dust']; }
	if($c == 741) { return $codes['foggy']; }
	
	// CLOUDS
	if($c == 800) { return $codes['sunny']; }
	if($c == 801 OR $c == 802 OR $c == 803) { return $codes['partly-cloudy']; }
	if($c == 804) { return $codes['mostly-cloudy']; }
	
	// EXTREME
	if($c == 900) { return $codes['tornado']; }
	if($c == 901) { return $codes['tropical-storm']; }
	if($c == 902) { return $codes['hurricane']; }
	if($c == 903) { return $codes['cold']; }
	if($c == 904) { return $codes['hot']; }
	if($c == 905) { return $codes['windy']; }
	if($c == 906) { return $codes['hail']; }
	
	return '';
}


// WEATHER ICONS MAPPING
function awesome_weather_get_icon_from_id_openweathermaps($c)
{
	return "wi wi-owm-$c";
}


// PRESET WEATHER BACKGROUND NAMES
function awesome_weather_preset_condition_names_openweathermaps( $weather_code )
{
	if( substr($weather_code,0,1) == "2" ) 						return "thunderstorm";
	else if( substr($weather_code,0,1) == "3" ) 				return "drizzle";
	else if( substr($weather_code,0,1) == "5" ) 				return "rain";
	else if( $weather_code == 611 ) 							return "sleet";
	else if( substr($weather_code,0,1) == "6" ) 				return "snow";
	else if( $weather_code == 781 OR $weather_code == 900 ) 	return "tornado";
	else if( $weather_code == 800 ) 							return "sunny";
	else if( substr($weather_code,0,1) == "8" ) 				return "cloudy";
	else if( $weather_code == 901 ) 							return "tropical-storm";
	else if( $weather_code == 902 ) 							return "hurricane";
	else if( $weather_code == 905 ) 							return "windy";
	else if( $weather_code == 906 ) 							return "hail";
	else if( $weather_code == 951 ) 							return "calm";
	else if( $weather_code > 951 AND $weather_code < 958 ) 		return "breeze";
}
