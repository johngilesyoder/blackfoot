<div class="row">
<?php 
  // Define loop
  $loop = new WP_Query( array( 'post_type' => 'water', 'posts_per_page' => 9, 'order' => 'asc' ) );
  // Start loop
  while ( $loop->have_posts() ) : $loop->the_post();
  // Set variables
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
	      <p><?php echo get_excerpt(120); ?></p>
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