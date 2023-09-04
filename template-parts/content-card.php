<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package maschuthi
 */

?>

<!--content-card-->

<card id="post-<?php the_ID(); ?>" <?php post_class('card h-100 '); ?>>

	<?php the_post_thumbnail('medium', ['class' => 'card-img-top shadow mb-3', 'title' => 'Feature image']);

	$terms = get_the_terms( get_the_ID(), 'category');
	$terms = !empty($terms)?array_pop($terms):0;
	$catcolor = get_field('kategoriefarbe', $terms)?:'#f00';
	//$style = 'style="background:'.$catcolor.'"';
	$style = 'style="background:bgdweiss"';
	$overlay = has_post_thumbnail()?'card-img-overlay-no':'';

	if ( is_singular() ) {
		the_title( '<h1 class="entry-title">', '</h1>' );
	} else {
		the_title( '<h4 class="m-0 entry-title '.$overlay.'" '.$style.'>
		<a class="'.$overlay.' stretched-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a>
		</h4>' );
	};
	?>
	<!-- .entry-header -->

	<?php 
		echo is_singular()?'<div class="card-body">'.the_content().'</div>':'';
	?>

	<!-- .entry-content -->

	<!--<div class="card-footer">
		<?php //maschuthi_entry_footer(); ?>
	</div><!-- .entry-footer -->

</card><!-- #post-<?php the_ID(); ?> -->

