<?php 

add_shortcode( 'kalkulate_service', function($atts, $content = null){
	extract(shortcode_atts(array(
		'post_order' 	=> '',
		'trim_words' 	=> '',
		'post_limit' 	=> '',
		'link_status'	=> '',

	), $atts));

	$output = '';

	$output .='<div class="service-section">
				<div class="service-carousel">';
					$order = (!empty($post_order) ? $post_order : 'DESC');
					$sevice_query = new WP_Query(array('post_type'=> 'service', 'order'=> $order, 'posts_per_page' => $post_limit));
					if($sevice_query->have_posts()) : 
						while($sevice_query->have_posts()) : $sevice_query->the_post();
						$output.='<div class="service-carousel-item">
			                    <div class="service-item">';
			                    	$one = get_post_meta( get_the_ID(), '__kalkulate__service_icon', 1 );

			                    	if(!empty($one)) :
					                	$output.='<div class="icon">';
				                        	if ($one == 2) {
				                        		$output.='<img src="'.get_post_meta( get_the_ID(), '__kalkulate__services_image_class_name', true ).'">';
				                        	}else {
				                        		$output.='<i class="'.get_post_meta( get_the_ID(), '__kalkulate__services_social_icon_class_name', true ).'"></i>';
				                        	}
				                            
				                        $output.='</div>';
									endif;


			                        
			                        $output.='<div class="service-text">';
			                        	if($link_status == 1){
			                        		$output .='<h4>'.get_the_title().'</h4>';
			                        	}else {
			                        		$output .='<h4><a href="'.get_the_permalink().'">'.get_the_title().'</a></h4>';
			                        	}
			                        	if(!empty($trim_words)) {
						                	$output .='<p>'.wp_trim_words( get_the_content(), $trim_words, null ).'</p>';
			                            }else{
			                            	$output .='<p>'.get_the_content().'</p>';
			                            }
			                        $output.='</div>
			                    </div>
			                </div>';
						endwhile;
						wp_reset_postdata();
					endif;	
				$output.='</div>
			</div>';

	return $output;

});


// Visual Composer
if(class_exists('WPBakeryVisualComposerAbstract')){
	vc_map(array(
		'name'			=> esc_html__( 'kalkulat Services', 'kalkulat' ),
		'base'			=> 'kalkulate_service',
		'class'			=> '',
		'description'	=> esc_html__( 'add kalkulat service posts', 'kalkulat' ),
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
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Trim Words', 'kalkulat' ),
				'param_name'	=> 'trim_words',
				'value'         => ''
			),
			array(
				'type'		=> 'dropdown',
				'heading'	=> esc_html__( 'Title Link', 'kalkulat' ),
				'param_name'=> 'link_status',
				'value'		=> array('show' => 0, 'hide' => 1)
			),
		)
	));
}