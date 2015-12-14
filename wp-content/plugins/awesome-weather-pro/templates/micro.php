
<div id="awesome-weather-<?php echo $weather->city_slug; ?>" class="<?php echo $background_classes ?>" <?php echo $inline_style; ?>>

<?php if($weather->background_image) { ?>
	<div class="awesome-weather-cover" style="background-image: url(<?php echo $weather->background_image; ?>);">
	<div class="awesome-weather-darken">
<?php } ?>

	<?php awe_change_weather_form( $weather ); ?>

	<div class="awesome-weather-header"><?php echo $header_title; ?><?php awe_change_weather_trigger( $weather ); ?></div>

	<?php if( isset($weather->data['current'])) { ?>
	
		<div class="awesome-weather-current-temp">
			<?php echo $weather->data['current']['temp']; ?><sup>&deg;</sup>
		</div><!-- /.awesome-weather-current-temp -->
		
		<?php if($weather->show_stats) { ?>
		<div class="awesome-weather-todays-stats">
			
			<div class="awe_desc">
				<?php if($weather->show_icons) { ?><i class="<?php echo $weather->data['current']['icon']; ?>"></i><?php } ?>
				<?php echo $weather->data['current']['description']; ?>
			</div>
		</div><!-- /.awesome-weather-todays-stats -->
		<?php } ?>
	
	<?php } ?>
	
	<?php if($weather->forecast_days != "hide") { ?>
	
		<div class="awesome-weather-forecast awe_days_<?php echo count($weather_forecast); ?> awecf">
	
			<?php foreach( $weather_forecast as $forecast ) { ?>
	
				<div class="awesome-weather-forecast-day">
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