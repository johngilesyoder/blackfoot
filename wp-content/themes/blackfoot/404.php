<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
    <link href="<?php echo get_template_directory_uri(); ?>/assets/icons/favicon.png" rel="shortcut icon">
    <link href="<?php echo get_template_directory_uri(); ?>/assets/icons/touch.png" rel="apple-touch-icon-precomposed">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php wp_head(); ?>
		<script>
      // conditionizr.com
      // configure environment tests
      conditionizr.config({
          assets: '<?php echo get_template_directory_uri(); ?>',
          tests: {}
      });
    </script>
    
    <script>try{Typekit.load();}catch(e){}</script>

	</head>

	<body <?php body_class(); ?>>

	<div class="container">

			<div class="error-message">
				<h1>404</h1>
				<h2>Page not found</h2>
				<p>Unfortunately, we were unable to find that page or it does not exist.<br />Please <a href="/">return</a> to the home page.</p>
			</div>
			<div class="site-logo-wrapper">
				<!-- ==== Site Logo ==== -->
				<div class="site-logo">
					<a href="/" class="hatch-logo">HATCH</a>
				</div>
			</div>
	</div>