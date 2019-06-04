<?php 

if( !defined( 'ABSPATH' ) ) exit;

/*
* Plugin Name: kalkulat Post Type
* Plugin URL: http://themelayer.com/
* Description: kalkulat Custom Post Type
* Version: 2.4
* Author: themelayer
* Author URI: http://themelayer.com/

* kalkulat Post Type
* @since kalkulat 2.0
* @Package kalkulat
*/


define('KALKULATE_CMB2_ACTIVED', in_array('cmb2/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) )));

if(KALKULATE_CMB2_ACTIVED){
	require_once plugin_dir_path( __FILE__ ) . 'kalkulate_metabox.php';
}
require_once plugin_dir_path( __FILE__ ) . 'widget/kalkulate_about.php';
require_once plugin_dir_path( __FILE__ ) . 'widget/kalkulate_recent_post.php';
require_once plugin_dir_path( __FILE__ ) . 'widget/kalkulate_widget_about_info.php';
require_once plugin_dir_path( __FILE__ ) . 'widget/kalkulate_nav_menu_widget.php';




/**
* Service Post Type
*/
if(!function_exists('kalkulate_service_post_type')){
	function kalkulate_service_post_type(){
		$labels = array(
			'name'  				=> esc_html__( 'Service', 'kalkulat' ),
			'singular_name'			=> esc_html__( 'Service', 'kalkulat' ),
			'menu_name'				=> esc_html__( 'Service', 'kalkulat' ),
			'parent_item_colon'		=> esc_html__( 'Parent Service', 'kalkulat' ),
			'all_items'				=> esc_html__( 'All Service', 'kalkulat' ),
			'view_item'				=> esc_html__( 'View Service', 'kalkulat' ),
			'add_new_item'        	=> esc_html__( 'Add New Service', 'kalkulat' ),
			'add_new'             	=> esc_html__( 'New Service', 'kalkulat' ),
			'edit_item'           	=> esc_html__( 'Edit Service', 'kalkulat' ),
			'update_item'         	=> esc_html__( 'Update Service', 'kalkulat' ),
			'search_items'        	=> esc_html__( 'Search Service', 'kalkulat' ),
			'not_found'           	=> esc_html__( 'No Service found', 'kalkulat' ),
			'not_found_in_trash'  	=> esc_html__( 'No Service found in Trash', 'kalkulat' )
		);
		$args = array(
			'labels'			=> $labels,
			'public'			=> true,
			'publicly_queryable'=> true,
			'show_in_menu'		=> true,
			'show_in_admin_bar'	=> true,
			'can_export'		=> true,
			'has_archive'		=> false,
			'hierarchical'		=> false,
			'menu_icon'			=> 'dashicons-admin-generic',
			'supports'			=> array('title', 'editor', 'thumbnail')
		);

		register_post_type( 'service', $args );
	}
}
add_action( 'init', 'kalkulate_service_post_type');

/**
* Testimonial Post Type
*/
if(!function_exists('kalkulate_testimonial_post_type')){
	function kalkulate_testimonial_post_type(){
		$labels = array(
			'name'  				=> esc_html__( 'Testimonial', 'kalkulat' ),
			'singular_name'			=> esc_html__( 'Testimonial', 'kalkulat' ),
			'menu_name'				=> esc_html__( 'Testimonial', 'kalkulat' ),
			'parent_item_colon'		=> esc_html__( 'Parent Testimonial', 'kalkulat' ),
			'all_items'				=> esc_html__( 'All Testimonial', 'kalkulat' ),
			'view_item'				=> esc_html__( 'View Testimonial', 'kalkulat' ),
			'add_new_item'        	=> esc_html__( 'Add New Testimonial', 'kalkulat' ),
			'add_new'             	=> esc_html__( 'New Testimonial', 'kalkulat' ),
			'edit_item'           	=> esc_html__( 'Edit Testimonial', 'kalkulat' ),
			'update_item'         	=> esc_html__( 'Update Testimonial', 'kalkulat' ),
			'search_items'        	=> esc_html__( 'Search Testimonial', 'kalkulat' ),
			'not_found'           	=> esc_html__( 'No Testimonial found', 'kalkulat' ),
			'not_found_in_trash'  	=> esc_html__( 'No Testimonial found in Trash', 'kalkulat' )
		);
		$args = array(
			'labels'			=> $labels,
			'public'			=> true,
			'publicly_queryable'=> true,
			'show_in_menu'		=> true,
			'show_in_admin_bar'	=> true,
			'can_export'		=> true,
			'has_archive'		=> false,
			'hierarchical'		=> false,
			'menu_icon'			=> 'dashicons-admin-comments',
			'supports'			=> array('title', 'editor', 'thumbnail')
		);

		register_post_type( 'testimonial', $args );
	}
}
add_action( 'init', 'kalkulate_testimonial_post_type');

/**
* About Post Type
*/
if(!function_exists('kalkulate_about_post_type')){
	function kalkulate_about_post_type(){
		$labels = array(
			'name'  				=> esc_html__( 'About', 'kalkulat' ),
			'singular_name'			=> esc_html__( 'About', 'kalkulat' ),
			'menu_name'				=> esc_html__( 'About', 'kalkulat' ),
			'parent_item_colon'		=> esc_html__( 'Parent About', 'kalkulat' ),
			'all_items'				=> esc_html__( 'All About', 'kalkulat' ),
			'view_item'				=> esc_html__( 'View About', 'kalkulat' ),
			'add_new_item'        	=> esc_html__( 'Add New About', 'kalkulat' ),
			'add_new'             	=> esc_html__( 'New About', 'kalkulat' ),
			'edit_item'           	=> esc_html__( 'Edit About', 'kalkulat' ),
			'update_item'         	=> esc_html__( 'Update About', 'kalkulat' ),
			'search_items'        	=> esc_html__( 'Search About', 'kalkulat' ),
			'not_found'           	=> esc_html__( 'No About found', 'kalkulat' ),
			'not_found_in_trash'  	=> esc_html__( 'No About found in Trash', 'kalkulat' )
		);
		$args = array(
			'labels'			=> $labels,
			'public'			=> true,
			'publicly_queryable'=> true,
			'show_in_menu'		=> true,
			'show_in_admin_bar'	=> true,
			'can_export'		=> true,
			'has_archive'		=> false,
			'hierarchical'		=> false,
			'menu_icon'			=> 'dashicons-businessman',
			'supports'			=> array('title', 'editor', 'thumbnail')
		);

		register_post_type( 'about', $args );
	}
}
add_action( 'init', 'kalkulate_about_post_type');


/**
* portfolio Post Type
*/
if(!function_exists('kalkulate_portfolio_post_type')){
	function kalkulate_portfolio_post_type(){
		$labels = array(
			'name'  				=> esc_html__( 'portfolio', 'kalkulat' ),
			'singular_name'			=> esc_html__( 'portfolio', 'kalkulat' ),
			'menu_name'				=> esc_html__( 'portfolio', 'kalkulat' ),
			'parent_item_colon'		=> esc_html__( 'Parent portfolio', 'kalkulat' ),
			'all_items'				=> esc_html__( 'All portfolio', 'kalkulat' ),
			'view_item'				=> esc_html__( 'View portfolio', 'kalkulat' ),
			'add_new_item'        	=> esc_html__( 'Add New portfolio', 'kalkulat' ),
			'add_new'             	=> esc_html__( 'New portfolio', 'kalkulat' ),
			'edit_item'           	=> esc_html__( 'Edit portfolio', 'kalkulat' ),
			'update_item'         	=> esc_html__( 'Update portfolio', 'kalkulat' ),
			'search_items'        	=> esc_html__( 'Search portfolio', 'kalkulat' ),
			'not_found'           	=> esc_html__( 'No portfolio found', 'kalkulat' ),
			'not_found_in_trash'  	=> esc_html__( 'No portfolio found in Trash', 'kalkulat' )
		);
		$args = array(
			'labels'			=> $labels,
			'public'			=> true,
			'publicly_queryable'=> true,
			'show_in_menu'		=> true,
			'show_in_admin_bar'	=> true,
			'can_export'		=> true,
			'has_archive'		=> false,
			'hierarchical'		=> false,
			'menu_icon'			=> 'dashicons-clipboard',
			'supports'			=> array('title', 'editor', 'thumbnail'),
			'taxonomies'        => array( 'category', 'post_tag'),
		);

		register_post_type( 'portfolio', $args );
	}
}
add_action( 'init', 'kalkulate_portfolio_post_type');

/**
* Team Post Type
*/
if(!function_exists('kalkulate_team')){
	function kalkulate_team(){
		$labels = array(
			'name'  				=> esc_html__( 'team', 'kalkulat' ),
			'singular_name'			=> esc_html__( 'team', 'kalkulat' ),
			'menu_name'				=> esc_html__( 'team', 'kalkulat' ),
			'parent_item_colon'		=> esc_html__( 'Parent team', 'kalkulat' ),
			'all_items'				=> esc_html__( 'All team', 'kalkulat' ),
			'view_item'				=> esc_html__( 'View team', 'kalkulat' ),
			'add_new_item'        	=> esc_html__( 'Add New team', 'kalkulat' ),
			'add_new'             	=> esc_html__( 'New team', 'kalkulat' ),
			'edit_item'           	=> esc_html__( 'Edit team', 'kalkulat' ),
			'update_item'         	=> esc_html__( 'Update team', 'kalkulat' ),
			'search_items'        	=> esc_html__( 'Search team', 'kalkulat' ),
			'not_found'           	=> esc_html__( 'No team found', 'kalkulat' ),
			'not_found_in_trash'  	=> esc_html__( 'No team found in Trash', 'kalkulat' )
		);
		$args = array(
			'labels'			=> $labels,
			'public'			=> true,
			'publicly_queryable'=> true,
			'show_in_menu'		=> true,
			'show_in_admin_bar'	=> true,
			'can_export'		=> true,
			'has_archive'		=> false,
			'hierarchical'		=> false,
			'menu_icon'			=> 'dashicons-groups',
			'supports'			=> array('title', 'editor', 'thumbnail')
		);

		register_post_type( 'team', $args );
	}
}
add_action( 'init', 'kalkulate_team');

/**
* Single page template for portolio
*/
if(!function_exists('kalkulate_portfolio_post_template')){
	function kalkulate_portfolio_post_template($single_template){
		global $post;
		if($post->post_type == 'portfolio'){
			$single_template = plugin_dir_path( __FILE__ ) . 'single/single-portfolio.php';
		}
		return $single_template;
	}
}
add_filter( 'single_template', 'kalkulate_portfolio_post_template' );

/*** Popular Posts By Views*/
if(!function_exists('kalkulate_set_post_views')){    
	function kalkulate_set_post_views($postID) {        
		$count_key = '__kalkulate__post_views_count';        
		$count = get_post_meta($postID, $count_key, true);        
		if($count==''){            
			$count = 0;           
			delete_post_meta($postID, $count_key);           
			add_post_meta($postID, $count_key, '0');       
		}else{           
			$count++;           
			update_post_meta($postID, $count_key, $count);       
		}   
	}
	function kalkulate_track_post_views ($post_id) {  
		if ( !is_single() ) return;       
		if ( empty ( $post_id) ) { 
		global $post;           
		$post_id = $post->ID;           
	}
	kalkulate_set_post_views($post_id);   
}    
add_action( 'wp_head', 'kalkulate_track_post_views');
}


/**
* Cases Post Type
*/
if(!function_exists('kalkulate_cases_post_type')){
	function kalkulate_cases_post_type(){
		$labels = array(
			'name'  				=> esc_html__( 'Cases', 'kalkulat' ),
			'singular_name'			=> esc_html__( 'Cases', 'kalkulat' ),
			'menu_name'				=> esc_html__( 'Cases', 'kalkulat' ),
			'parent_item_colon'		=> esc_html__( 'Parent cases', 'kalkulat' ),
			'all_items'				=> esc_html__( 'All cases', 'kalkulat' ),
			'view_item'				=> esc_html__( 'View cases', 'kalkulat' ),
			'add_new_item'        	=> esc_html__( 'Add New cases', 'kalkulat' ),
			'add_new'             	=> esc_html__( 'New cases', 'kalkulat' ),
			'edit_item'           	=> esc_html__( 'Edit cases', 'kalkulat' ),
			'update_item'         	=> esc_html__( 'Update cases', 'kalkulat' ),
			'search_items'        	=> esc_html__( 'Search cases', 'kalkulat' ),
			'not_found'           	=> esc_html__( 'No cases found', 'kalkulat' ),
			'not_found_in_trash'  	=> esc_html__( 'No cases found in Trash', 'kalkulat' )
		);
		$args = array(
			'labels'			=> $labels,
			'public'			=> true,
			'publicly_queryable'=> true,
			'show_in_menu'		=> true,
			'show_in_admin_bar'	=> true,
			'can_export'		=> true,
			'has_archive'		=> false,
			'hierarchical'		=> false,
			'menu_icon'			=> 'dashicons-dashboard',
			'supports'			=> array('title', 'editor', 'thumbnail'),
			'taxonomies'        => array( 'category', 'post_tag'),
		);

		register_post_type( 'cases', $args );
	}
}
add_action( 'init', 'kalkulate_cases_post_type');



/**
* kalkulate Post Share
*/
if(!function_exists('kalkulate_post_share')){
	function kalkulate_post_share(){
		global $post;
		// Get current page URL 
		$crunchifyURL = get_permalink();
	 
		// Get current page title
		$crunchifyTitle = str_replace( ' ', '%20', get_the_title());
		$twitterURL = 'https://twitter.com/intent/tweet?text='.$crunchifyTitle.'&amp;url='.$crunchifyURL.'&amp;via=Crunchify';
		$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$crunchifyURL;
		$googleURL = 'https://plus.google.com/share?url='.$crunchifyURL;
		?>
		<div class="social-content">
			<a class="post-facebook" href="<?php print esc_url($facebookURL); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
			<a class="post-twitter" href="<?php print esc_url($twitterURL); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
			<a class="post-google-plus" href="<?php print esc_url($googleURL); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
		</div>
		<?php
	}
}