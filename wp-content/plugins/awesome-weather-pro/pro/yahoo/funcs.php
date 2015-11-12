<?php

// WEATHER DESCRIPTION MAPPING
function awesome_weather_get_desc_from_id_yahoo($c)
{
	$codes = awesome_weather_condition_code_descriptions();
	
	// THUNDERSTORMS
	if($c == 37) { return $codes['isolated-thunderstorms']; }
	if($c == 3) { return $codes['severe-thunderstorms']; }
	if($c == 4 OR $c == 45)  { return $codes['thunderstorms']; }
	
	// DRIZZLE
	if($c == 9) { return $codes['drizzle']; }
	
	// RAIN
	if($c == 11 OR $c == 12) { return $codes['showers']; }
	if($c == 42) { return $codes['scattered-showers']; }
	if($c == 10) { return $codes['freezing-rain']; }
	
	// SNOW
	if($c == 14) { return $codes['light-snow-showers']; }
	if($c == 16) { return $codes['snow']; }
	if($c == 41) { return $codes['heavy-snow']; }
	if($c == 18) { return $codes['sleet']; }
	if($c == 14) { return $codes['snow-showers']; }
	
	// ATMOSPHERE
	if($c == 22) { return $codes['smoky']; }
	if($c == 21) { return $codes['haze']; }
	if($c == 19) { return $codes['dust']; }
	if($c == 20) { return $codes['foggy']; }
	
	// CLOUDS
	if($c == 32) { return $codes['sunny']; }
	if($c == 27 OR $c == 28 OR $c == 29 OR $c == 30) { return $codes['partly-cloudy']; }
	if($c == 26) { return $codes['mostly-cloudy']; }
	
	// FAIR
	if($c == 33 OR $c == 34) { return $codes['fair']; }
	
	// EXTREME
	if($c == 0) { return $codes['tornado']; }
	if($c == 1) { return $codes['tropical-storm']; }
	if($c == 2) { return $codes['hurricane']; }
	if($c == 25) { return $codes['cold']; }
	if($c == 36) { return $codes['hot']; }
	if($c == 24) { return $codes['windy']; }
	if($c == 17) { return $codes['hail']; }
	
	return '';
}

// WEATHER ICONS MAPPING
function awesome_weather_get_icon_from_id_yahoo($c)
{
	return "wi wi-yahoo-$c";
}



// PRESET WEATHER BACKGROUND NAMES
function awesome_weather_preset_condition_names_yahoo( $c )
{
	if($c == 0) { return 'tornado'; }
	if($c == 1) { return 'tropical-storm'; }
	if($c == 2) { return 'hurricane'; }
	if( in_array( $c, array(3,4,37,38,39,40,42,45,47))) { return 'thunderstorm'; }
	if( in_array( $c, array(5,6,7,10,18))) { return 'sleet'; }
	if($c == 8 OR $c == 9) { return 'drizzle'; }
	if( in_array( $c, array(11,12))) { return 'rain'; }
	if( in_array( $c, array(13, 14, 15, 16, 41, 46, 43))) { return 'snow'; }
	if( in_array( $c, array(17,35))) { return 'hail'; }
	if( in_array( $c, array(19,22,24,25))) { return 'windy'; }
	if($c == 20 OR $c == 21) { return 'foggy'; }
	if( in_array( $c, array(26,28,44))) { return 'cloudy'; }
	if( in_array( $c, array(27,29))) { return 'cloudy-night'; }
	if( in_array( $c, array(31,33))) { return 'calm-night'; }
	if( in_array( $c, array(32,34,36))) { return 'sunny'; }
	if( in_array( $c, array(23))) { return 'breeze'; }
}