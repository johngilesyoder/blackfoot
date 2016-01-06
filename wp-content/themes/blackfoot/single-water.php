<?php get_header(); ?>

	<main role="main">

	<?php 
		if (have_posts()): while (have_posts()) : the_post();
		// Get feature img URL
		$thumb_id = get_post_thumbnail_id();
    $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
    $thumb_url = $thumb_url_array[0];
		// Get Location, Video URL, and Report URL
    $water_location = types_render_field("location", array("raw"=>"true"));
    $water_video = types_render_field("video-url", array("raw"=>"true"));
    $water_report = types_render_field("fishing-report-url", array("raw"=>"true"));
    // Get Stats
    $stat_catch = types_render_field("typical-catch", array("raw"=>"true"));
    $stat_drainage = types_render_field("total-area-of-drainage", array("raw"=>"true"));
    $stat_miles = types_render_field("total-river-miles-we-guide", array("raw"=>"true"));
    $stat_distance = types_render_field("travel-distances-from-missoula", array("raw"=>"true"));
    $stat_accommodations = types_render_field("bank-side-accommodations", array("raw"=>"true"));
    $stat_style = types_render_field("primary-style-of-fishing", array("raw"=>"true"));
    $stat_pattern_1_title = types_render_field("pattern-1-title", array("raw"=>"true"));
    $stat_pattern_2_title = types_render_field("pattern-2-title", array("raw"=>"true"));
    $stat_pattern_3_title = types_render_field("pattern-3-title", array("raw"=>"true"));
    $stat_pattern_4_title = types_render_field("pattern-4-title", array("raw"=>"true"));
    $stat_pattern_5_title = types_render_field("pattern-5-title", array("raw"=>"true"));
    $stat_pattern_6_title = types_render_field("pattern-6-title", array("raw"=>"true"));
    $stat_pattern_1_image = types_render_field("pattern-1-image", array("raw"=>"true"));
    $stat_pattern_2_image = types_render_field("pattern-2-image", array("raw"=>"true"));
    $stat_pattern_3_image = types_render_field("pattern-3-image", array("raw"=>"true"));
    $stat_pattern_4_image = types_render_field("pattern-4-image", array("raw"=>"true"));
    $stat_pattern_5_image = types_render_field("pattern-5-img", array("raw"=>"true"));
    $stat_pattern_6_image = types_render_field("pattern-6-img", array("raw"=>"true"));
	?>

		<!-- Article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<!-- Hero -->
			<section class="water-hero" style="background-image: url('<?php echo $thumb_url ?>');">
				<div class="water-hero-gradient">
					<div class="container">
						<!-- Breadcrumbs -->
						<?php if ( function_exists('yoast_breadcrumb') ) 
						{yoast_breadcrumb('<nav id="breadcrumbs" class="breadcrumbs">','</nav>');}?>
						<div class="water-hero-content">
							<!-- Water Title -->
							<div class="row">
								<div class="col-md-6">
									<h1 class="water-title"><?php the_title(); ?></h1>
								</div>
							</div>
							<!-- Water Meta -->
							<div class="water-meta">
								<?php if ( $water_location !== '' ) : ?>
									<span class="water-location"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-location-white.svg"><?php echo $water_location; ?></span>
								<? endif; ?>
								<?php if ( $water_video !== '' ) : ?>
									<a href="<?php echo $water_video; ?>" target="_blank" class="water-video"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-water-video.svg">Watch the Video</a>
								<? endif; ?>
								<?php if ( $water_report !== '' ) : ?>
									<a href="<?php echo $water_report; ?>" class="water-report"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-water-report.svg">View Fishing Report</a>
								<? endif; ?>
							</div>
						</div>
					</div>
				</div>
			</section>
			<div class="water-body">
				<div class="container">
					<div class="row">
						<div class="col-md-8">
							<!-- Water Description -->
							<section class="water-description">
								<h2 class="section-title">Description</h2>
								<div id="description-content" class="description-content">
									<?php the_content(); // Dynamic Content ?>
								</div>
							</section>
							<!-- Water Stats -->
							<section class="water-stats">
								<h2 class="section-title">The Stats</h2>
								<ul>
									<?php if ( $stat_catch !== '' ) : ?>
									<li class="stat">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-stat-catch.svg">
										<h4>Typical Catch</h4>
										<p><?php echo $stat_catch; ?></p>
									</li>
									<? endif; ?>
									<?php if ( $stat_drainage !== '' ) : ?>
									<li class="stat">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-stat-drainage.svg">
										<h4>Total Area of Drainage</h4>
										<p><?php echo $stat_drainage; ?></p>
									</li>
									<? endif; ?>
									<?php if ( $stat_miles !== '' ) : ?>
									<li class="stat">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-stat-miles.svg">
										<h4>Total River Miles We Guide</h4>
										<p><?php echo $stat_miles; ?></p>
									</li>
									<? endif; ?>
									<?php if ( $stat_distance !== '' ) : ?>
									<li class="stat">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-stat-distance.svg">
										<h4>Travel Distances from Missoula</h4>
										<p><?php echo $stat_distance; ?></p>
									</li>
									<? endif; ?>
									<?php if ( $stat_accommodations !== '' ) : ?>
									<li class="stat">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-stat-accommodations.svg">
										<h4>Bank-side Accommodations</h4>
										<p><?php echo $stat_accommodations; ?></p>
									</li>
									<? endif; ?>
									<?php if ( $stat_style !== '' ) : ?>
									<li class="stat">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-stat-style.svg">
										<h4>Primary Style of Fishing</h4>
										<p><?php echo $stat_style; ?></p>
									</li>
									<? endif; ?>
							</section>
							<!-- Top 5 Patterns -->
							<section class="water-patterns">
								<h2 class="section-title">BRO’s Top Six Patterns for <em><?php the_title(); ?></em></h2>	
								<div class="row">	
									<ul>
									<?php if ( $stat_pattern_1_title !== '' ) : ?>
									<li>
										<span class="pattern-img" style="background-image:url('<?php echo $stat_pattern_1_image; ?>');"></span>
										<?php echo $stat_pattern_1_title; ?>
									</li>
									<? endif; ?>
									<?php if ( $stat_pattern_2_title !== '' ) : ?>
									<li>
										<span class="pattern-img" style="background-image:url('<?php echo $stat_pattern_2_image; ?>');"></span>
										<?php echo $stat_pattern_2_title; ?>
									</li>
									<? endif; ?>
									<?php if ( $stat_pattern_3_title !== '' ) : ?>
									<li>
										<span class="pattern-img" style="background-image:url('<?php echo $stat_pattern_3_image; ?>');"></span>
										<?php echo $stat_pattern_3_title; ?>
									</li>
									<? endif; ?>
									<?php if ( $stat_pattern_4_title !== '' ) : ?>
									<li>
										<span class="pattern-img" style="background-image:url('<?php echo $stat_pattern_4_image; ?>');"></span>
										<?php echo $stat_pattern_4_title; ?>
									</li>
									<? endif; ?>
									<?php if ( $stat_pattern_5_title !== '' ) : ?>
									<li>
										<span class="pattern-img" style="background-image:url('<?php echo $stat_pattern_5_image; ?>');"></span>
										<?php echo $stat_pattern_5_title; ?>
									</li>
									<? endif; ?>
									<?php if ( $stat_pattern_6_title !== '' ) : ?>
									<li>
										<span class="pattern-img" style="background-image:url('<?php echo $stat_pattern_6_image; ?>');"></span>
										<?php echo $stat_pattern_6_title; ?>
									</li>
									<? endif; ?>
									</ul>
								</div>					
							</section>
						</div>
						<div class="col-md-4">
							<!-- Sidebar -->
							<aside class="water-sidebar">
								<?php get_template_part( 'includes/book-now-block' ); ?>
								<div class="other-waters">
									<h2 class="sidebar-title">More of Our Waters</h2>
									<div>
										<?php
										  // Define loop
										  $loop = new WP_Query( array( 'post_type' => 'water', 'posts_per_page' => 9 ) );
										  // Start loop
										  while ( $loop->have_posts() ) : $loop->the_post();
										  // Set variables
										  $thumb_id           = get_post_thumbnail_id();
										  $thumb_url_array    = wp_get_attachment_image_src($thumb_id, 'full', true);
										  $thumb_url          = $thumb_url_array[0];
										  $water_species      = types_render_field("popular-fish-species", array());
										  $water_trips        = types_render_field("trip-types", array());
										?>

									  <!-- Water Block -->
								    <a href="<?php the_permalink(); ?>" class="other-water" style="background-image: url('<?php echo $thumb_url; ?>');">
								    	<span class="other-water-title"><?php if (strlen($post->post_title) > 15) { echo substr(the_title($before = '', $after = '', FALSE), 0, 15) . '...'; } else { the_title(); } ?></span>
								    </a>

										<?php endwhile; wp_reset_query(); ?>
										
									</div>
								</div>
							</aside>
						</div>
					</div>
				</div>
			</div>
		</article>

	<?php endwhile; ?>

	<?php endif; ?>

	</main>

<?php get_footer(); ?>
