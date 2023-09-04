<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package maschuthi
 */

?>

<!--content--->

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) {
			echo ('<a class="zurueck bi bi-arrow-left-circle" href="'. wp_get_referer().'"></a>');
			the_title( '<h2 class="entry-title">', '</h2>' );
		} else {
			echo ('<a class="zurueck bi bi-arrow-left-circle" href="'. wp_get_referer().'"></a>');
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}

		if ( 'post' === get_post_type() ) {} 
		
		?>
	</header><!-- .entry-header -->

	<?php //echo is_singular()?maschuthi_post_thumbnail():''; ?>

	<div class="entry-content">
		<?php
		if ( is_singular() ) {
			the_content( );
		} else {
			?>
			<div class="row">
				<div class="col-12 col-lg-6 ">
					<?php the_post_thumbnail('small', ['class' => 'shadow mb-3 img-fluid', 'title' => 'Feature image']);?>
				</div>
				<div class="col-12 col-lg-6">
					<?php the_content('weiterlesen: ' . get_the_title());?>
				</div>
			</div>
		<?php
		}
			wp_link_pages(['before' => '<div class="page-links">' . esc_html__( 'Seiten: ', 'maschuthi' ),'after'  => '</div>']);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php //maschuthi_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
