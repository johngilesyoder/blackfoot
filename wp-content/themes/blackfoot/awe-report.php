<div id="awesome-weather-<?php echo $weather->city_slug; ?>" class="<?php echo $background_classes ?>" <?php echo $inline_style; ?>>
  
  <div class="awecf">
  
  <?php if($weather->forecast_days != "hide") { ?>
  
    <div class="awesome-weather-forecast awecf awe_days_<?php echo count($weather_forecast); ?>">
  
      <?php if( isset($weather->data['current'])) { ?>
      <div class="awesome-weather-forecast-day">
        <div class="awesome-weather-forecast-day-abbr"><?php _e('Today', 'awesome-weather-pro'); ?></div>
        <?php if($weather->show_icons) { ?><i class="<?php echo $weather->data['current']['icon']; ?>"></i><?php } ?>
        <div class="awe_highlow"><?php echo $weather->data['current']['high']; ?>&deg; / <?php echo $weather->data['current']['low']; ?>&deg;</div>  
      </div>
      <?php } ?>
  
      <?php foreach( $weather_forecast as $forecast ) { ?>
  
        <div class="awesome-weather-forecast-day">
          <div class="awesome-weather-forecast-day-abbr"><?php echo $forecast->day_of_week; ?></div>
          <?php if($weather->show_icons) { ?><i class="<?php echo $forecast->icon; ?>"></i><?php } ?>
          <div class="awe_highlow"><?php echo $forecast->high; ?>&deg; / <?php echo $forecast->low; ?>&deg;</div>  
        </div>
  
      <?php } ?>
      
    </div><!-- /.awesome-weather-forecast -->
  
  <?php } ?>
  
  </div>

</div><!-- /.awesome-weather-wrap: wide -->