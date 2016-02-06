<?php /* Template Name: Test Template */ get_header(); ?>


	<main role="main">
		<div class="container">

			<!-- ===================== -->
			<!-- FEATURED ITEM EXAMPLE -->
			<!-- ===================== -->
			<?php 
				$args = array(  
					'post_type' => 'product',  
					'meta_key' => '_featured',  
					'meta_value' => 'yes',  
					'posts_per_page' => 1  
				); 
				$featured_query = new WP_Query( $args );

				if ($featured_query->have_posts()) : while ($featured_query->have_posts()) : $featured_query->the_post();
				$product = get_product( $featured_query->post->ID );
				// Return Brand name for product
				global $product;
				$brand = array_shift( wc_get_product_terms( $product->id, 'product_brand', array( 'fields' => 'names' ) ) );
			?>

			<article>
				<h2 class="featured-title">Featured Product</h2>

				<?php
					if ( has_post_thumbnail() ) {

						$image_title    = esc_attr( get_the_title( get_post_thumbnail_id() ) );
						$image_caption  = get_post( get_post_thumbnail_id() )->post_excerpt;
						$image_link     = get_the_permalink();
						$image          = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
							'title' => $image_title,
							'alt' => $image_title
							)
						);
						$attachment_count = count( $product->get_gallery_attachment_ids() );

						if ( $attachment_count > 0 ) {
							$gallery = '[product-gallery]';
						} else {
							$gallery = '';
						}
						echo '<a href="' . $image_link . '">' . $image . '</a>';
					} else {
						echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );
					}
				?>
 
				<div class="featured-item-content">
					<h3 class="item-title"><?php echo $brand . '&nbsp;'; ?><?php the_title(); ?></h3>

					<?php 
						echo apply_filters( 'woocommerce_short_description', $post->post_excerpt );
						if ( $price_html = $product->get_price_html() ) :
					?>

						<span class="price"><?php echo $price_html; ?></span>

					<?php endif; ?>

					<?php
						echo apply_filters( 'woocommerce_loop_add_to_cart_link',
						sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="btn btn-primary btn-add-to-cart %s product_type_%s">%s</a>',
							esc_url( $product->add_to_cart_url() ),
							esc_attr( $product->id ),
							esc_attr( $product->get_sku() ),
							esc_attr( isset( $quantity ) ? $quantity : 1 ),
							$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
							esc_attr( $product->product_type ),
							esc_html( $product->add_to_cart_text() )
						),
						$product );
					?>

				</div>    
			</article>

			<?php endwhile; wp_reset_query(); ?>  

			<?php endif; ?> 

		</div>
	</main>

<?php get_footer(); ?>
