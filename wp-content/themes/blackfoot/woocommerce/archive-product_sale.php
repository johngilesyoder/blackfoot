<?php
/**
* Template Name: Sale Products
* Description: The Template for displaying a sales archive.
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<?php get_header(); ?> 

<?php do_action( 'woocommerce_before_main_content' ); ?>

<div class="container woocommerce">
  <div class="row">
    <div class="col-md-3">

      <?php do_action( 'woocommerce_sidebar' );?>

    </div>
    <div class="col-md-9">

    	<hgroup class="category-title">
				<h1 class="page-title"><span class="glyphicon glyphicon-tag"></span> <?php the_title(); ?></h1>
				<div class="term-description">
					<?php the_content(); ?>
				</div>
			</hgroup>

	    <?php
	    	$args = array(
	    	    'post_type'      => 'product',
	    	    'meta_query'     => array(
	    	        'relation' => 'OR',
	    	        array( // Simple products type
	    	            'key'           => '_sale_price',
	    	            'value'         => 0,
	    	            'compare'       => '>',
	    	            'type'          => 'numeric'
	    	        ),
	    	        array( // Variable products type
	    	            'key'           => '_min_variation_sale_price',
	    	            'value'         => 0,
	    	            'compare'       => '>',
	    	            'type'          => 'numeric'
	    	        )
	    	    )
	    	);

	    	query_posts( $args );
	    	?>
	    	<?php if ( have_posts() ) : ?>

					<div class="category-sorting">
					<?php
						/**
						 * woocommerce_before_shop_loop hook
						 *
						 * @hooked woocommerce_result_count - 20
						 * @hooked woocommerce_catalog_ordering - 30
						 */
						do_action( 'woocommerce_before_shop_loop' );
					?>
					</div>

					<?php woocommerce_product_loop_start(); ?>

						<?php woocommerce_product_subcategories(); ?>

						<?php while ( have_posts() ) : the_post(); ?>

							<?php wc_get_template_part( 'content', 'product' ); ?>

						<?php endwhile; // end of the loop. ?>

					<?php woocommerce_product_loop_end(); ?>

					<?php
						/**
						 * woocommerce_after_shop_loop hook
						 *
						 * @hooked woocommerce_pagination - 10
						 */
						do_action( 'woocommerce_after_shop_loop' );
					?>

				<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

					<?php wc_get_template( 'loop/no-products-found.php' ); ?>

				<?php endif; ?>

		</div>
	</div>
</div>

<?php	do_action( 'woocommerce_after_main_content' ); ?>

<?php get_footer(); ?>