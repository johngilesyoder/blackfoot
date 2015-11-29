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
        <div class="col-md-4">
          <article class="home-trip">
            <a href="#" class="trip-block" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/trip-float.jpg');">
              <h1 class="trip-title">Float Fishing Trips</h1>
            </a>
            <p class="trip-summary">Western Montana boasts hundreds of miles of floatable world class fly fishing waters. Our most popular trip will create a lifetime of memories.</p>
          </article>
        </div>
        <div class="col-md-4">
          <article class="home-trip">
            <a href="#" class="trip-block" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/trip-wade.jpg');">
              <h1 class="trip-title">Walk &amp; Wade Fishing Trips</h1>
            </a>
            <p class="trip-summary">Let our guides take you to the secret hot spots where sometimes our boats may not be allowed or it is harder to reach.</p>
          </article>
        </div>
        <div class="col-md-4">
          <article class="home-trip">
            <a href="#" class="trip-block" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/trip-overnight.jpg');">
              <h1 class="trip-title">Overnight Trips</h1>
            </a>
            <p class="trip-summary">Let us create a custom overnight or multi-day Montana fly fishing adventure.</p>
          </article>
        </div>
        <div class="col-md-4">
          <article class="home-trip">
            <a href="#" class="trip-block" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/trip-smith.jpg');">
              <h1 class="trip-title">Smith River Trips</h1>
            </a>
            <p class="trip-summary">Take the trip of a lifetime on Montana’s Smith River. All you need to really know is for five days and four nights you will experience life changing scenery, fishing with new and old friends.</p>
          </article>
        </div>
        <div class="col-md-4">
          <article class="home-trip">
            <a href="#" class="trip-block" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/trip-alberton.jpg');">
              <h1 class="trip-title">Alberton Gorge Whitewater</h1>
            </a>
            <p class="trip-summary">Carved by the great Missoula flood, the Alberton Gorge combines the thrill of whitewater with an unforgettable fishing opportunity. Did we mention big fish live in these waters?</p>
          </article>
        </div>
        <!-- <div class="col-md-4">
          <article class="home-trip">
            <a href="#" class="trip-block" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/trip-lodging.jpg');">
              <h1 class="trip-title">Lodging &amp; Accomodation Pkgs</h1>
            </a>
            <p class="trip-summary">You can relax even more with our full service packages - enjoy the finest Montana style accommodations we have to offer and let us take care of all your needs.</p>
          </article>
        </div> -->
        <div class="col-md-4">
          <article class="home-trip">
            <a href="#" class="trip-block" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/trip-stillwater.jpg');">
              <h1 class="trip-title">Still Water Trips</h1>
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
      <a href="#" class="btn btn-book">Book the trip of a lifetime</a>
    </div>
  </div>
</section>