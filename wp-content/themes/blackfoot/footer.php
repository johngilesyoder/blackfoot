		<footer class="site-footer">
      <div class="footer-top">
      	<div class="container">
          <a href="#top" id="back-to-top" class="back-to-top">Back to top</a>
          <div class="row">
            <div class="footer-links">
              <div class="row">
                <nav class="links-column">
                  <?php footer_links_1(); ?>
                </nav>
                <nav class="links-column">
                  <?php footer_links_2(); ?>
                </nav>
                <nav class="links-column">
                  <?php footer_links_3(); ?>
                </nav>
                <nav class="links-column">
                  <?php footer_links_4(); ?>
                </nav>
                <nav class="links-column">
                  <?php footer_links_5(); ?>
                </nav>
                <nav class="links-column">
                  <?php footer_links_6(); ?>
                </nav>
              </div>
            </div>
            <div class="footer-connect">
              <img class="logo-footer" src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-footer.svg">
              <address>
                3055 North Reserve Street, Suite A1<br>
                Missoula, Montana 59808
              </address>
              <div class="footer-contact">
                <a class="footer-phone" href="tel:+14065427411"><img class="icon-phone-footer" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-phone-footer.svg">(406) 542-7411</a>
                <span class="bullet">&bull;</span>
                <a href="/contact-us/">Contact us</a>
                <span class="bullet">&bull;</span>
                <div class="fb-follow" data-href="https://www.facebook.com/zuck" data-layout="button" data-show-faces="false"></div>
              </div>
            </div>
          </div>
      	 </div>
        </div>
      </div>
      <div class="footer-bottom">
        <div class="container">
          <div class="footer-trust">
            <div class="row">
              <div class="col-md-4">
                <div class="footer-trust-badges">
                  <img class="badge-trout-unlimited" src="<?php echo get_template_directory_uri(); ?>/assets/img/badge-trout-unlimited.png">
                  <img class="badge-orvis" src="<?php echo get_template_directory_uri(); ?>/assets/img/badge-orvis.png">
                </div>
              </div>
              <div class="col-md-8">
                <div class="footer-trust-copy">
                  <h3>Missoula, Montana's family owned, Orvis-endorsed fly fishing company.</h3>
                  <p>Sharing Montana rivers with anglers for over 20 years, Blackfoot River Outfitters' reputation as a leader in the Montana fly fishing industry, sits firmly on a foundation of loyal clients and their referrals. When you book a guided trip with us or have a question about fly fishing in Montana, a lifetime of experience is pressed into action.</p>
                </div>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            &copy; <?php echo date('Y'); ?> Blackfoot River Outfitters. All rights reserved. <a href="#">Privacy</a>
          </div>
         </div>
        </div>
      </div>
    </footer>

		<?php wp_footer(); ?>

	</body>
</html>
