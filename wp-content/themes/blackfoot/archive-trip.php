<?php get_header(); ?>

  <main role="main">
    <div class="container">
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <!-- Page Title -->
          <h1 class="page-title"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-fly.svg"> Guided Fly Fishing Trips</h1>

          <div class="page-summary">

            <?php
              $post_type = get_post_type_object( get_post_type($post) );
              echo $post_type->description ;
            ?>

          </div>

        </div>
      </div>
    </div>
    <section class="trips">
      <div class="container">

       <?php get_template_part('loop-trip'); ?>

       <!-- Hosted Trip Block -->
       <div class="trip">
         <div class="trip-left">
           <div class="trip-photo" style="background-image: url('<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>');"></div>
         </div>
         <div class="trip-right">
           <div class="trip-content">
             <h2 class="trip-title">Hosted Fly Fishing Trips</h2>
             <p class="trip-summary">While 99% of our business is done booking trips for private parties, on occasion we will host trips to our exclusive lodges as well as new and exciting destinations.</p>
             <!-- <span class="price">

             </span> -->
             <a href="/hosted-fly-fishing-trips/" class="btn btn-primary">View our hosted trips</a>
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
