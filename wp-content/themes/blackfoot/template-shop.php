<?php /* Template Name: Shop Page Template */ get_header(); ?>

<?php get_template_part( 'includes/shop-banner' ); ?>

	<main role="main">
		<div class="container">
			<!-- Breadcrumbs -->
			<?php if ( function_exists('yoast_breadcrumb') ) 
			{yoast_breadcrumb('<nav id="breadcrumbs" class="breadcrumbs">','</nav>');} ?>
			
			HELLO

		</div>
	</main>

<?php get_footer(); ?>
