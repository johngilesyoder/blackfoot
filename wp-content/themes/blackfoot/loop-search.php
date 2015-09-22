<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<div class="loop-post">
		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<!-- post title -->
			<h2 class="post-title">
				<?php if ( get_post_meta( get_the_ID(), 'l_url', true ) ) {?>
			    <a target="_blank" href="<?php echo get_post_meta( get_the_ID(), 'l_url', true ); ?>">
			    	<?php the_title(); ?><img class="icon-external-link" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-external-link.svg">
			    </a>
				<?php } else {?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<?php if ( in_category( 'profiles' ) ) : ?>
							Profile &nbsp;//&nbsp; 
						<?php endif; ?>
						<?php the_title(); ?>
					</a>
				<?php }?>
			</h2>
			<div class="post-meta">
				<span class="author"><?php _e( '', 'html5blank' ); ?> <?php the_author_posts_link(); ?></span> &nbsp;&bull;&nbsp; <span class="date"><?php the_time('F j, Y'); ?></p></span>
			</div>

			<div class="post-excerpt">
				<?php html5wp_excerpt('html5wp_index'); // Build your custom callback length in functions.php ?>
			</div>

			<?php if ( get_post_meta( get_the_ID(), 'l_url', true ) ) {?>
				<a target="_blank" href="<?php echo get_post_meta( get_the_ID(), 'l_url', true ); ?>" class="btn btn-default btn-continue">Visit link &nbsp;&rarr;</a>
			<?php } else {?>
				<a href="<?php the_permalink(); ?>" class="btn btn-default btn-continue">Continue reading &nbsp;&rarr;</a>
			<?php }?>

			<?php if ( in_category( 'becauseofhatch' ) ) {?>
				<div class="post-format">
					<span class="format-icon"></span>
				</div>
			<?php }?>
		</article>
		<!-- /article -->
	</div>

<?php endwhile; ?>

<?php else: ?>

	<!-- article -->
	<article>
		<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
	</article>
	<!-- /article -->

<?php endif; ?>
