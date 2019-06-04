<?php
add_shortcode( 'kalkulate_map', function($atts, $content = null){
	extract(shortcode_atts( array(
		'map_latitude'		=> '',
		'map_longitude'		=> '',
		'map_marker'		=> '',
		'id'				=> ''

	),  $atts));

	if(!KALKULATE_CORE_VISUAL_COMPOSER_ACTIVED) return $output = '';
	$output = '';
		 
		$marker_url = array( 0 => '' );
		if(!empty($map_marker)){
		 	$marker_url = wp_get_attachment_image_src($map_marker , 'full');
		}
		$output .='<div class="contact-section">
			<div id="map" class="google-map"></div>
		</div>';

		

	if(!empty($map_latitude) && !empty($map_longitude)){
		$output .= '<script>
		  jQuery("#map").gmap3({
			map:{
				options:{
					zoom: 10,
					center: ['.$map_latitude.','.$map_longitude.'],
					mapTypeControl: true,
					mapTypeControlOptions: {
						style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
					},
					mapTypeId: "style1",
					mapTypeControlOptions: {
						mapTypeIds: [google.maps.MapTypeId.ROADMAP, "style1"]
					},
					navigationControl: true,
					scrollwheel: false,
					streetViewControl: true
				}
			},
			marker:{
				latLng: ['.$map_latitude.','.$map_longitude.'],
				options: {animation:google.maps.Animation.BOUNCE, icon: "'.$marker_url[0].'" }
			},
			styledmaptype:{
				id: "style1",
				options:{
					name: "Style 1"
				},
				styles: [
					{
						featureType: "road.highway",
						stylers: [
							{"color": "#ffffff"},         
							{"elementType":"geometry"},
						]
					},{
						featureType: "water",
						stylers: [
							{ visibility: "on" },
							{ color: "#93c2ce" }
						]
					},{
						featureType:"landscape",
						stylers:[
							{"color":"#f2f2f2"}
						]
					},{
						featureType: "poi.park",
						elementType:"geometry",
						stylers: [
							{"color":"#efefef"}
						]
					},{
						featureType: "transit.line",
						stylers: [
							{"color":"#ffffff"}
						]
					}
				]
			}
	   	});

		</script>';
	}

	return $output;
});

// Visual Composer
if(class_exists('WPBakeryVisualComposerAbstract')){
	vc_map(array(
		'name'			=> esc_html__( 'kalkulat Map', 'kalkulat' ),
		'base'			=> 'kalkulate_map',
		'class'			=> '',
		'description'	=> esc_html__( 'add google map', 'kalkulat' ),
		'category'		=> esc_html__( 'kalkulat Shortcode', 'kalkulat' ),
		'params'		=> array(
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Google Map Latitude', 'kalkulat' ),
				'param_name'	=> 'map_latitude',
				'value'			=> ''	
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Google Map Longitude', 'kalkulat' ),
				'param_name'	=> 'map_longitude',
				'value'			=> ''	
			),
			array(
				'type'			=> 'attach_image',
				'heading'		=> esc_html__( 'Google Map Marker', 'kalkulat' ),
				'param_name'	=> 'map_marker',
				'value'			=> ''	
			)
		)
	));
}


