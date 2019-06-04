<?php 

add_shortcode( 'kalkulate_progress_bar', function($atts, $content = null){
	extract(shortcode_atts(array(
		'progress_style'		=> '',
		'progress_bar' 			=> '',
		'title' 				=> '',
		'counting'  			=> '',
		'animation'				=> '',
		'animation_style'		=> '',
		'animation_duration'	=> '',
		'animation_delay'		=> '',

	), $atts));

	$output = '';

	//animation style
	$is_animation = (($animation == 1) ? ' wow '.$animation_style : '');
	$animation_styles = (($animation == 1) ? 'data-wow-duration="'.$animation_duration.'s" data-wow-delay="'.$animation_delay.'s"' : '');
		if($progress_style == 1){
				$output .='<div class="progress-section progress-section2 style-two '.$is_animation.'" '.$animation_styles.'>
                <div class="all-progress progress-running">';
                	$progress_bar = vc_param_group_parse_atts($atts['progress_bar']);
					$is_array = (is_array($progress_bar) ? true : false);
					if(!empty($progress_bar) && $is_array){
						$i = 1;
						foreach($progress_bar as $progress){
                    		$output .='<div class="progress-item">
		                        <span class="progress-heading">'.(isset($progress['title']) ? $progress['title'] : '').'</span>
		                        <div class="progress-bg text-right">
		                            <div id="progress_'.$i.'" class="progress-rate" data-value="'.(isset($progress['counting']) ? $progress['counting'] : '').'">
		                            
		                            </div>
		                            <span class="progress_number">
		                            	<span class="counter">'.(isset($progress['counting']) ? $progress['counting'] : '').'</span>
		                            	%
		                            </span>
		                        </div>
		                    </div>';
		                    $i++;
		                }
		            }
                $output .='</div>
            </div>';
        } else {
        	$output .='<div class="progress-section '.$is_animation.'" '.$animation_styles.'>
                <div class="all-progress progress-running">';
                	$progress_bar = vc_param_group_parse_atts($atts['progress_bar']);
					$is_array = (is_array($progress_bar) ? true : false);
					if(!empty($progress_bar) && $is_array){
						$i = 1;
						foreach($progress_bar as $progress){
                    		$output .='<div class="progress-item">
		                        <span class="progress-heading">'.(isset($progress['title']) ? $progress['title'] : '').'</span>
		                        <div class="progress-bg text-right">
		                            <div id="progress_'.$i.'" class="progress-rate" data-value="'.(isset($progress['counting']) ? $progress['counting'] : '').'">
		                            </div>
		                        </div>
		                    </div>';
		                    $i++;
		                }
		            }
                $output .='</div>
            </div>';
        }
			

	return $output;

});

// Visual Composer
if(class_exists('WPBakeryVisualComposerAbstract')){
	vc_map(array(
		'name'			=> esc_html__( 'kalkulat Progress Bar', 'kalkulat' ),
		'base'			=> 'kalkulate_progress_bar',
		'class'			=> '',
		'description'	=> esc_html__( 'add multiple progress bar', 'kalkulat' ),
		'category'		=> esc_html__( 'kalkulat Shortcode', 'kalkulat' ),
		'params'		=> array(
			array(
				'type'		=> 'dropdown',
				'heading'	=> esc_html__( 'Progress Style', 'kalkulat' ),
				'param_name'=> 'progress_style',
				'value'		=> array(
					esc_html__( 'Default Style', 'kalkulat' ) 	=> 0, 
					esc_html__( 'Style Two', 'kalkulat' ) 		=> 1,
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
				'heading'		=> esc_html__( 'progress Text', 'kalkulat' ),
				'param_name'	=> 'progress_bar',
				'params'		=> array(
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__( 'Title', 'kalkulat' ),
						'param_name'	=> 'title',
						'value'         => ''
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__( 'Count Value', 'kalkulat' ),
						'param_name'	=> 'counting',
						'value'         => ''
					),
					
				),

			)
		)
	));
}