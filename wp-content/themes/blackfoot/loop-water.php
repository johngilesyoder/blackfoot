<div class="row">
<?php if (have_posts()): while (have_posts()) : the_post();

	// Set testimonial variables
  $thumb_id           = get_post_thumbnail_id();
  $thumb_url_array    = wp_get_attachment_image_src($thumb_id, 'full', true);
  $thumb_url          = $thumb_url_array[0];
  $water_species      = types_render_field("popular-fish-species", array());
  $water_trips        = types_render_field("trip-types", array());

?>

	<!-- Water Block -->
	<div class="water-tile-wrapper">
	  <article id="post-<?php the_ID(); ?>" class="water-tile">
	    <a href="<?php the_permalink(); ?>" class="water-block" style="background-image: url('<?php echo $thumb_url; ?>');">
	      <h1 class="trip-title"><?php the_title(); ?></h1>
	    </a>
	    <div class="water-summary">
	      <p><?php echo substr(the_excerpt('', '', FALSE), 0, 140); ?></p>
	      <span class="water-detail water-species"><strong>FISH SPECIES:</strong>&nbsp; <?php echo $water_species; ?></span>
	      <span class="water-detail water-trips"><strong>TRIP TYPES:</strong>&nbsp; <?php echo $water_trips; ?></span>
	    </div>
	  </article>
	</div>

<?php endwhile; ?>

<?php else: ?>

	<!-- article -->
	<article>
		<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
	</article>
	<!-- /article -->

<?php endif; ?>
</div>