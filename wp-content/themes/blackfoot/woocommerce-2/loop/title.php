<?php
/**
 * Product loop title
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Return Brand name for products
global $product;
$brand = array_shift( wc_get_product_terms( $product->id, 'product_brand', array( 'fields' => 'names' ) ) );

?>
<h3 class="product-title"><?php echo $brand . ' '; ?><?php the_title(); ?></h3>
