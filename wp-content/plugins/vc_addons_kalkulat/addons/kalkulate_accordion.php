<?php 

add_shortcode( 'kalkulate_accordion', function($atts, $content = null){
	extract(shortcode_atts(array(
		'panel_title' 			=> '',
		'panel_body'  			=> '',
		'animation'				=> '',
		'animation_style'		=> '',
		'animation_duration'	=> '',
		'animation_delay'		=> '',
	), $atts));

	$output = '';

	//animation style
	$is_animation = (($animation == 1) ? ' wow '.$animation_style : '');
	$animation_styles = (($animation == 1) ? 'data-wow-duration="'.$animation_duration.'s" data-wow-delay="'.$animation_delay.'s"' : '');

	$output .='<div class="why-choose-us-section">
                <div class="panel-group '.$is_animation.'" id="accordion" '.$animation_styles.'>';
                	$accordions = vc_param_group_parse_atts($atts['accordions']);
					$is_array = (is_array($accordions) ? true : false);
					if(!empty($accordions) && $is_array){
						$randval = rand(10, 1000000);
						$i = $randval;
						foreach ($accordions as $accordion) {
	                        $output .='<div class="panel">
	    						<div class="panel-heading">
	    							<a class="accordion-toggle '.(($i == $randval) ? '' : 'collapsed').'" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$i.'">
	    							<h4>'.(isset($accordion['panel_title']) ? $accordion['panel_title'] : '').'</h4>
	                                <i class="indicator fa fa-angle-right"></i>
	    							</a>
	    						</div>
	    						<div id="collapse'.$i.'" class="panel-collapse collapse '.(($i == $randval) ? ' in' : '').'">
	    						    <div class="panel-body">
	                                    <p>'.(isset($accordion['panel_body']) ? $accordion['panel_body'] : '').'</p>
	    						    </div>
	    						</div>
	    					</div>';
							$i++;
						}
					}
				$output .='</div>
			</div>';

	return $output;

});


// Visual Composer
if(class_exists('WPBakeryVisualComposerAbstract')){
	vc_map(array(
		'name'			=> esc_html__( 'kalkulat Accordions', 'kalkulat' ),
		'base'			=> 'kalkulate_accordion',
		'class'			=> '',
		'description'	=> esc_html__( 'add kalkulat team member', 'kalkulat' ),
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
				'type'		=> 'param_group',
				'heading'	=> esc_html__( 'Add Accordion', 'kalkulat' ),
				'param_name'=> 'accordions',
				'params'    => array(
					array(
						'type'		=> 'textfield',
						'heading'	=> esc_html__( 'Panel Title', 'kalkulat' ),
						'param_name'=> 'panel_title'
					),
					array(
						'type'		=> 'textarea',
						'heading'	=> esc_html__( 'Panel Body', 'kalkulat' ),
						'param_name'=> 'panel_body'
					),
				)
			)
		)
	));
}