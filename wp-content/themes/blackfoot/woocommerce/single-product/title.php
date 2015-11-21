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
?>

<?php echo do_shortcode('[product_brand width="" height="" class="brand-logo"]') ?>
<h1 itemprop="name" class="product_title entry-title"><?php echo get_the_term_list( $post_id, 'product_brand' ) . '&nbsp'; ?><?php the_title(); ?></h1>
