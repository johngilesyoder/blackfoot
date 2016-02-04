<?php 
  // Define loop
  $loop = new WP_Query( array( 'post_type' => 'trip', 'posts_per_page' => 9, 'order' => 'asc' ) );
  // Start loop
  while ( $loop->have_posts() ) : $loop->the_post();
  // Set variables
  $price_statement = types_render_field("price-statement", array("raw"=>"true"));
?>

<!-- Trip Block -->
<div class="trip">
  <div class="trip-left">
    <div class="trip-photo" style="background-image: url('<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>');">
    <?php if ( has_tag( 'most-popular' ) ) : ?>
      <span class="most-popular">Most Popular</span>
    <?php endif; ?>
    </div>
  </div>
  <div class="trip-right">
    <div class="trip-content">
      <h2 class="trip-title"><?php the_title(); ?></h2>
      <p class="trip-summary"><?php the_excerpt(); ?></p>
      <span class="price">
        From <span class="amount">$<?php echo $price_statement; ?></span> per day
      </span>
      <a href="<?php the_permalink(); ?>" class="btn btn-primary">View details &amp; book now</a>
    </div>
  </div>
</div>

<?php endwhile; wp_reset_query(); ?>