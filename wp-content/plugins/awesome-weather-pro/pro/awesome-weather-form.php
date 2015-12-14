<form action="#" method="post" class="awesome-weather-form" data-title="<?php echo esc_attr($weather->override_title); ?>" data-city-id="<?php echo $weather->city_id; ?>" data-slug="<?php echo esc_attr($weather->city_slug); ?>" data-js-slug="<?php echo esc_attr($weather->widget_js_var); ?>">
	<input type="text" name="awe-new-location" placeholder="<?php _e('Location:', 'awesome-weather-pro'); ?>">
</form>
<div class="awesome-weather-blankout">
	<div class="awe-loading"><i class="wi <?php echo apply_filters('awesome_weather_loader', 'wi-day-sunny'); ?>"></i></div>
	<div class="awesome-weather-blankout-error"><?php _e('City not found, please try again.', 'awesome-weather-pro'); ?></div>
</div>