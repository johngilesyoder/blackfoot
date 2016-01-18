<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head <?php do_action( 'add_head_attributes' ); ?>>

    <!-- Title -->
    <!-- =================================== -->
		<title><?php wp_title(''); ?></title>


    <!-- Meta -->
    <!-- =================================== -->

    <!-- Typekit -->
    <!-- =================================== -->

    <?php gravity_form_enqueue_scripts( 6, false ); ?>
    <!-- Wordpress Generated -->
    <!-- =================================== -->
		<?php wp_head(); ?>

    <!-- Facebook SDK -->
    <!-- =================================== -->


	</head>

	<body id="top" <?php body_class(); ?>>

    