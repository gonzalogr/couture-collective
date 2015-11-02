<?php $season_id = CC_Controller::get_active_season(); ?>

<?php get_header();?>

<?php wc_print_notices(); ?>

<div id="look-book" class="template template-page">
	
	<section id="look-book-body" class="look-book block">	
	
		<div class="products">

			<div class="container">
				<div class="row">
					<div class="hidden-xs col-sm-3">

						<div class="row">		
													
							<div class="col-sm-12">
								<p class="h7 uppercase">Filter by Size</p>
							</div>

						</div>

						<div class="row m2">	

							<div class="col-sm-12">
								<div class="bordered-dark-bottom m1"></div>
								<div class="row">
									<div class="col-sm-12  small m2"><a class="active" data-size-key="*">Show All Sizes</a></div>
									<div class="col-sm-12  small m1"><a data-size-key="extra-small">Extra Small</a></div>
									<div class="col-sm-12  small m1"><a data-size-key="small">Small</a></div>
									<div class="col-sm-12  small m1"><a data-size-key="medium">Medium</a></div>
									<div class="col-sm-12  small m1"><a data-size-key="large">Large</a></div>
								</div>
								
							</div>
					
						</div>

						<div class="row">		
													
							<div class="col-sm-12">
								<p class="h7 uppercase">Filter by Designer</p>
							</div>

						</div>

						<div class="row m2">	

							<div class="col-sm-12">
								<div class="bordered-dark-bottom m1"></div>
								<div class="row">

									<div class="col-sm-12  small m2"><a class="active" data-designer-key="*">Show All Designers</a></div>

									<?php foreach (CC_Controller::get_designers( $season_id ) as $designer ) { ?>

										<div class="col-sm-12  small m1"><a data-designer-key="<?php echo CC_Controller::normalize_name( $designer ); ?>"><?php echo $designer ?></a></div>
										
									<?php } ?>
									

								</div>
								
							</div>
					
						</div>

					</div>


					<div class="col-xs-12 col-sm-9">
					<div class="row">
					<?php

					// $row_length = 4;
					// $index = 0;

					$args = array(
						'post__in' => CC_Controller::get_dresses_for_season( $season_id ),
						'post_type' => 'dress',
						'posts_per_page' => -1,
						'orderby' => 'title',
						'order' => 'ASC'
					);

					$GLOBALS['LOOP'] = new WP_Query( $args );
					$GLOBALS['USER'] = wp_get_current_user();

					if ( $GLOBALS['LOOP']->have_posts() ) {

						while ( $GLOBALS['LOOP']->have_posts() ) : 

							$GLOBALS['LOOP']->the_post();

							//if ( $index % $row_length == 0 ) echo '<div class="row">';

						 	get_template_part( '_partials/dress/dress', 'card' );

						 	//if ( $index % $row_length == $row_length - 1 ) echo '</div>';

						endwhile;

					} else { 
						echo '<h1>There aren\'t any dresses right now!</h1>';
					} 

					?>
					</div>
					</div>


			</div>

		</div>
		</div>
											
	</section>	
		
</div>	

<?php get_footer(); ?>
