
<?php
	/**
	 * @todo refactor
	 */

	// if (
	// 	//pages that no one should ever see, ever!
	// 	is_shop() ||
	// 	is_product() ||
	// 	is_product_category() ||
	// 	is_product_tag() 
	// ) { 
	// 	get_template_part('_partials/placeholder/placeholder', 'forward' ); 
	// } elseif (
	// 	// pages that the guest user should not see
	// 	cc_user_is_guest() && ( is_page( array( 7 ) ) || is_admin() )
	// ) {
	// 	get_template_part('_partials/placeholder/placeholder', 'forward' ); 
	// } elseif (
	// 	//pages that anyone can see
	// 	is_home() ||
	// 	is_page(array( 9, 26, 30, 363, 7, 6 ))
	// ) {
	// 	// no-op
	// } else {
	// 	//pages that only logged in users should see
	// 	if ( !is_user_logged_in() ) {
	// 	 	get_template_part('_partials/login','modal');
	// 	} else if ( is_page( array( ) ) ) {

	// 	}
	// }


	if (is_shop() ||is_product() || is_product_category() || is_product_tag()  ) {
		/* These pages should be displayed under NO circumstances. */
		get_template_part('_partials/placeholder/placeholder', 'forward' ); 

	} else if ( is_user_logged_in() ) {
		/* These pages should be displayed under NO circumstances. */
		if ( cc_user_is_guest() && ( is_page( array( 7, 35 ) ) || is_admin() && !cc_can_see_admin() )) {

			get_template_part('_partials/placeholder/placeholder', 'forward' ); 

		} else if ( is_page( array( 11 ) ) || (is_admin() && in_array( array('shop_manager','administrator')) ) ) {

			get_template_part('_partials/placeholder/placeholder', 'forward' ); 

		}
	} 

	/*

	// commented out the free lookbook feature.

	else { // 35 = closet, 5 = cart
		if ( is_page( 35 ) ) { 
			get_template_part('_partials/placeholder/placeholder', 'forward' ); 
		}
	}
	*/
	

	// commented out the modal invocation on restricted pages.
	// this will make the look-book public and make it much easier
	// to navigate the 

	else {
		if ( !is_home() && !is_page(array( 9, 26, 30, 363, 11, 7, 6, 3606, 919)) && (!is_post_type_archive( 'trunkshow' ) ) && !is_singular('trunkshow') ) {

			get_template_part('_partials/login','modal');

		} 
	}
	
	do_action('cc_remove_membership_items');
?>

<!DOCTYPE html>

<html class="header-closed image-closed">

