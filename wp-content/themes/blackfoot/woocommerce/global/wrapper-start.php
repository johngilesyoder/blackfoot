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
global $post;
if( function_exists('get_product') ){
  $product = get_product( $post->ID );
}
?>

<?php if ( $product->is_type( 'booking' ) ) : ?>

  <!-- BREADCRUMB -->
  <div class="trip-breadcrumb">
    <div class="container">
      <?php woocommerce_breadcrumb(); ?>
    </div>
  </div>

<?php else : ?>

  <!-- SHOP BANNER -->
  <?php echo get_template_part( 'includes/shop/shop-banner' ); ?>

  <!-- BREADCRUMB -->
  <?php if ( !is_shop() ) : ?>
    <div class="container">
      <?php woocommerce_breadcrumb(); ?>
    </div>
  <?php endif; ?>
  

<?php endif; ?>
