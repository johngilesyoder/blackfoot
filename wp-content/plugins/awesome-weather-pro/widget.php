<?php
	
// AWESOME WEATHER WIDGET, WIDGET CLASS, SO MANY WIDGETS
class AwesomeWeatherWidget extends WP_Widget 
{
	function AwesomeWeatherWidget() { parent::__construct(false, $name = 'Awesome Weather Widget'); }

    function widget($args, $instance) 
    {	
        extract( $args );
        
        // GET WIDGET ID, USED FOR USER LOCATION
        $widget_id = isset($args['widget_id']) ? $args['widget_id'] : false;
        
        $location 					= isset($instance['location']) ? $instance['location'] : false;
        $woeid 						= isset($instance['woeid']) ? $instance['woeid'] : false;
        $owm_city_id 				= isset($instance['owm_city_id']) ? $instance['owm_city_id'] : false;
        $override_title 			= isset($instance['override_title']) ? $instance['override_title'] : false;
        $widget_title 				= isset($instance['widget_title']) ? $instance['widget_title'] : false;
        $units 						= isset($instance['units']) ? $instance['units'] : false;
        $size 						= isset($instance['size']) ? $instance['size'] : false;
        $forecast_days 				= isset($instance['forecast_days']) ? $instance['forecast_days'] : false;
        $hide_stats 				= (isset($instance['hide_stats']) AND $instance['hide_stats'] == 1) ? 1 : 0;
        $show_link 					= (isset($instance['show_link']) AND $instance['show_link'] == 1) ? 1 : 0;
        $use_user_location			= (isset($instance['use_user_location']) AND $instance['use_user_location'] == 1) ? 1 : 0;
        $allow_user_to_change		= (isset($instance['allow_user_to_change']) AND $instance['allow_user_to_change'] == 1) ? 1 : 0;
        $show_icons					= (isset($instance['show_icons']) AND $instance['show_icons'] == 1) ? 1 : 0;
        $background					= isset($instance['background']) ? $instance['background'] : false;
        $custom_bg_color			= isset($instance['custom_bg_color']) ? $instance['custom_bg_color'] : false;
        $custom_template_name		= isset($instance['custom_template_name']) ? $instance['custom_template_name'] : false;
        $extended_url				= isset($instance['extended_url']) ? $instance['extended_url'] : false;
        $extended_text				= isset($instance['extended_text']) ? $instance['extended_text'] : false;
        $background_by_weather 		= (isset($instance['background_by_weather']) AND $instance['background_by_weather'] == 1) ? 1 : 0;
		$text_color					= isset($instance['text_color']) ? $instance['text_color'] : "#ffffff";
		
		echo $before_widget;
		if($widget_title != "") echo $before_title . $widget_title . $after_title;
		echo awesome_weather_logic( array( 
									'widget_id' => $widget_id,
									'location' => $location, 
									'woeid' => $woeid,
									'owm_city_id' => $owm_city_id,
									'override_title' => $override_title, 
									'size' => $size, 
									'units' => $units, 
									'forecast_days' => $forecast_days, 
									'hide_stats' => $hide_stats, 
									'show_link' => $show_link, 
									'background' => $background, 
									'custom_bg_color' => $custom_bg_color,
									'use_user_location' => $use_user_location,
									'allow_user_to_change' => $allow_user_to_change,
									'custom_template_name' => $custom_template_name,
									'show_icons' => $show_icons,
									'extended_url' => $extended_url,
									'extended_text' => $extended_text,
									'background_by_weather' => $background_by_weather,
									'text_color' => $text_color
								));
		echo $after_widget;
    }
 
