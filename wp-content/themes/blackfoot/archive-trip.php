<?php get_header(); ?>

  <main role="main">
      <div class="container">
        <div class="row">
          <div class="col-md-10 col-md-offset-1">
            <!-- Page Title -->
            <h1 class="page-title"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-fly.svg"> <?php the_title(); ?></h1>

            <?php if (have_posts()): while (have_posts()) : the_post(); ?>
            
            <div class="page-summary">sdfsdf

              <?php 
                $post_type = get_post_type_object( get_post_type($post) );
                echo $post_type->description ;
              ?>

            </div>

            <?php endwhile; ?>

            <?php endif; ?>

          </div>
        </div>
      </div>
      <section class="trips">
        <div class="container">

         <?php get_template_part('loop-trip'); ?>

        </div>
      </section>
    </section>

    <!-- Trip Why? -->
    <!-- =================================== -->
    <!-- =================================== -->

    <?php get_template_part( 'includes/trip-why' ); ?>

  </main>

<?php get_footer(); ?>