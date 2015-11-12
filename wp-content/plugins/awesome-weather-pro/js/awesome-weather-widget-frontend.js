

// jQUERY READY
jQuery(document).ready(function()
{
	jQuery(document).delegate('.awesome-weather-form', 'submit', function(e)
	{
		var this_form = jQuery(this);
		var js_slug = this_form.data('js-slug');
		var city_slug = this_form.data('slug');
		var user_location = this_form.children('input').val();
 
		jQuery('#awesome-weather-' + city_slug + ' .awesome-weather-blankout .awesome-weather-blankout-error').hide();
 
		if( user_location )
		{
			// SHOW LOADING
			jQuery('#awesome-weather-' + city_slug + ' .awesome-weather-blankout .awe-loading').show();
			jQuery('#awesome-weather-' + city_slug + ' .awesome-weather-form').hide();
			
			
			var widget_obj = awe['awe_weather_widget_json_' + js_slug];
			widget_obj.longlat_location = "0";
			widget_obj.user_location = user_location;
			
			
			// PASS WEATHER OBJECT BACK THROUGH THE SYSTEM
			jQuery.post(awe['ajaxurl'], widget_obj, function(response) 
			{
				if( response == "false" )
				{
					awesome_weather_show_form( city_slug );
					jQuery('#awesome-weather-' + city_slug + ' .awesome-weather-blankout .awesome-weather-blankout-error').show();
				}
				else
				{
					// SPIT BACK THE RESULTS IN THE CONTAINER
					jQuery("#awesome-weather-" + city_slug ).replaceWith( response );
					jQuery('#awesome-weather-' + city_slug + ' .awesome-weather-blankout .awesome-weather-blankout-error').hide();
				}
				
				// SET COOKIE OF CITY ID
				var new_city_id = jQuery(".awesome-weather-form[data-js-slug='" + js_slug + "']").data('city-id');
				Cookies.set('awe_city_id', new_city_id, { expires: 7 } );
				
				// STOP LOADING
				awe_stop_loading();
			});
		}

		e.preventDefault();
	});
	
	
	// WEATHER TRIGGER
	jQuery(document).delegate('.awe-weather-trigger a', 'click', function(e) 
	{
		
		console.log(awe);
		
		var this_btn = jQuery(this);
		this_btn.addClass('loading');
		
		var js_slug = this_btn.data('js-slug');
		var city_slug = this_btn.data('slug');
		
		jQuery('#awesome-weather-' + city_slug + ' .awe-weather-bubble').hide();
		
		
		// SHOW LOADING
		jQuery('#awesome-weather-' + city_slug + ' .awesome-weather-blankout').show();
		
		
		// CHECK IF HTML5 GEOLOCATION IS AVAILABLE
		if (navigator.geolocation) 
		{
			// GET POSITION
        	navigator.geolocation.getCurrentPosition(awesome_weather_set_location, awesome_weather_show_form_to_user);
    	} 
    	else 
    	{
	    	// NO GEO LOCATION, SHOW FORM
			awesome_weather_show_form( city_slug );
		}
		
		function awesome_weather_show_form_to_user()
		{
			awesome_weather_show_form( city_slug );
		}
		
		function awesome_weather_set_location(position) 
		{
			// SAVE LOCATION AND REFRESH
			var widget_obj = awe['awe_weather_widget_json_' + js_slug];
			

			// ADD IP LOCATION TO NEW WEATHER OBJECT
			widget_obj.longlat_location = position.coords.latitude + "," + position.coords.longitude;
			widget_obj.longlat_triggered = "1";
		
			// PASS WEATHER OBJECT BACK THROUGH THE SYSTEM
			jQuery.post(awe['ajaxurl'], widget_obj, function(response) 
			{
				// SPIT BACK THE RESULTS IN THE CONTAINER
				jQuery("#awesome-weather-" + city_slug ).replaceWith( response );
				
				
				// SET COOKIE OF CITY ID
				var new_city_id = jQuery(".awesome-weather-form[data-js-slug='" + js_slug + "']").data('city-id');
				Cookies.set('awe_city_id', new_city_id, { expires: 7 });
				
				
				// STOP LOADING
				awe_stop_loading();
			});
		}	

		e.preventDefault();
		return false;
	});
	
	function awesome_weather_show_form( city_slug ) 
	{
		awe_stop_loading( city_slug );
		
		jQuery('#awesome-weather-' + city_slug + ' .awesome-weather-form').show();
		jQuery('#awesome-weather-' + city_slug + ' .awesome-weather-form input').focus();
		jQuery('#awesome-weather-' + city_slug + ' .awesome-weather-blankout').show();
		
		jQuery(document).delegate('#awesome-weather-' + city_slug + ' .awesome-weather-blankout', 'click', function(e) 
		{
			jQuery('#awesome-weather-' + city_slug + ' .awesome-weather-form').hide();
			jQuery('#awesome-weather-' + city_slug + ' .awesome-weather-blankout').hide();
		});
	}
		
	function awe_stop_loading( city_slug )
	{
		jQuery('#awesome-weather-' + city_slug + ' .awesome-weather-blankout .awe-loading').hide();
	}
	
	
});