<section id="home-waters" class="home-waters">
  <div class="container">
    <!-- Section title -->
    <h2 class="section-title">Our Montana waters are <u>Legendary</u>.</h2>
    <!-- Section quote -->
    <blockquote class="section-quote">
      <div class="row">
        <div class="col-md-1">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/section-testimonial-1.png">
        </div>
        <div class="col-md-11">
          <p>"We’ve been fishing with BRO every summer for years. This year, we came in the spring. The fishing was unbelievable."</p>
          <footer><span>&mdash;</span> Paul Tomscuh <cite>State College, Pennsylvania</cite></footer>
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
          // Set testimonial variables
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
                <p><?php the_excerpt(); ?></p>
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
      <a href="#" class="btn btn-book">Book your trip on Montana's legendary waters</a>
    </div>
  </div>
</section>