<nav id="site-header-lg" class="site-header navbar navbar-inverse navbar-fixed-top site-header-lg">
  <div class="container">
    <a class="navbar-brand" href="/">
      <span class="site-logo">
        <img class="logo-top" src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-mark-white.svg">
        <img class="logo-bottom" src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-text-white.svg">
      </span>
    </a>
    <?php home_navigation_left(); ?>
    <?php home_navigation_right(); ?>
    <div class="home-header-secondary-nav">
      <div class="home-header-contact">
        <a class="header-home-phone" href="tel:+14065427411"><img class="icon-phone" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-phone-white.svg">(406) 542-7411</a>
        <a href="/contact-us">Contact us</a>
      </div>
      <a class="home-header-cart" href="<?php echo WC()->cart->get_cart_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-cart-white.svg" alt="View your cart"></a>
    </div>
  </div><!-- /.container -->
</nav>