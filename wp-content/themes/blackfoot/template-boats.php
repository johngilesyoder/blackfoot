<?php /* Template Name: Boats Template */ get_header(); ?>

	<?php get_template_part( 'includes/boats/boats-subnav' ); ?>

	<main role="main">
		<!-- Hero -->
		<section class="boats-hero" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/boats-hero-bg.jpg');">
			<div class="container">
				<div class="boats-hero-content">
					<h2>Find Your <span>Perfect</span> Boat</h2>
					<img class="logo-blackfoot" src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-text-white.svg">
					<img class="logo-byob" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-byob-white.svg">
					<img class="logo-sotar" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-sotar-white.png">
					<a href="/build-the-perfect-fly-fishing-boat" class="btn btn-primary">Build your own <span>perfect fly fishing </span>boat</a>
				</div>
			</div>
		</section>
		<!-- Strike -->
		<section class="strike-main">
			<div class="container">
				<div class="row">
					<div class="col-sm-3">
						<aside class="strike-sidebar">
							<div class="john-photo">
							  <img class="photo" src="<?php echo get_template_directory_uri(); ?>/assets/img/boats-sidebar-john.png">
							  <span class="john-title">
							    <strong>John Herzer</strong>
							    <span>Founder, BRO</span>
							    <span>Designer of SOTAR Strike Raft</span>
							  </span>
							</div>
							<img class="sidebar-photo" src="<?php echo get_template_directory_uri(); ?>/assets/img/photo-boats-sidebar.png">
						</aside>
					</div>
					<div class="col-sm-9">
						<div class="content-block">
							<span class="subtitle">The Ultimate Fishing Boat</span>
							<h2>
								<img class="logo-sotar" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-sotar-black.png">
								Strike Raft
							</h2>

							<?php if (have_posts()): while (have_posts()) : the_post(); ?>

							<!-- Strike Summary -->
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

								<?php the_content(); ?>

							</article>

							<?php endwhile; ?>

							<?php endif; ?>

							<a href="/build-the-perfect-fly-fishing-boat" class="btn btn-primary btn-byob"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-byob-white.svg">Get started<span> building the perfect boat now</span></a>

						</div>
					</div>
				</div>
				<div class="strike-video">
					<a href="#" class="video-placeholder" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/boats-video-placeholder.png');" data-toggle="modal" data-target="#video-modal" data-theVideo="https://www.youtube.com/embed/UiHMN68Jb5s">
						<span class="btn-video">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-play-white.svg">
						</span>
					</a>
				</div>
			</div>
		</section>
		<!-- Special Edition -->
		<section class="special-edition">
			<div class="container">
				<hgroup>
					<h2>Get the Ultimate ‘Strike’</h2>
					<h3>After 30 years, John has learned exactly what you need. We are proud to offer his recommended SOTAR Strike configuration.</h3>
				</hgroup>
				<div class="special-edition-product">
					<div class="row">
						<div class="col-sm-8">
							<div class="row">
								<div class="col-sm-3">
									<img class="product-img" src="<?php echo get_template_directory_uri(); ?>/assets/img/strike-product-img.png">
								</div>
								<div class="col-sm-9">
									<span class="product-title"><img class="logo-sotar" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-sotar-black.png"> Strike Raft</span>
									<span class="product-subtitle">2016 Montana Guide Edition</span>
								</div>
							</div>
						</div>
						<div class="col-sm-4">
							<a href="#" class="btn btn-primary btn-learn-more">Request info now</a>
						</div>
					</div>
					<div class="quote-from-john">
						<h2>A few words from John Herzer on the 2016 Montana Guide Edition Strike Raft</h2>
						<p>
							"Seems like everyday I field the same questions regarding which raft to buy for fishing, what frame to use, and how to properly accessorize it.  Often that long and convoluted conversation ends in the customer asking me to put together a package resembling the rig I row every day.  With that in mind we offer the 'Montana Guide Edition' Sotar Strike.
							<div class="collapse" id="quoteCollapse">
							  <p>This one-stop shopping experience settles all your questions about assembling the finest fishing raft package available in the industry; period.</p>
							  <p>We start with the 13’6” Sotar Strike, perfect for spreading out the sometimes chaos of 2 anglers fishing out of a boat.  The 19” tube diameter diminishes to 14” in the bow section affording maximum visibility and low profile in the wind.  The stern tubes also diminish but only down to 16” allowing for gear stacked high on multi-day trips or a heavy angler and the anchor weight resting on the back tube on day trips.  The MT Guide Edition includes a 3rd air chamber in the main tubes as insurance for punctures and a top chafe of liquid lexitron applied down the straight sections and around the stern for protection against abrasion under the frame.</p>
							  <p>For the frame we’ve chosen the Montana Raft Frames’ Premier model.  This frame is best in class for the industry!  Powder coated break down aluminum base frame, dry box under rower’s seat, integrated anchor cage system with Harken sailing pulleys (read 30# anchor draws up like a 20#), two angler high back Tempress seats, and RodDog double rod holder.  Everything on this frame is made to fit the Strike like a glove minimizing line tangles while maximizing rower and angler visibility and comfort.  This is a frame we helped design and is utilized by serious guides across the United States.</p>
							</div>
							<a class="continue-reading-link" role="button" data-toggle="collapse" href="#quoteCollapse" aria-expanded="false" aria-controls="quoteCollapse">Read more</a>
						</p>
					</div>
				</div>
			</div>
		</section>
		<section id="other-watercraft" class="other-watercraft">
			<div class="container">
				<hgroup>
					<h2>Looking for more ways to spend time on the water?</h2>
					<h3>We also offer the full line of SOTAR Rafts, Inflatable Kayaks, and Catarafts.</h3>
				</hgroup>
				<div class="other-categories">
					<div class="row">
						<div class="col-sm-6 col-md-4">
							<div class="boat-category">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/img/boats-rafts.jpg">
								<h3>SOTAR Rafts</h3>
								<p>All SOTAR Inflatables are designed and manufactured one at a time. No other Inflatables are made with such personal care and attention.</p>
							</div>
						</div>
						<div class="col-sm-6 col-md-4">
							<div class="boat-category">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/img/boats-kayaks.jpg">
								<h3>SOTAR Kayaks</h3>
								<p>SOTAR Inflatable Kayaks are a beautiful fusion of performance and durability.   A look at the sleek lines gives you a glimpse of the performance you will appreciate.</p>
							</div>
						</div>
						<div class="col-sm-6 col-md-4">
							<div class="boat-category">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/img/boats-cats.jpg">
								<h3>SOTAR Catarafts</h3>
								<p>SOTAR’s continuous curve Cat design has become an industry standard. By eliminating all cross miter seams we were able to decrease drag and increase performance.</p>
							</div>
						</div>
					</div>
				</div>
				<div class="schedule-consultation">
					<a href="/contact-us" class="btn btn-primary btn-schedule">Schedule a boat consultation with our experts</a>
				</div>
			</div>
		</section>
	</main>

	<!-- Modal -->
	<div class="modal fade" id="video-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-body">
	      	<button type="button" class="close" data-dismiss="modal" aria-label="Close">Close <span aria-hidden="true">&times;</span></button>
	        <div>
              <iframe width="100%" height="350" src=""></iframe>
          </div>
	      </div>
	    </div>
	  </div>
	</div>

	<script type="text/javascript">
		jQuery(function() {
			jQuery("a[data-toggle='collapse']").click(function() {
        if (jQuery(this).text() == 'Read more') {
          jQuery(this).text('Read less');
        } else {
          jQuery(this).text('Read more');
        }
      });
		});

		  autoPlayYouTubeModal();

	  //FUNCTION TO GET AND AUTO PLAY YOUTUBE VIDEO FROM DATATAG
	  function autoPlayYouTubeModal() {
      var trigger = jQuery("body").find('[data-toggle="modal"]');
      trigger.click(function () {
          var theModal = jQuery(this).data("target"),
              videoSRC = jQuery(this).attr("data-theVideo"),
              videoSRCauto = videoSRC + "?autoplay=1";
          jQuery(theModal + ' iframe').attr('src', videoSRCauto);
          jQuery(theModal + ' button.close').click(function () {
              $(theModal + ' iframe').attr('src', videoSRC);
          });
          jQuery('.modal').click(function () {
              jQuery(theModal + ' iframe').attr('src', videoSRC);
          });
      });
	  }

	</script>

	<?php get_template_part( 'includes/book-now-banner' ); ?>

<?php get_footer(); ?>
