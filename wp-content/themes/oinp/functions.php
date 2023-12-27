<?php

if ( ! function_exists( 'oinp_setup' ) ) :

	function oinp_setup() {

		load_theme_textdomain( 'oinp', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'post-thumbnails' );

		register_nav_menus( array(

			'primary'   => __( 'Primary Menu', 'oinp' ),

			'footer1'   => __( 'Footer Menu 1', 'oinp' ),

			'footer2'   => __( 'Footer Menu 2', 'oinp' ),
			
			'hamilton1'   => __( 'Hamilton Menu', 'oinp' ),

		) );

		add_theme_support( 'post-formats', array( 'aside', 'gallery', 'quote', 'image', 'video' ) );

	}

endif; // oinp_setup

add_action( 'after_setup_theme', 'oinp_setup' );

// map location cpt start
add_action('init', 'map_location_custom_post_type');
function map_location_custom_post_type() {
	$labels = array(
		"name" => __( 'Map Locations', 'oinp' ),
		"singular_name" => __( 'Map Location', 'oinp' ),
		);
	
	$args = array(
	 "label" => __('Map Locations', 'oinp'),
	 "labels" => $labels,
		"description" => "",
		"public" => false,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "locations", "with_front" => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-media-interactive", 
		"supports" => array( "title", "editor", "thumbnail", "page-attributes" ),	
	);
	register_post_type( "locations", $args );
}

// maplocation cpt end

// Scripts and styles

function oinp_scripts() {

	wp_enqueue_style( 'theme-style', get_template_directory_uri() . '/style.css', false, '1.0', 'all');
	wp_enqueue_style( 'stylev1', get_template_directory_uri() . '/assets/css/stylev1.css', false, '1.0', 'all');

	// wp_enqueue_style( 'oinp-style', get_template_directory_uri() . '/assets/css/style.min.css', false, '1.0', 'all');

	// wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', false, '1.0', 'all');

	// wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/css/slider.css', false);

	// wp_enqueue_style( 'mapbox-style', 'https://api.mapbox.com/mapbox-gl-js/v2.11.0/mapbox-gl.css', false, '2.11.0', 'all');

	

	// wp_deregister_script( 'jquery' );

	// wp_enqueue_script( 'jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js', array( ), '3.6.1' );

	// wp_enqueue_script( 'jquery' );

	// wp_enqueue_script( 'tweenMax', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js', array( ), '1.19.1' );

	// wp_enqueue_script( 'draggable', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/utils/Draggable.min.js', array( ), '1.19.1' );

	// wp_enqueue_script( 'mapbox', 'https://api.mapbox.com/mapbox-gl-js/v2.11.0/mapbox-gl.js', array( ), 2.11 );

	// wp_enqueue_script( 'owl', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( ), '2.3.4' );

	// wp_enqueue_script( 'script', get_template_directory_uri() . '/assets/js/script.js', array( ), 1.0 );

}

add_action( 'wp_enqueue_scripts', 'oinp_scripts' );



require get_template_directory() . '/inc/custom-functions.php';

// require get_template_directory() . '/inc/site-shortcodes.php';

// require get_template_directory() . '/inc/custom-posttypes.php';

?>