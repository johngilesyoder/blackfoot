<?php get_header(); ?>

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
	</main>

<?php get_footer(); ?>
