<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package maschuthi
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses maschuthi_header_style()
 */

function custom_header_setup() {
	add_theme_support( 
	   'custom-header', 
	   apply_filters(
		'maschuthi_custom_header_args',
			array(
				'default-image'          => get_stylesheet_directory_uri() . '/css/img/menu.svg',
				'random-default'         => false,
				'width'                  => 1320,
				'height'                 => 200,
				'flex-height'            => true,
				'flex-width'             => true,
				'default-text-color'     => '000000',
				'header-text'            => true,
				'uploads'                => true,
				'wp-head-callback'       => '',
				'admin-head-callback'    => '',
				'admin-preview-callback' => '',
				'video'                  => true,
				'video-active-callback'  => 'is_front_page',
			)
	   	)
	);
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
	// Add support for editor styles.
	add_theme_support( 'editor-styles' );
	add_editor_style( 'css/editor-styles.css' ); 
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
	   'menu-2' => esc_html__( 'Secundary', 'maschuthi' ),
	) );
 }
 add_action( 'after_setup_theme', 'custom_header_setup' );



if ( ! function_exists( 'maschuthi_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see maschuthi_custom_header_setup().
	 */
	function maschuthi_header_style() {
		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
			?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
				}
			<?php
			// If the user has set a custom color for the text use that.
		else :
			?>
			.site-title a,
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;
