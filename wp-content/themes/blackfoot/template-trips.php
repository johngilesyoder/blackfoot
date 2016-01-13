<?php /* Template Name: Trips Page Template */ get_header(); ?>

	<main role="main">
		<div class="container">
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<!-- Page Title -->
					<h1 class="page-title"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-fly.svg"> <?php the_title(); ?></h1>

					<?php if (have_posts()): while (have_posts()) : the_post(); ?>
					
					<div class="page-summary"><?php the_content(); ?></div>

					<?php endwhile; ?>

					<?php endif; ?>

				</div>
			</div>
		</div>
		<section class="trips">
			<div class="container">
				
					<?php
						$args = array(
							'post_type' => 'trip',
							'posts_per_page' => 12,
							);

						$loop = new WP_Query( $args );
						if ( $loop->have_posts() ) {
							while ( $loop->have_posts() ) : $loop->the_post();
								get_template_part( 'includes/trip-block' );
							endwhile;
						} else {
							echo __( 'No trips found' );
						}
						wp_reset_postdata();
					?>

			</div>
		</section>

		<!-- Trip Why? -->
		<!-- =================================== -->
		<!-- =================================== -->

		<?php get_template_part( 'includes/trip-why' ); ?>

	</main>

<?php get_footer(); ?>