<?php 
  global $product;
  $brand = array_shift( wc_get_product_terms( $product->id, 'product_brand', array( 'fields' => 'names' ) ) );
  $price = $product->price;
?>

<tr>
  <td class="accessory-option">
    <input type="checkbox" class="accessory-checkbox" name="accessory" data-title="<?php echo $brand . '&nbsp;'; ?><?php the_title(); ?>" data-item="boat-accessory" data-price="0.00" data-price-each="<?php echo $price ?>" value="Boat Accessory">
  </td>
  <td class="accessory-img">
    <?php
      if ( has_post_thumbnail() ) {
        $image_title    = esc_attr( get_the_title( get_post_thumbnail_id() ) );
        $image_link     = get_the_permalink();
        $image          = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
          'title' => $image_title,
          'alt' => $image_title
          )
        );
        echo '<a href="' . $image_link . '">' . $image . '</a>';
      } else {
        echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );
      }
    ?>
  </td>
  <td class="accessory-details">
    <span class="accessory-title"><?php echo $brand . '&nbsp;'; ?><?php the_title(); ?></span>
    <?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ); ?>
  </td>
  <td class="accessory-qty">
    <input class="accessory-qty-value" type="text" name="quantity" value="1">
  </td>
  <td class="accessory-price">
    <span class="price">$<?php echo $price; ?></span>
  </td>
  <td class="accessory-subtotal">
    $<span class="accessory-subtotal-value">0.00</span>
  </td>
</tr>