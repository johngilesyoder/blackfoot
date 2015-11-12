<div id="awesome-weather-<?php echo $weather->city_slug; ?>" class="<?php echo $background_classes ?>" <?php echo $inline_style; ?>>

<?php if($weather->background_image) { ?>
	<div class="awesome-weather-cover" style="background-image: url(<?php echo $weather->background_image; ?>);">
	<div class="awesome-weather-darken">
<?php } ?>

	<?php awe_change_weather_form( $weather ); ?>

	<div class="awesome-weather-header"><?php echo $header_title; ?><?php awe_change_weather_trigger( $weather ); ?></div>

	<div class="awesome-weather-long-padding">&nbsp;</div>
	
	<div class="awecf">

	<?php if(isset($weather->data['current']) AND $weather->show_stats) { ?>
	<div class="awesome-weather-todays-stats">
		
		<div class="awe_desc">
			<?php echo $weather->data['current']['description']; ?>
		</div>
			
	</div><!-- /.awesome-weather-todays-stats -->
	<?php } ?>
	
	<?php if($weather->forecast_days != "hide") { ?>
	
		<div class="awesome-weather-forecast awecf awe_days_<?php echo count($weather_forecast); ?>">
	
	
			<?php if( isset($weather->data['current'])) { ?>
			<div class="awesome-weather-forecast-day">
				<?php if($weather->show_icons) { ?><i class="<?php echo $weather->data['current']['icon']; ?>"></i><?php } ?>
				<div class="awesome-weather-forecast-day-abbr"><?php _e('Now', 'awesome-weather-pro'); ?></div>
				<div class="awesome-weather-forecast-day-temp"><?php echo $weather->data['current']['temp']; ?></div>
			</div>
			<?php } ?>
	
			<?php foreach( $weather_forecast as $forecast ) { ?>
	
				<div class="awesome-weather-forecast-day">
					<?php if($weather->show_icons) { ?><i class="<?php echo $forecast->icon; ?>"></i><?php } ?>
					<div class="awesome-weather-forecast-day-abbr"><?php echo $forecast->day_of_week; ?></div>
					<div class="awesome-weather-forecast-day-temp"><?php echo $forecast->temp; ?></div>
				</div>
	
			<?php } ?>
			
		</div><!-- /.awesome-weather-forecast -->
	
	<?php } ?>
	
	</div>
	
	<?php if( $weather->extended_url ) { ?>
		<div class="awesome-weather-more-weather-link"><a href="<?php echo $weather->extended_url; ?>" target="_blank"><?php echo $weather->extended_text; ?></a></div>
	<?php } ?>

<?php if($weather->background_image) { ?>
	</div><!-- /.awesome-weather-cover -->
	</div><!-- /.awesome-weather-darken -->
<?php } ?>

</div><!-- /.awesome-weather-wrap: wide -->