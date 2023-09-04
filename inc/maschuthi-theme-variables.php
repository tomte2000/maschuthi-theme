<?php
if(class_exists('acf_pro') || class_exists('acf')):
	//acf options page
	if( function_exists('acf_add_options_page') ) {
		acf_add_options_page(array(
			'page_title' 	=> 'Theme General Settings',
			'menu_title'	=> 'Theme Settings',
			'menu_slug' 	=> 'theme-general-settings',
			'capability'	=> 'edit_posts',
			'redirect'		=> false
		));
		//standardfarben
		//echo nl2br(print_themevariables ('standardfarben'));
		//echo(print_me(get_themevariables('standardfarben')));
		//echo(print_me(get_themevariables('schriftgrosse')));
	}

	//für das scss-variablen array
	function print_themevariables ($value) {
		if( have_rows($value, 'option') ){
			$themevariables = '(';
			while( have_rows($value, 'option') ) {
				the_row();
				if (get_sub_field('value') != '') {
					$themevariables .= get_sub_field('key') . ':' . get_sub_field('value')  . get_sub_field('unit') . ',';
				}
			}
			$themevariables .= ');';
			return($themevariables);
		}
	}

	//für das scss-variablen array und die gutenbergpalette
	function get_themevariables ($value) {
		if( have_rows($value, 'option') ){
			$themevariables = [];
			while( have_rows($value, 'option') ) {
				the_row();
				if (get_sub_field('value') != '') {
					$themevariables [get_sub_field('key')] = get_sub_field('value') . get_sub_field('unit');
				}
			}
			return($themevariables);
		}
	}

	//theme palette
	function mytheme_setup_theme_supported_features() {
		$standardfarben = get_themevariables ('standardfarben');
		$editor_array = [];
		if (is_array($standardfarben)) {
			foreach ($standardfarben as $key => $standardfarbe) {	
				array_push($editor_array,['name' => __( $key, 'themeLangDomain' ),'slug' => $key,'color' => $standardfarbe]);
			}
		}
		add_theme_support( 'editor-color-palette', $editor_array );
	}
	add_action( 'after_setup_theme', 'mytheme_setup_theme_supported_features' );

	//scss variablen
	function wp_scss_set_variables(){
		/*farben*/
		$colors = [   
			//standardfarben für gutenberg in css
			'standardfarben' => nl2br(print_themevariables ('standardfarben')),
			'schriftgrosse' => nl2br(print_themevariables ('schriftgrosse')),
			//////
			//'font-family' =>  '"Source Sans Pro", sans-serif',
			'font-family' =>  '"courier", sans-serif',
			'headings-font-family' =>  '"Barlow Condensed", sans-serif',
			'menu-font-family' => '"Barlow Condensed", sans-serif',
		];

		//standardfarben für scss
		$standardfarben = get_themevariables('standardfarben');
		$schriftgrosse = get_themevariables('schriftgrosse');
		
		if (is_array($standardfarben) && is_array($schriftgrosse)) {
			$variables = array_merge($colors, get_themevariables('standardfarben'), get_themevariables('schriftgrosse'));
		}else{
			$variables = $colors;
		}
		//echo(print_me($standardfarben));
		return $variables;
	}
	add_filter('wp_scss_variables','wp_scss_set_variables');

	//javascript varibable {json} für colors anlegen gehört in functions.php
	//wird aufgerufen wenn acf installiert ist
	function mytheme_enqueue_block_editor_assets() {
		// Register the script like this for a theme:
		wp_register_script( 'block-filters', get_stylesheet_directory_uri() . '/js/block-filters.js', array( 'wp-hooks' ), '1.0.0', true );
		$wp_custom_vars = [ 
			'get_the_title'	=> get_the_title(),
			'colors' 		=> get_themevariables ('standardfarben')
		];
		wp_localize_script( 'block-filters', 'wp_custom_vars', $wp_custom_vars );
		wp_enqueue_script( 'block-filters' );
	}
	add_action( 'enqueue_block_editor_assets', 'mytheme_enqueue_block_editor_assets' );
endif;
