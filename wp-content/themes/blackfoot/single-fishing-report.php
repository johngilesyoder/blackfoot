<?php get_header(); ?>

	<main role="main">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<!-- Breadcrumbs -->
					<?php if ( function_exists('yoast_breadcrumb') ) 
					{yoast_breadcrumb('<nav id="breadcrumbs" class="breadcrumbs">','</nav>');} ?>
				</div>
				<div class="col-md-6">
					<div class="select-report">	
						<form action="<?php bloginfo('url'); ?>" method="get">
							Select a river to view it’s report <?php wp_dropdown_pages(array('post_type'=>'fishing-report','selected'=>'0','show_option_none'=>'Select a river')); ?>
							<button type="submit" name="submit" class="btn btn-default btn-xs">View</button>
						</form>
					</div>
				</div>
			</div>
			<?php if (have_posts()): while (have_posts()) : the_post(); 
				$report_rating = types_render_field("conditions-at-a-glance", array("raw"=>"true"));
				$report_conditions = types_render_field("conditions", array("raw"=>"true"));
				$report_hatch = types_render_field("the-hatch", array("raw"=>"true"));
				$report_patterns = types_render_field("fly-patterns", array("raw"=>"true"));
		    $report_forecast_id = types_render_field("location-id", array("raw"=>"true"));
		    $report_flow = types_render_field("water-flow", array("raw"=>"true"));
		    $report_visibility = types_render_field("visibility", array("raw"=>"true"));
		    $report_temperature = types_render_field("water-temperature-at-mid-day", array("raw"=>"true"));
		    $report_water_condition = types_render_field("water-condition", array("raw"=>"true"));
		    $report_time = types_render_field("best-time-of-day-to-fish", array("raw"=>"true"));
		    $report_stretch = types_render_field("best-stretch", array("raw"=>"true"));
		    $report_access = types_render_field("best-access-point", array("raw"=>"true"));
		    $report_species = types_render_field("fish-species", array("raw"=>"true"));
		    $report_season = types_render_field("fishing-season", array("raw"=>"true"));
		    $report_airport = types_render_field("nearest-airport", array("raw"=>"true"));
		    $report_leader = types_render_field("recommended-fly-fishing-leader", array("raw"=>"true"));
		    $report_tippet = types_render_field("recommended-fly-fishing-tippet", array("raw"=>"true"));
		    $report_rod = types_render_field("best-fly-fishing-rod", array("raw"=>"true"));
		    $report_floating_line = types_render_field("best-floating-fly-line", array("raw"=>"true"));
		    $report_sinking_line = types_render_field("best-sinking-fly-line", array("raw"=>"true"));
		    $report_illustration = types_render_field("location-illustration", array("raw"=>"true"));
			?>
			<div class="row">
				<div class="col-md-8">
					<div class="report-header">
						<div class="row">
							<div class="col-md-9">
								<hgroup>
									<img class="report-illustration" src="<?php echo $report_illustration; ?>">
									<!-- Page Title -->
									<h1 class="page-title"><?php the_title(); ?></h1>
									<span class="report-updated">Updated <strong><?php the_modified_time('m/d/Y'); ?> at <?php the_modified_time('g:ia'); ?></strong></span>
								</hgroup>
							</div>
							<div class="col-md-3">
								<div class="report-share">
									<!-- FB -->
									<div class="share-fb">
										<div class="fb-share-button" data-href="<?php the_permalink(); ?>" data-layout="button"></div>
									</div>
									<!-- Tweet -->
									<div class="share-tweet">
										<a href="https://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8">
					<!-- Article -->
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="report-body">
							<section class="report-glance off-white">
								<h3 class="section-title">Conditions At-a-glance</h3>
								<div class="condition-rating">
									<span class="rating-active <?php echo $report_rating; ?>"></span>
								</div>
								<span class="condition-rating-text"><?php echo $report_rating; ?></span>
							</section>
							<section class="report-forecast">
								<h3 class="section-title">Weather Forecast</h3>
								<?php echo do_shortcode('[awesome-weather woeid="' . $report_forecast_id . '" size="custom" custom_template_name="report" units="F" forecast_days="5" show_icons="1"]'); ?>
							</section>
							<section class="report-summary">
								<h3 class="section-title">Our Report</h3>
								<?php the_content(); ?>
							</section>
							<section class="report-conditions off-white">
								<h3 class="section-title">Conditions</h3>
								<?php echo $report_conditions; ?>
							</section>
							<section class="report-hatch off-white">
								<h3 class="section-title">The Hatch</h3>
								<?php echo $report_hatch; ?>
							</section>
							<section class="report-patterns off-white">
								<h3 class="section-title">Fly Patterns</h3>
								<?php echo $report_patterns; ?>
							</section>
							<section class="report-specifics">
								<h3 class="section-title">Specifics</h3>
								<div class="report-specification">
									<h4>Water Flow</h4>
									<?php echo $report_flow; ?>
								</div>
								<div class="report-specification">
									<h4>Visibility</h4>
									<?php echo $report_visibility; ?>
								</div>
								<div class="report-specification">
									<h4>Water temperature at mid-day</h4>
									<?php echo $report_temperature; ?>
								</div>
								<div class="report-specification">
									<h4>Water Condition</h4>
									<?php echo $report_water_condition; ?>
								</div>
								<div class="report-specification">
									<h4>Best time of day to fish</h4>
									<?php echo $report_time; ?>
								</div>
								<div class="report-specification">
									<h4>Best stretch</h4>
									<?php echo $report_stretch; ?>
								</div>
								<div class="report-specification">
									<h4>Best access point</h4>
									<?php echo $report_access; ?>
								</div>
								<div class="report-specification">
									<h4>Fish species</h4>
									<?php echo $report_species; ?>
								</div>
								<div class="report-specification">
									<h4>Fishing season</h4>
									<?php echo $report_season; ?>
								</div>
								<div class="report-specification">
									<h4>Nearest airport</h4>
									<?php echo $report_airport; ?>
								</div>
								<div class="report-specification">
									<h4>Recommended fly fishing leader</h4>
									<?php echo $report_leader; ?>
								</div>
								<div class="report-specification">
									<h4>Recommended fly fishing tippet</h4>
									<?php echo $report_tippet; ?>
								</div>
								<div class="report-specification">
									<h4>Best fly fishing rod</h4>
									<?php echo $report_rod; ?>
								</div>
								<div class="report-specification">
									<h4>Best floating fly line</h4>
									<?php echo $report_floating_line; ?>
								</div>
								<div class="report-specification">
									<h4>Best sinking fly line</h4>
									<?php echo $report_sinking_line; ?>
								</div>
							</section>
						</div>
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
					<aside class="report-sidebar">
						<?php get_template_part( 'includes/book-now-block' ); ?>
						<div class="mailing-list-signup">
							<h2 class="sidebar-title"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-updates.svg"> Stay tuned</h2>
							<p>Get alerts when we post a new report.</p>

							<!-- Begin MailChimp Signup Form -->
							<div id="mc_embed_signup">
								<form action="//blackfoot.us12.list-manage.com/subscribe/post?u=3c4a344d1d0c615470903a5ce&amp;id=a44ead3a0f" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
								  <div id="mce-responses" class="clear">
										<div class="response" id="mce-error-response" style="display:none"></div>
										<div class="response" id="mce-success-response" style="display:none"></div>
									</div>
									<div class="input-group mc-field-group">
										<input type="email" value="" name="EMAIL" class="form-control required email" id="mce-EMAIL" placeholder="email address">
										<span class="input-group-btn">
											<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn btn-default btn-subscribe">
										</span>
									</div>
									<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
						    	<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_3c4a344d1d0c615470903a5ce_a44ead3a0f" tabindex="-1" value=""></div>
								</form>
							</div>
							<!--End mc_embed_signup-->
						</div>
						  <!-- FEATURED ITEM -->
							<?php 
						    $args = array(  
						      'post_type' => 'product',  
						      'meta_key' => '_featured',  
						      'meta_value' => 'yes',  
						      'posts_per_page' => 1  
						    ); 
						    $featured_query = new WP_Query( $args );
						  ?>  
						          
						  <?php 
						    if ($featured_query->have_posts()) : while ($featured_query->have_posts()) : $featured_query->the_post();
						    $product = get_product( $featured_query->post->ID );
						    // Return Brand name for product
						    global $product;
						    $brand = array_shift( wc_get_product_terms( $product->id, 'product_brand', array( 'fields' => 'names' ) ) );
						  ?>

						  <article id="sidebar-featured" class="sidebar-featured">
						    <h2 class="featured-title"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-featured-peach.svg"> Featured Product</h2>
						    <div class="featured-item-img">
						      <?php
						        if ( has_post_thumbnail() ) {

						          $image_title    = esc_attr( get_the_title( get_post_thumbnail_id() ) );
						          $image_caption  = get_post( get_post_thumbnail_id() )->post_excerpt;
						          $image_link     = get_the_permalink();
						          $image          = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
						            'title' => $image_title,
						            'alt' => $image_title
						            ) );

						          $attachment_count = count( $product->get_gallery_attachment_ids() );

						          if ( $attachment_count > 0 ) {
						            $gallery = '[product-gallery]';
						          } else {
						            $gallery = '';
						          }

						          echo '<a href="' . $image_link . '">' . $image . '</a>';

						        } else {

						          echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );

						        }
						      ?>
						    </div> 
						    <div class="featured-item-content">
						      <h3 class="item-title"><?php echo $brand . '&nbsp;'; ?><?php the_title(); ?></h3>
						      <?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
						      <?php if ( $price_html = $product->get_price_html() ) : ?>
						        <span class="price"><?php echo $price_html; ?></span>
						      <?php endif; ?>
						      <?php echo apply_filters( 'woocommerce_loop_add_to_cart_link',
						            sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="btn btn-primary btn-add-to-cart %s product_type_%s">%s</a>',
						              esc_url( $product->add_to_cart_url() ),
						              esc_attr( $product->id ),
						              esc_attr( $product->get_sku() ),
						              esc_attr( isset( $quantity ) ? $quantity : 1 ),
						              $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
						              esc_attr( $product->product_type ),
						              esc_html( $product->add_to_cart_text() )
						            ),
						          $product );
						      ?>
						    </div>    
						  </article>

						  <?php endwhile; wp_reset_query(); ?>  

						  <?php endif; ?> 
					</aside>
				</div>
			</div>
		</div>
	</main>

	<?php get_template_part( 'includes/book-now-banner' ); ?>

<?php get_footer(); ?>