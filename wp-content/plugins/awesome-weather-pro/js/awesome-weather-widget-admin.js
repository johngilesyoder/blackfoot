

// CUSTOM WIDGET SIZE TOGGLE
jQuery(document).ready(function()
{
	jQuery(document.body).on('change', '.awesome-weather-size-select', function()
	{
		var widget_id = jQuery(this).data('widgetid');
	
		if( jQuery(this).val() == "custom" )
		{
			jQuery("#custom-template-" + widget_id  + "-field").show();
		}
		else
		{
			jQuery("#custom-template-" + widget_id  + "-field").hide();
		}
	});


	// SEARCH FOR LOCATION ID
	
	
	// OPENWEATHERMAPS
	jQuery(document.body).on('keyup', '.awe-location-search-field-openweathermaps', _.debounce( function()
	{
		
		if( jQuery(this).val() != "")
		{
			var units_val				= jQuery('#c-' + jQuery(this).data('unitsfield')).prop('checked') ? "f" : "c";
			var location_id 			= jQuery(this).attr('id');
			var owm_city_id_selector	= "#" + jQuery(this).data('cityidfield');
		
			// PING
			var data = { action: 'awe_ping_owm_for_id', location: jQuery(this).val(), units: units_val };
			jQuery.getJSON(ajaxurl, data, function(response) 
			{
				var place_count = response.count;
				var places 		= response.list;
				
				// IF NO PLACES DISPLAY AN ERROR
				if( !places )
				{
					jQuery('#owmid-selector-' + location_id).html( awe_script.no_owm_city );
				}
				else
				{
					if(place_count == 1)
					{
						jQuery( owm_city_id_selector ).val( places[0].id );
						jQuery( '#owmid-selector-' + location_id ).html( "<span style='color:red;'>" + awe_script.one_city_found + "</span>" );
					}
					else
					{
						var rtn = awe_script.confirm_city;
					
						for( p = 0; p < places.length; p++)
						{	
							if( places[p].id && places[p].id != 0 )
							{
								// SET TO FIRST
								if(p == 0)
								{
									jQuery( owm_city_id_selector ).val( places[p].id );
								}
							
								rtn = rtn + "<div style='padding: 3px;'> - <a href='javascript:;' onclick=\"jQuery('" + owm_city_id_selector + "').val(" + places[p].id + ");\" style='text-decoration:none;'>" + places[p].name + ", " + places[p].sys.country + " - ( " + places[p].id + " )</a></div>"; 
							}
						}
						jQuery('#owmid-selector-' + location_id).html( rtn );
					}
				}
			});
		}
		
		
			
		
	}, 350));
	
	
	// YAHOO
	jQuery(document.body).on('keyup', '.awe-location-search-field-yahoo', _.debounce( function()
	{
		if( jQuery(this).val() != "")
		{
			var units_val				= jQuery('#c-' + jQuery(this).data('unitsfield')).prop('checked') ? "f" : "c";
			var location_id 			= jQuery(this).attr('id');
			var woeid_selector			= "#" + jQuery(this).data('cityidfield');
		
			// PING
			var data = { action: 'awe_ping_yahoo_for_woeid', location: jQuery(this).val() };
			jQuery.getJSON(ajaxurl, data, function(response) 
			{
				var place_count = response.query.count;
				var places 		= response.query.results.place;
				
				// IF NO PLACES DISPLAY AN ERROR
				if( !places )
				{
					jQuery('#woeid-selector-' + location_id).html( awe_script.no_yahoo_city );
				}
				else
				{
					if(place_count == 1)
					{
						jQuery( woeid_selector ).val( places.woeid );
						jQuery('#woeid-selector-'  + location_id).html( "<span style='color:red;'>" + awe_script.one_city_found + "</span>" );
					}
					else
					{
						var rtn = awe_script.confirm_city;
					
						for( p = 0; p < places.length; p++)
						{	
							if( places[p].woeid && places[p].woeid != 0 )
							{
								// SET TO FIRST
								if(p == 0)
								{
									jQuery( woeid_selector ).val( places[p].woeid );
								}
							
								rtn = rtn + "<div style='padding: 3px;'> - <a href='javascript:;' onclick=\"jQuery('" + woeid_selector + "').val(" + places[p].woeid + ");\" style='text-decoration:none;'>" + places[p].name + ", " + places[p].admin1 + ", " + places[p].country.code + " - ( " + places[p].woeid + " )</a></div>"; 
							}
						}
						jQuery( '#woeid-selector-' + location_id ).html( rtn );
					}
				}
			});	
		}
	}, 350));
	
});