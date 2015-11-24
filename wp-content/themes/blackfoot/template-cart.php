<?php /* Template Name: Cart Page Template */ get_header(); ?>

<?php get_template_part( 'includes/shop-banner' ); ?>

	<main role="main">
		<div class="container">
			<div class="title-area">
				<div class="row">
					<div class="col-md-7"><!-- Page Title -->
						<h1 class="page-title">Your Cart</h1>
					</div>
					<div class="col-md-5">
						<div class="checkout-top">
							<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<!-- Article -->
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php echo do_shortcode( '[woocommerce_cart]' ); ?>
					</article>
				</div>
			</div>
		</div>
	</main>

<?php get_footer(); ?>
