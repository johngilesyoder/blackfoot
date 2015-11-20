<section id="home-shop" class="home-shop">
  <div class="container">
    <div class="row">
      <!-- Section title -->
      <hgroup class="col-md-7">
        <h2><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-shop-dark.svg">Blackfoot River Outfitters Shop</h2>
        <h3>We own and operate a  full-service fly shop to outfit your adventure and fishing needs.</h3>
      </hgroup>
      <div class="col-md-5">
        <!-- Shop button -->
        <div class="shop-btn">
          <a href="/shop/" class="btn btn-book">Shop online now</a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        FEATURED ITEM
      </div>
      <div class="col-md-8">
        <div class="home-new-items">
          <h4><span>New Items</span></h4>

          <?php echo do_shortcode('[recent_products per_page="2" columns="2"]'); ?>

        </div>
      </div>
  </div>
</section>