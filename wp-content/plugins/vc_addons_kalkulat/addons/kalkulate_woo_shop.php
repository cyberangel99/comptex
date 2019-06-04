<?php 
add_shortcode( 'kalkulate_shop', function($atts, $content = null){
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
            $output .='<div class="col-md-4 col-sm-6 col-xs-12">
                <div class="shop-item">
                    <a href="'.get_the_permalink().'">
                        <div class="image">
                            <img src="'.get_the_post_thumbnail_url().'" alt="'.esc_attr__( 'product', 'kalkulat' ).'" class="img-responsive">
                        </div>
                    </a>
                    <div class="text">
                        <span class="item-name">'.get_the_title().'</span>';
							
                        $output .='<div class="shop-meta">	
							<div class="price">'.$product->get_price_html().'</div>
						</div>';
						$output .= kalkulate_add_tocart_button();
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
		'name'			=> esc_html__( 'kalkulat Shop', 'kalkulat' ),
		'base'			=> 'kalkulate_shop',
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