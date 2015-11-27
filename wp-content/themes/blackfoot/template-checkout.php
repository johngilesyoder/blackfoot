<?php /* Template Name: Checkout Page Template */ get_header(); ?>

<?php get_template_part( 'includes/shop-banner' ); ?>

	<main role="main">
		<div class="container">
			<h1 class="page-title"><?php the_title(); ?></h1>
				<!-- Article -->
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php echo do_shortcode( '[woocommerce_checkout]' ); ?>
				</article>
			</div>
		</div>
	</main>

<?php get_footer(); ?>
