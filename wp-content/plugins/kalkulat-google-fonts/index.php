<?php
/*
Plugin Name: kalkulat Google Fonts
Plugin URI: http://themelayer.net
Description: kalkulat Google Fonts for customizer settings api.
Version: 1.4
Author: themelayer
Author URI: http://themelayer.net
License: GPLv2 or later
*/



// don't load directly
if (!defined('ABSPATH')) die('-1');
require_once plugin_dir_path( __FILE__ ) . 'inc/typography_customizer.php';


	// get data from customizer




if(!function_exists('kalkulat_google_fonts_url')) {
	function kalkulat_google_fonts_url($font) {
		$font_url = '';

		if ( 'off' !== _x( 'on', 'Google font: on or off', 'kalkulat' ) ) {
			$font_url = add_query_arg( 'family', urlencode($font), "//fonts.googleapis.com/css" );
		}
		return $font_url;
	}
}	
if(!function_exists('kalkulat_google_font_scripts')) {
	function kalkulat_google_font_scripts() {
		$fonts = '';
		$kalkulat_body_font 				= get_theme_mod( 'body_font_family' );
		$kalkulat_body_font_weight 		= get_theme_mod( 'body_font_weight_id' );
		$kalkulat_heading_font 			= get_theme_mod( 'heading_font_family' );
		$kalkulat_heading_font_weight		= get_theme_mod( 'heading_font_weight_id' );
		$kalkulat_sub_heading_font 		= get_theme_mod( 'sub_heading_font_family' );
		$kalkulat_sub_heading_font_weight  = get_theme_mod( 'sub_heading_font_weight_id' );
		if(!empty($kalkulat_body_font)){
			$fonts .= $kalkulat_body_font.':'.$kalkulat_body_font_weight.'|';
		}
		if(!empty($kalkulat_heading_font)){
			$fonts .= $kalkulat_heading_font.':'.$kalkulat_heading_font_weight.'|';
		}
		if(!empty($kalkulat_sub_heading_font)){
			$fonts .= $kalkulat_sub_heading_font.':'.$kalkulat_sub_heading_font_weight;
		}
		wp_enqueue_style( 'kalkulat-google-font', kalkulat_google_fonts_url($fonts), array('kalkulat-web-font'));
	}
}
add_action( 'wp_enqueue_scripts', 'kalkulat_google_font_scripts' );


// font weight to number
if(!function_exists('kalkulat_font_weight_to_number')){
	function kalkulat_font_weight_to_number($font_weight){

		$weight = '';

		if($font_weight == 'thin' || $font_weight == '100italic'){
			$weight = 100;
		}else if($font_weight == 'extra-light' || $font_weight == '200italic'){
			$weight = 200;
		}else if($font_weight == 'light' || $font_weight == '300italic'){
			$weight = 300;
		}else if($font_weight == 'regular' || $font_weight == '400italic'){
			$weight = 400;
		}else if($font_weight == 'medium' || $font_weight == '500italic'){
			$weight = 500;
		}else if($font_weight == 'semi-bold' || $font_weight == 'semi-bold'){
			$weight = 600;
		}else if($font_weight == 'bold' || $font_weight == '700italic'){
			$weight = 700;
		}else if($font_weight == 'extra-bold' || $font_weight == 'extra-bold'){
			$weight = 800;
		}else if($font_weight == 'black' || $font_weight == '900italic'){
			$weight = 900;
		}else {
			$weight = 400;
		}
		return $weight;	
	}
}



// add inline font family
if(!function_exists('kalkulat_custom_fonts_load')){
	function kalkulat_custom_fonts_load(){
		$kalkulat_body_font 				= get_theme_mod( 'body_font_family' );
		$kalkulat_body_font_weight 		= get_theme_mod( 'body_font_weight_id' );
		$kalkulat_heading_font 			= get_theme_mod( 'heading_font_family' );
		$kalkulat_heading_font_weight		= get_theme_mod( 'heading_font_weight_id' );
		$kalkulat_sub_heading_font 		= get_theme_mod( 'sub_heading_font_family' );
		$kalkulat_sub_heading_font_weight  = get_theme_mod( 'sub_heading_font_weight_id' );


		$custom_css = '';
		if(!empty($kalkulat_body_font)){
			$custom_css .="
		         body, p {
		          font-family: $kalkulat_body_font !important;
		          font-weight:  ".kalkulat_font_weight_to_number($kalkulat_body_font_weight)." !important;
		          ".(($kalkulat_body_font_weight == 'italic') ? 'font-style: italic' : '').";
		        } 
		    ";
		}
		
		if(!empty($kalkulat_heading_font)){
			$custom_css .="
		         h1, h2, h3, h4, h5, h6 {
		          font-family: $kalkulat_heading_font !important;
		          font-weight: ".kalkulat_font_weight_to_number($kalkulat_heading_font_weight)." !important;
		          ".(($kalkulat_heading_font_weight == 'italic') ? 'font-style: italic' : '').";
		        } 
		    ";
		}	

		if(!empty($kalkulat_sub_heading_font)){
			$custom_css .="
		         .section-heading span {
		          font-family: $kalkulat_sub_heading_font !important;
		          font-weight: ".kalkulat_font_weight_to_number($kalkulat_sub_heading_font_weight)." !important;
		          ".(($kalkulat_sub_heading_font_weight == 'italic') ? 'font-style: italic' : '').";
		        } 
		    ";
		}

		wp_add_inline_style( 'kalkulat-main-stylesheet', $custom_css );
	}
}
add_action('wp_enqueue_scripts', 'kalkulat_custom_fonts_load', 30);