<head>

	<meta charset="<?php bloginfo('charset'); ?>">
	
	<?php if (is_search()) { ?>
		<meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>

	<title> 
	   <?php
	      if (function_exists('is_tag') && is_tag()) {
	         single_tag_title(); 
	         }
	      elseif (is_search()) {
	         echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
	      elseif (!(is_404()) && (is_single()) || (is_page())) {
	         wp_title(''); echo ' - '; }
	      elseif (is_404()) {
	         echo 'Not Found - '; 
	         }
	      if (is_home()) {
	         bloginfo('name'); }
	      else {
	          bloginfo('name'); }
	   ?>
	</title>
				   
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<meta name="google-site-verification" content="">
	<meta name="author" content="Greg Nemes and Nic Schumann of Work-Shop">
		
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<link rel="apple-touch-icon" href="/apple-touch-icon.png">	
	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/_/img/favicon.ico">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
			
    <!--[if lt IE 9]>
      <script src="<?php bloginfo('template_directory'); ?>/_/js/html5shiv.js"></script>
      <script src="<?php bloginfo('template_directory'); ?>/_/js/respond.js"></script>
    <![endif]-->		
    
	<link href='https://fonts.googleapis.com/css?family=Muli:300,400,300italic,400italic' rel='stylesheet' type='text/css'>
        	
	<?php wp_head(); ?>
				
</head>

<body <?php body_class('before'); ?>>

<?php // get_template_part('landing'); ?>

<?php get_template_part('ie'); ?>

<?php
// $alert_state = ( is_front_page() ) ? 'site-alert-off' : 'site-alert-off';
// //admin pages, my-account, and closet
// if ( !(is_admin() || is_page( array( 7 ) ) || is_page( array( 35 ) )) ) :
// 	$alert_state = 'site-alert-on';
// 	if ( is_user_logged_in() ) :
// 	 	global $current_user;
// 	 	get_currentuserinfo();

// 	 	if( current_user_can( 'manage_options' ) && current_user_can('manage_woocommerce') ): 
// 	 		$alert_state = 'site-alert-off';
// 	 	endif;
// 	endif; 	
// endif; 
// 
 
if ( /*get_current_user_id() != 1*/ false ) {
	$alert_state = "site-alert-on";
} else {
	$alert_state = "site-alert-off";
}


?>

<div id="state" class="loading <?php echo $alert_state; ?>">

	<div id="background" class="<?php  if ( is_home()) : echo 'background-home'; endif; ?>
"></div>


	<?php if ( isset($alert_state) && $alert_state == 'site-alert-on' ) : ?>

		<div id="site-alert" class="bg-white" >
			<div class="container">
				<div class="row">
					<div class="col-sm-8 col-sm-offset-2">
						<h2 class="m1">We're currently in the process of updating Couture Collective!</h2>
						
						<h2>You'll be able to access the site again soon.</h2>
						
						<h2 class="italic m1">Thanks for your patience.</h2>

						<?php get_template_part('_partials/login'); ?>

					</div>
				</div>
			</div>
		</div>		
	 	 			 	
	 	
	 <?php endif; ?>


	<?php $current_season = get_post( CC_Controller::get_active_season() ); ?>

		<header id="header" class="off">

			<nav id="nav">
			
				<div class="container">	
					<div class="row">	
					
						<div class="nav-left hidden-xs col-sm-4">
												
							<ul>	
															
								<li>
									<a href="<?php bloginfo('url'); ?>/look-book">
										<?php echo $current_season->post_title; ?> Look Book
									</a>
								</li>	
								<li>
									<a href="<?php bloginfo('url'); ?>/seasons">
										Past Seasons
									</a>
								</li>	
								
								<li>
									<a href="<?php bloginfo('url'); ?>/shows">
										Upcoming Shows
									</a>
								</li>	
								
								<?php if ( get_field('sneak_peak_active', 'option') ) : ?>
								<li>
									<a href="<?php bloginfo('url'); ?>/sneak-peek">
										<?php echo get_field('sneak_peak_heading', 'option'); ?>
									</a>
								</li>	
								<?php endif; ?>

								<li>
									<a href="<?php bloginfo('url'); ?>/how-it-works">
										How it Works
									</a>
								</li>	
								
								<?php if ( is_home() && !is_user_logged_in() ) : ?>
								<li>
									<a href="<?php bloginfo('url'); ?>/join" class="">
										Become a Member
									</a>
								</li>							
								<?php endif; ?>
							</ul>
							
						</div>
						
						<div id="carrot" class="menu-toggle visible-xs">
							<a href="#menu">Menu</a>
						</div>						
									
						<a id="logo" class="logo col-sm-4" href="<?php bloginfo('url'); ?>">
						
							<img id="logo-whole" class="hidden-xs" src="<?php bloginfo('template_directory'); ?>/_/img/logo.png" alt="logo">
						
							<img id="logo-type" class="visible-xs" src="<?php bloginfo('template_directory'); ?>/_/img/mark.png" alt="logo">			
											
						</a>		
							
						<div class="nav-right col-sm-4 hidden-xs">
							
						 	<?php if ( is_user_logged_in() ) { 
							 	global $current_user;
							 	get_currentuserinfo();
							 	global $woocommerce;
							 	

							 		if ( !cc_user_is_guest() ) {
							 	 ?>
									<ul class="right-logged-in <?php if ( cc_user_is_guest() ) : echo 'hidden'; endif; ?>">
										<li class="">
											<a href="<?php bloginfo('url'); ?>/cart" id="cart-link" class="<?php if($woocommerce->cart->cart_contents_count): echo 'active'; endif?>
">
												<?php get_template_part('_icons/cart'); ?>
												<?php if($woocommerce->cart->cart_contents_count): echo '<span class="cart-count">(' . $woocommerce->cart->cart_contents_count . ')</span>'; endif?>
											</a>
										</li>	
										<li class="">
											<a href="<?php bloginfo('url'); ?>/closet">
												My Closet
											</a>
										</li>	
										<li class="dropdown my-account-item">
											<a href="<?php bloginfo('url'); ?>/my-account">
												My Account<span class="icon icon-right" data-icon="&#8221;"></span>
											</a>
	 
											<ul class="dropdown-menu" role="menu">
												<li><a href="<?php bloginfo('url'); ?>/my-account">Settings</a></li>
												<li><a href="<?php echo wp_logout_url( home_url() ); ?>" title="Logout">Logout</a></li>
											</ul>
	
										</li>										
									
									</ul>
									<?php } else { ?>

										<ul class="right-logged-out">
											<li><a href="<?php echo wp_logout_url( home_url() ); ?>" title="Logout">Logout</a></li>
										</ul>

									<?php } ?>
			
							<?php } else { 
									if(is_home()){ ?>
									
									<div id="header-login">
										
										<?php get_template_part('_partials/login'); ?>
										
									</div>							
										
									<? }
									else{ ?>
										
										<ul class="right-logged-out">
											<li>
												<a href="<?php bloginfo('url'); ?>/login">
													Login
												</a>
											</li>	
											<li>
												<a href="<?php bloginfo('url'); ?>/join">
													Become a Member
												</a>
											</li>										
										
										</ul>									
									
									<?} } ?> 
												
							</div>							
									
								
						</div>							
					</div>	
				
			</nav>	
			
			<div id="menu-xs" class="menu-xs closed">
				<ul>								
					<li>
						<a href="<?php bloginfo('url'); ?>/look-book">
							<?php echo $current_season->post_title; ?> Look Book
						</a>
					</li>	
					<li>
						<a href="<?php bloginfo('url'); ?>/seasons">
							Past Seasons
						</a>
					</li>	

					<li>
						<a href="<?php bloginfo('url'); ?>/shows">
							Upcoming Shows
						</a>
					</li>	

					<?php if ( get_field('sneak_peak_active', 'option') ) : ?>
					<li>
						<a href="<?php bloginfo('url'); ?>/sneak-peek">
							<?php echo get_field('sneak_peak_heading', 'option'); ?>
						</a>
					</li>	
					<?php endif; ?>

					<li>
						<a href="<?php bloginfo('url'); ?>/how-it-works">
							How it Works
						</a>
					</li>	
					
					<?php if ( is_user_logged_in() ) : ?>
					<li>
						<a href="<?php bloginfo('url'); ?>/my-account">
							My Account
						</a>		
					</li>
					<li>
						<a href="<?php bloginfo('url'); ?>/closet">
							My Closet
						</a>		
					</li>					
					
					<li><a href="<?php echo wp_logout_url( home_url() ); ?>" title="Logout">Logout</a></li>
							
					<?php else: ?>
					<li>
						<a href="<?php bloginfo('url'); ?>/join">
							Become a Member
						</a>		
					</li>					
					<?php endif; ?>

					<?php if ($logged_in = is_user_logged_in()) : 
						global $current_user;
			 			get_currentuserinfo();

			 			if ( ($manage_options = current_user_can( 'manage_options' )) || ($manage_wc = current_user_can('manage_woocommerce')) ) : ?>
						
						<li><a href="<?php bloginfo('url'); ?>/wp-admin"><span class="icon" data-icon="("></span></a></li>

					<?php endif; endif; ?>
				</ul>						
			</div>	

			<?php if ( $logged_in ) :
			 	
			 	if( $manage_options || $manage_wc ): ?>

			 		<div id="admin-login" class="hidden-xs"><a href="<?php bloginfo('url'); ?>/wp-admin"><span class="icon" data-icon="("></span></a></div>

			 <?php endif; endif; ?>			
			
		</header>

	<div id="headerfix"></div>
		
	<div id="content" class="">
