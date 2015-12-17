<?php
  $family_summary           = types_render_field("family-business-summary", array());
  $testimonial_1            = types_render_field("testimonial-1", array());
  $testimonial_1_photo      = types_render_field("testimonial-1-photo", array('raw' => true));
  $testimonial_1_name       = types_render_field("testimonial-1-name", array());
  $testimonial_1_location   = types_render_field("testimonial-1-location", array());
  $trust_block_1_text       = types_render_field("trust-block-1-text", array());
  $trust_block_2_text       = types_render_field("trust-block-2-text", array());
  $trust_block_3_text       = types_render_field("trust-block-3-text", array());
  $trust_block_1_photo      = types_render_field("trust-block-1-photo", array('raw' => true));
  $trust_block_2_photo      = types_render_field("trust-block-2-photo", array('raw' => true));
  $trust_block_3_photo      = types_render_field("trust-block-3-photo", array('raw' => true));
?>

<section id="home-trust" class="home-trust">
  <div class="container">
    <!-- ===== Trust family ===== -->
    <div class="home-family">
      <div class="row">
        <div class="col-md-3">
          <div class="family-photo">
            <img class="photo" src="<?php echo get_template_directory_uri(); ?>/assets/img/family.jpg">
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
            <span class="testimonial-bubble" style="background-image:url('<?php echo $testimonial_1_photo; ?>');"><span>
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
              <span class="trust-photo" style="background-image:url('<?php echo $trust_block_1_photo; ?>');"><span>
            </div>
            <p><?php echo $trust_block_1_text; ?></p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="relax-block">
            <div class="relax-block-img">
              <span class="trust-photo" style="background-image:url('<?php echo $trust_block_2_photo; ?>');"><span>
            </div>
            <p><?php echo $trust_block_2_text; ?></p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="relax-block">
            <div class="relax-block-img">
              <span class="trust-photo" style="background-image:url('<?php echo $trust_block_3_photo; ?>');"><span>
            </div>
            <p><?php echo $trust_block_3_text; ?></p>
          </div>
        </div>
      </div>
      <!-- Section book -->
      <div class="section-book">
        <a href="/book-a-trip-with-us/" class="btn btn-book">Book your Montana fly fishing adventure</a>
      </div>
    </div>
  </div>
</section>