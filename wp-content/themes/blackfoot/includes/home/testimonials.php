<section id="home-testimonials" class="home-testimonials">
  <!-- Section title -->
  <h2 class="section-title">Meet some of our delighted guests. You’re next.</h2>

  <?php
    // Define loop
    $loop = new WP_Query( array( 'post_type' => 'testimonial', 'posts_per_page' => 6 ) );
    // Start loop
    while ( $loop->have_posts() ) : $loop->the_post();
    // Set testimonial variables
    $thumb_id           = get_post_thumbnail_id();
    $thumb_url_array    = wp_get_attachment_image_src($thumb_id, 'full', true);
    $thumb_url          = $thumb_url_array[0];
    $testimonial_home   = types_render_field("guest-home-location", array());
    $testimonial_water  = types_render_field("water-that-was-fished", array());
  ?>

    <!-- Testimonial Card -->
    <article class="testimonial-block">
      <div class="flipper">
        <div class="front">
          <!-- Testimonial card front -->
          <div class="testimonial-img" style="background-image: url('<?php echo $thumb_url; ?>');"></div>
        </div>
        <div class="back">
          <!-- Testimonial card back -->
          <div class="testimonial-content">
            <span class="testimonial-name"><?php the_title(); ?></span>
            <span class="testimonial-location"><?php echo $testimonial_home; ?></span>
            <hr>
            <span class="testimonial-fished">Fished <?php echo $testimonial_water; ?></span>
          </div>
        </div>
      </div>
    </article>

  <?php endwhile; wp_reset_query(); ?>

</section>