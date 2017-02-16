<?php /* Template Name: Hosted Trips */ get_header(); ?>

  <main role="main">
    <div class="container">
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <!-- Page Title -->
          <h1 class="page-title"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-fly.svg"> Hosted Fly Fishing Trips</h1>

          <div class="page-summary">

            <?php if (have_posts()): while (have_posts()) : the_post(); ?>

  						<?php the_content(); ?>

  					<?php endwhile; ?>

  					<?php else: ?>

  						<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>

  					<?php endif; ?>

          </div>

        </div>
      </div>
    </div>
    <section class="trips">
      <div class="container">

       <?php get_template_part('loop-trip-hosted'); ?>

      </div>
    </section>

    <!-- Trip Why? -->
    <!-- =================================== -->
    <!-- =================================== -->

    <?php get_template_part( 'includes/trip-why' ); ?>

  </main>

<?php get_footer(); ?>
