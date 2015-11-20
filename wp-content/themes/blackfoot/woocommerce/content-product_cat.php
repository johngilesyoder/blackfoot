<?php
/**
 * The template for displaying product category thumbnails within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product_cat.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'wc_loop_shop_columns', '2' );
}

// Increase loop count
$woocommerce_loop['loop'] ++;
?>

<!-- Category tile wrapper -->
<li <?php wc_product_cat_class('category-tile'); ?>>

	<?php do_action( 'woocommerce_before_subcategory', $category ); ?>

	<!-- Category tile anchor -->
	<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">
		<div class="category-img-wrapper">

			<!-- Category image -->
			<?php do_action( 'woocommerce_before_subcategory_title', $category ); ?>

		</div>

		<!-- Category Title -->
		<h3 class="category-title">Shop <?php echo $category->name; ?></h3>

		<?php do_action( 'woocommerce_after_subcategory_title', $category ); ?>

	</a>

	<?php do_action( 'woocommerce_after_subcategory', $category ); ?>

</li>