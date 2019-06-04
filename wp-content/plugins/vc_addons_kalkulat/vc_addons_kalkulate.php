<?php 

if( !defined( 'ABSPATH' ) ) exit;


/*
* Plugin Name: Kalkulat Vc Addons
* Plugin URL: http://themelayer.net/
* Description: Visual Composer Custom Addons for kalkulat theme only
* Version: 2.4
* Author: themelayer
* Author URI: http://themelayer.net/

* kalkulat Vc Addons
* @since kalkulat 2.0
* @Package kalkulat 
*/

define('KALKULATE_CORE_VISUAL_COMPOSER_ACTIVED', true);

if(!defined('KALKULATE_WOOCOMMERCE_PLUGIN_ACTIVED_FOR_VC')){
	define( 'KALKULATE_WOOCOMMERCE_PLUGIN_ACTIVED_FOR_VC', in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) );
}


function kalkulate_loader(){
	if(KALKULATE_CORE_VISUAL_COMPOSER_ACTIVED){

		require_once plugin_dir_path( __FILE__ ) . 'addons/kalkulate_section_title.php';
		require_once plugin_dir_path( __FILE__ ) . 'addons/kalkulate_call_to_action.php';
		require_once plugin_dir_path( __FILE__ ) . 'addons/kalkulate_client.php';
		require_once plugin_dir_path( __FILE__ ) . 'addons/kalkulate_service.php';
		require_once plugin_dir_path( __FILE__ ) . 'addons/kalkulate_testimonial.php';
		require_once plugin_dir_path( __FILE__ ) . 'addons/kalkulate_testimonial_two.php';
		require_once plugin_dir_path( __FILE__ ) . 'addons/kalkulate_fact_count.php';
		require_once plugin_dir_path( __FILE__ ) . 'addons/kalkulate_accordion.php';
		require_once plugin_dir_path( __FILE__ ) . 'addons/kalkulate_progress_bar.php';
		require_once plugin_dir_path( __FILE__ ) . 'addons/kalkulate_intro.php';
		require_once plugin_dir_path( __FILE__ ) . 'addons/kalkulate_feature.php';
		require_once plugin_dir_path( __FILE__ ) . 'addons/kalkulate_work.php';
		require_once plugin_dir_path( __FILE__ ) . 'addons/kalkulate_portfolio_one.php';
		require_once plugin_dir_path( __FILE__ ) . 'addons/kalkulate_portfolio_two.php';
		require_once plugin_dir_path( __FILE__ ) . 'addons/kalkulate_team.php';
		require_once plugin_dir_path( __FILE__ ) . 'addons/kalkulate_team_two.php';
		require_once plugin_dir_path( __FILE__ ) . 'addons/kalkulate_blog.php';
		require_once plugin_dir_path( __FILE__ ) . 'addons/kalkulate_blog_two.php';
		require_once plugin_dir_path( __FILE__ ) . 'addons/kalkulate_blog_three.php';
		require_once plugin_dir_path( __FILE__ ) . 'addons/kalkulate_video.php';
		require_once plugin_dir_path( __FILE__ ) . 'addons/kalkulate_contact_info.php';
		require_once plugin_dir_path( __FILE__ ) . 'addons/kalkulate_map.php';
		require_once plugin_dir_path( __FILE__ ) . 'addons/kalkulate_btn.php';
		require_once plugin_dir_path( __FILE__ ) . 'addons/kalkulate_cases.php';
		require_once plugin_dir_path( __FILE__ ) . 'addons/kalkulate_fun_fact.php';
		require_once plugin_dir_path( __FILE__ ) . 'addons/kalkulate_offer_banner.php';
		// woocommcerce addons
		if(KALKULATE_WOOCOMMERCE_PLUGIN_ACTIVED_FOR_VC){
			require_once plugin_dir_path( __FILE__ ) . 'include.php';
			require_once plugin_dir_path( __FILE__ ) . 'addons/kalkulate_woo_shop.php';
			require_once plugin_dir_path( __FILE__ ) . 'addons/kalkulate_woo_shop_two.php';
			require_once plugin_dir_path( __FILE__ ) . 'addons/kalkulate_product_list.php';
			require_once plugin_dir_path( __FILE__ ) . 'addons/kalkulate_category_product.php';
		}

	}
}
add_action('init', 'kalkulate_loader', 30 );



function kalkulate_add_tocart_button(){
if(KALKULATE_WOOCOMMERCE_PLUGIN_ACTIVED_FOR_VC){
	global $product;
	if ( $product ) {
		$defaults = array(
			'quantity' => 1,
			'class' => implode( ' ', array_filter( array(
				'',
				'product_type_' . $product->get_type(),
				$product->is_purchasable() && $product->is_in_stock() ? 'kalkulate_add_tocart_button' : '',
				$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart':''
				) ) )
			);
		extract($defaults);
		return sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s add_to_cart_button"> '.esc_html__( '+ Add to cart', 'kalkulat' ).'</a>',
			esc_url( $product->add_to_cart_url() ),
			esc_attr( isset( $quantity ) ? $quantity : 1 ),
			esc_attr( $product->get_id() ),
			esc_attr( $product->get_sku() ),
			esc_attr( isset( $class ) ? $class : 'button' )
			);
	}
}
return '';
}

function kalkulate_add_tocart_button_icon(){
if(KALKULATE_WOOCOMMERCE_PLUGIN_ACTIVED_FOR_VC){
	global $product;
	if ( $product ) {
		$defaults = array(
			'quantity' => 1,
			'class' => implode( ' ', array_filter( array(
				'',
				'product_type_' . $product->get_type(),
				$product->is_purchasable() && $product->is_in_stock() ? 'kalkulate_add_tocart_button_icon' : '',
				$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart':''
				) ) )
			);
		extract($defaults);
		return sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s add_to_cart_button"> <i class="fa fa-shopping-cart"></i></a>',
			esc_url( $product->add_to_cart_url() ),
			esc_attr( isset( $quantity ) ? $quantity : 1 ),
			esc_attr( $product->get_id() ),
			esc_attr( $product->get_sku() ),
			esc_attr( isset( $class ) ? $class : 'button' )
			);
	}
}
return '';
}