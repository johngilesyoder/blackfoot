<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<!-- SHOP BANNER -->
<?php echo get_template_part( 'includes/shop-banner' ); ?>

<!-- BREADCRUMB -->
<?php if ( !is_shop() ) : ?>
	<div class="container">
		<?php woocommerce_breadcrumb(); ?>
	</div>
<?php endif; ?>
