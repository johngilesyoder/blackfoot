<?php
/**
 * Booking product add to cart
 */
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

global $product;

if ( ! $product->is_purchasable() ) {
  return;
}

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<noscript><?php _e( 'Your browser must support JavaScript in order to make a booking.', 'woocommerce-bookings' ); ?></noscript>

<form class="cart" method="post" enctype='multipart/form-data'>

  <div id="wc-bookings-booking-form" class="wc-bookings-booking-form" style="display:none">

    <?php do_action( 'woocommerce_before_booking_form' ); ?>

    <?php $booking_form->output(); ?>

    <legend>
      <span>2. Choose Your Options</span>
    </legend>

    <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

    <div class="wc-bookings-booking-cost" style="display:none"></div>

  </div>

  <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />

  <div class="btn-wrapper">
    <button type="submit" class="btn-primary wc-bookings-booking-form-button single_add_to_cart_button button alt disabled" style="display:none">Book now</button>
  </div>

<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
