<?php
add_shortcode( 'kalkulate_testimonial', function($atts, $content = null){
	extract(shortcode_atts( array(
		'post_order'		=> '',
		'post_limit'		=> '',
		'trim_words'		=> '',
		'id'				=> ''
	),  $atts));


	$output = '';	

	$output .='<div class="testimonial-area">
                <div class="testimonial-carousel owl-carousel owl-theme">';
                $order = (($post_order == 1) ? 'ASC' : 'DESC');
					$testimonial_query = new WP_Query(array('post_type' => 'testimonial', 'order' => $order, 'posts_per_page' => $post_limit));

					if($testimonial_query->have_posts()){
						while($testimonial_query->have_posts()) : $testimonial_query->the_post();
                    		$output .='<div class="single-testimonial-quote">';
                    			$one = get_post_meta( get_the_ID(), '__kalkulate__testimonial_icon', 1 );

                				if ($one == 2) {
                    				$output .='<div class="testimonial-quote-icon base-color text-center">
					                    <img src="'.get_post_meta( get_the_ID(), '__kalkulate__testimonial_image', true ).'">
					                </div>';
                    			}else {
                    				$output .='<div class="testimonial-quote-icon base-color text-center">
					                    <i class="fa '.get_post_meta( get_the_ID(), '__kalkulate__testimonial_icons', true).'"></i>
					                </div>';
                    			}
                    			if(!empty($trim_words)) {
				                	$output .='<p>'.wp_trim_words( get_the_content(), $trim_words, null ).'</p>';
	                            }else{
	                            	$output .='<p>'.get_the_content().'</p>';
	                            }
                    			$output .='<div class="author">
	                                <h4>'.get_the_title().'</h4>
	                                <span>'.get_post_meta( get_the_ID(), '__kalkulate__testimonial_designation', true ).'</span>
	                            </div>
	                        </div>';
                    	endwhile;
					    wp_reset_postdata();
					}
                $output .='</div>
            </div>';

	return $output;
});

// Visual Composer
if(class_exists('WPBakeryVisualComposerAbstract')){
	vc_map(array(
		'name'			=> esc_html__( 'kalkulat Testimonial', 'kalkulat' ),
		'base'			=> 'kalkulate_testimonial',
		'class'			=> '',
		'description'	=> esc_html__( 'add your client multiple reviews', 'kalkulat' ),
		'category'		=> esc_html__( 'kalkulat Shortcode', 'kalkulat' ),
		'params'		=> array(
			array(
				'type'			=> 'dropdown',
				'heading'		=> esc_html__( 'Post Order', 'kalkulat' ),
				'param_name'	=> 'post_order',
				'value'			=> array('DESC' => '0', 'ASC' => '1'),	
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Post Limit', 'kalkulat' ),
				'param_name'	=> 'post_limit',
				'value'			=> '-1',
				'save_always'	=> true	
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Trim Words', 'kalkulat' ),
				'param_name'	=> 'trim_words',
				'value'         => ''
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'ID', 'kalkulat' ),
				'param_name'	=> 'id',
				'value'			=> '',	
			)
		)
	));
}
