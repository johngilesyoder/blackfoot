<?php get_header(); ?>

	<main role="main">
		<div class="container">

			<!-- Breadcrumbs -->
			<?php if ( function_exists('yoast_breadcrumb') ) 
			{yoast_breadcrumb('<nav id="breadcrumbs" class="breadcrumbs">','</nav>');} ?>

			<div class="row">

				<?php
				global $post;
				$children = get_pages( array( 'child_of' => $post->ID ) );
				?>

				<?php if ( is_page() && $post->post_parent || is_page() && count( $children ) > 0 ) : ?>

				
				<div class="col-md-8 col-md-push-4">

					<!-- Page Title -->
					<h1 class="page-title"><?php the_title(); ?></h1>
					
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

				<div class="col-md-4 col-md-pull-8">
					<?php
				  if ($post->post_parent) {
				  $children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0");
				  $titlenamer = get_the_title($post->post_parent);
				  }

				  else {
				  $children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
				  $titlenamer = get_the_title($post->ID);
				  }
				  if ($children) : ?>
				  <div class="page-sidebar">
					  <h2><?php echo $titlenamer; ?></h2>
					  <ul>
					  	<?php echo $children; ?>
					  </ul>
					</div>

					<?php else: ?>
					
					<?php endif; ?>
				</div>

				<?php else : ?>
				
				<div class="col-md-8">
					<!-- Page Title -->
					<h1 class="page-title"><?php the_title(); ?></h1>

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
				<div class="col-md-4">

					<?php get_sidebar(); ?>
					
				</div>

				<?php endif; ?>

				</div>
			</div>
		</div>
	</main>

	<?php get_template_part( 'includes/book-now-banner' ); ?>
	
<?php get_footer(); ?>
