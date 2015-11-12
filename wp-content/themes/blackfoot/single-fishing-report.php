<?php get_header(); ?>

	<main role="main">
		<div class="container">
			<!-- Breadcrumbs -->
			<?php if ( function_exists('yoast_breadcrumb') ) 
			{yoast_breadcrumb('<nav id="breadcrumbs" class="breadcrumbs">','</nav>');} ?>
			<div class="row">
				<div class="col-md-8">
					<div class="report-header">
						<hgroup>
							<!-- Page Title -->
							<h1 class="page-title"><?php the_title(); ?></h1>
							<span class="report-updated">Updated <strong><?php the_modified_time('m/d/Y'); ?> at <?php the_modified_time('g:ia'); ?></strong></span>
						</hgroup>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8">
					<?php if (have_posts()): while (have_posts()) : the_post(); 
						$report_rating = types_render_field("conditions-at-a-glance", array("raw"=>"true"));
						$report_hatch = types_render_field("the-hatch", array("raw"=>"true"));
						$report_patterns = types_render_field("fly-patterns", array("raw"=>"true"));
				    $report_forecast_id = types_render_field("location-id", array("raw"=>"true"));
				    $report_flow = types_render_field("water-flow", array("raw"=>"true"));
				    $report_visibility = types_render_field("visibility", array("raw"=>"true"));
				    $report_temperature = types_render_field("water-temperature-at-mid-day", array("raw"=>"true"));
				    $report_water_condition = types_render_field("water-condition", array("raw"=>"true"));
				    $report_time = types_render_field("best-time-of-day-to-fish", array("raw"=>"true"));
				    $report_stretch = types_render_field("best-stretch", array("raw"=>"true"));
				    $report_access = types_render_field("access-point", array("raw"=>"true"));
				    $report_species = types_render_field("fish-species", array("raw"=>"true"));
				    $report_season = types_render_field("fishing-season", array("raw"=>"true"));
				    $report_airport = types_render_field("nearest-airport", array("raw"=>"true"));
				    $report_leader = types_render_field("recommended-fly-fishing-leader", array("raw"=>"true"));
				    $report_tippet = types_render_field("recommended-fly-fishing-tippet", array("raw"=>"true"));
				    $report_rod = types_render_field("best-fly-fishing-rod", array("raw"=>"true"));
				    $report_floating_line = types_render_field("best-floating-fly-line", array("raw"=>"true"));
				    $report_sinking_line = types_render_field("best-sinking-fly-line", array("raw"=>"true"));
					?>
					<!-- Article -->
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="report-body">
							<section class="report-glance off-white">
								<h3 class="section-title">Conditions At-a-glance</h3>
								<div class="condition-rating">
									<span class="rating-active <?php echo $report_rating; ?>"></span>
								</div>
								<span class="condition-rating-text"><?php echo $report_rating; ?></span>
							</section>
							<section class="report-forecast">
								<h3 class="section-title">Weather Forecast</h3>
								<?php echo do_shortcode('[awesome-weather woeid="' . $report_forecast_id . '" size="custom" custom_template_name="report" units="F" forecast_days="5" show_icons="1"]'); ?>
							</section>
							<section class="report-summary">
								<h3 class="section-title">Our Report</h3>
								<?php the_content(); ?>
							</section>
							<section class="report-conditions off-white">
								<h3 class="section-title">Conditions</h3>
								<?php echo $report_conditions; ?>
							</section>
							<section class="report-hatch off-white">
								<h3 class="section-title">The Hatch</h3>
								<?php echo $report_hatch; ?>
							</section>
							<section class="report-patterns off-white">
								<h3 class="section-title">Fly Patterns</h3>
								<?php echo $report_patterns; ?>
							</section>
							<section class="report-specifics">
								<h3 class="section-title">Specifics</h3>
								<div class="report-specification">
									<h4>Water Flow</h4>
									<?php echo $report_flow; ?>
								</div>
								<div class="report-specification">
									<h4>Visibility</h4>
									<?php echo $report_visibility; ?>
								</div>
								<div class="report-specification">
									<h4>Water temperature at mid-day</h4>
									<?php echo $report_temperature; ?>
								</div>
								<div class="report-specification">
									<h4>Water Condition</h4>
									<?php echo $report_water_condition; ?>
								</div>
								<div class="report-specification">
									<h4>Best time of day to fish</h4>
									<?php echo $report_time; ?>
								</div>
								<div class="report-specification">
									<h4>Best stretch</h4>
									<?php echo $report_stretch; ?>
								</div>
								<div class="report-specification">
									<h4>Best access point</h4>
									<?php echo $report_access; ?>
								</div>
								<div class="report-specification">
									<h4>Fish species</h4>
									<?php echo $report_species; ?>
								</div>
								<div class="report-specification">
									<h4>Fishing season</h4>
									<?php echo $report_season; ?>
								</div>
								<div class="report-specification">
									<h4>Nearest airport</h4>
									<?php echo $report_airport; ?>
								</div>
								<div class="report-specification">
									<h4>Recommended fly fishing leader</h4>
									<?php echo $report_leader; ?>
								</div>
								<div class="report-specification">
									<h4>Recommended fly fishing tippet</h4>
									<?php echo $report_tippet; ?>
								</div>
								<div class="report-specification">
									<h4>Best fly fishing rod</h4>
									<?php echo $report_rod; ?>
								</div>
								<div class="report-specification">
									<h4>Best floating fly line</h4>
									<?php echo $report_floating_line; ?>
								</div>
								<div class="report-specification">
									<h4>Best sinking fly line</h4>
									<?php echo $report_sinking_line; ?>
								</div>
							</section>
						</div>
					</article>
					<?php endwhile; ?>
					<?php else: ?>
						<!-- Article (not found) -->
						<article>
							<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
						</article>
					<?php endif; ?>
				</div>
				<div class="col-md-4">
					<aside class="report-sidebar">
						<?php get_template_part( 'includes/book-now-block' ); ?>
					</aside>
				</div>
			</div>
		</div>
	</main>

<?php get_footer(); ?>
