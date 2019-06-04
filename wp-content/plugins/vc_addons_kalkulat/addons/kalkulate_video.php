<?php 

add_shortcode( 'kalkulate_video', function($atts, $content = null){
	extract(shortcode_atts(array(
		'video_thumb'			=> '',
		'video_url' 			=> '',
		'animation'				=> '',
		'animation_style'		=> '',
		'animation_duration'	=> '',
		'animation_delay'		=> '',
		'id' 					=> '',

	), $atts));

	$output = '';

	//animation style
	$is_animation = (($animation == 1) ? ' wow '.$animation_style : '');
	$animation_styles = (($animation == 1) ? 'data-wow-duration="'.$animation_duration.'s" data-wow-delay="'.$animation_delay.'s"' : '');

	$output .='<div class="why-choose-us-two-section">
	            <div class="image pr '.$is_animation.'" '.$animation_styles.'>';

	            	$video_thumb_url  = wp_get_attachment_image_src($video_thumb, 'full', array('class'=> 'img-responsive') );

	                $output .='<img src="'.$video_thumb_url[0].'" alt="'.esc_attr('gental man', 'kalkulat').'">
	                <div class="popup-play white-bg">
	                    <a class="play-icon wow animated pulse" href="'.$video_url.'"><i class="fa fa-play"></i></a>
	                </div>
	            </div>
		    </div>';

	return $output;

});


// Visual Composer
if(class_exists('WPBakeryVisualComposerAbstract')){
	vc_map(array(
		'name'			=> esc_html__( 'kalkulat Video', 'kalkulat' ),
		'base'			=> 'kalkulate_video',
		'class'			=> '',
		'description'	=> esc_html__( 'Add popup video player', 'kalkulat' ),
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
				'type'			=> 'attach_image',
				'heading'		=> esc_html__( 'Add Video Thumbnail', 'kalkulat' ),
				'param_name'	=> 'video_thumb',
				'value'         => ''
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Add Video Url', 'kalkulat' ),
				'param_name'	=> 'video_url',
				'value'         => ''
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Add Id', 'kalkulat' ),
				'param_name'	=> 'id',
				'value'         => ''
			),
		)
	));
}