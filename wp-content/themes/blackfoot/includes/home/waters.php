<?php
  $testimonial_3            = types_render_field("testimonial-3", array());
  $testimonial_3_photo      = types_render_field("testimonial-3-photo", array());
  $testimonial_3_name       = types_render_field("testimonial-3-name", array());
  $testimonial_3_location   = types_render_field("testimonial-3-location", array());
?>

<section id="home-waters" class="home-waters">
  <div class="container">
    <!-- Section title -->
    <h2 class="section-title">Our Montana waters are <u>Legendary</u>.</h2>
    <!-- Section quote -->
    <blockquote class="section-quote">
      <div class="row">
        <div class="col-md-1">
          <?php echo $testimonial_3_photo; ?>
        </div>
        <div class="col-md-11">
          <?php echo $testimonial_3; ?>
          <footer><span>&mdash;</span> <?php echo $testimonial_3_name; ?> <cite><?php echo $testimonial_3_location; ?></cite></footer>
        </div>
      </div>
    </blockquote>
    <!-- Waters List -->
    <div class="home-waters-list">
      <div class="row">

        <?php
          // Define loop
          $loop = new WP_Query( array( 'post_type' => 'water', 'posts_per_page' => 9 ) );
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
            <article class="water-tile">
              <a href="#" class="water-block" style="background-image: url('<?php echo $thumb_url; ?>');">
                <h1 class="trip-title"><?php the_title(); ?></h1>
              </a>
              <div class="water-summary">
                <p><?php echo get_excerpt(120); ?></p>
                <span class="water-detail water-species"><strong>FISH SPECIES:</strong>&nbsp; <?php echo $water_species; ?></span>
                <span class="water-detail water-trips"><strong>TRIP TYPES:</strong>&nbsp; <?php echo $water_trips; ?></span>
              </div>
            </article>
          </div>

        <?php endwhile; wp_reset_query(); ?>

      </div>
    </div>
    <!-- Section Book -->
    <div class="section-book">
      <a href="/trips/" class="btn btn-book">Book your trip on Montana's legendary waters</a>
    </div>
  </div>
</section>