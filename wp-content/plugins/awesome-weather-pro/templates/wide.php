
<div id="awesome-weather-<?php echo $weather->city_slug; ?>" class="<?php echo $background_classes ?>" <?php echo $inline_style; ?>>

<?php if($weather->background_image) { ?>
	<div class="awesome-weather-cover" style="background-image: url(<?php echo $weather->background_image; ?>);">
	<div class="awesome-weather-darken">
<?php } ?>

	<?php awe_change_weather_form( $weather ); ?>

	<div class="awesome-weather-header awecf"><?php echo $header_title; ?><?php awe_change_weather_trigger( $weather ); ?></div>

	<?php if( isset($weather->data['current'])) { ?>
	
		<div class="awecf">
		<div class="awesome-weather-current-temp">
			<?php echo $weather->data['current']['temp']; ?><sup>&deg;</sup>
					<?php if($weather->show_icons) { ?>
			<i class="<?php echo $weather->data['current']['icon']; ?>"></i>
		<?php } ?>
		</div><!-- /.awesome-weather-current-temp -->
		
		<?php if($weather->show_stats) { ?>
		<div class="awesome-weather-todays-stats">
			<div class="awe_desc"><?php echo $weather->data['current']['description']; ?></div>
			<div class="awe_humidty"><?php echo $weather->data['current']['humidity']; ?>% <?php _e('humidity', 'awesome-weather-pro'); ?></div>
			<div class="awe_wind"><?php _e('wind:', 'awesome-weather-pro'); ?> <?php echo $weather->data['current']['wind_speed']; ?><?php echo $weather->data['current']['wind_speed_text']; ?> <?php echo $weather->data['current']['wind_direction']; ?></div>
			<div class="awe_highlow"><?php _e('H', 'awesome-weather-pro'); ?> <?php echo $weather->data['current']['high']; ?> &bull; <?php _e('L', 'awesome-weather-pro'); ?> <?php echo $weather->data['current']['low']; ?></div>	
		</div><!-- /.awesome-weather-todays-stats -->
		<?php } ?>
		</div>
		
	<?php } ?>
	
	<?php if($weather->forecast_days != "hide") { ?>
	
		<div class="awesome-weather-forecast awe_days_<?php echo count($weather_forecast); ?> awecf">
	
			<?php foreach( $weather_forecast as $forecast ) { ?>
	
				<div class="awesome-weather-forecast-day">
					<?php if($weather->show_icons) { ?><i class="<?php echo $forecast->icon; ?>"></i><?php } ?>
					<div class="awesome-weather-forecast-day-temp"><?php echo $forecast->temp; ?><sup>&deg;</sup></div>
					<div class="awesome-weather-forecast-day-abbr"><?php echo $forecast->day_of_week; ?></div>
				</div>
	
			<?php } ?>
	
		</div><!-- /.awesome-weather-forecast -->
	
	<?php } ?>
	
	<?php if( $weather->extended_url ) { ?>
		<div class="awesome-weather-more-weather-link"><a href="<?php echo $weather->extended_url; ?>" target="_blank"><?php echo $weather->extended_text; ?></a></div>
	<?php } ?>

<?php if($weather->background_image) { ?>
	</div><!-- /.awesome-weather-cover -->
	</div><!-- /.awesome-weather-darken -->
<?php } ?>

</div><!-- /.awesome-weather-wrap: wide -->