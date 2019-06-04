<?php 

add_shortcode( 'kalkulate_call_to_action', function($atts, $content = null){
	extract(shortcode_atts(array(
		'call_to_action_btn' 		=> '',
    	'call_to_action_uri' 		=> '',
		'call_to_action_title' 		=> '',
		'call_to_action_sub_title'  => '',

	), $atts));

	$output = '';

	$output .='<div class="get-started-area">
            <div class="row">
                <div class="col-md-8">
                    <div class="get-started-text">';
                    	if(!empty($call_to_action_title)) :
		                	$output .='<h3>'.$call_to_action_title.'</h3>';
						endif;
						if(!empty($call_to_action_sub_title)) :
		                	$output .='<span>'.$call_to_action_sub_title.'</span>';
						endif;
                    $output .='</div>
                </div>';
                if(!empty($call_to_action_btn)) :
                	$output .='<div class="col-md-4">
	                    <div class="get-started-button text-right">
	                        <a href="'.$call_to_action_uri.'" class="kal-button btn-large">'.$call_to_action_btn.'</a>
	                    </div>
	                </div>';
				endif;
            $output .='</div>
        </div>';

	return $output;

});


// Visual Composer
if(class_exists('WPBakeryVisualComposerAbstract')){
	vc_map(array(
		'name'			=> esc_html__( 'Kalkulat Call To Action', 'kalkulat' ),
		'base'			=> 'kalkulate_call_to_action',
		'class'			=> '',
		'description'	=> esc_html__( 'add call to action', 'kalkulat' ),
		'category'		=> esc_html__( 'kalkulat Shortcode', 'kalkulat' ),
		'params'		=> array(
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'btn Text', 'kalkulat' ),
				'param_name'	=> 'call_to_action_btn',
				'value'         => ''
			),
    	array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Btn URL', 'kalkulat' ),
				'param_name'	=> 'call_to_action_uri',
				'value'         => ''
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Title', 'kalkulat' ),
				'param_name'	=> 'call_to_action_title',
				'value'         => ''
			),
			array(
				'type'			=> 'textarea',
				'heading'		=> esc_html__( 'Sub Title', 'kalkulat' ),
				'param_name'	=> 'call_to_action_sub_title',
				'value'         => ''
			),
		)
	));
}