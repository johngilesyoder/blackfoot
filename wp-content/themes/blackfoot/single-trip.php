<?php get_header(); ?>

	<main role="main">

	<?php
		if (have_posts()): while (have_posts()) : the_post();
		// Get feature img URL
		$thumb_id = get_post_thumbnail_id();
    $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
    $thumb_url = $thumb_url_array[0];

    $price_statement = types_render_field("price-statement", array("raw"=>"true"));
	?>

		<!-- Article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<!-- Hero -->
			<section class="trip-hero" style="background-image: url('<?php echo $thumb_url ?>');">
				<div class="trip-hero-gradient">
					<div class="container">
						<!-- Breadcrumbs -->
						<?php if ( function_exists('yoast_breadcrumb') )
						{yoast_breadcrumb('<nav id="breadcrumbs" class="breadcrumbs">','</nav>');}?>
						<div class="trip-hero-content">
							<!-- Water Title -->
							<h1 class="trip-title"><?php the_title(); ?></h1>
							<div class="trip-meta">
								<span class="price">
				        	<?php echo $price_statement; ?>
				      	</span>
				      </div>
						</div>
					</div>
				</div>
			</section>
			<div class="trip-body">
				<div class="container">
					<div class="row">
						<div class="col-md-8">
							<!-- Water Description -->
							<section class="trip-description">
								<h2 class="section-title">Description</h2>
								<div id="description-content" class="description-content">
									<?php the_content(); // Dynamic Content ?>
								</div>
							</section>

						</div>
						<div class="col-md-4">
							<!-- Trips Sidebar -->
							<aside class="trip-sidebar">
								<div class="book-now-block">
									<?php if (is_single( 'smith-river-trips' )) : ?>
									<h2>Book this trip!</h2>
								  <p>
								    If you are interested in booking a trip on the beautiful Smith River, please call us at <a href="tel:+14065427411">(406) 542-7411</a> or <a href="/contact-us/">send us a message</a>.
								  </p>
								  <a href="/contact-us/" class="btn btn-book">Inquire or Book now</a>
									<?php elseif (in_category( '441' )) : ?>
										<h2>Book this trip!</h2>
									  <p>
									    If you are interested in booking a hosted trip, please call us at <a href="tel:+14065427411">(406) 542-7411</a> or <a href="/contact-us/">send us a message</a>.
									  </p>
									<?php else : ?>
								  <h2>Book a trip!</h2>
								  <p>
								    <strong>Floatfish</strong>, <strong>Floatfish/Whitewater</strong>, <strong>Walk/Wade Combos</strong>, <strong>Overnight Trips</strong>, and <strong>Scenic trips</strong> available for many Montana waters.
								  </p>
								  <a href="/book-a-trip-with-us/" class="btn btn-book">Inquire or Book now</a>
									<?php endif; ?>
								</div>
								<div class="badge-orvis">
						    	<span>Blackfoot River Outfitters is proud to be an Orvis<sup>&trade;</sup> endorsed guide.</span>
						    	<img src="<?php echo get_template_directory_uri(); ?>/assets/img/badge-orvis.gif">
						    </div>
							</aside>
						</div>
					</div>
				</div>
			</div>
		</article>

	<?php endwhile; ?>

	<?php endif; ?>

	<?php get_template_part( 'includes/trip-why' ); ?>

	</main>

<?php get_footer(); ?>
