<aside class="shop-sidebar" role="complementary">
	<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-shop')) ?>
  <a class="sidebar-sale" href="/on-sale/"><span class="glyphicon glyphicon-tag"></span>Shop Sales</a>
  <div class="sidebar-retail">
    <h3><span class="glyphicon glyphicon-map-marker"></span> Come visit us!</h3>
    <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/assets/img/home-hero-5.jpg">
    <p>We own and operate two full-service <a href="/contact-us/">fly shops</a> to outfit your adventure and fishing needs. But if you just can't wait until you get here, stock up now from our online store.</p>
  </div>
</aside>
