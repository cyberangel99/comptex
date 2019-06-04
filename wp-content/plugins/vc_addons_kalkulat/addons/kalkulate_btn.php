<?php 

add_shortcode( 'kalkulate_btn', function($atts, $content = null){
	extract(shortcode_atts(array(
		'kalkulate_btn_style'		=> '',
		'kalkulate_btn_alignment'	=> '',
		'btn_text' 					=> '',
		'btn_url' 					=> '',
		'animation'					=> '',
		'animation_style'			=> '',
		'animation_duration'		=> '',
		'animation_delay'			=> '',

	), $atts));

	$output = '';

	//Section Title Alignment
	$alignment = '';
	if($kalkulate_btn_alignment == 2){
		$alignment .='text-center';
	}
	else if ($kalkulate_btn_alignment == 3){
		$alignment .='text-right';
	}
	else if ($kalkulate_btn_alignment == 4){
		$alignment .='text-right';
	}
	else{
		$alignment .='text-left';
	}
	//Section Title animation
	$is_animation = (($animation == 1) ? ' wow '.$animation_style : '');
	$animation_styles = (($animation == 1) ? 'data-wow-duration="'.$animation_duration.'s" data-wow-delay="'.$animation_delay.'s"' : '');

	$output .='<div class="all-header-area '.$is_animation.'" '.$animation_styles.'>';
				if($kalkulate_btn_style == 2){
					$output .='<div class="section-btn '.$alignment.'">';
		                if(!empty($btn_text)) :
		                	$output .='<a href="'.$btn_url.'" class="kal-button">'.$btn_text.'</a>';
						endif;
		            $output .='</div>';
				}
				else{
					$output .='<div class="section-btn '.$alignment.'">';
		                if(!empty($btn_text)) :
		                	$output .='<a href="'.$btn_url.'" class="kal-button kal-button-2">'.$btn_text.'</a>';
						endif;
		            $output .='</div>';
				}
    		$output .='</div>';

	return $output;
});

// Visual Composer
if(class_exists('WPBakeryVisualComposerAbstract')){
	vc_map(array(
		'name'			=> esc_html__( 'kalkulat Btn', 'kalkulat' ),
		'base'			=> 'kalkulate_btn',
		'class'			=> '',
		'description'	=> esc_html__( 'Add kalkulat Btn', 'kalkulat' ),
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
				'type'		=> 'dropdown',
				'heading'	=> esc_html__( 'Kalkulat Btn Style', 'kalkulat' ),
				'param_name' => 'kalkulate_btn_style',
				'value'		 => array(
					esc_html__( 'Style One', 'kalkulat' ) 		=> 1,
					esc_html__( 'Style Two', 'kalkulat' ) 		=> 2,
				)
			),
			array(
				'type'		=> 'dropdown',
				'heading'	=> esc_html__( 'Alignment', 'kalkulat' ),
				'param_name' => 'kalkulate_btn_alignment',
				'value'		 => array(
					esc_html__( 'Left', 'kalkulat' ) 	=> 1,
					esc_html__( 'Center', 'kalkulat' ) 	=> 2,
					esc_html__( 'Right', 'kalkulat' ) 	=> 3,
				)
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Btn Text', 'kalkulat' ),
				'param_name'	=> 'btn_text',
				'value'         => ''
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Btn Url', 'kalkulat' ),
				'param_name'	=> 'btn_url',
				'value'         => ''
			),
		)
	));
}