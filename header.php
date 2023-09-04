<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package maschuthi
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site d-flex flex-column min-vh-100">
		<!-- Top menu -->
		<header id="masthead" class="site-header sticky-top shadow mb-5 sticky-top bgdrot pt-5 pb-5">
			<!--site-branding-->
			<div class="site-branding container">
				<div class="row">
					<div class="col-6 col-lg-9">
						<nav id="navbar-main-menu" class="row navbar navbar-expand-lg">
							<button class="navbar-toggler collapsed col-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">							
								<span class="navbar-toggler-icon"></span>
							</button>
							<div class="collapse navbar-collapse col-6 col-lg-9" id="navbarSupportedContent">
								<?php
								wp_nav_menu([
									'menu'            	=> 'main-menu',
									'theme_location'  	=> 'Primary',
									'container'       	=> false,
									'fallback_cb'     	=> '__return_false',
									'items_wrap' 		=> '<ul id="%1$s" class="nav navbar-nav %2$s">%3$s</ul>',
									'depth'         	=> 2,
									//'before'            => '<span class="d-block pe-5">',
									//'after'            	=> '</span>',
									'walker'          	=> new bootstrap_5_wp_nav_menu_walker()
								]);
								?>
							</div>
						</nav>
					</div>
					<!--<div id="sprache" class="col-6 col-lg-3 d-flex">
						<div class="ms-auto" id="expand-sprache" data-bs-toggle="collapse" data-bs-target="#navbar-top-menu"></div>
						<div id="navbar-top-menu" class="collapse collapse-horizontal">
							<?php //if (function_exists("the_msls")) the_msls(); ?>
						</div>
					</div>-->

					<div class="col-6 col-lg-3">
						<?php 
							echo has_custom_logo()? get_custom_logo(): '';
							echo display_header_text()? '<span class="blog-name">'.get_bloginfo('name').'</span>':'';
						?>
					</div>
				</div>
			</div>
			<!-- #site-navigation -->
			
			<?php 
				
			if ( is_front_page() && is_active_sidebar( 'title' ) ) {
				dynamic_sidebar( 'title' );
			}
			?>
		</header>
