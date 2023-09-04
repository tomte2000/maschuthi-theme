<?php
/**
 * The template for displaying category pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package headless
 */

get_header();
?>

<!-- category -->

<?php 
	if (get_the_category()) {
		$cat = get_queried_object();
		$cat_color = get_field('kategoriefarbe', $cat->taxonomy . '_' . $cat->term_id);
		$cat_img_array = get_field('kategorieimage', $cat->taxonomy . '_' . $cat->term_id);
		$cat_img = '<img src="'.wp_get_attachment_image_src($cat_img_array['id'])[0].'" class="img-fluid">';
	}
?>

	<main id="primary" class="site-main container">
	<?php 
	if (have_posts()) { 
		echo(
		'<header class="page-header row mb-3">
			<div class="col-12 col-lg-11">	
				<a class="zurueck bi bi-arrow-left-circle" href="'. wp_get_referer().'"></a>');
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
		echo(
			'</div>
			<div class="col-12 col-lg-1 ms-auto">'
			 	. $cat_img . 
			'</div>
		</header><!-- .page-header -->

		<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4">');
		foreach($posts as $key => $post) {
			$data = [ 'number' => $key, 'parentcat' => $cat];
			$first = $key == 0?'col mb-4':'col mb-4';
			the_post();
			echo (
			'<div class="'.$first.'">');
				get_template_part( 'template-parts/content', 'card', $data );
			echo('</div>');
		};
		echo('</div>');
		the_posts_navigation();
	} else {

		get_template_part( 'template-parts/content', 'none' );

	};
	get_sidebar(); 
	?>

	</main><!-- #main -->
<?php

get_footer();
