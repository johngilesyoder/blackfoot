<?php /* Template Name: Boats Template */ get_header(); ?>

	<div class="subnav">
		<div class="container-fluid">
			<h1 class="page-title"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-byob-black.svg"><?php the_title(); ?></h1>
			<ul>
				<li><a href="#">Strike Raft</a></li>
				<li><a href="#">Rafts, Kayaks, Cats</a></li>
				<li><a href="#" class="link-consultation">Schedule a Consultation</a></li>
			</ul>
		</div>
	</div>

	<main role="main">
		<!-- Hero -->
		<section class="boats-hero" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/boats-hero-bg.jpg');">
			<div class="container">
				<div class="boats-hero-content">
					<h2>Find Your <span>Perfect</span> Boat</h2>
					<img class="logo-blackfoot" src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-text-white.svg">
					<img class="logo-byob" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-byob-white.svg">
					<img class="logo-sotar" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-sotar-white.png">
				</div>
			</div>
		</section>
		<section class="strike-main">
			<div class="container">
				<div class="row">
					<div class="col-sm-3">
						<aside class="strike-sidebar">
							<div class="john-photo">
							  <img class="photo" src="<?php echo get_template_directory_uri(); ?>/assets/img/boats-sidebar-john.png">
							  <span class="john-title">
							    <strong>John Herzer</strong>
							    <span>Founder, BRO</span>
							    <span>Designer of SOTAR Strike Raft</span>
							  </span>
							</div>
							<img class="sidebar-photo" src="<?php echo get_template_directory_uri(); ?>/assets/img/photo-boats-sidebar.png">
						</aside>
					</div>
					<div class="col-sm-9">
						<div class="content-block">
							<span class="subtitle">The Ultimate Fishing Boat</span>
							<h2>
								<img class="logo-sotar" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-sotar-black.png">
								Strike Raft
							</h2>
							<a href="#" class="btn btn-primary btn-byob"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-byob-white.svg">Build Your Own Boat Now</a>

							<?php if (have_posts()): while (have_posts()) : the_post(); ?>

							<!-- Strike Summary -->
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

								<?php the_content(); ?>

							</article>

							<?php endwhile; ?>

							<?php endif; ?>

						</div>
					</div>
				</div>
			</div>
		</section>
	</main>

<?php get_footer(); ?>
