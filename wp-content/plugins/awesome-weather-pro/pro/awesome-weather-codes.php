<?php

// GET ALL CONDITION CODES
function awesome_weather_condition_code_descriptions()
{
	return apply_filters('awesome_weather_codes', array(
		'tornado' 					=> __('tornado', 'awesome-weather-pro'),
		'tropical-storm' 			=> __('tropical storm', 'awesome-weather-pro'),
		'hurricane' 				=> __('hurricane', 'awesome-weather-pro'),
		'severe-thunderstorms' 		=> __('severe thunderstorms', 'awesome-weather-pro'),
		'thunderstorms'				=> __('thunderstorms', 'awesome-weather-pro'),
		'thundershowers'			=> __('thundershowers', 'awesome-weather-pro'),
		'mixed-rain-snow'			=> __('mixed rain and snow', 'awesome-weather-pro'),
		'mixed-rain-sleet' 			=> __('mixed rain and sleet', 'awesome-weather-pro'),
		'mixed-snow-sleet' 			=> __('mixed snow and sleet', 'awesome-weather-pro'),
		'mixed-rain-hail' 			=> __('mixed rain and hail', 'awesome-weather-pro'),
		'freezing-drizzle'			=> __('freezing drizzle', 'awesome-weather-pro'),
		'drizzle'					=> __('drizzle', 'awesome-weather-pro'),
		'freezing-rain' 			=> __('freezing rain', 'awesome-weather-pro'),
		'showers' 					=> __('showers', 'awesome-weather-pro'),
		'scattered-showers' 		=> __('scattered showers', 'awesome-weather-pro'),
		'snow-flurries' 			=> __('snow flurries', 'awesome-weather-pro'),
		'light-snow-showers' 		=> __('light snow showers', 'awesome-weather-pro'),
		'blowing-snow' 				=> __('blowing snow', 'awesome-weather-pro'),
		'snow' 						=> __('snow', 'awesome-weather-pro'),
		'heavy-snow' 				=> __('heavy snow', 'awesome-weather-pro'),
		'scattered-snow'			=> __('scattered snow showers', 'awesome-weather-pro'),
		'heavy-snow' 				=> __('heavy snow', 'awesome-weather-pro'),
		'snow-showers' 				=> __('snow showers', 'awesome-weather-pro'),
		'hail' 						=> __('hail', 'awesome-weather-pro'),
		'sleet' 					=> __('sleet', 'awesome-weather-pro'),
		'dust' 						=> __('dust', 'awesome-weather-pro'),
		'foggy' 					=> __('foggy', 'awesome-weather-pro'),
		'haze' 						=> __('haze', 'awesome-weather-pro'),
		'windy' 					=> __('windy', 'awesome-weather-pro'),
		'cold' 						=> __('cold', 'awesome-weather-pro'),
		'hot' 						=> __('hot', 'awesome-weather-pro'),
		'cloudy' 					=> __('cloudy', 'awesome-weather-pro'),
		'smoky' 					=> __('smoky', 'awesome-weather-pro'),
		'mostly-cloudy' 			=> __('mostly cloudy', 'awesome-weather-pro'),
		'partly-cloudy' 			=> __('partly cloudy', 'awesome-weather-pro'),
		'clear' 					=> __('clear', 'awesome-weather-pro'),
		'sunny' 					=> __('sunny', 'awesome-weather-pro'),
		'fair' 						=> __('fair', 'awesome-weather-pro'),
		'isolated-thunderstorms' 	=> __('isolated thunderstorms', 'awesome-weather-pro'),
		'scattered-thunderstorms' 	=> __('scattered thunderstorms', 'awesome-weather-pro')
	));
}