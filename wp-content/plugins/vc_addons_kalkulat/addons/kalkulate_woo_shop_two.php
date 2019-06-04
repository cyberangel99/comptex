<?php 
add_shortcode( 'kalkulate_shop_two', function($atts, $content = null){
	extract(shortcode_atts(array(
		'post_order' => '',
		'post_limit' => '',

	), $atts));

	$output = '';

    $output .='<div class="kalkulate-shop-vc">
        <div class="row">';
            $query = new WP_Query( array('post_type' => 'product','posts_per_page' => $post_limit, 'order' => $post_order) );
            if($query->have_posts()) :
                while($query->have_posts()) : $query->the_post();
                global $product,$post;
            $output .='<div class="col-md-3 col-sm-6 col-xs-12">
                <div class="shop-item-two">
                	<div class="thumb">
					 	<a href="'.get_the_permalink().'">
                			'.get_the_post_thumbnail( null, 'kalkulate-shop-item-two', array('class'=> 'img-responsive')).'
						</a>
            		</div>
                    <div class="shop-details-area">
                    	<div class="shop-item-icon">
		            		<div class="icons">
								<a class="image-popup-vertical-fit" href="'.get_the_post_thumbnail_url().'">
									<i class="fa fa-search"></i>
									'.get_the_post_thumbnail().'
								</a>
							</div>
							'.do_shortcode("[ti_wishlists_addtowishlist]").'';
							$output .='<div class="icons icons-two">';
				            	$output .= kalkulate_add_tocart_button_icon();
				            $output .='</div>';
		            	$output .='</div>
		            	<div class="shop-details">
	                        <a href="'.get_the_permalink().'" class="item-name">'.get_the_title().'</a>';
	                        $output .='<div class="shop-meta">	
								<div class="price">'.$product->get_price_html().'</div>';
								$asdf = $product->get_average_rating();
								for ($i=0; $i < $asdf; $i++) { 
									$output .='<i class="fa fa-star"></i>';
								}
							$output .='</div>
						</div>';
                    $output .='</div>
                </div><!--/.shop-item-->
            </div>';
                endwhile;
                wp_reset_postdata();
            endif;
        $output .='</div>
    </div>';

	return $output;
});                

// Visual Composer
if(class_exists('WPBakeryVisualComposerAbstract')){
	vc_map(array(
		'name'			=> esc_html__( 'kalkulat Shop Two', 'kalkulat' ),
		'base'			=> 'kalkulate_shop_two',
		'class'			=> '',
		'description'	=> esc_html__( 'Kalkulat Woocommerce Posts', 'kalkulat' ),
		'category'		=> esc_html__( 'kalkulat Shortcode', 'kalkulat' ),
		'params'		=> array(
			array(
				'type'			=> 'dropdown',
				'heading'		=> esc_html__( 'Post Order', 'kalkulat' ),
				'param_name'	=> 'post_order',
				'value'         => array('DESC','ASC')
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Post Limit', 'kalkulat' ),
				'param_name'	=> 'post_limit',
				'value'         => '-1',
				'save_always'   => true
			),
		)
	));
}