    function update($new_instance, $old_instance) 
    {		
		$instance = $old_instance;
		$instance['location'] 					= strip_tags($new_instance['location']);
		$instance['woeid'] 						= strip_tags($new_instance['woeid']);
		$instance['owm_city_id'] 				= strip_tags($new_instance['owm_city_id']);
		$instance['override_title'] 			= strip_tags($new_instance['override_title']);
		$instance['widget_title'] 				= strip_tags($new_instance['widget_title']);
		$instance['units'] 						= strip_tags($new_instance['units']);
		$instance['size'] 						= strip_tags($new_instance['size']);
		$instance['forecast_days'] 				= strip_tags($new_instance['forecast_days']);
		$instance['background'] 				= strip_tags($new_instance['background']);
		$instance['custom_bg_color'] 			= strip_tags($new_instance['custom_bg_color']);
		$instance['text_color'] 				= strip_tags($new_instance['text_color']);
		$instance['custom_template_name'] 		= strip_tags($new_instance['custom_template_name']);
		$instance['extended_url'] 				= strip_tags($new_instance['extended_url']);
		$instance['extended_text'] 				= strip_tags($new_instance['extended_text']);
		$instance['hide_stats'] 				= (isset($new_instance['hide_stats']) AND $new_instance['hide_stats'] == 1) ? 1 : 0;
		$instance['show_link'] 					= (isset($new_instance['show_link']) AND $new_instance['show_link'] == 1) ? 1 : 0;
		$instance['use_user_location'] 			= (isset($new_instance['use_user_location']) AND $new_instance['use_user_location'] == 1) ? 1 : 0;
		$instance['allow_user_to_change'] 		= (isset($new_instance['allow_user_to_change']) AND $new_instance['allow_user_to_change'] == 1) ? 1 : 0;
		$instance['show_icons'] 				= (isset($new_instance['show_icons']) AND $new_instance['show_icons'] == 1) ? 1 : 0;
		$instance['background_by_weather'] 		= (isset($new_instance['background_by_weather']) AND $new_instance['background_by_weather'] == 1) ? 1 : 0;
        return $instance;
    }
 
