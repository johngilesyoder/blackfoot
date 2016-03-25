<?php /* Template Name: BYOB Success Template */ get_header(); ?>

	<?php get_template_part( 'includes/boats/boats-subnav' ); ?>

	<main role="main">
		<div class="container">

			<!-- Breadcrumbs -->
			<?php if ( function_exists('yoast_breadcrumb') ) 
			{yoast_breadcrumb('<nav id="breadcrumbs" class="breadcrumbs">','</nav>');} ?>

			<div class="row">
				
				<div class="col-md-8">
					<!-- Page Title -->
					<h1 class="page-title"><span class="glyphicon glyphicon-ok"></span> Your Boat Order Has Been Successfully Submitted!</h1>

					<?php if (have_posts()): while (have_posts()) : the_post(); ?>

					<!-- Article -->
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<?php the_content(); ?>

					</article>

					<?php endwhile; ?>

					<?php else: ?>

					<!-- Article (not found) -->
					<article>
						<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
					</article>

					<?php endif; ?>

				</div>

				</div>
			</div>
		</div>
	</main>

<?php get_footer(); ?>
