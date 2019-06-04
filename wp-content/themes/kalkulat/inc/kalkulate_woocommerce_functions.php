<?php
/** 
 * Woocommerce functionality
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

	/*==================================================
		Function name: kalkulate_woo_miniCart
		Return : current product cart price and product number
	*/
	
	if(!function_exists('kalkulate_woo_miniCart')){
		function kalkulate_woo_miniCart(){
			global $woocommerce;
	?>
	
		<div class="cart-showcase minicart">
			<i class="fa fa-shopping-cart" aria-hidden="true"></i>
			<?php 
				if(WC()->cart->cart_contents_count != 0) :
			?>
			<span class="cart-list-button"><?php echo esc_html( WC()->cart->cart_contents_count );?></span>
			<?php 
				endif;
			?>
		</div>
		<div class="widget_shopping_cart_content"></div>
	<?php
		}
	}
	if(!function_exists('kalkulate_woo_wishlist')){
		function kalkulate_woo_wishlist($id,$type){
			$output = '';
			if(kalkulate_PLUGIN_WOOCOMMERCE_WISHLIST_ACTIVED){
				
				global $product;
				
				$product_id = $product->get_id();
			
				$output.='<div class="yith-wcwl-add-to-wishlist add-to-wishlist-'. $id.'" data-toggle="tooltip" title="'.esc_attr($product->get_title()).'" data-added="Browse Wishlist" data-original-title="Add to Wishlist">';
					$output.='<div class="yith-wcwl-add-button add_to_faverit show" style="display:block"> ';
						$output.='<a href="'.get_site_url().'/?add_to_wishlist='. $id .'" rel="nofollow" data-product-id="'.$id.'" data-product-type="'.$product->get_type().'" class="add_to_wishlist"> ';
						$output.='<i class="icon icon-Heart"></i></a>';
						$output.='<img src="'.get_site_url().'/wp-content/plugins/yith-woocommerce-wishlist/assets/images/wpspin_light.gif" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden">';
					$output.='</div>';
					$output.='<div class="yith-wcwl-wishlistaddedbrowse add_to_faverit hide" style="display:none;"> ';
						$output.='<a href="'.get_site_url().'/wishlist/view/" rel="nofollow">';
						$output.='<i class="icon icon-Heart"></i> </a>';
					$output.='</div>';
					$output.='<div class="yith-wcwl-wishlistexistsbrowse add_to_faverit hide" style="display:none"> ';
					$output.='<a href="'.get_site_url().'/wishlist/view/" rel="nofollow"> ';
						$output.='<i class="icon icon-Heart"></i></a>';
					$output.='</div>';
				$output.='</div>';
			}
			return $output;
		}
	}

	if (!function_exists('kalkulate_lite_header_add_to_cart_fragment')) {
		function kalkulate_lite_header_add_to_cart_fragment( $fragments ) {
			ob_start();
			?>
			<div class="cart-showcase minicart">

				<i class="icon-icomoon-shopping-cart"></i>
				<?php
					if(WC()->cart->cart_contents_count != 0) :
				?>
				<span class="cart-list-button"><?php echo esc_html( WC()->cart->cart_contents_count );?></span>
				<?php 
					endif;
				?>
			</div>
	<?php
			
			$fragments['.minicart'] = ob_get_clean();
			
			return $fragments;
		}
	}
	add_filter( 'woocommerce_add_to_cart_fragments', 'kalkulate_lite_header_add_to_cart_fragment' );

	function kalkulate_remove_breadethumb_class($array){
		$array['wrap_before'] = '<ol class="breadcrumb">';
		$array['wrap_after'] ='</ol>';
		$array['delimiter'] ='';

		return $array;
	}
	add_filter("woocommerce_breadcrumb_defaults","kalkulate_remove_breadethumb_class");


	if(!function_exists('kalkulate_price_compare')):
	function kalkulate_price_compare($id,$type){
		$output ='';
		if(kalkulate_PLUGIN_WOOCOMMERCE_COMPARE_ACTIVED){			
			$output.='<a href="'.get_site_url().'?action=yith-woocompare-add-product&amp;id='.$id.'" class="compare button popup" data-product_id="'.$id.'" rel="nofollow"><i class="icon icon-Restart"></i></a>';
		}
		return $output;
	}
	endif;
	add_filter("woocommerce_loop_add_to_cart_link","kalkulate_group");
	
	function kalkulate_group($class){
		if(strpos($class, 'add_to_cart_button') === false){
			$class = str_replace('button ', ' button add_to_cart_button ', $class);
		}
		return $class;
	}
	
	function kalkulate_remove_hook(){
		remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
	}
	add_action('init','kalkulate_remove_hook');




//Change the add to cart text on product archives
add_filter( 'woocommerce_product_add_to_cart_text', 'woo_archive_custom_cart_button_text' ); // 2.1 +

function woo_archive_custom_cart_button_text() {
    return __( '+ ADD TO CART', 'kalkulat' );
}