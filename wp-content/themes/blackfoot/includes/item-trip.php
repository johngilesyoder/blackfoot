<div class="row">
  <div class="col-md-6">
    
    <?php woocommerce_show_product_images(); ?>
    <?php 
      /**
       * woocommerce_before_single_product_summary hook
       *
       * @hooked woocommerce_show_product_sale_flash - 10
       * @hooked woocommerce_show_product_images - 20
       */
      //do_action( 'woocommerce_before_single_product_summary' );
    ?>
    <div class="trip-content">
      <?php the_content(); ?>
    </div>

  </div>
  <div class="col-md-6">
    <div class="purchase-console summary entry-summary">

    <?php //woocommerce_template_single_rating(); ?>
    <?php woocommerce_template_single_add_to_cart(); ?>
    <?php //woocommerce_template_single_price(); ?>
    <?php //woocommerce_template_single_meta(); ?>

    <?php woocommerce_template_single_sharing(); ?>
      
      <?php
        /**
         * woocommerce_single_product_summary hook
         *
         * @hooked woocommerce_template_single_title - 5
         * @hooked woocommerce_template_single_rating - 10
         * @hooked woocommerce_template_single_price - 10
         * @hooked woocommerce_template_single_excerpt - 20
         * @hooked woocommerce_template_single_add_to_cart - 30
         * @hooked woocommerce_template_single_meta - 40
         * @hooked woocommerce_template_single_sharing - 50
         */
        //do_action( 'woocommerce_single_product_summary' );
      ?>

    </div>
  </div>
</div>

<!-- Trip Why? -->
<!-- =================================== -->
<!-- =================================== -->

<?php get_template_part( 'includes/trip-why' ); ?>

<script type="text/javascript">

  // Set default value to 0 for Custom price input
  jQuery(document).ready(function(){
      jQuery('.product-addon-if-conditions-permit-do-you-have-a-river-preference select').val("no-preference-1");
      jQuery('.product-addon-would-you-like-to-add-a-detailed-flycasting-lesson select').val("no-thank-you-2");
  });

</script>