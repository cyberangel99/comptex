<?php
add_shortcode( 'kalkulate_feature', function($atts, $content = null){
	extract(shortcode_atts( array(
		'features'				=> '',
		'features_icon'			=> '',
		'feature_title'         => '',
		'feature_content'       => '',
		'animation'				=> '',
		'animation_style'		=> '',
		'animation_duration'	=> '',
		'animation_delay'		=> '',

		'icon_or_image'			=> '',
		'default_icon'			=> '',
		'icons_class'			=> '',
		'feature_image'			=> '',

		

	),  $atts));


	$output = '';

	//animation style
	$is_animation = (($animation == 1) ? ' wow '.$animation_style : '');

	$output .='<div class="what-wedo-section">
    	<div class="what-wedo-image-verticle">
            <div class="row match-height-active">';
	                $features = vc_param_group_parse_atts($atts['features']);
					$is_array = (is_array($features) ? true : false);
					if(!empty($features) && $is_array){
						$i = (($animation == 1) ? $animation_delay : '0');
						$j = 1;
						foreach($features as $feature){
							//animation-style
							$animation_style = (($animation == 1) ? 'data-wow-duration="'.$animation_duration.'s" data-wow-delay="'.$i.'s"' : '');

		                    $output .='<div class="col-sm-6">
	                            <div class="we-do-item '.$is_animation.'" '.$animation_style.'>';

			                        $icon_thumb_url  = (isset($feature['feature_image']) ? wp_get_attachment_image_src($feature['feature_image'], 'full', array('class'=> 'img-responsive') ) : '');
			                        
			                        if(!empty($counter['default_icon']) || !empty($counter['icons_class']) || !empty($counter['feature_image'])) {

		                        		if ($feature['icon_or_image'] == 1) {
		                        			$output .='<div class="number base-color">
				                                <i class="'.$feature['default_icon'].'"></i>
				                            </div>';
		                        		}
		                        		if ($feature['icon_or_image'] == 2) {
		                        			$output .='<div class="number base-color">
				                                <i class="'.$feature['icons_class'].'"></i>
				                            </div>';
		                        		}
		                        		elseif ($feature['icon_or_image'] == 3) {
		                        			$output .='<div class="number base-color">
				                                <img src="'. $icon_thumb_url[0].'">
				                            </div>';
		                        		}
		                        	}
	                        		else {
	                        			$output .='<div class="number base-color">
			                                0'.$j.'
			                            </div>';
	                        		}

		                        	
	                        		

		                            $output .='<div class="text">
	                                    <h4><a href="'.get_the_permalink().'">'.(isset($feature['feature_title']) ? $feature['feature_title'] : '').'</a></h4>
	                                    <p>'.(isset($feature['feature_content']) ? $feature['feature_content'] : '').'</p>
	                                </div>
		                        </div>
		                    </div>';
		                    $i = $i+ 0.2;
		                    $j++;
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
		'name'			=> esc_html__( 'kalkulat feature', 'kalkulat' ),
		'base'			=> 'kalkulate_feature',
		'class'			=> '',
		'description'	=> esc_html__( 'Add multiple feature', 'kalkulat' ),
		'category'		=> esc_html__( 'kalkulat Shortcode', 'kalkulat' ),
		'params'		=> array(
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
				'heading'		=> esc_html__( 'features Text', 'kalkulat' ),
				'param_name'	=> 'features',
				'params'		=> array(
					array(
						'type'		=> 'dropdown',
						'heading'	=> esc_html__( 'Choose Icon Type', 'kalkulat' ),
						'param_name'=> 'icon_or_image',
						'value'		=> array(
							esc_html__( 'Icon Picker', 'kalkulat' ) 		=> 1,
							esc_html__( 'Icon Class Name', 'kalkulat' )    	=> 2,
							esc_html__( 'Icon Image', 'kalkulat' ) 			=> 3,
						)
					),
					array(
						'type'			=> 'iconpicker',
						'heading'		=> esc_html__( 'Icon Choose', 'kalkulat' ),
						'param_name'	=> 'default_icon',
						'save_always'	=> true,
						'dependency'	=> array(
							'element'	=> 'icon_or_image',
							'value'		=> '1'
						)
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__( 'Icon Class Exp: fa fa-facebook or icon-icomoon-light-bulb', 'kalkulat' ),
						'param_name'	=> 'icons_class',
						'save_always'	=> true,
						'dependency'	=> array(
							'element'	=> 'icon_or_image',
							'value'		=> '2'
						)
					),
					array(
						'type'			=> 'attach_image',
						'heading'		=> esc_html__( 'Icon Image', 'kalkulat' ),
						'param_name'	=> 'feature_image',
						'save_always'	=> true,
						'dependency'	=> array(
							'element'	=> 'icon_or_image',
							'value'		=> '3'
						)
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__( 'Add Title', 'kalkulat' ),
						'param_name'	=> 'feature_title',
						'value'			=> ''
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__( 'Add Content', 'kalkulat' ),
						'param_name'	=> 'feature_content',
						'value'			=> ''
					),
					
				),
			)
		)
	));
}


