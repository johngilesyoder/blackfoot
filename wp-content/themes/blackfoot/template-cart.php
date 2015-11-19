<?php /* Template Name: Cart Page Template */ get_header(); ?>

<?php get_template_part( 'includes/shop-banner' ); ?>

	<main role="main">
		<div class="container">
			<!-- Breadcrumbs -->
			<?php if ( function_exists('yoast_breadcrumb') ) 
			{yoast_breadcrumb('<nav id="breadcrumbs" class="breadcrumbs">','</nav>');} ?>
			<!-- Page Title -->
			<h1 class="page-title">Your Cart</h1>
			<div class="row">
				<div class="col-md-8">
					<!-- Article -->
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php echo do_shortcode( '[woocommerce_cart]' ); ?>
					</article>
				</div>
			</div>
		</div>
	</main>

<?php get_footer(); ?>
