<?php
  $family_summary           = types_render_field("family-business-summary", array());
  $testimonial_1            = types_render_field("testimonial-1", array());
  $testimonial_1_photo      = types_render_field("testimonial-1-photo", array());
  $testimonial_1_name       = types_render_field("testimonial-1-name", array());
  $testimonial_1_location   = types_render_field("testimonial-1-location", array());
?>

<section id="home-trust" class="home-trust">
  <div class="container">
    <!-- ===== Trust family ===== -->
    <div class="home-family">
      <div class="row">
        <div class="col-md-3">
          <div class="family-photo">
            <img class="photo" src="<?php echo get_template_directory_uri(); ?>/assets/img/family.png">
            <span class="bro-logo">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-text-white.svg">
            </span>
          </div>
        </div>
        <div class="col-md-9">
          <p><?php echo $family_summary; ?></p>
        </div>
      </div>
    </div>
    <!-- ===== Trust relax ===== -->
    <div class="home-relax">
      <!-- Section title -->
      <h2 class="section-title">Relax. We take care of <u>everything</u>.</h2>
      <!-- Section quote -->
      <blockquote class="section-quote">
        <div class="row">
          <div class="col-md-1">
            <?php echo $testimonial_1_photo; ?>
          </div>
          <div class="col-md-11">
            <?php echo $testimonial_1; ?>
            <footer><span>&mdash;</span> <?php echo $testimonial_1_name; ?> <cite><?php echo $testimonial_1_location; ?></cite></footer>
          </div>
        </div>
      </blockquote>
      <!-- Trust blocks -->
      <div class="row">
        <div class="col-md-4">
          <div class="relax-block">
            <div class="relax-block-img">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/relax-block-1.jpg">
            </div>
            <p>Whether you are a <strong>beginner</strong> or an <strong>expert</strong> our goal is to give you a singular experience that fits your skill level and personality. Our experienced guides will keep you safe, comfortable and many times entertained.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="relax-block">
            <div class="relax-block-img">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/relax-block-2.jpg">
            </div>
            <p>We’ll escort you and your guests to the waters fishing the best and most trips include a satisfying river side dining experience. If you are missing anything, let us know, we also have a full service fly shop.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="relax-block">
            <div class="relax-block-img">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/relax-block-3.jpg">
            </div>
            <p>Your only job is to relax, put your fly on the water and catch wild Montana trout. We call that tight lines. If you aren’t hooked when you get here you will be when you leave.</p>
          </div>
        </div>
      </div>
      <!-- Section book -->
      <div class="section-book">
        <a href="#" class="btn btn-book">Book your Montana fly fishing adventure</a>
      </div>
    </div>
  </div>
</section>