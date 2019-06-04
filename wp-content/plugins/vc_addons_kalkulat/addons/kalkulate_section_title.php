<?php 

add_shortcode( 'kalkulate_section_title', function($atts, $content = null){
	extract(shortcode_atts(array(
		'section_title_style'		=> '',
		'section_title_alignment'	=> '',
		'title' 					=> '',
		'sub_title' 				=> '',
		'animation'					=> '',
		'animation_style'			=> '',
		'animation_duration'		=> '',
		'animation_delay'			=> '',

	), $atts));

	$output = '';

	//Section Title Alignment
	$alignment = '';
	if($section_title_alignment == 2){
		$alignment .='text-center';
	}
	else if ($section_title_alignment == 3){
		$alignment .='text-right';
	}
	else if ($section_title_alignment == 4){
		$alignment .='text-right';
	}
	else{
		$alignment .='text-left';
	}
	//Section Title animation
	$is_animation = (($animation == 1) ? ' wow '.$animation_style : '');
	$animation_styles = (($animation == 1) ? 'data-wow-duration="'.$animation_duration.'s" data-wow-delay="'.$animation_delay.'s"' : '');

	$output .='<div class="all-header-area '.$is_animation.'" '.$animation_styles.'>';
				if($section_title_style == 2){
					$output .='<div class="section-heading '.$alignment.'">';
		                if(!empty($title)) :
		                	$output .='<h2 class="base-color">'.$title.'</h2>';
						endif;
		                if(!empty($sub_title)) :
		                	$output .='<p class="large-pra">'.$sub_title.'</p>';
						endif;
		            $output .='</div>';
				}
				else if($section_title_style == 3){
					$output .='<div class="section-heading section-heading-3 '.$alignment.'">';
		                if(!empty($title)) :
		                	$output .='<h2>'.$title.'</h2>';
						endif;
		                if(!empty($sub_title)) :
		                	$output .='<p>'.$sub_title.'</p>';
						endif;
		            $output .='</div>';
				}
				else if($section_title_style == 4){
					$output .='<div class="section-heading '.$alignment.'">';
		                if(!empty($sub_title)) :
		                	$output .='<span>'.$sub_title.'</span>';
						endif;
		                if(!empty($title)) :
		                	$output .='<h2>'.$title.'</h2>';
						endif;
		            $output .='</div>';
				}
				else if($section_title_style == 5){
					$output .='<div class="section-heading section-heading-five '.$alignment.'">';
		                if(!empty($sub_title)) :
		                	$output .='<span>'.$sub_title.'</span>';
						endif;
		                if(!empty($title)) :
		                	$output .='<h2>'.$title.'</h2>';
						endif;
		            $output .='</div>';
				}
				else if($section_title_style == 6){
					$output .='<div class="section-heading section-heading-six '.$alignment.'">';
		                if(!empty($sub_title)) :
		                	$output .='<span>'.$sub_title.'</span>';
						endif;
		                if(!empty($title)) :
		                	$output .='<h2>'.$title.'</h2>';
						endif;
		            $output .='</div>';
				}
				else{
					$output .='<div class="section-heading '.$alignment.'">';
		                if(!empty($title)) :
		                	$output .='<h2>'.$title.'</h2>';
						endif;
		                if(!empty($sub_title)) :
		                	$output .='<span>'.$sub_title.'</span>';
						endif;
		            $output .='</div>';
				}
    		$output .='</div>';

	return $output;
});

// Visual Composer
if(class_exists('WPBakeryVisualComposerAbstract')){
	vc_map(array(
		'name'			=> esc_html__( 'kalkulat Section Titles', 'kalkulat' ),
		'base'			=> 'kalkulate_section_title',
		'class'			=> '',
		'description'	=> esc_html__( 'Add kalkulat Section Title', 'kalkulat' ),
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
				'heading'	=> esc_html__( 'Section Title Style', 'kalkulat' ),
				'param_name' => 'section_title_style',
				'value'		 => array(
					esc_html__( 'Style One', 'kalkulat' ) 		=> 1,
					esc_html__( 'Style Two', 'kalkulat' ) 		=> 2,
					esc_html__( 'Style Three', 'kalkulat' ) 	=> 3,
					esc_html__( 'Style Four', 'kalkulat' ) 		=> 4,
					esc_html__( 'Style Five', 'kalkulat' ) 		=> 5,
					esc_html__( 'Style Six', 'kalkulat' ) 		=> 6,
				)
			),
			array(
				'type'		=> 'dropdown',
				'heading'	=> esc_html__( 'Alignment', 'kalkulat' ),
				'param_name' => 'section_title_alignment',
				'value'		 => array(
					esc_html__( 'Left', 'kalkulat' ) 	=> 1,
					esc_html__( 'Center', 'kalkulat' ) 	=> 2,
					esc_html__( 'Right', 'kalkulat' ) 	=> 3,
				)
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Title', 'kalkulat' ),
				'param_name'	=> 'title',
				'value'         => ''
			),
			array(
				'type'			=> 'textarea_safe',
				'heading'		=> esc_html__( 'Sub Title', 'kalkulat' ),
				'param_name'	=> 'sub_title',
				'value'         => ''
			),
		)
	));
}