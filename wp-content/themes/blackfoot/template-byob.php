<?php /* Template Name: BYOB Template */ get_header(); ?>

	<?php get_template_part( 'includes/boats/boats-subnav' ); ?>

	<main role="main">
		<!-- Hero -->
		<section class="byob-hero" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/boats/Sotar_Strike_Fishing_Inflatable_Raft.jpg');">
			<div class="container">
				<div class="boats-hero-content">
					<img class="logo-byob" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-byob-white.svg">
					<h2>Build Your Own SOTAR Strike</h2>
				</div>
			</div>
		</section>
		<section class="byob-summary">
			<div class="container">
				<div class="content-block">
					<span class="subtitle">The Ultimate Fishing Boat</span>
					<h2>
						<img class="logo-sotar" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-sotar-black.png">
						Strike Raft
					</h2>

					<?php if (have_posts()): while (have_posts()) : the_post(); ?>

					<!-- Strike Summary -->
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<?php the_content(); ?>

					</article>

					<?php endwhile; ?>

					<?php endif; ?>

				</div>
			</div>
		</section>
		<div class="container">
			<h3 class="page-title">Build Your Boat</h3>
			<div class="row">
				<div class="col-md-9">
					<!-- THE JAVASCRIPT FORM -->
					<!-- =================== -->
					<form id="byob-form" class="byob-form">
						
						<!-- STEP ONE -->
						<section class="step step-boat-size">
					    <div class="step-title" id="step-one-title">
					    	<h3>1. Choose Your Boat Size</h3>
					    	<button type="button" id="step-one-edit" class="btn btn-default btn-edit" style="display:none;"><span class="glyphicon glyphicon-pencil"></span>Change</button>
					    </div>
					    <div class="step-body">
						    <fieldset id="boat-options" class="boat-options">
						    	<div class="row">
						    		<!-- Size Option -->
							    	<div class="col-md-4">
								    	<div class="size-option">
								    		<div class="size-img">
								    			<img src="<?php echo get_template_directory_uri(); ?>/assets/img/boats/11_6_strike.png">
									      </div>
									      <div class="radio">
									      	<label>
									      		<input type="radio" name="boat" data-item="Sotar Strike Raft - 11 foot 6 inch" data-price="4211.00" value="116">
									      		11' 6"
									      	</label>
									      </div>
									      <span class="base-price">Starting at <strong>$4,211</strong></span>
									      <p class="size-description">Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
									    </div>
									  </div>
								    <!-- Size Option -->
								    <div class="col-md-4">
									    <div class="size-option most-popular">
									      <!-- *** MOST POPULAR *** -->
									      <div class="size-img">
									      	<img src="<?php echo get_template_directory_uri(); ?>/assets/img/boats/13_6_strike.png">
									      </div>
									      <div class="radio">
									      	<label>
									      		<input type="radio" name="boat" data-item="Sotar Strike Raft - 13 foot 6 inch" data-price="4536.00" value="136">
									      		13' 6"
									      	</label>
									      </div>
									      <span class="base-price">Starting at <strong>$4,536</strong></span>
									      <p class="size-description">Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
									    </div>
									  </div>
								    <!-- Size Option -->
								    <div class="col-md-4">
									    <div class="size-option">
									    	<div class="size-img">
									    		<img src="<?php echo get_template_directory_uri(); ?>/assets/img/boats/14_6_strike.png">
									      </div>
									      <div class="radio">
									      	<label>
									      		<input type="radio" name="boat" data-item="Sotar Strike Raft - 14 foot 6 inch" data-price="4752.00" value="146">
									      		14' 6"
									      	</label>
									      </div>
									      <span class="base-price">Starting at <strong>$4,752</strong></span>
									      <p class="size-description">Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
									    </div>
									  </div>
								  </div>
						    </fieldset>
						    <table id="boat-lineitems" class="table table-striped table-boat-base-price" style="display:none;">
						      <thead>
						      	<tr>
						      		<th>Description</th>
						      		<th>Qty</th>
						      		<th>Price</th>
						      	</tr>
						      </thead>
						      <tbody>
						      	<tr>
						      		<td>
						      			<strong><span id="boat-lineitem"></span></strong>
						      		</td>
						      		<td>
						      			<span>1</span>
						      		</td>
						      		<td class="boat-base-price">
						      			<strong>$<span id="boat-price"></span></strong>
						      		</td>
						      	</tr>
						      	<tr>
						      		<td>
						      			6 Handle / D-Rings (Standard)
						      		</td>
						      		<td>&nbsp;</td>
						      		<td>&nbsp;</td>
						      	</tr>
						      	<tr>
						      		<td>
						      			4 D-Rings (Standard)
						      		</td>
						      		<td>&nbsp;</td>
						      		<td>&nbsp;</td>
						      	</tr>
						      	<tr>
					      			<td>
					      				Self-Bailing Floor (Standard)
					      			</td>
					      			<td>&nbsp;</td>
					      			<td>&nbsp;</td>
						      	</tr>
						      	<tr>
					      			<td>
					      				2 Outside Chambers (Standard)
					      			</td>
					      			<td>&nbsp;</td>
					      			<td>&nbsp;</td>
						      	</tr>
						      </tbody>
						    </table>
						  </div>
					  </section>
						
						<!-- STEP TWO -->
						<section id="step-two" class="step step-additional-options" style="display:none;">
					    <div class="step-title">
					    	<h3>2. Choose Your Options</h3>
					    </div>
					    <div class="step-body">
						    <fieldset id="additional-options" style="display:none;">
						      <table class="table table-options">
						      	<thead>
						      		<tr>
						      			<th>&nbsp;</th>
						      			<th colspan="2">Option</th>
						      			<th>Price</th>
						      		</tr>
						      	</thead>
						      	<tbody>
								      <!-- These will all need to be hard-coded -->
								      <tr>
								      	<td>
								      		<input type="checkbox" name="boat-option" data-item="additional-chamber-option" data-price="150.00" value="150.00">
								      	</td>
								      	<td class="option-img">
								      		<img src="http://placehold.it/100x100">
								      	</td>
								      	<td>
								      		<strong>Additional Chamber</strong><br>
								      		<em>Adding a third chamber to the outside tubes is what we call "cheap insurance". We recommend an additional chamber to those who expect to take their boat on multiple day trips or extended distance floats and could become compromised if the boat suffered a severe puncture. With 3/4 of your boat still inflated you can always make it to camp or the takeout before doing serious patch.</em>
								      	</td>
								      	<td>
								      		$150.00
								      	</td>
								      </tr>
								      <tr>
								      	<td>
								      		<input type="checkbox" name="boat-option" data-item="top-chafe-option" data-price="269.00" value="269.00">
								      	</td>
								      	<td class="option-img">
								      		<img src="http://placehold.it/100x100">
								      	</td>
								      	<td>
								      		<strong>Top Chafe</strong><br>
								      		<em>Covering the straight section and around the stern (that portion under frame) not only looks good but is functional. The "liquid lex"chafe  is rolled on providing a bit of sticky texture so your foot remains planted when getting in or out, acts as a barrier to the sand rubbing between the frame and the boat, and when applied in a darker color the chafe highlights the boat and serves to keep the tubes looking  cleaner</em>
								      	</td>
								      	<td>
								      		$269.00
								      	</td>
								      </tr>
								      <tr>
								      	<td>
								      		<input type="checkbox" name="boat-option" data-item="bottom-wrap-option" data-price="400.00" value="400.00">
								      	</td>
								      	<td class="option-img">
								      		<img src="http://placehold.it/100x100">
								      	</td>
								      	<td>
								      		<strong>Bottom Wrap</strong><br>
								      		<em>Bottom wrap is like a armor plating for your Strike.  Plan on floating rivers through sharp volcanic canyons or dragging your boat in and out of unimproved accesses or over brush and beaver cut willows?  Add a bottom wrap for the most puncture resistant raft made.</em>
								      	</td>
								      	<td>
								      		$400.00
								      	</td>
								      </tr>
								    </tbody>
							    </table>
						    </fieldset>
						  </div>
					  </section>

				    <!-- STEP THREE -->
				    <section id="step-three" class="step step-colors" style="display:none;">
					    <div class="step-title">
					    	<h3>3. Customize Your Colors</h3>
					    </div>
					    <div class="step-body">
						    <div id="color-picker" style="display:none;">
						    	<div class="btn-group btn-group-sm btn-group-colors" id="color-button-group" role="group">
						    	  <button type="button" id="primary-boat-color" class="btn btn-default active">Primary Boat Color</button>
						    	  <button type="button" id="handle-patch-color" class="btn btn-default">Handle Patch Color</button>
						    	  <button type="button" id="d-ring-patch-color" class="btn btn-default">D-Ring Patch Color</button>
						    	  <button type="button" id="floor-color" class="btn btn-default">Floor Color</button>
						    	  <button type="button" id="chafe-color" class="btn btn-default">Chafe Color</button>
						    	</div>
						      <div class="row">
						      	<div class="col-sm-4">
						      		<div class="color-guide">
						      			<img src="<?php echo get_template_directory_uri(); ?>/assets/img/boats/primary-boat-color.png" id="color-image" />
						      		</div>
						      	</div>
						      	<div class="col-sm-8">
								      <fieldset id="color-options" class="color-options">
								      	<div class="row">
								      		<div class="col-sm-6 col-md-6 col-lg-4 color-option">
							      				<input id="color-light-blue" type="radio" name="color" value="Light Blue">
									        	<label for="color-light-blue"><span class="light-blue"><i></i></span>Light Blue</label>
										      </div>
										      <div class="col-sm-6 col-md-6 col-lg-4 color-option">
									        	<input id="color-dark-blue" type="radio" name="color" value="Dark Blue">
									        	<label for="color-dark-blue"><span class="dark-blue"><i></i></span>Dark Blue</label>
										      </div>
										      <div class="col-sm-6 col-md-6 col-lg-4 color-option">
									        	<input id="color-teal" type="radio" name="color" value="Teal">
									        	<label for="color-teal"><span class="teal"><i></i></span>Teal</label>
										      </div>
										      <div class="col-sm-6 col-md-6 col-lg-4 color-option">
									        	<input id="color-yellow" type="radio" name="color" value="Yellow">
									        	<label for="color-yellow"><span class="yellow"><i></i></span>Yellow</label>
										      </div>
										      <div class="col-sm-6 col-md-6 col-lg-4 color-option">
									        	<input id="color-orange" type="radio" name="color" value="Orange">
									        	<label for="color-orange"><span class="orange"><i></i></span>Orange</label>
										      </div>
										      <div class="col-sm-6 col-md-6 col-lg-4 color-option">
									        	<input id="color-magenta" type="radio" name="color" value="Red">
									        	<label for="color-magenta"><span class="magenta"><i></i></span>Magenta</label>
											    </div>
										      <div class="col-sm-6 col-md-6 col-lg-4 color-option">
									        	<input id="color-grey" type="radio" name="color" value="Grey">
									        	<label for="color-grey"><span class="grey"><i></i></span>Grey</label>
										      </div>
										      <div class="col-sm-6 col-md-6 col-lg-4 color-option">
									        	<input id="color-white" type="radio" name="color" value="White">
									        	<label for="color-white"><span class="white"><i></i></span>White</label>
										      </div>
										      <div class="col-sm-6 col-md-6 col-lg-4 color-option">
									        	<input id="color-black" type="radio" name="color" value="Black">
									        	<label for="color-black"><span class="black"><i></i></span>Black</label>
										      </div>
										      <div class="col-sm-6 col-md-6 col-lg-4 color-option">
									        	<input id="color-green" type="radio" name="color" value="Green">
									        	<label for="color-green"><span class="green"><i></i></span>Green</label>
										      </div>
										      <div class="col-sm-6 col-md-6 col-lg-4 color-option">
									        	<input id="color-dark-green" type="radio" name="color" value="Dark Green">
									        	<label for="color-dark-green"><span class="dark-green"><i></i></span>Dark Green</label>
										      </div>
										    </div>
								      </fieldset>
								    </div>
								  </div>
						    </div>
						  </div>
					  </section>

				    <!-- STEP FOUR -->
				    <section id="step-four" class="step step-frame" style="display:none;">
					    <div class="step-title">
					    	<h3>4. Choose the Perfect Frame</h3>
					    </div>
					    <div class="step-body">
						    <fieldset id="frames" style="display:none;">
			    	      <table class="table table-frame">
			    	      	<thead>
			    	      		<tr>
			    	      			<th>&nbsp;</th>
			    	      			<th colspan="2"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/boats/mt-raft-frames-logo.png"/> MT Raft Frames</th>
			    	      			<th>Price</th>
			    	      		</tr>
			    	      	</thead>
			    	      	<tbody>
			    			      <!-- These will all need to be hard-coded -->
			    			      <tr>
			    			      	<td>
			    			      		<input type="radio" name="frame" data-item="MT Raft Basic" data-price="1620.00" value="MT Raft Basic">
			    			      	</td>
			    			      	<td class="frame-img">
			    			      		<img src="http://placehold.it/100x100">
			    			      	</td>
			    			      	<td>
			    			      		<strong>MT Raft Frame Basic</strong><br>
			    			      		<em>Breakdown aluminum fishing frame, two Tempress high back swivel seats, exclusive internal anchor system fitted with Harken pulleys/cleat, and guide seat attached to cross bar.</em>
			    			      	</td>
			    			      	<td>
			    			      		$1,620.00
			    			      	</td>
			    			      </tr>
			    			      <tr>
			    			      	<td>
			    			      		<input type="radio" name="frame" data-item="MT Raft Deluxe" data-price="2220.00" value="MT Raft Deluxe">
			    			      	</td>
			    			      	<td class="frame-img">
			    			      		<img src="http://placehold.it/100x100">
			    			      	</td>
			    			      	<td>
			    			      		<strong>MT Raft Frame Deluxe</strong><br>
			    			      		<em>Breakdown <u>powder coated</u> aluminum fishing frame, two Tempress high back swivel seats, exclusive internal anchor system fitted with Harken pulleys/cleat, and customized aluminum dry box with guide seat.</em>
			    			      	</td>
			    			      	<td>
			    			      		$2,220.00
			    			      	</td>
			    			      </tr>
			    			      <tr>
			    			      	<td>
			    			      		<input type="radio" name="frame" data-item="MT Raft Premier" data-price="2900.00" value="MT Raft Premier">
			    			      	</td>
			    			      	<td class="frame-img">
			    			      		<img src="http://placehold.it/100x100">
			    			      	</td>
			    			      	<td>
			    			      		<strong>MT Raft Frame Premier</strong><br>
			    			      		<em>Breakdown <u>powder coated</u> aluminum fishing frame, two Temptress high back swivel seats, exclusive internal anchor system fitted with Harken pulleys/cleat, and customized aluminum dry box with guide seat.</em>
			    			      	</td>
			    			      	<td>
			    			      		$2,900.00
			    			      	</td>
			    			      </tr>
			    			    </tbody>
			    		    </table>
			    		    <table class="table table-frame nrs-frames">
			    	      	<thead>
			    	      		<tr>
			    	      			<th>&nbsp;</th>
			    	      			<th><img src="<?php echo get_template_directory_uri(); ?>/assets/img/boats/nrs-logo.jpg"/> NRS Frames</th>
			    	      			<th>Price</th>
			    	      		</tr>
			    	      	</thead>
			    	      	<tbody>
			    			      <!-- These will all need to be hard-coded -->
			    			      <tr>
			    			      	<td>
			    			      		<input type="radio" name="frame" data-item="NRS Custom Basic" data-price="1450.00" value="NRS Custom Basic">
			    			      	</td>
			    			      	<td class="frame-img">
			    			      		<img src="http://placehold.it/100x100">
			    			      	</td>
			    			      	<td>
			    			      		<strong>NRS Custom Basic</strong><br>
			    			      		<em>Breakdown aluminum fishing frame, two NRS high back swivel seats, oar locks, and anchor system.</em>
			    			      	</td>
			    			      	<td>
			    			      		$1,450.00
			    			      	</td>
			    			      </tr>
			    			      <tr>
			    			      	<td>
			    			      		<input type="radio" name="frame" data-item="Deluxe" data-price="1975.00" value="NRS Custom Dry Box">
			    			      	</td>
			    			      	<td class="frame-img">
			    			      		<img src="http://placehold.it/100x100">
			    			      	</td>
			    			      	<td>
			    			      		<strong>NRS Custom with Dry Box</strong><br>
			    			      		<em>Breakdown aluminum fishing frame, two NRS high back swivel seats, oar locks, anchor system, and aluminum dry box with guide seat.</em>
			    			      	</td>
			    			      	<td>
			    			      		$1,975.00
			    			      	</td>
			    			      </tr>
			    			      <tr>
			    			      	<td>
			    			      		<input type="radio" name="frame" data-item="Premier" data-price="2900.00" value="Premier">
			    			      	</td>
			    			      	<td class="frame-img">
			    			      		<img src="http://placehold.it/100x100">
			    			      	</td>
			    			      	<td>
			    			      		<strong>MT Raft Frame: Premier</strong><br>
			    			      		<em>Breakdown <u>powder coated</u> aluminum fishing frame, two Temptress high back swivel seats, exclusive internal anchor system fitted with Harken pulleys/cleat, and customized aluminum dry box with guide seat.</em>
			    			      	</td>
			    			      	<td>
			    			      		$2,900.00
			    			      	</td>
			    			      </tr>
			    			    </tbody>
			    		    </table>
			    		    <div class="no-frame">
				    		    <div class="radio">
				    		    	<label>
				    		    		<input type="radio" name="frame" data-item="" data-price="0.00" value="" checked> <strong>No, thanks.</strong> I will not be purchasing a frame.
				    		    	</label>
				    		    </div>
				    		  </div>
						    </fieldset>
						  </div>
					  </section>

				    <!-- STEP FIVE -->
				    <section id="step-five" class="step step-accessories" style="display:none;">
					    <div class="step-title">
					    	<h3>5. Accessorize Your Boat</h3>
					    </div>
					    <div class="step-body">
						    <fieldset id="accessories" style="display:none;">
							    <table class="table table-accessories">
							    	<thead>
							    		<tr>
							    			<th>&nbsp;</th>
							    			<th colspan="2">Accessory</th>
							    			<th class="accessory-qty">Qty</th>
							    			<th>Price</th>
							    			<th>Subtotal</th>
							    		</tr>
							    	</thead>
							    	<tbody>
									    <?php
									    		$args = array(
									    			'post_type' => 'product',
									    			'posts_per_page' => 12,
									    			'product_tag' => 'boat-accessory',
									    			);
									    		$loop = new WP_Query( $args );
									    		if ( $loop->have_posts() ) {
									    			while ( $loop->have_posts() ) : $loop->the_post();
									    				get_template_part( 'includes/boat-accessories' );
									    			endwhile;
									    		} else {
									    			echo __( 'No products found' );
									    		}
									    		wp_reset_postdata();
									    	?>
									   </tbody>
							    </table>
						      <!-- Note the data-price will get calculated when the quantity is changed -->
						      <!-- <input type="checkbox" name="accessory" data-item="orion-cooler" data-price="0.00" data-price-each="549.00" value="Orion Cooler">Orion Cooler
				    			<input type="text" name="quantity" value="1"> 549.00 <span>0.00</span><br/> -->
						      <!-- *** There are 14 more accessories on the current list (maybe more maybe less ask John) ***
						      Some or all of these will need to be added to the store inventory
						      -->
						    </fieldset>
						  </div>
					  </section>
					</form>

					<section id="mobile-totals" class="step step-totals" style="display:none;">
						<div class="step-title">
							<h3>Your boat order total</h3>
						</div>
						<div class="step-body">
							<table class="table-totals">
								<tbody>
									<tr>
										<td class="subtotal-label">Subtotal</td>
										<td id="mobile-subtotal" class="subtotal-value">$0.00</td>
									</tr>
									<tr>
										<td class="shipping-label">Shipping</td>
										<td class="shipping-value">TBD</td>
									</tr>
									<tr>
										<td class="tax-label">Tax</td>
										<td class="tax-value">$0.00</td>
									</tr>
									<tr>
										<td class="total-label">Total</td>
										<td id="mobile-total" class="total-value">$0.00</td>
									</tr>
								</tbody>
							</table>
						</div>
					</section>

					<!-- PLACE ORDER -->
					<section id="step-place-order" class="step step-place-order" style="display:none">
						<div class="step-title">
							<h3>Place Your Order</h3>
						</div>
						<div class="step-body">
							
							<!-- THE ORDER FORM -->
							<!-- ================ -->
							<form id="gravity-form">
								<!-- hidden fields -->
						    <input type="hidden" name="boat" id="boat" value="">
						    <input type="hidden" name="additional-chamber" id="additional-chamber-option" value="">
						    <input type="hidden" name="top-chafe" id="top-chafe-option" value="">
						    <input type="hidden" name="bottom-wrap" id="bottom-wrap-option" value="">
						    <input type="hidden" name="total" id="purchase-total" value="0.00">
						    <input type="hidden" name="primary-boat-color" id="primary-boat-color" value="">
						    <input type="hidden" name="handle-patch-color" id="handle-patch-color" value="">
						    <input type="hidden" name="d-ring-patch-color" id="d-ring-patch-color" value="">
						    <input type="hidden" name="floor-color" id="floor-color" value="">
						    <input type="hidden" name="chafe-color" id="chafe-color" value="">
						    <input type="hidden" name="frame" id="frame" value="">
						    <input type="hidden" name="boat-accessory-quantity" id="boat-accessory" value="">
							</form>
							<?php gravity_form( 3, false, false, false, '', true ); ?>
						</div>
					</section>
				</div>
				<div class="col-md-3">
					<aside id="sticky-totals" class="sticky-totals" style="display:none;">
						<table class="table-totals">
							<tbody>
								<tr>
									<td class="subtotal-label">Subtotal</td>
									<td id="sticky-subtotal" class="subtotal-value">$0.00</td>
								</tr>
								<tr>
									<td class="shipping-label">Shipping</td>
									<td class="shipping-value">TBD</td>
								</tr>
								<tr>
									<td class="tax-label">Tax</td>
									<td class="tax-value">$0.00</td>
								</tr>
								<tr>
									<td class="total-label">Total</td>
									<td id="sticky-total" class="total-value">$0.00</td>
								</tr>
							</tbody>
						</table>
					</aside>
				</div>
			</div>
			<!-- Shop with confidence -->
			<div id="shop-confidence" class="shop-confidence" style="display:none;">
				<h4>Purchase with Confidence</h4>
			  <div>
			  	<img src="<?php echo get_template_directory_uri(); ?>/assets/img/RapidSSL_SEAL-90x50.gif">
			  	<img src="<?php echo get_template_directory_uri(); ?>/assets/img/powered-by-stripe.svg">
			  </div>
			</div>
		</div>
	</main>

	<script>
  jQuery(document).ready(function(){
    jQuery("#sticky-totals").sticky({topSpacing:90});
  });
</script>

<?php get_footer(); ?>
