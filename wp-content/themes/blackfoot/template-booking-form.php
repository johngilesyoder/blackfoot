<?php /* Template Name: Booking Page Template */ get_header(); ?>

	<main role="main">
		<div class="container">
			<!-- Breadcrumbs -->
			<?php if ( function_exists('yoast_breadcrumb') ) 
			{yoast_breadcrumb('<nav id="breadcrumbs" class="breadcrumbs">','</nav>');} ?>
			<!-- Page Title -->
			<h1 class="page-title"><?php the_title(); ?></h1>
			<div class="row">
				<div class="col-md-8">
				<?php if (have_posts()): while (have_posts()) : the_post(); ?>
					<!-- Article -->
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php //the_content(); ?>
						<?php gravity_form( 6, false, false, false, '', false ); ?>
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
				<aside class="booking-sidebar">
					<img class="booking-photo" src="<?php echo get_template_directory_uri(); ?>/assets/img/guide-staff.jpg">
					<div class="alert alert-info alert-booking">
			      <span class="glyphicon glyphicon-question-sign"></span> <strong>Have questions, custom requests, or prefer to book over the phone?</strong>
			      <p>Please feel free to call us at <a href="tel:+14065427411">(406) 542-7411</a> or <a href="/contact-us/">send us a message</a>.</p>
			    </div>
			    <div class="badge-orvis">
			    	<span>Blackfoot River Outfitters is proud to be an Orvis<sup>&trade;</sup> endorsed guide.</span>
			    	<img src="<?php echo get_template_directory_uri(); ?>/assets/img/badge-orvis.gif">
			    </div>
				</aside>
			</div>
		</div>
	</main>

<?php get_footer(); ?>
