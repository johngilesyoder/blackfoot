<?php
/**
 * Single Product title
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 1.6.4
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
<h1 itemprop="name" class="product_title trip-title entry-title">Book a <?php the_title(); ?> with Blackfoot River Outfitters</h1>
<?php else : ?>
<?php echo do_shortcode('[product_brand width="" height="" class="brand-logo"]') ?>
<h1 itemprop="name" class="product_title entry-title"><?php echo get_the_term_list( $post_id, 'product_brand' ) . ' '; ?><?php the_title(); ?></h1>
<?php endif; ?>