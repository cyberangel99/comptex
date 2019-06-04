<?php 
add_shortcode( 'kalkulate_category_product', function($atts, $content = null){
	extract(shortcode_atts(array(
		'product_cat_id' 	 => '',
		'id' 	 			 => '',

	), $atts));

	$output = '';

	$output .='<div class="kalkulate-shop-vc">
		<div class="shop-category-product">';
	        $thumbnail_id = get_term_meta( $product_cat_id, 'thumbnail_id', true );
	    	$thumb = wp_get_attachment_image_src($thumbnail_id, 'full', array('class'=> 'img-responsive') );
	    	$output.='<div class="thumb">
				<a href="'.esc_url(get_term_link(intval($product_cat_id),'product_cat')).'">
	    			<img src="'.$thumb[0].'" alt="'.esc_attr('category', 'kalkulat').'"/>
				</a>
	    	</div>';

	        /**
		  	 ** product Cat name
		   	**/
	        $product_cat_term = get_terms( array(
			    'taxonomy' => 'product_cat',
			    'hide_empty' => false,
			   ) );

			   $single_product_name = '';
			   $Region_names = wp_list_pluck($product_cat_term, 'name', 'term_taxonomy_id');
			   foreach($Region_names as $key => $value){
			    if($key == $product_cat_id){
			     $single_product_name = $value;
			     break;
			    }
			}
			$output.='<a class="title" href="'.esc_url(get_term_link(intval($product_cat_id),'product_cat')).'">'.$single_product_name.'</a>';

	    $output .='</div>
    </div>';

   

	return $output;
});                

// Visual Composer
if(class_exists('WPBakeryVisualComposerAbstract')){
	vc_map(array(
		'name'			=> esc_html__( 'kalkulat Category Product', 'kalkulat' ),
		'base'			=> 'kalkulate_category_product',
		'class'			=> '',
		'description'	=> esc_html__( 'Kalkulat Woocommerce Posts', 'kalkulat' ),
		'category'		=> esc_html__( 'kalkulat Shortcode', 'kalkulat' ),
		'params'		=> array(
			array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Choose Category', 'kalkulat' ),
                'param_name'    => 'product_cat_id',
                'value'         => get_all_product_cat_id(),   
            ),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__( 'Id', 'kalkulat' ),
                'param_name'    => 'id',
                'value'         => ''
            )
		)
	));
}