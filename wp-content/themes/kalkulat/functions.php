<?php 
/**
 * kalkulate functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage kalkulat
 * @since 1.0
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
*/

if(!function_exists( "kalkulate_setup" )){
	function kalkulate_setup(){

		// laod theme text domain
		load_theme_textdomain( 'kalkulat', get_template_directory() . '/languages' );

		// theme support 
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'custom-header' );
		add_theme_support( 'custom-background' );
		add_theme_support( 'post-thumbnails' );

		add_theme_support( 'woocommerce' );


		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
		// Add image size
		add_image_size( 'kalkulate-blog-thumbnail', 300, 230, true );
		add_image_size( 'kalkulate-work-thumbnail', 290, 213, true );
    	add_image_size( 'kalkulate-portfolio-one-thumb', 270, 300, true );
		add_image_size( 'kalkulate-portfolio-two-thumb', 370, 270, true );
    	add_image_size( 'kalkulate-widget-recent-post-thumb', 70, 70, true );
    	add_image_size( 'kalkulate-cases-thumb', 270, 250, true );
    	add_image_size( 'kalkulate-shop-item-two', 270, 300, true );
    	add_image_size( 'kalkulate-shop-product-list', 85, 100, true );


		// Set the default content width.
		$GLOBALS['content_width'] = 750;

		register_nav_menus( array( 
        	'main_menu'			=> esc_html__( 'Main Menu', 'kalkulat' ),
        	'footer_menu'		=> esc_html__( 'Footer Menu', 'kalkulat' ),
		) );

		// This theme styles the visual editor to resemble the theme style
		add_editor_style( 'css/custom-editor-style.css' );
		
		// Enable support for Post Formats.
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'audio',
		) );

		// Add theme support for Custom Logo.
		add_theme_support( 'custom-logo', array(
			'width'       => 110,
			'height'      => 35,
			'flex-width'  => true,
		) );
		/*
		|---------------------------------------
		|	Gutenberg Support
		|---------------------------------------
		*/ 
		add_theme_support( 'wp-block-styles' );
        add_theme_support( 'align-wide' );
        add_theme_support( 'responsive-embeds' );

		// Gutenberg Admin Fonts support
		if( function_exists( 'register_block_type' ) ){
		    function kalkulat_add_editor_styles() {
				wp_enqueue_style( 'kalkulat-web-font', kalkulate_web_fonts_url('Poppins:300,400,500,600,700|Raleway:200,300,400,500,600,700,800,900'), array());
		        wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), false, 'all' );
		        wp_enqueue_style( 'editor-style', get_theme_file_uri( '/css/editor-style.css' ));
		    }
		    add_action( 'admin_enqueue_scripts', 'kalkulat_add_editor_styles' );
		}

		// Gutenberg Color Palette
        add_theme_support( 'editor-color-palette', array(
            array(
                'name' => esc_html__( 'Primary', 'kalkulat' ),
                'slug' => 'primary',
                'color' => '#00c0ff',
            ),
            array(
                'name' => esc_html__( 'Secondary', 'kalkulat' ),
                'slug' => 'secondary',
                'color' => '#7b52a1',
            ),
            array(
                'name' => esc_html__( 'Green Sea', 'kalkulat' ),
                'slug' => 'green-sea',
                'color' => '#1abc9c',
            ),
            array(
                'name' => esc_html__( 'Green Emarald', 'kalkulat' ),
                'slug' => 'green-emarald',
                'color' => '#2ecc71',
            ),
            array(
                'name' => esc_html__( 'Amethyst', 'kalkulat' ),
                'slug' => 'amethyst',
                'color' => '#9b59b6',
            ),
            array(
                'name' => esc_html__( 'Asphalt', 'kalkulat' ),
                'slug' => 'asphalt',
                'color' => '#34495e',
            ),
            array(
                'name' => esc_html__( 'SunFlower', 'kalkulat' ),
                'slug' => 'sunflower',
                'color' => '#f1c40f',
            ),
            array(
                'name' => esc_html__( 'Orange', 'kalkulat' ),
                'slug' => 'orange',
                'color' => '#f39c12',
            ),
            array(
                'name' => esc_html__( 'Alizarin', 'kalkulat' ),
                'slug' => 'alizarin',
                'color' => '#e74c3c',
            )
        ) );


        /*
		 * Enable Editor Font Sizes
		 *
		 * See: https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/#block-font-sizes
		 */
        add_theme_support( 'editor-font-sizes', array(
            array(
                'name' => esc_html__( 'small', 'kalkulat' ),
                'size' => 12,
                'slug' => 'small'
            ),
            array(
                'name' => esc_html__( 'regular', 'kalkulat' ),
                'size' => 15,
                'slug' => 'regular'
            ),
            array(
                'name' => esc_html__( 'large', 'kalkulat' ),
                'size' => 30,
                'slug' => 'large'
            ),
            array(
                'name' => esc_html__( 'larger', 'kalkulat' ),
                'size' => 48,
                'slug' => 'larger'
            )
        ) );


	}
}
add_action( 'after_setup_theme', 'kalkulate_setup' );


