<li class="col-md-4">
  <div class="trip" style="background-image: url('<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>');">
    <div class="trip-content">
      <h2 class="trip-title"><?php the_title(); ?></h2>
      <p class="trip-summary"><?php the_excerpt(); ?></p>
      <a href="<?php the_permalink(); ?>" class="btn btn-primary">Select options &amp; book now</a>
    </div>
    <?php woocommerce_template_single_price(); ?>
  </div>
</li>