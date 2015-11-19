<?php get_header(); ?>

<?php get_template_part( 'includes/shop-banner' ); ?>

	<main role="main">
		<div class="container">
			<!-- Breadcrumbs -->
			<?php if ( function_exists('yoast_breadcrumb') ) 
			{yoast_breadcrumb('<nav id="breadcrumbs" class="breadcrumbs">','</nav>');} ?>
			<!-- Page Title -->
			<h1 class="page-title"><?php the_title(); ?></h1>
			<div class="row">
				<div class="col-md-4">
					<?php //get_sidebar('shop'); ?>
				</div>
				<div class="col-md-8">
					<!-- Article -->
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php woocommerce_content(); ?>
					</article>
			</div>
		</div>
	</main>

<?php get_footer(); ?>
