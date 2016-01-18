<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head <?php do_action( 'add_head_attributes' ); ?>>

    <!-- Title -->
    <!-- =================================== -->
		<title><?php wp_title(''); ?></title>
    
    <!-- Styles -->
    <!-- =================================== -->
		<link href="//www.//www.blackfootriver.com" rel="dns-prefetch">
    <link href="<?php echo get_template_directory_uri(); ?>/assets/icons/favicon.png" rel="shortcut icon">
    <link href="<?php echo get_template_directory_uri(); ?>/assets/icons/touch.png" rel="apple-touch-icon-precomposed">

    <!-- Meta -->
    <!-- =================================== -->
    <meta charset="<?php bloginfo('charset'); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Typekit -->
    <!-- =================================== -->
    <script src="https://use.typekit.net/las1vox.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>

    <?php gravity_form_enqueue_scripts( 6, false ); ?>
    <!-- Wordpress Generated -->
    <!-- =================================== -->
		<?php wp_head(); ?>

    <!-- Facebook SDK -->
    <!-- =================================== -->
    

	</head>

	<body id="top" <?php body_class(); ?>>
    <!-- Google Analytics -->
    <!-- =================================== -->
    <?php //get_template_part( 'includes/analyticstracking' ); ?>

    <?php if ( is_front_page() ) : ?>
      
    <!-- Navbar (Big homepage one) -->
    <!-- =================================== -->
    <?php get_template_part( 'includes/header-home' ); ?>

    <?php endif; ?>

    <!-- Navbar -->
    <!-- =================================== -->
    <?php if ( is_singular( 'water' )  || is_front_page() ) : ?>

    <!-- Conditionally loaded inverted navbar -->
    <nav id="site-header" class="site-header navbar navbar-inverse navbar-fixed-top">

    <?php else: ?>

    <!-- Default navbar -->
    <nav id="site-header" class="site-header navbar navbar-default navbar-fixed-top">

    <?php endif; ?>

      <div class="container">
        <div class="navbar-header">
          <!-- Mobile menu toggle -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- Site logo -->
          <a class="navbar-brand" href="/">
            <span class="site-logo">
              <img class="logo-left" src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-mark-white.svg">
              <img class="logo-right" src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-text-white.svg">
            </span>
          </a>
        </div>
        <!-- Collect the nav links for toggling -->
        <div class="collapse navbar-collapse" id="navbar-collapse">
          <?php primary_nav(); ?>
        </div>
        <!-- Phone / Cart -->
        
      </div>
    </nav>