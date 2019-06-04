<?php 

add_shortcode( 'kalkulate_offer_banner', function($atts, $content = null){
	extract(shortcode_atts(array(
		'section_title_alignment'	=> '',
		'title' 					=> '',
		'sub_title' 				=> '',
		'offer_content' 			=> '',
		'btn_text' 					=> '',
		'btn_link' 					=> '',

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

	$output .='<div class="offer-banner '.$alignment.'">';
        if(!empty($title)) :
        	$output .='<h2>'.$title.'</h2>';
		endif;
        if(!empty($sub_title)) :
        	$output .='<p class="sub-title">'.$sub_title.'</p>';
		endif;
		if(!empty($offer_content)) :
        	$output .='<p>'.$offer_content.'</p>';
		endif;
		if(!empty($btn_text)) :
        	$output .='<a class="kal-button kal-button-2" href="'.$btn_link.'">'.$btn_text.'</a>';
		endif;
    $output .='</div>';

	return $output;
});

// Visual Composer
if(class_exists('WPBakeryVisualComposerAbstract')){
	vc_map(array(
		'name'			=> esc_html__( 'kalkulat Offer Banner', 'kalkulat' ),
		'base'			=> 'kalkulate_offer_banner',
		'class'			=> '',
		'description'	=> esc_html__( 'Add kalkulat  Offer Banner', 'kalkulat' ),
		'category'		=> esc_html__( 'kalkulat Shortcode', 'kalkulat' ),
		'params'		=> array(
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
			array(
				'type'			=> 'textarea_safe',
				'heading'		=> esc_html__( 'Offer Content', 'kalkulat' ),
				'param_name'	=> 'offer_content',
				'value'         => ''
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Button Content', 'kalkulat' ),
				'param_name'	=> 'btn_text',
				'value'         => ''
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Button link', 'kalkulat' ),
				'param_name'	=> 'btn_link',
				'value'         => ''
			),
		)
	));
}