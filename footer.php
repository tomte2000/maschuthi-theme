<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package maschuthi
 */

?>

			<footer id="colophon" class="site-footer">
				<div class="site-info container">
				<?php  
					if(has_nav_menu('menu-2')) {
						wp_nav_menu(array(	       
					       'theme_location'  => 'menu-2',
					       'container'       => false,
					       'menu_id'         => false,
					       'menu_class'      => 'ms-0 col-12 nav d-flex align-items-end',
					       'depth'           => 2,
					       'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
					       'walker'          => new bootstrap_5_wp_nav_menu_walker()
					  	));
					};
				?>	
				</div><!-- .site-info -->
			</footer><!-- #colophon -->
		</div><!-- #page -->

		<?php wp_footer(); ?>
		<script type="text/javascript">
    		<?php 
			get_field('javascript_editor')?the_field('javascript_editor'):'';
			?>
		</script>

	</body>
</html>
