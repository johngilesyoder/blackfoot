<?php /* Template Name: Trips Page Template */ get_header(); ?>

	<main role="main">
		<div class="container">
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<!-- Page Title -->
					<h1 class="page-title"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-fly.svg"> <?php the_title(); ?></h1>
					<div class="page-summary"><?php the_content(); ?></div>
				</div>
			</div>
		</div>
		<section class="trips">
			<div class="container-fluid">
				<div class="row">
				
					<?php
						$args = array(
							'post_type' => 'product',
							'posts_per_page' => 12,
							'tax_query' => array(
							    array(
						        'taxonomy' => 'product_type',
						        'field'    => 'slug',
						        'terms'    => 'booking', 
							    ),
							 	),
							);

						$loop = new WP_Query( $args );
						if ( $loop->have_posts() ) {
							while ( $loop->have_posts() ) : $loop->the_post();
								get_template_part( 'includes/trip-block' );
							endwhile;
						} else {
							echo __( 'No products found' );
						}
						wp_reset_postdata();
					?>

					<!-- Static Trips -->
					<!-- =================================== -->
					<!-- <div class="col-md-4">
					  <div class="trip" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/trip-stillwater.jpg');">
					    <div class="trip-content">
					      <h2 class="trip-title">Still Water Trip</h2>
					      <p class="trip-summary">Maecenas sed diam eget risus varius blandit sit amet non magna. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
					      <a href="/contact-us/" class="btn btn-primary">Contact us to book</a>
					    </div>
					    <div class="price">
					    	From: <span class="amount">$500.00</span>
					    </div>
					  </div>
					</div>
					<div class="col-md-4">
					  <div class="trip" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/trip-smith.jpg');">
					    <div class="trip-content">
					      <h2 class="trip-title">Smith River Trip</h2>
					      <p class="trip-summary">Maecenas sed diam eget risus varius blandit sit amet non magna. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
					      <a href="/contact-us/" class="btn btn-primary">Contact us to book</a>
					    </div>
					    <div class="price">
					    	From: <span class="amount">$500.00</span>
					    </div>
					  </div>
					</div> -->
					<div class="col-md-4">
					  <div class="trip-callout">
					    <div class="callout-content">
					    	<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-callout-question.svg">
					      <h3>Have a custom request or question and wish to contact us first?</h3>
					      <p>
					      	Call us at <a href="tel:+1406542-7411">(406) 542-7411</a><br>
					      	or <a href="/contact-us/">Send us a message</a>
					      </p>
					    </div>
					  </div>
					</div>
				</div>
			</div>
		</section>

		<!-- Trip Why? -->
		<!-- =================================== -->
		<!-- =================================== -->

		<?php get_template_part( 'includes/trip-why' ); ?>

	</main>

<?php get_footer(); ?>