/**
*	Enqueue scripts and styles.
**/
if(!function_exists("kalkulate_scripts")){
	function kalkulate_scripts(){

		// all styelsheets
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), false, 'all' );
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), false, 'all' );
		wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.min.css', array(), false, 'all' );
		wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/css/magnific-popup.css', array(), false, 'all' );
		wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/css/owl.carousel.min.css', array(), false, 'all' );
		wp_enqueue_style( 'owl-theme', get_template_directory_uri() . '/css/owl.theme.min.css', array(), false, 'all' );
		wp_enqueue_style( 'kalkulat-stylesheet', get_template_directory_uri() . '/css/style.css', array(), false, 'all' );
		wp_enqueue_style( 'kalkulat-responsive', get_template_directory_uri() . '/css/responsive.css', array(), false, 'all' );
		wp_enqueue_style( 'kalkulat-main-stylesheet', get_stylesheet_uri(), array(), false, 'all' );


		// all javascript
		wp_enqueue_script( 'jquery-matchHeight', get_template_directory_uri() . '/js/jquery.matchHeight.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'jquery-magnific-popup', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'jquery-waypoints', get_template_directory_uri() . '/js/jquery.waypoints.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'jquery-counterup', get_template_directory_uri() . '/js/jquery.counterup.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'scrollUp', get_template_directory_uri() . '/js/jquery.scrollUp.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'wow', get_template_directory_uri() . '/js/wow.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'gmap3', get_template_directory_uri() . '/js/gmap3.min.js', array( 'jquery' ), null, false );
		wp_enqueue_script( 'kalkulat-custom', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), null, true );

		$map_api = get_theme_mod( 'map_api' );
		if($map_api != false){
			wp_enqueue_script( 'google-map-api', 'https://maps.googleapis.com/maps/api/js?key=' . $map_api, array( 'jquery' ), null, false );
		}
		

		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}


	}
}
add_action( 'wp_enqueue_scripts', 'kalkulate_scripts');

/**
 * Enqueue google fonts
 */
if(!function_exists('kalkulate_web_fonts_url')) {
	function kalkulate_web_fonts_url($font) {
		$font_url = '';

		if ( 'off' !== _x( 'on', 'Google font: on or off', 'kalkulat' ) ) {
			$font_url = add_query_arg( 'family', urlencode($font), "//fonts.googleapis.com/css" );
		}
		return $font_url;
	}
}	
if(!function_exists('kalkulate_font_scripts')) {
	function kalkulate_font_scripts() {
		wp_enqueue_style( 'kalkulat-web-font', kalkulate_web_fonts_url('Poppins:300,400,500,600,700|Raleway:200,300,400,500,600,700,800,900'), array());
	}
}
add_action( 'wp_enqueue_scripts', 'kalkulate_font_scripts' );



/**
* Add Post Class
*/
if(!function_exists('kalkulate_post_class')){
	function kalkulate_post_class($classes){
		if(is_single()){
			$classes[] = 'blog-detail-container';
		} else {
			$classes[] = 'blog-item blog-style-one';
		}
		return $classes;
	}
}
add_filter( 'post_class', 'kalkulate_post_class' );



/**
* widgets
*/
if(!function_exists('kalkulate_widget')){
	function kalkulate_widget(){
	  	/**
		* Main Sidebar
		*/
		register_sidebar( array(
			'name'          => esc_html__( 'Blog Sidebar', 'kalkulat' ),
			'id'            => 'blog-sidebar',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar', 'kalkulat' ),
			'before_widget' => '<aside class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>'
		) );

		/**
		* Main Sidebar
		*/
		register_sidebar( array(
			'name'          => esc_html__( 'Shop Sidebar', 'kalkulat' ),
			'id'            => 'shop-sidebar',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar', 'kalkulat' ),
			'before_widget' => '<aside class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>'
		) );

		/**
		* Footer Sidebar
		*/
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Sidebar', 'kalkulat' ),
			'id'            => 'footer-sidebar',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar', 'kalkulat' ),
			'before_widget' => '<div class="col-md-4 col-sm-12"><aside class="widget %2$s">',
			'after_widget'  => '</aside></div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>'
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Sidebar Two', 'kalkulat' ),
			'id'            => 'footer-sidebar-two',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar two', 'kalkulat' ),
			'before_widget' => '<div class="col-md-4 col-sm-12"><aside class="widget %2$s">',
			'after_widget'  => '</aside></div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>'
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Shop Sidebar', 'kalkulat' ),
			'id'            => 'footer-shop-sidebar',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar', 'kalkulat' ),
			'before_widget' => '<div class="col-md-4 col-sm-12"><aside class="widget %2$s">',
			'after_widget'  => '</aside></div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>'
		) );
	}
}
add_action( 'widgets_init', 'kalkulate_widget' );

require_once get_template_directory() . '/inc/kalkulate_functions.php';
require_once get_template_directory() . '/inc/kalkulate_customizer.php';
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/inc/kalkulate_add_plugin.php';

if(!defined('KALKULATE_WOOCOMMERCE_PLUGIN_ACTIVED')){
	define( 'KALKULATE_WOOCOMMERCE_PLUGIN_ACTIVED', in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) );
}
if(KALKULATE_WOOCOMMERCE_PLUGIN_ACTIVED){
	require_once get_template_directory() . '/inc/kalkulate_woocommerce_functions.php';
}