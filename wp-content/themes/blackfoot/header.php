<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

    <!--[if gte IE 9]>
      <style type="text/css">
        .gradient {
           filter: none;
        }
      </style>
    <![endif]-->
    
		<link href="//www.google-analytics.com" rel="dns-prefetch">
    <link href="<?php echo get_template_directory_uri(); ?>/assets/icons/favicon.png" rel="shortcut icon">
    <link href="<?php echo get_template_directory_uri(); ?>/assets/icons/touch.png" rel="apple-touch-icon-precomposed">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

    <script src="https://use.typekit.net/las1vox.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>

		<?php wp_head(); ?>
		<script>
      // conditionizr.com
      // configure environment tests
      conditionizr.config({
          assets: '<?php echo get_template_directory_uri(); ?>',
          tests: {}
      });
    </script>

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=740887432614704&version=v2.0";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

	</head>

	<body <?php body_class(); ?>>

      <?php if ( is_front_page() ) : ?>

        <?php get_template_part( 'includes/header-home' ); ?>

      <?php endif; ?>

      <?php if ( is_page('waters') || is_front_page() ) : ?>
        <nav id="site-header" class="site-header navbar navbar-inverse navbar-fixed-top">
      <?php else: ?>
        <nav id="site-header" class="site-header navbar navbar-default navbar-fixed-top">
      <?php endif; ?>
          <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="/">
                <span class="site-logo">
                  <img class="logo-left" src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-mark-white.svg">
                  <img class="logo-right" src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-text-white.svg">
                </span>
              </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-collapse">
              <?php primary_nav(); ?>
            </div><!-- /.navbar-collapse -->
            <div class="header-secondary-nav">
              <a class="header-phone" href="tel:+14065427411"><span class="icon-phone">Call us</span>(406) 542-7411</a>
              <a class="header-cart" href="<?php echo WC()->cart->get_cart_url(); ?>"><span class="icon-cart">View your cart</span></a>
            </div>
          </div><!-- /.container-fluid -->
        </nav>