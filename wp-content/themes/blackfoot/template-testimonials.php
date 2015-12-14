<?php /* Template Name: Testimonials Page Template */ get_header(); ?>

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
						
					<?php the_content(); ?>

				<?php endwhile; ?>

					</article>
				
				<?php endif; ?>

					<?php
					  // Define loop
					  $loop = new WP_Query( array( 'post_type' => 'testimonial', 'posts_per_page' => 6 ) );
					  // Start loop
					  while ( $loop->have_posts() ) : $loop->the_post();
					  // Set testimonial variables
					  $thumb_id           = get_post_thumbnail_id();
					  $thumb_url_array    = wp_get_attachment_image_src($thumb_id, 'full', true);
					  $thumb_url          = $thumb_url_array[0];
					  $testimonial_home   = types_render_field("guest-home-location", array());
					?>

				  <!-- Section quote -->
				  <blockquote class="testimonial">
				    <div class="row">
				      <div class="col-md-2">
				        <div class="testimonial-photo" style="background-image: url('<?php echo $thumb_url; ?>');"></div>
				      </div>
				      <div class="col-md-10">
				        <?php echo the_content(); ?>
				        <footer><span>&mdash;</span> <?php the_title(); ?> <cite><?php echo $testimonial_home; ?></cite></footer>
				      </div>
				    </div>
				  </blockquote>
				  <?php endwhile; wp_reset_query(); ?>

				</div>
				<div class="col-md-4">
					<!-- Sidebar -->
					<aside class="water-sidebar">
						<?php get_template_part( 'includes/book-now-block' ); ?>
					</aside>
				</div>

				
			</div>
		</div>
	</main>

<?php get_footer(); ?>