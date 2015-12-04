<?php
  $details_summary      = types_render_field("trip-details-summary", array());
  $testimonial_2            = types_render_field("testimonial-2", array());
  $testimonial_2_photo      = types_render_field("testimonial-2-photo", array());
  $testimonial_2_name       = types_render_field("testimonial-2-name", array());
  $testimonial_2_location   = types_render_field("testimonial-2-location", array());
?>

<section id="home-trips" class="home-trips">
  <div class="container">
    <!-- Section title -->
    <h2 class="section-title">We have a fly fishing adventure for anyone.</h2>
    <!-- Section quote -->
    <blockquote class="section-quote">
      <div class="row">
        <div class="col-md-1">
          <?php echo $testimonial_2_photo; ?>
        </div>
        <div class="col-md-11">
          <?php echo $testimonial_2; ?>
          <footer><span>&mdash;</span> <?php echo $testimonial_2_name; ?> <cite><?php echo $testimonial_2_location; ?></cite></footer>
        </div>
      </div>
    </blockquote>
    <!-- Trips list -->
    <div class="home-trips-list">
      <div class="row">

        <?php
          $args = array(
            'post_type' => 'product',
            'posts_per_page' => 12,
            'tax_query' => array(
                array(
                  'taxonomy' => 'product_type',
                  'field'    => 'slug',
                  'terms'    => 'booking', 
                ),
              ),
            );

          $loop = new WP_Query( $args );
          if ( $loop->have_posts() ) {
            while ( $loop->have_posts() ) : $loop->the_post();
              get_template_part( 'includes/home/trip-block' );
            endwhile;
          } else {
            echo __( 'No products found' );
          }
          wp_reset_postdata();
        ?>

        <div class="col-md-4">
          <article class="home-trip">
            <a href="/trips/" class="trip-block" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/trip-alberton.jpg');">
              <h1 class="trip-title">Alberton Gorge Whitewater</h1>
            </a>
            <p class="trip-summary">Carved by the great Missoula flood, the Alberton Gorge combines the thrill of whitewater with an unforgettable fishing opportunity. Did we mention big fish live in these waters?</p>
          </article>
        </div>
        <div class="col-md-4">
          <article class="home-trip">
            <a href="/trips/" class="trip-block" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/trip-stillwater.jpg');">
              <h1 class="trip-title">Still Water Trip</h1>
            </a>
            <p class="trip-summary">Carved by the great Missoula flood, the Alberton Gorge combines the thrill of whitewater with an unforgettable fishing opportunity. Did we mention big fish live in these waters.</p>
          </article>
        </div>
        <div class="col-md-4">
          <article class="home-trip">
            <a href="/trips/" class="trip-block" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/trip-smith.jpg');">
              <h1 class="trip-title">Smith River Trip</h1>
            </a>
            <p class="trip-summary">Carved by the great Missoula flood, the Alberton Gorge combines the thrill of whitewater with an unforgettable fishing opportunity. Did we mention big fish live in these waters.</p>
          </article>
        </div>
      </div>
    </div>
    <!-- Trip details -->
    <div class="trips-details">
      <h3><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-question-white.svg">Wondering about the details?</h3>
      <p><?php echo $details_summary; ?></p>
    </div>
    <!-- Section book -->
    <div class="section-book">
      <a href="/trips/" class="btn btn-book">Book the trip of a lifetime</a>
    </div>
  </div>
</section>