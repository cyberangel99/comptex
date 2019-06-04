<?php
add_shortcode( 'kalkulate_client', function($atts, $content = null){
	extract(shortcode_atts( array(
		'clients'				=> '',
		'client_thumb'			=> '',
		'client_link'			=> ''
	),  $atts));

	$output = '';

		$output .='<div class="client-area">
	            <div class="client-carousel owl-carousel owl-theme">';
	                $clients = vc_param_group_parse_atts($atts['clients']);
					$is_array = (is_array($clients) ? true : false);
					if(!empty($clients) && $is_array){
						foreach($clients as $client){
							
							$client_thumb_url = array( 0 => '' );
							if(!empty($client['client_thumb'])){
								$client_thumb_url  = wp_get_attachment_image_src( $client['client_thumb'], 'kalkulate-client-thumb', false );
							}

							$output .='<div class="client-logo">
								<a href="'.(isset($client['client_link']) ? $client['client_link'] : '').'">
									<img src="'.(isset($client_thumb_url[0]) ? $client_thumb_url[0] : '').'" alt="'.esc_attr__( 'Client Thumbnail', 'kalkulat' ).'">
								</a>
							</div>';
						}
					}
	            $output .='</div>
		    </div>';
	return $output;
});

// Visual Composer
if(class_exists('WPBakeryVisualComposerAbstract')){
	vc_map(array(
		'name'			=> esc_html__( 'kalkulat Client', 'kalkulat' ),
		'base'			=> 'kalkulate_client',
		'class'			=> '',
		'description'	=> esc_html__( 'add multiple client logo', 'kalkulat' ),
		'category'		=> esc_html__( 'kalkulat Shortcode', 'kalkulat' ),
		'params'		=> array(
			array(
				'type'			=> 'param_group',
				'heading'		=> esc_html__( 'Client Thumbnail', 'kalkulat' ),
				'param_name'	=> 'clients',
				'params'		=> array(
					array(
						'type'			=> 'attach_image',
						'heading'		=> esc_html__( 'Add Thumbnail', 'kalkulat' ),
						'param_name'	=> 'client_thumb',
						'value'			=> ''
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__( 'Add Client Link', 'kalkulat' ),
						'param_name'	=> 'client_link',
						'value'			=> ''
					),
					
				),

			)
		)
	));
}


