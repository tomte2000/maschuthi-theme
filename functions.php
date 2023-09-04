<?php
/**
 * maschuthi functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package maschuthi
 */

    //für maschuthi 12.20.2022 mit bootstrap 5
	/*
		neu maschuthi 12.20.2022:
		• 	By adding data-masonry='{"percentPosition": true }' to the .row wrapper, 
			we can combine the powers of Bootstrap's responsive grid and Masonry's positioning.
		•	acf optionsseite für footercontent eingeführt - > /inc/acf-blocks.php
		•	scss variablen in /inc/theme-variables.php
	*/



if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function maschuthi_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on maschuthi, use a find and replace
		* to change 'maschuthi' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'maschuthi', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'maschuthi' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'maschuthi_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'maschuthi_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function maschuthi_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'maschuthi_content_width', 640 );
}
add_action( 'after_setup_theme', 'maschuthi_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function maschuthi_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'maschuthi' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'maschuthi' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'maschuthi_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
add_action('wp_enqueue_scripts', 'maschuthi_scripts');
function maschuthi_scripts() {
	wp_enqueue_style( 'maschuthi-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'maschuthi-style', 'rtl', 'replace' );
	wp_enqueue_script( 'maschuthi-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_style( 'bootstrapstyle', get_template_directory_uri() . '/bootstrap-5.2.3-dist/css/bootstrap.min.css' );
	wp_enqueue_style( 'bootstrapiconstyle', get_template_directory_uri() . '/bootstrap-icons-1.10.5/font/bootstrap-icons.css' );
	wp_enqueue_style( 'fontstyle', get_template_directory_uri() . '/fonts/maschuthi-fonts.css');
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js', array('jquery') );

	// Register the script like this for the theme:
	wp_enqueue_script( 'maschuthi-script', get_template_directory_uri() . '/js/maschuthi-script.js', array(), true );
	$wp_custom_vars = array(	
		'template_url' => get_template_directory_uri(), 
		'upload_dir' => wp_upload_dir(),
		'thumb_url' => get_the_post_thumbnail_url(),
		'img' => wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "full" ));
	wp_localize_script( 'maschuthi-script', 'wp_custom', $wp_custom_vars );
	wp_enqueue_script( 'maschuthi-script' );

   /////
}


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


require_once get_template_directory() . '/inc/maschuthi-theme-variables.php';
require_once get_template_directory() . '/inc/maschuthi-class-wp-bootstrap-navwalker.php';
require_once get_template_directory() . '/inc/maschuthi-pods-functions.php';