    function form($instance) 
    {	
    	global $awesome_weather_sizes;
    	
        $location 				= isset($instance['location']) ? esc_attr($instance['location']) : "";
        $woeid 					= isset($instance['woeid']) ? esc_attr($instance['woeid']) : "";
        $owm_city_id 			= isset($instance['owm_city_id']) ? esc_attr($instance['owm_city_id']) : "";
        $override_title 		= isset($instance['override_title']) ? esc_attr($instance['override_title']) : "";
        $widget_title 			= isset($instance['widget_title']) ? esc_attr($instance['widget_title']) : "";
        $selected_size 			= isset($instance['size']) ? esc_attr($instance['size']) : "wide";
        $units 					= (isset($instance['units']) AND strtoupper($instance['units']) == "C") ? "C" : "F";
        $forecast_days 			= isset($instance['forecast_days']) ? esc_attr($instance['forecast_days']) : 5;
        $hide_stats 			= (isset($instance['hide_stats']) AND $instance['hide_stats'] == 1) ? 1 : 0;
        $show_link 				= (isset($instance['show_link']) AND $instance['show_link'] == 1) ? 1 : 0;
        $use_user_location 		= (isset($instance['use_user_location']) AND $instance['use_user_location'] == 1) ? 1 : 0;
        $allow_user_to_change 	= (isset($instance['allow_user_to_change']) AND $instance['allow_user_to_change'] == 1) ? 1 : 0;
        $show_icons 			= (isset($instance['show_icons']) AND $instance['show_icons'] == 1) ? 1 : 0;
        $background				= isset($instance['background']) ? esc_attr($instance['background']) : "";
        $custom_bg_color		= isset($instance['custom_bg_color']) ? esc_attr($instance['custom_bg_color']) : "";
        $custom_template_name	= isset($instance['custom_template_name']) ? esc_attr($instance['custom_template_name']) : "";
        $extended_url			= isset($instance['extended_url']) ? esc_attr($instance['extended_url']) : "";
        $extended_text			= isset($instance['extended_text']) ? esc_attr($instance['extended_text']) : "";
        $background_by_weather 		= (isset($instance['background_by_weather']) AND $instance['background_by_weather'] == 1) ? 1 : 0;
		$text_color					= isset($instance['text_color']) ? esc_attr($instance['text_color']) : "#ffffff";
		
		
		if( $instance['units'] == "auto" ) $units = "auto";
	
		$theme_folder = substr(strrchr(get_stylesheet_directory(),'/'),1);
		
		$weather_provider = get_option('aw-weather-provider');
		if( defined('AWESOME_WEATHER_PRO_PROVIDER') )
		{
			$weather_provider = AWESOME_WEATHER_PRO_PROVIDER;
		}
		
		$awe_field_id = $this->get_field_id('owm_city_id');
		if( $weather_provider == "yahoo" ) 
		{
			$awe_field_id = $this->get_field_id('woeid');
		}
		
	?>
	
	<div id="awesome-weather-fields-<?php echo $this->id; ?>">
	
		<p>
	    	<label for="<?php echo $this->get_field_id('location'); ?>"><?php _e('Template:', 'awesome-weather-pro'); ?></label><br>
	    	<select id="<?php echo $this->get_field_id('size'); ?>" name="<?php echo $this->get_field_name('size'); ?>" class="awesome-weather-size-select" data-widgetid="<?php echo $this->id; ?>">
	      	<?php foreach($awesome_weather_sizes as $size => $text) { ?>
	      		<option value="<?php echo $size; ?>"<?php if($selected_size == $size) echo " selected=\"selected\""; ?>><?php echo $text; ?></option>
	      	<?php } ?>
	    	</select>
        </p>
        
		<div id="custom-template-<?php echo $this->id; ?>-field"<?php if($selected_size != "custom") echo " style='display:none;'"; ?>>
        	<label for="<?php echo $this->get_field_id('custom_template_name'); ?>"><?php _e('Custom Template Filename:', 'awesome-weather-pro'); ?></label> <small>(<?php _e('found in theme folder', 'awesome-weather-pro'); ?>)</small><br>
        	<?php echo $theme_folder; ?>/awe-&nbsp;<input id="<?php echo $this->get_field_id('custom_template_name'); ?>" name="<?php echo $this->get_field_name('custom_template_name'); ?>" type="text" value="<?php echo $custom_template_name; ?>" style="width: 60px; font-size: 11px;" />&nbsp;.php
		</div>
		
		<hr>
		
		<p>
        	<label for="<?php echo $this->get_field_id('location'); ?>"><?php _e('Search for Your Location:', 'awesome-weather-pro'); ?></label> 
        	<input data-cityidfield="<?php echo $awe_field_id; ?>" data-unitsfield="<?php echo $this->get_field_id('units'); ?>" class="widefat awe-location-search-field-<?php echo $weather_provider; ?>" style="margin-top: 4px;" id="<?php echo $this->get_field_id('location'); ?>" name="<?php echo $this->get_field_name('location'); ?>" type="text" value="<?php echo $location; ?>" />
		</p>
		
		<?php if( $weather_provider == "openweathermaps" ) { ?>

			<p>
				<label for="<?php echo $this->get_field_id('owm_city_id'); ?>">
					<?php _e('OpenWeatherMap City ID:', 'awesome-weather-pro'); ?><br>
					<small><?php _e('(use the field above to find the ID for your city)', 'awesome-weather-pro'); ?></small>
				</label>
				<input class="widefat" style="margin-top: 4px; line-height: 1.5em;" id="<?php echo $this->get_field_id('owm_city_id'); ?>" name="<?php echo $this->get_field_name('owm_city_id'); ?>" type="text" value="<?php echo $owm_city_id; ?>" />
			</p>
		
			<div id="owmid-selector-<?php echo $this->get_field_id('location'); ?>"></div>
		
			<script>
				
				<?php if( !$owm_city_id ) { ?>
				jQuery('#<?php echo $this->get_field_id('location'); ?>').trigger('keyup');
				<?php } ?>
				
			</script>
		
		<?php } ?>
	
		<?php if( $weather_provider == "yahoo" ) { ?>
		
			<p>
				<label for="<?php echo $this->get_field_id('woeid'); ?>">
					<?php _e('WOEID:', 'awesome-weather-pro'); ?><br>
					<small><?php _e('(use the field above to find the ID for your city)', 'awesome-weather-pro'); ?></small>
				</label>
				<input class="widefat" style="margin-top: 4px; line-height: 1.5em;" id="<?php echo $this->get_field_id('woeid'); ?>" name="<?php echo $this->get_field_name('woeid'); ?>" type="text" value="<?php echo $woeid; ?>" />
			</p>
		
			<div id="woeid-selector-<?php echo $this->get_field_id('location'); ?>"></div>
		
			<script>

				<?php if( !$woeid ) { ?>
				jQuery('#<?php echo $this->get_field_id('location'); ?>').trigger('keyup');
				<?php } ?>

			</script>
		
		<?php } ?>
		
		<hr>
                
		<p>
        	<label for="<?php echo $this->get_field_id('override_title'); ?>"><?php _e('Banner Title:', 'awesome-weather-pro'); ?></label> 
        	<input class="widefat" id="<?php echo $this->get_field_id('override_title'); ?>" name="<?php echo $this->get_field_name('override_title'); ?>" type="text" value="<?php echo $override_title; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('widget_title'); ?>"><?php _e('Widget Title: (optional)', 'awesome-weather-pro'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('widget_title'); ?>" name="<?php echo $this->get_field_name('widget_title'); ?>" type="text" value="<?php echo $widget_title; ?>" />
		</p>
		
		<hr>
        
        <p>
			<label for="<?php echo $this->get_field_id('forecast_days'); ?>"><?php _e('Forecast:', 'awesome-weather-pro'); ?></label> &nbsp;
			<select id="<?php echo $this->get_field_id('forecast_days'); ?>" name="<?php echo $this->get_field_name('forecast_days'); ?>">
				
				<?php if( $weather_provider == "openweathermaps" ) { ?>
				<option value="15"<?php if($forecast_days == 15) echo " selected=\"selected\""; ?>><?php _e('15 Days', 'awesome-weather-pro'); ?></option>
				<option value="14"<?php if($forecast_days == 14) echo " selected=\"selected\""; ?>><?php _e('14 Days', 'awesome-weather-pro'); ?></option>
				<option value="13"<?php if($forecast_days == 13) echo " selected=\"selected\""; ?>><?php _e('13 Days', 'awesome-weather-pro'); ?></option>
				<option value="12"<?php if($forecast_days == 12) echo " selected=\"selected\""; ?>><?php _e('12 Days', 'awesome-weather-pro'); ?></option>
				<option value="11"<?php if($forecast_days == 11) echo " selected=\"selected\""; ?>><?php _e('11 Days', 'awesome-weather-pro'); ?></option>
				<option value="10"<?php if($forecast_days == 10) echo " selected=\"selected\""; ?>><?php _e('10 Days', 'awesome-weather-pro'); ?></option>
				<option value="9"<?php if($forecast_days == 9) echo " selected=\"selected\""; ?>><?php _e('9 Days', 'awesome-weather-pro'); ?></option>
				<option value="8"<?php if($forecast_days == 8) echo " selected=\"selected\""; ?>><?php _e('8 Days', 'awesome-weather-pro'); ?></option>
				<option value="7"<?php if($forecast_days == 7) echo " selected=\"selected\""; ?>><?php _e('7 Days', 'awesome-weather-pro'); ?></option>
				<option value="6"<?php if($forecast_days == 6) echo " selected=\"selected\""; ?>><?php _e('6 Days', 'awesome-weather-pro'); ?></option>
				<option value="5"<?php if($forecast_days == 5) echo " selected=\"selected\""; ?>><?php _e('5 Days', 'awesome-weather-pro'); ?></option>
				<?php } ?>
				
				<option value="4"<?php if($forecast_days == 4) echo " selected=\"selected\""; ?>><?php _e('4 Days', 'awesome-weather-pro'); ?></option>
				<option value="3"<?php if($forecast_days == 3) echo " selected=\"selected\""; ?>><?php _e('3 Days', 'awesome-weather-pro'); ?></option>
				<option value="2"<?php if($forecast_days == 2) echo " selected=\"selected\""; ?>><?php _e('2 Days', 'awesome-weather-pro'); ?></option>
				<option value="1"<?php if($forecast_days == 1) echo " selected=\"selected\""; ?>><?php _e('1 Day', 'awesome-weather-pro'); ?></option>
				<option value="hide"<?php if($forecast_days == 'hide') echo " selected=\"selected\""; ?>><?php _e("Don't Show", 'awesome-weather-pro'); ?></option>
			</select>
		</p>
		
		<p>
        	<label for="<?php echo $this->get_field_id('background'); ?>"><?php _e('Background Image:', 'awesome-weather-pro'); ?></label> 
        	<input class="widefat" id="<?php echo $this->get_field_id('background'); ?>" name="<?php echo $this->get_field_name('background'); ?>" type="text" value="<?php echo $background; ?>" />
		</p>
        
        <p>
          <input id="<?php echo $this->get_field_id('background_by_weather'); ?>" name="<?php echo $this->get_field_name('background_by_weather'); ?>" type="checkbox" value="1" <?php if($background_by_weather) echo ' checked="checked"'; ?> />
          <label for="<?php echo $this->get_field_id('background_by_weather'); ?>"><?php _e('Use Different Background Images Based on Weather', 'awesome-weather-pro'); ?></label>  <a href="https://halgatewood.com/docs/plugins/awesome-weather-widget/creating-different-backgrounds-for-different-weather" target="_blank">(?)</a> &nbsp;
        </p>
        
		<p>
        	<label for="<?php echo $this->get_field_id('custom_bg_color'); ?>"><?php _e('Custom Background Color:', 'awesome-weather-pro'); ?></label><br />
        	<small><?php _e('overrides color changing', 'awesome-weather-pro'); ?>: #7fb761 or rgba(0,0,0,0.5)</small>
        	<input class="widefat" id="<?php echo $this->get_field_id('custom_bg_color'); ?>" name="<?php echo $this->get_field_name('custom_bg_color'); ?>" type="text" value="<?php echo $custom_bg_color; ?>" />
		</p>
		
		<p>
		    <label for="<?php echo $this->get_field_id( 'text_color' ); ?>" style="display:block;"><?php _e( 'Text Color', 'awesome-weather' ); ?></label> 
		    <input class="widefat color-picker" id="<?php echo $this->get_field_id( 'text_color' ); ?>" name="<?php echo $this->get_field_name( 'text_color' ); ?>" type="text" value="<?php echo esc_attr( $text_color ); ?>" />
		</p>
		
		<script type="text/javascript">
		    jQuery(document).ready(function($) 
		    { 
		            jQuery('#<?php echo $this->get_field_id( 'text_color' ); ?>').on('focus', function(){
		                var parent = jQuery(this).parent();
		                jQuery(this).wpColorPicker()
		                parent.find('.wp-color-result').click();
		            }); 
		            
		            jQuery('#<?php echo $this->get_field_id( 'text_color' ); ?>').wpColorPicker()
		    }); 
		</script>
		      
		<p>
        	<label for="<?php echo $this->get_field_id('units'); ?>"><?php _e('Units:', 'awesome-weather-pro'); ?></label> &nbsp;
        	<input id="c-<?php echo $this->get_field_id('units'); ?>" name="<?php echo $this->get_field_name('units'); ?>" type="radio" value="F" <?php if($units == "F") echo ' checked="checked"'; ?> /> F &nbsp; &nbsp;
        	<input id="f-<?php echo $this->get_field_id('units'); ?>" name="<?php echo $this->get_field_name('units'); ?>" type="radio" value="C" <?php if($units == "C") echo ' checked="checked"'; ?> /> C &nbsp; &nbsp;
        	<span id="awe-auto-units-span" <?php if(!$use_user_location) echo "class=\"hidden\""; ?>><input id="auto-<?php echo $this->get_field_id('units'); ?>" name="<?php echo $this->get_field_name('units'); ?>" type="radio" value="auto" <?php if($units == "auto") echo ' checked="checked"'; ?> /> Auto</span>
		</p>
		
		<p>
        	<input id="<?php echo $this->get_field_id('use_user_location'); ?>" name="<?php echo $this->get_field_name('use_user_location'); ?>" type="checkbox" value="1" <?php if($use_user_location) echo ' checked="checked"'; ?> />
			<label for="<?php echo $this->get_field_id('use_user_location'); ?>"><?php _e('Use User Location', 'awesome-weather-pro'); ?></label>
		</p>
		<p id="allow-user-to-change"<?php if(!$use_user_location) echo " class=\"hidden\""; ?>>
        	<input id="<?php echo $this->get_field_id('allow_user_to_change'); ?>" name="<?php echo $this->get_field_name('allow_user_to_change'); ?>" type="checkbox" value="1" <?php if($allow_user_to_change) echo ' checked="checked"'; ?> />
			<label for="<?php echo $this->get_field_id('allow_user_to_change'); ?>"><?php _e('Allow User to Change the Location', 'awesome-weather-pro'); ?></label>
		</p>
		
		<script>
			jQuery('#<?php echo $this->get_field_id('use_user_location'); ?>').change(function() 
			{
				jQuery('span#awe-auto-units-span').toggleClass('hidden');
				jQuery('p#allow-user-to-change').toggleClass('hidden');
				
			});
		</script>
		
		<p>
        	<input id="<?php echo $this->get_field_id('show_icons'); ?>" name="<?php echo $this->get_field_name('show_icons'); ?>" type="checkbox" value="1" <?php if($show_icons) echo ' checked="checked"'; ?> />
			<label for="<?php echo $this->get_field_id('show_icons'); ?>"><?php _e('Show Weather Icons', 'awesome-weather-pro'); ?></label>
		</p>
		
		<p>
        	<input id="<?php echo $this->get_field_id('hide_stats'); ?>" name="<?php echo $this->get_field_name('hide_stats'); ?>" type="checkbox" value="1" <?php if($hide_stats) echo ' checked="checked"'; ?> />
			<label for="<?php echo $this->get_field_id('hide_stats'); ?>"><?php _e('Hide Stats', 'awesome-weather-pro'); ?></label>
		</p>
		
		<hr>
		
		<?php if( $weather_provider == "openweathermaps") { ?>
		<p>
        	<input id="<?php echo $this->get_field_id('show_link'); ?>" name="<?php echo $this->get_field_name('show_link'); ?>" type="checkbox" value="1" <?php if($show_link) echo ' checked="checked"'; ?> />
			<label for="<?php echo $this->get_field_id('show_link'); ?>"><?php _e('Link to OpenWeatherMap Extended Forecast', 'awesome-weather-pro'); ?></label>
		</p>
		<?php } ?>
		
		<p>
        	<label for="<?php echo $this->get_field_id('extended_url'); ?>"><?php _e('Custom Extended Forecast URL:', 'awesome-weather-pro'); ?></label> 
        	<input class="widefat" id="<?php echo $this->get_field_id('extended_url'); ?>" name="<?php echo $this->get_field_name('extended_url'); ?>" type="text" value="<?php echo $extended_url; ?>" />
		</p>
		
		<p>
        	<label for="<?php echo $this->get_field_id('extended_text'); ?>"><?php _e('Custom Extended Forecast Text:', 'awesome-weather-pro'); ?></label> 
        	<input class="widefat" id="<?php echo $this->get_field_id('extended_text'); ?>" name="<?php echo $this->get_field_name('extended_text'); ?>" type="text" value="<?php echo $extended_text; ?>" />
		</p>
		
		
	</div>

        <?php 
    }
}

add_action( 'widgets_init', create_function('', 'return register_widget("AwesomeWeatherWidget");') );