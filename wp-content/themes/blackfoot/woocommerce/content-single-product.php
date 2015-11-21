<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

	<hgroup class="title-group">
		<div class="row">
			<div class="col-md-10">

				<?php woocommerce_template_single_title(); ?>

			</div>
			<div class="col-md-2">
				<div class="product-share">
					<!-- FB -->
					<div class="share-fb">
						<div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button"></div>
					</div>
					<!-- Tweet -->
					<div class="share-tweet">
						<a href="https://twitter.com/share" class="twitter-share-button" data-via="johngilesyoder" data-count="none">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
					</div>
				</div>
			</div>
		</div>
	</hgroup>

	<div class="row">
		<div class="col-md-8">
			
			<?php woocommerce_show_product_images(); ?>
			<?php 
				/**
				 * woocommerce_before_single_product_summary hook
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10
				 * @hooked woocommerce_show_product_images - 20
				 */
				//do_action( 'woocommerce_before_single_product_summary' );
			?>

		</div>
		<div class="col-md-4">
			<div class="purchase-console summary entry-summary">

			<?php woocommerce_template_single_rating(); ?>
			<?php woocommerce_template_single_price(); ?>
			<?php woocommerce_template_single_add_to_cart(); ?>
			<?php //woocommerce_template_single_meta(); ?>

			<div class="free-shipping-message">
				<p><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-shipping-brown.svg"> <strong>Free Shipping</strong> on orders over $50!</p>
			</div>

			<?php woocommerce_template_single_sharing(); ?>
				
				<?php
					/**
					 * woocommerce_single_product_summary hook
					 *
					 * @hooked woocommerce_template_single_title - 5
					 * @hooked woocommerce_template_single_rating - 10
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40
					 * @hooked woocommerce_template_single_sharing - 50
					 */
					//do_action( 'woocommerce_single_product_summary' );
				?>

			</div>
		</div>
	</div>
	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
