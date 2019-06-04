<?php
add_shortcode( 'kalkulate_fun_fact', function($atts, $content = null){
	extract(shortcode_atts( array(
		'post_grid' 			=> '',
		'counters'				=> '',
		'counters_icon'			=> '',
		'counter_title'         => '',
		'counter_content'       => '',
		'animation'				=> '',
		'animation_style'		=> '',
		'animation_duration'	=> '',
		'animation_delay'		=> '',
		'icon_or_image'			=> '',
		'default_icon'			=> '',
		'icons_class'			=> '',
		'counter_image'			=> '',

		

	),  $atts));


	$output = '';

	//animation style
	$is_animation = (($animation == 1) ? ' wow '.$animation_style : '');

	$output .='<div class="counter-area fun-fact-section">
	            <div class="all-counter">
	                <div class="row">';
	                $counters = vc_param_group_parse_atts($atts['counters']);
					$is_array = (is_array($counters) ? true : false);
					if(!empty($counters) && $is_array){
						$i = (($animation == 1) ? $animation_delay : '0');
						foreach($counters as $counter){
							//animation-style
							$animation_style = (($animation == 1) ? 'data-wow-duration="'.$animation_duration.'s" data-wow-delay="'.$i.'s"' : '');

		                    $output .='<div class="'.(!empty($post_grid) ? $post_grid : 'col-md-3').' col-sm-6 text-center">
		                        <div class="single-counter '.$is_animation.'" '.$animation_style.'>';

			                        $icon_thumb_url  = (isset($counter['counter_image']) ? wp_get_attachment_image_src($counter['counter_image'], 'full', array('class'=> 'img-responsive') ) : '');

			                        if(!empty($counter['default_icon']) || !empty($counter['icons_class']) || !empty($counter['counter_image'])) :
		                        		if ($counter['icon_or_image'] == 1) {
		                        			$output .='<div class="icon">
				                                <i class="'.$counter['icons_class'].'"></i>
				                            </div>';
		                        		}
		                        		elseif ($counter['icon_or_image'] == 2) {
		                        			$output .='<div class="icon">
				                                <img src="'. $icon_thumb_url[0].'">
				                            </div>';
		                        		}
		                        		else {
		                        			$output .='<div class="icon">
				                                <i class="'.$counter['default_icon'].'"></i>
				                            </div>';
		                        		}
		                        	endif;


		                            $output .='<div class="text">
		                                <div class="counters">
		                                    '.(isset($counter['counter_title']) ? $counter['counter_title'] : '').'
		                                </div>
		                                <span>'.(isset($counter['counter_content']) ? $counter['counter_content'] : '').'</span>
		                            </div>
		                        </div>
		                    </div>';
		                    $i = $i+ 0.2;
		                }
					}
	                $output .='</div>
	            </div>
	    </div>';
	return $output;
});



// Visual Composer
if(class_exists('WPBakeryVisualComposerAbstract')){
	vc_map(array(
		'name'			=> esc_html__( 'kalkulat fun fact', 'kalkulat' ),
		'base'			=> 'kalkulate_fun_fact',
		'class'			=> '',
		'description'	=> esc_html__( 'add fun fact', 'kalkulat' ),
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
			array(
				'type'			=> 'param_group',
				'heading'		=> esc_html__( 'counters Text', 'kalkulat' ),
				'param_name'	=> 'counters',
				'params'		=> array(
					array(
						'type'		=> 'dropdown',
						'heading'	=> esc_html__( 'Choose Icon Type', 'kalkulat' ),
						'param_name'=> 'icon_or_image',
						'value'		=> array(
							esc_html__( 'Icon Picker', 'kalkulat' )  		=> 0,
							esc_html__( 'Icon Class Name', 'kalkulat' )    	=> 1,
							esc_html__( 'Icon Image', 'kalkulat' ) 			=> 2,
						)
					),
					array(
						'type'			=> 'iconpicker',
						'heading'		=> esc_html__( 'Icon Choose', 'kalkulat' ),
						'param_name'	=> 'default_icon',
						'save_always'	=> true,
						'dependency'	=> array(
							'element'	=> 'icon_or_image',
							'value'		=> '0'
						)
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__( 'Icon Class Exp: fa fa-facebook or icon-icomoon-light-bulb', 'kalkulat' ),
						'param_name'	=> 'icons_class',
						'save_always'	=> true,
						'dependency'	=> array(
							'element'	=> 'icon_or_image',
							'value'		=> '1'
						)
					),
					array(
						'type'			=> 'attach_image',
						'heading'		=> esc_html__( 'Icon Image', 'kalkulat' ),
						'param_name'	=> 'counter_image',
						'value'			=> '0',
						'save_always'	=> true,
						'dependency'	=> array(
							'element'	=> 'icon_or_image',
							'value'		=> '2'
						)
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__( 'Add Title', 'kalkulat' ),
						'param_name'	=> 'counter_title',
						'value'			=> ''
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__( 'Add Content', 'kalkulat' ),
						'param_name'	=> 'counter_content',
						'value'			=> ''
					),
					
				),
			)
		)
	));
}


