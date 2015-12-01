<?php get_header(); ?>

	<main role="main">
    <div class="container">
      <!-- Breadcrumbs -->
      <?php if ( function_exists('yoast_breadcrumb') ) 
      {yoast_breadcrumb('<nav id="breadcrumbs" class="breadcrumbs">','</nav>');} ?>
      <!-- Page Title -->
      <h1 class="page-title">Our Waters</h1>

      <div class="page-content">
        <?php 
          $post_type = get_post_type_object( get_post_type($post) );
          echo $post_type->description ;
        ?>
      </div>

			<?php get_template_part('loop-water'); ?>

    </div>
	</main>

<?php get_footer(); ?>
