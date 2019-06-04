<?php 

add_shortcode( 'kalkulate_contact_info', function($atts, $content = null){
	extract(shortcode_atts(array(
		'contact_title'			=> '',
		'contact_main_title'	=> '',
		'contact_sub_title'		=> '',
		'contact_address_title' => '',
		'contact_address' 		=> '',
		'additional_info'		=> '',
		'add_title'				=> '',
		'add_info'				=> '',


	), $atts));

	$output = '';
	

	$output .='<div class="kalkulate-map-location-informatrion">
                <div class="kalkulate">';
                    if(!empty($contact_title)) :
	                	$output .='<span class="small-text">'.$contact_title.'</span>';
					endif;
                    $output .='<div class="heading">';
                        if(!empty($contact_main_title)) :
		                	$output .='<h4>'.$contact_main_title.'</h4>';
						endif;
						if(!empty($contact_sub_title)) :
		                	$output .='<span class="small-text">'.$contact_sub_title.'</span>';
						endif;
                    $output .='</div>
                    <div class="property">';
                        if(!empty($contact_address_title)) :
		                	$output .='<h6>'.$contact_address_title.'</h6>';
						endif;
						if(!empty($contact_address)) :
		                	$output .='<span class="small-text">'.$contact_address.'</span>';
						endif;
                    $output .='</div>
                    <ul class="direct-contact">';
                        
                        $additional_info = vc_param_group_parse_atts($atts['additional_info']);
						$is_array = (is_array($additional_info) ? true : false);
						if(!empty($additional_info) && $is_array){
							foreach($additional_info as $add_title){

								$output .='<li><strong>'.(isset($add_title['add_title']) ? $add_title['add_title'] : '').'</strong>'.(isset($add_title['add_info']) ? $add_title['add_info'] : '').'</li>';
							}
						}
                    $output .='</ul>
                </div>
            </div>';

	return $output;

});


// Visual Composer
if(class_exists('WPBakeryVisualComposerAbstract')){
	vc_map(array(
		'name'			=> esc_html__( 'kalkulat Contact Info', 'kalkulat' ),
		'base'			=> 'kalkulate_contact_info',
		'class'			=> '',
		'description'	=> esc_html__( 'Add kalkulat Contact Info', 'kalkulat' ),
		'category'		=> esc_html__( 'kalkulat Shortcode', 'kalkulat' ),
		'params'		=> array(
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Contact Title', 'kalkulat' ),
				'param_name'	=> 'contact_title',
				'value'         => ''
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Contact Title', 'kalkulat' ),
				'param_name'	=> 'contact_main_title',
				'value'         => ''
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Sub Title', 'kalkulat' ),
				'param_name'	=> 'contact_sub_title',
				'value'         => ''
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Address Title', 'kalkulat' ),
				'param_name'	=> 'contact_address_title',
				'value'         => ''
			),
			array(
				'type'			=> 'textarea',
				'heading'		=> esc_html__( 'Address', 'kalkulat' ),
				'param_name'	=> 'contact_address',
				'value'         => ''
			),
			array(
				'type'			=> 'param_group',
				'heading'		=> esc_html__( 'Add Additional Info', 'kalkulat' ),
				'param_name'	=> 'additional_info',
				'params'		=> array(
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__( 'Title', 'kalkulat' ),
						'param_name'	=> 'add_title',
						'value'			=> ''
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__( 'Info', 'kalkulat' ),
						'param_name'	=> 'add_info',
						'value'			=> ''
					),
					
				),

			)
		)
	));
}