<?php /* Template Name: Test Template */ get_header(); ?>

	<?php get_template_part( 'includes/boats/boats-subnav' ); ?>

	<main role="main">
		<div class="container">

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
				    <fieldset id="boat-options">
				    	<div class="row">
					    	<div class="col-sm-4">
						      <div class="radio">
						      	<label>
						      		<input type="radio" name="boat" data-item="Sotar Strike Raft - 11 foot 6 inch" data-price="4211.00" value="116">
						      		11' 6"
						      	</label>
						      </div>
						    </div>
						    <div class="col-sm-4">
						      <!-- *** MOST POPULAR *** -->
						      <div class="radio">
						      	<label>
						      		<input type="radio" name="boat" data-item="Sotar Strike Raft - 13 foot 6 inch" data-price="4536.00" value="136">
						      		13' 6"
						      	</label>
						      </div>
						    </div>
						    <div class="col-sm-4">
						      <div class="radio">
						      	<label>
						      		<input type="radio" name="boat" data-item="Sotar Strike Raft - 14 foot 6 inch" data-price="4752.00" value="146">
						      		14' 6"
						      	</label>
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
				      		<td>
				      			1
				      		</td>
				      		<td>
				      			$0.00
				      		</td>
				      	</tr>
				      	<tr>
				      		<td>
				      			4 D-Rings (Standard)
				      		</td>
				      		<td>
				      			1
				      		</td>
				      		<td>
				      			$0.00
				      		</td>
				      	</tr>
				      	<tr>
			      			<td>
			      				Self-Bailing Floor (Standard)
			      			</td>
			      			<td>
			      				1
			      			</td>
			      			<td>
			      				$0.00
			      			</td>
				      	</tr>
				      	<tr>
			      			<td>
			      				2 Outside Chambers (Standard)
			      			</td>
			      			<td>
			      				1
			      			</td>
			      			<td>
			      				$0.00
			      			</td>
				      	</tr>
				      </tbody>
				    </table>
				  </div>
			  </section>
				
				<!-- STEP TWO -->
				<section id="step-two" class="step" style="display:none;">
			    <div class="step-title">
			    	<h3>2. Choose Your Options</h3>
			    </div>
			    <div class="step-body">
				    <fieldset id="additional-options" style="display:none;">
				      <table class="table">
				      	<thead>
				      		<tr>
				      			<th>&nbsp;</th>
				      			<th>&nbsp;</th>
				      			<th>Qty</th>
				      			<th>Price</th>
				      			<th>Subtotal</th>
				      		</tr>
				      	</thead>
				      	<tbody>
						      <!-- These will all need to be hard-coded -->
						      <tr>
						      	<td>
						      		<input type="checkbox" name="boat-option" data-item="additional-chamber-option" data-price="150.00" value="150.00">
						      	</td>
						      	<td>
						      		<strong>Additional Chamber</strong><br>
						      		<em>Marketing spiel for the additional chamber</em>
						      	</td>
						      	<td>
						      		0
						      	</td>
						      	<td>
						      		$150.00
						      	</td>
						      	<td>
						      		<span>$0.00</span>
						      	</td>
						      </tr>
						      <tr>
						      	<td>
						      		<input type="checkbox" name="boat-option" data-item="top-chafe-option" data-price="269.00" value="269.00">
						      	</td>
						      	<td>
						      		<strong>Top Chafe</strong><br>
						      		<em>Marketing spiel for the top chafe</em>
						      	</td>
						      	<td>
						      		0
						      	</td>
						      	<td>
						      		$269.00
						      	</td>
						      	<td>
						      		<span>$0.00</span>
						      	</td>
						      </tr>
						      <tr>
						      	<td>
						      		<input type="checkbox" name="boat-option" data-item="bottom-chafe-option" data-price="400.00" value="400.00">
						      	</td>
						      	<td>
						      		<strong>Bottom Chafe</strong><br>
						      		<em>Marketing spiel for the bottom chafe</em>
						      	</td>
						      	<td>
						      		0
						      	</td>
						      	<td>
						      		$400.00
						      	</td>
						      	<td>
						      		<span>$0.00</span>
						      	</td>
						      </tr>
						    </tbody>
					    </table>
				    </fieldset>
				  </div>
			  </section>

		    <!-- STEP THREE -->
		    <section id="step-three" class="step" style="display:none;">
			    <div class="step-title">
			    	<h3>3. Customize Your Colors</h3>
			    </div>
			    <div class="step-body">
				    <div id="color-picker" style="display:none;">
				      <div class="row">
				      	<div class="col-sm-4">
				      		<img src="<?php echo get_template_directory_uri(); ?>/assets/img/boats/primary-boat-color.png" id="color-image" />
				      	</div>
				      	<div class="col-sm-8">
						      <div class="btn-group btn-group-sm" id="color-button-group" role="group">
						        <button type="button" id="primary-boat-color" class="btn btn-default active">Primary Boat Color</button>
						        <button type="button" id="handle-patch-color" class="btn btn-default">Handle Patch Color</button>
						        <button type="button" id="d-ring-patch-color" class="btn btn-default">D-Ring Patch Color</button>
						        <button type="button" id="floor-color" class="btn btn-default">Floor Color</button>
						        <button type="button" id="chafe-color" class="btn btn-default">Chafe Color</button>
						      </div>
						      <fieldset id="boat-options">
						      	<div class="row">
						      		<div class="col-sm-4">
								        <div class="radio">
								        	<label>
								        		<input type="radio" name="color" value="Red">
								        		Red
								        	</label>
								        </div>
								        <div class="radio">
								        	<label>
								        		<input type="radio" name="color" value="Red">
								        		Red
								        	</label>
								        </div>
								        <div class="radio">
								        	<label>
								        		<input type="radio" name="color" value="Red">
								        		Red
								        	</label>
								        </div>
								      </div>
								      <div class="col-sm-4">
								        <div class="radio">
								        	<label>
								        		<input type="radio" name="color" value="Blue">
								        		Blue
								        	</label>
								        </div>
								        <div class="radio">
								        	<label>
								        		<input type="radio" name="color" value="Red">
								        		Red
								        	</label>
								        </div>
								        <div class="radio">
								        	<label>
								        		<input type="radio" name="color" value="Red">
								        		Red
								        	</label>
								        </div>
								      </div>
								      <div class="col-sm-4">
								        <div class="radio">
								        	<label>
								        		<input type="radio" name="color" value="Green">
								        		Green
								        	</label>
								        </div>
								        <div class="radio">
								        	<label>
								        		<input type="radio" name="color" value="Red">
								        		Red
								        	</label>
								        </div>
								        <div class="radio">
								        	<label>
								        		<input type="radio" name="color" value="Red">
								        		Red
								        	</label>
								        </div>
								      </div>
								    </div>
						      </fieldset>
						    </div>
						  </div>
				    </div>
				  </div>
			  </section>

		    <!-- STEP FOUR -->
		    <section id="step-four" class="step" style="display:none;">
			    <div class="step-title">
			    	<h3>4. Choose the Perfect Frame</h3>
			    </div>
			    <div class="step-body">
				    <fieldset id="frames" style="display:none;">
				      <p><em>Marketing spiel for basic</em></p>
				      <div class="radio">
				      	<label>
				      		<input type="radio" name="frame" data-item="Basic" data-price="1000.00" value="Basic">
				      		Basic
				      	</label>
				      </div>
				      <p><em>Marketing spiel for deluxe</em></p>
				      <div class="radio">
				      	<label>
				      		<input type="radio" name="frame" data-item="Deluxe" data-price="2000.00" value="Deluxe">
				      		Deluxe
				      	</label>
				      </div>
				      <p><em>** MOST POPULAR** Marketing spiel for premier</em></p>
				      <div class="radio">
				      	<label>
				      		<input type="radio" name="frame" data-item="Premier" data-price="3000.00" value="Premier">
				      		Premier
				      	</label>
				      </div>
				      <div class="radio">
				      	<label>
				      		<input type="radio" name="frame" data-item="" data-price="0.00" value="">
				      		Reset
				      	</label>
				      </div>
				    </fieldset>
				  </div>
			  </section>

		    <!-- STEP FIVE -->
		    <section id="step-five" class="step" style="display:none;">
			    <div class="step-title">
			    	<h3>5. Accessorize Your Boat</h3>
			    </div>
			    <div class="step-body">
				    <fieldset id="accessories" style="display:none;">
				      <!-- Note the data-price will get calculated when the quantity is changed -->
				      <input type="checkbox" name="accessory" data-item="orion-cooler" data-price="0.00" data-price-each="549.00" value="Orion Cooler">Orion Cooler
		    			<input type="text" name="quantity" value="1"> 549.00 <span>0.00</span><br/>
				      <!-- *** There are 14 more accessories on the current list (maybe more maybe less ask John) ***
				      Some or all of these will need to be added to the store inventory
				      -->
				    </fieldset>
				  </div>
			  </section>
			</form>

			<!-- THE GRAVITY FORM -->
			<!-- ================ -->
			<form id="gravity-form">
				
				<!-- hidden fields -->
		    <input type="hidden" name="boat" id="boat" value="">
		    <input type="hidden" name="additional-chamber" id="additional-chamber-option" value="">
		    <input type="hidden" name="top-chafe" id="top-chafe-option" value="">
		    <input type="hidden" name="bottom-chafe" id="bottom-chafe-option" value="">
		    <input type="hidden" name="total" id="purchase-total" value="0.00">
		    <input type="hidden" name="primary-boat-color" id="primary-boat-color" value="">
		    <input type="hidden" name="handle-patch-color" id="handle-patch-color" value="">
		    <input type="hidden" name="d-ring-patch-color" id="d-ring-patch-color" value="">
		    <input type="hidden" name="floor-color" id="floor-color" value="">
		    <input type="hidden" name="chafe-color" id="chafe-color" value="">
		    <input type="hidden" name="frame" id="frame" value="">
		    <input type="hidden" name="orion-cooler-quantity" id="orion-cooler" value="">

			</form>

			<?php gravity_form( 3, false, false, false, '', false ); ?>

		</div>
	</main>

<?php get_footer(); ?>
