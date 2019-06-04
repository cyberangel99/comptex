<?php 

add_shortcode( 'kalkulate_intro', function($atts, $content = null){
	extract(shortcode_atts(array(
		'post_grid' 			=> '',
		'post_order' 			=> '',
		'post_limit' 			=> '',
		'trim_words'			=> '',
		'animation'				=> '',
		'animation_style'		=> '',
		'animation_duration'	=> '',
		'animation_delay'		=> '',
		'link_status'			=> ''

	), $atts));

	$output = '';

	$is_animation = (($animation == 1) ? ' wow '.$animation_style : '');

	$output .='<div class="kalkulate-intro">
	            <div class="row row-eq-rs-height">';
					$order = (!empty($post_order) ? $post_order : 'DESC');
					$about_query = new WP_Query(array('post_type'=> 'about', 'order'=> $order, 'posts_per_page' => $post_limit));

					if($about_query->have_posts()) :
						$i = (($animation == 1) ? $animation_delay : '0');
						while($about_query->have_posts()) : $about_query->the_post();
							//animation-style
							$animation_style = (($animation == 1) ? 'data-wow-duration="'.$animation_duration.'s" data-wow-delay="'.$i.'s"' : '');
							$output.='<div class="'.(!empty($post_grid) ? $post_grid : 'col-md-3').' col-sm-6">
								<div class="kalkulate-single-intro '.$is_animation.'" '.$animation_style.'>
			                        <div class="text">

			                            <h3 class="intro-heading"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3>';
			                            if(!empty($trim_words)) {
						                	$output .='<p>'.wp_trim_words( get_the_content(), $trim_words, null ).'</p>';
			                            }else{
			                            	$output .='<p>'.get_the_content().'</p>';
			                            }
										
			                            
			                            // learn more button on/off
			                            if($link_status == 1){
			                            	if(!empty($trim_words)) :
							                	$output .='<a class="link-arrow" href="'.get_the_permalink().'">'.esc_html__( 'Learn More', 'kalkulat').'</a>';
											endif;
			                            }
		                            	
			                        $output .='</div>
			                    </div>
			                </div>';
			                $i = $i+ 0.3;
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
		'name'			=> esc_html__( 'kalkulat About', 'kalkulat' ),
		'base'			=> 'kalkulate_intro',
		'class'			=> '',
		'description'	=> esc_html__( 'add kalkulat About Posts', 'kalkulat' ),
		'category'		=> esc_html__( 'kalkulat Shortcode', 'kalkulat' ),
		'params'		=> array(
			array(
				'type'			=> 'dropdown',
				'heading'		=> esc_html__( 'Post Grid', 'kalkulat' ),
				'param_name'	=> 'post_grid',
				'value'			=> array( 
					'col-md-12',
					'col-md-6',
					'col-md-4',
					'col-md-3',
					'col-sm-12',
					'col-sm-6',
					'col-sm-4',
					'col-sm-3',	
				)	
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Trim Words', 'kalkulat' ),
				'param_name'	=> 'trim_words',
				'value'         => ''
			),
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
				'type'		=> 'dropdown',
				'heading'	=> esc_html__( 'Learn More Button', 'kalkulat' ),
				'param_name'=> 'link_status',
				'value'		=> array('show' => 1, 'hide' => 0)
			),
			array(
				'type'		=> 'dropdown',
				'heading'	=> esc_html__( 'Animation', 'kalkulat' ),
				'param_name'=> 'animation',
				'value'		=> array('OFF' => 0, 'ON' => 1)
			),
			array(
				'type'			=> 'animation_style',
				'heading'		=> esc_html__( 'Animation Style', 'kalkulat' ),
				'param_name'	=> 'animation_style',
				'value'			=> 'fadeInUp',
				'save_always'	=> true,
				'dependency'	=> array(
					'element'	=> 'animation',
					'value'		=> '1'
				)
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Animation Duration', 'kalkulat' ),
				'param_name'	=> 'animation_duration',
				'value'			=> '1.5',
				'save_always'	=> true,
				'dependency'	=> array(
					'element'	=> 'animation',
					'value'		=> '1'
				)
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Animation Delay', 'kalkulat' ),
				'param_name'	=> 'animation_delay',
				'value'			=> '0',
				'save_always'	=> true,
				'dependency'	=> array(
					'element'	=> 'animation',
					'value'		=> '1'
				)
			),
		)
	));
}