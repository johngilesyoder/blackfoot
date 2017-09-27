<?php
/**
 * Empty cart page
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices();

?>

<div class="empty-cart">
  <h2>Uh oh! Your cart is empty.</h2>
  <p>Take a look at some of the products in our shop to get you started.</p>
  <p class="return-to-shop"><a class="btn button wc-backward" href="/shop/"><?php _e( 'Return To Shop', 'woocommerce' ) ?></a></p>
</div>

<?php do_action( 'woocommerce_cart_is_empty' ); ?>
