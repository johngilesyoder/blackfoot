<?php get_header(); ?>

	<main role="main">
    <div class="container">
      <!-- Breadcrumbs -->
      <?php if ( function_exists('yoast_breadcrumb') ) 
      {yoast_breadcrumb('<nav id="breadcrumbs" class="breadcrumbs">','</nav>');} ?>
      <!-- Page Title -->
      <h1 class="page-title">Our Waters</h1>

			<?php get_template_part('loop-water'); ?>

    </div>
	</main>

<?php get_footer(); ?>
