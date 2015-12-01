<div class="row">
<?php if (have_posts()): while (have_posts()) : the_post();

	// Variables
  // $water_species      = types_render_field("popular-fish-species", array());
  // $water_trips        = types_render_field("trip-types", array());
  $report_illustration = types_render_field("location-illustration", array("raw"=>"true")); 
  $report_rating = types_render_field("conditions-at-a-glance", array("raw"=>"true"));
?>

	<!-- Report -->
  <a href="<?php the_permalink(); ?>" class="fishing-report-wrapper col-md-6">
    <article id="post-<?php the_ID(); ?>" class="fishing-report">
      <hgroup>
        <img class="report-illustration" src="<?php echo $report_illustration; ?>">
        <!-- Page Title -->
        <h2 class="report-title"><?php the_title(); ?></h2>
        <span class="report-updated">Updated <strong><?php the_modified_time('m/d/Y'); ?> at <?php the_modified_time('g:ia'); ?></strong></span>
      </hgroup>
      <p><?php echo substr(get_the_excerpt(), 0,80); ?> &hellip; <span class="read-more">Read more</span></p>
      <div class="condition-rating">
        <span class="rating-active <?php echo $report_rating; ?>"></span>
      </div>
    </article>
  </a>

<?php endwhile; ?>

<?php else: ?>

	<!-- article -->
	<article>
		<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
	</article>
	<!-- /article -->

<?php endif; ?>
</div>