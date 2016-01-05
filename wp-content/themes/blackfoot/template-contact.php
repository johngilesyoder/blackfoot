<?php /* Template Name: Contact Us Page Template */ get_header(); ?>

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
			<div class="col-md-4">
				<aside class="contact-sidebar">
					<!-- Locations -->
					<h2 class="contact-sidebar-title">Our shop locations</h2>
					<!-- Location (Missoula) -->
					<div class="location location-blackfoot">
						<h3><img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-text-white.svg"></h3>
						<div class="address-wrapper">
							<address>
								3055 North Reserve Street, Suite A-1<br>
								Missoula, Montana 59808
							</address>
							<span class="location-email"><strong>Email:</strong> <a href="mailto:trout@blackfootriver.com">trout@blackfootriver.com</a></span>
							<span class="location-phone"><strong>Phone:</strong> (406) 542-7411</span>
						</div>
						<div class="map-wrapper">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10906.029392899114!2d-114.0393564623613!3d46.89273972490584!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xa373c026818ad3d8!2sBlackfoot+River+Outfitters!5e0!3m2!1sen!2sus!4v1447273121564" width="100%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
						</div>
					</div>
					<!-- Location (Philipsburg) -->
					<div class="location location-flint-creek">
						<h3><img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-flintcreek.png"></h3>
						<div class="address-wrapper">
							<address>
								148 West Broadway<br>
								Philipsburg, Montana 59858
							</address>
							<span class="location-email"><strong>Email:</strong> <a href="info@flintcreekoutdoors.com">matthew@blackfootriver.com</a></span>
							<span class="location-phone"><strong>Phone:</strong> (406) 859-9500</span>
						</div>
						<div class="map-wrapper">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2754.8741524891075!2d-113.29732918439636!3d46.33219268312634!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x535c751dbb11b1b9%3A0x8912078a3a3da183!2sFlint+Creek+Outdoors!5e0!3m2!1sen!2sus!4v1447274220331" width="100%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
						</div>
					</div>
				</aside>
			</div>
		</div>
	</main>

<?php get_footer(); ?>
