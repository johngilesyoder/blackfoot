<!-- FEATURED PRODUCT -->
<!-- =================================== -->
<?php 
  $args = array(  
    'post_type' => 'product',  
    'meta_key' => '_featured',  
    'meta_value' => 'yes',  
    'posts_per_page' => 1  
  ); 
  $featured_query = new WP_Query( $args );
?>  
        
<?php 
  if ($featured_query->have_posts()) : while ($featured_query->have_posts()) : $featured_query->the_post();
  $product = get_product( $featured_query->post->ID );
  // Return Brand name for product
  global $product;
  $brand = array_shift( wc_get_product_terms( $product->id, 'product_brand', array( 'fields' => 'names' ) ) );
?>

<section id="shop-featured" class="shop-section shop-featured">
  <div class="row">
    <div class="col-md-7">
      <div class="featured-item-content">
        <h2 class="featured-title"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-featured-peach.svg"> Featured Product</h2>
        <h3 class="item-title"><?php echo $brand . '&nbsp;'; ?><?php the_title(); ?></h3>
        <?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
        <?php if ( $price_html = $product->get_price_html() ) : ?>
          <span class="price"><?php echo $price_html; ?></span>
        <?php endif; ?>
        <?php echo apply_filters( 'woocommerce_loop_add_to_cart_link',
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
    </div>
    <div class="col-md-5">
      <div class="featured-item-img">
        <?php
            if ( has_post_thumbnail() ) {

              $image_title  = esc_attr( get_the_title( get_post_thumbnail_id() ) );
              $image_caption  = get_post( get_post_thumbnail_id() )->post_excerpt;
              $image_link   = wp_get_attachment_url( get_post_thumbnail_id() );
              $image        = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
                'title' => $image_title,
                'alt' => $image_title
                ) );

              $attachment_count = count( $product->get_gallery_attachment_ids() );

              if ( $attachment_count > 0 ) {
                $gallery = '[product-gallery]';
              } else {
                $gallery = '';
              }

              echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_caption, $image ), $post->ID );

            } else {

              echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );

            }
          ?>
      </div> 
    </div>
  </div>    
</section>

<?php endwhile; wp_reset_query(); ?>  

<?php endif; ?> 

<!-- NEW ITEMS -->
<!-- =================================== -->
<section id="shop-recent" class="shop-section shop-recent">
  <h3 class="section-title"><span>New Items</span></h1>
  <?php echo do_shortcode('[recent_products per_page="3" columns="3"]'); ?>
</section>

<!-- FEATURED BRANDS -->
<!-- =================================== -->
<section id="shop-categories" class="shop-section shop-categories">
  <h3 class="section-title"><span>Product Categories</span></h3>
  <?php echo do_shortcode('[product_categories hide_empty="0" columns="3" parent="0"]'); ?>
</section>

<!-- FEATURED BRANDS -->
<!-- =================================== -->
<section id="shop-brands" class="shop-section shop-brands">
  <h3 class="section-title"><span>Featured Brands</span></h3>
  <div class="featured-brands">
    <a href="/brand/orvis/"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/featured-brand-orvis.jpg"></a>
    <a href="/brand/g-loomis/"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/featured-brand-gloomis.jpg"></a>
    <a href="/brand/simms/"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/featured-brand-simms.jpg"></a>
    <a href="/brand/sotar"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/featured-brand-sotar.jpg"></a>
  </div>
</section>