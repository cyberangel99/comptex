<?php 

//service metabox
if(!function_exists('kalkulate_service_metabox')){
	function kalkulate_service_metabox(){

		// Start with an underscore to hide fields from custom fields list
		$prefix = '__kalkulate__';

		/**
		* Initiate the metabox
		*/

		$cmb = new_cmb2_box( array(
			'id'			=> 'kalkulate_service_metabox',
			'title'			=> esc_html__( 'service Metabox', 'kalkulat' ),
			'object_types'	=> array('service'), // post type
			'context'		=> 'normal',
			'priority'		=> 'high',
			'show_names'	=> true
		) );
		//Icon custom field
		$cmb->add_field( array(
			'name'    => esc_html__( 'Select Item', 'kalkulat' ),
			'id'      => $prefix . 'service_icon',
			'type'    => 'radio',
			'options' => array(
				'1' => 'Service icon',
				'2' => 'service image',
			),
		) );
		$cmb->add_field( array(
			'name'			=> esc_html__( 'Social Icon', 'kalkulat' ),
			'id'			=> $prefix . 'services_social_icon_class_name',
			'description'	=> esc_html__( 'add your social icon Full class name. Example: fa fa-faceboook or icon-icomoon-speech-bubble', 'kalkulat' ),
			'type'	=> 'text'
		) );
		$cmb->add_field( array(
			'name'			=> esc_html__( 'Service Image', 'kalkulat' ),
			'id'			=> $prefix . 'services_image_class_name',
			'description'	=> esc_html__( 'add your Service image', 'kalkulat' ),
		    'type'             => 'file',
		) );
	}
}
add_action( 'cmb2_admin_init', 'kalkulate_service_metabox' );


//Testimonial metabox
if(!function_exists('kalkulate_testimonial_metabox')){
	function kalkulate_testimonial_metabox(){

		// Start with an underscore to hide fields from custom fields list
		$prefix = '__kalkulate__';

		/**
		* Initiate the metabox
		*/

		$cmb = new_cmb2_box( array(
			'id'			=> 'kalkulate_testimonial_metabox',
			'title'			=> esc_html__( 'testimonial Metabox', 'kalkulat' ),
			'object_types'	=> array('testimonial'), // post type
			'context'		=> 'normal',
			'priority'		=> 'high',
			'show_names'	=> true
		) );
		// custom field start 
		$cmb->add_field( array(
			'name'			=> esc_html__( 'Testimonial Designation', 'kalkulat' ),
			'desc'			=> esc_html__( 'add Your Testimonial Designation', 'kalkulat' ),
			'id'			=> $prefix . 'testimonial_designation',
			'type'			=> 'text',
			'show_on_cb'	=> 'testimonial_hide_if_no_cats'
		) );
		//Icon custom field
		$cmb->add_field( array(
			'name'    => esc_html__( 'Select Icon or Image', 'kalkulat' ),
			'id'      => $prefix . 'testimonial_icon',
			'type'    => 'radio',
			'options' => array(
				'1' => esc_html__('Testimonial icon'),
				'2' => esc_html__('Testimonial image'),
			),
		) );
		$cmb->add_field( array(
			'name'			=> esc_html__( 'Testimonial Icon', 'kalkulat' ),
			'desc'			=> esc_html__( 'add Your Testimonial Icon. Example: fa-facebook', 'kalkulat' ),
			'id'			=> $prefix . 'testimonial_icons',
			'type'			=> 'text',
			'show_on_cb'	=> 'testimonial_hide_if_no_cats'
		) );
		$cmb->add_field( array(
			'name'			=> esc_html__( 'Testimonial Icon Image', 'kalkulat' ),
			'desc'			=> esc_html__( 'add Your Testimonial Image', 'kalkulat' ),
			'id'			=> $prefix . 'testimonial_image',
			'type'			=> 'file',
			'show_on_cb'	=> 'testimonial_hide_if_no_cats'
		) );

	}
}
add_action( 'cmb2_admin_init', 'kalkulate_testimonial_metabox' );

//Portfolio metabox
if(!function_exists('kalkulate_portfolio_metabox')){
	function kalkulate_portfolio_metabox(){

		// Start with an underscore to hide fields from custom fields list
		$prefix = '__kalkulate__';

		/**
		* Initiate the metabox
		*/

		$cmb = new_cmb2_box( array(
			'id'			=> 'kalkulate_portfolio_metabox',
			'title'			=> esc_html__( 'Our Work Metabox', 'kalkulat' ),
			'object_types'	=> array('portfolio'), // post type
			'context'		=> 'normal',
			'priority'		=> 'high',
			'show_names'	=> true
		) );
		// custom field start 
		$cmb->add_field( array(
			'name'			=> esc_html__( 'Sub title', 'kalkulat' ),
			'desc'			=> esc_html__( 'add Your Sub title', 'kalkulat' ),
			'id'			=> $prefix . 'portfolio_sub_title',
			'type'			=> 'text',
			'show_on_cb'	=> 'portfolio_hide_if_no_cats'
		) );
		// custom field start 
		$cmb->add_field( array(
			'name'			=> esc_html__( 'Portfolio Designer', 'kalkulat' ),
			'desc'			=> esc_html__( 'Add Your Designer', 'kalkulat' ),
			'id'			=> $prefix . 'portfolio_designer',
			'type'			=> 'text',
			'show_on_cb'	=> 'portfolio_hide_if_no_cats'
		) );
		// custom field start 
		$cmb->add_field( array(
			'name'			=> esc_html__( 'Client Text', 'kalkulat' ),
			'desc'			=> esc_html__( 'Add Your Client', 'kalkulat' ),
			'id'			=> $prefix . 'portfolio_client',
			'type'			=> 'text',
			'show_on_cb'	=> 'portfolio_hide_if_no_cats'
		) );
		// custom field start 
		$cmb->add_field( array(
			'name'			=> esc_html__( 'Portfolio Tools', 'kalkulat' ),
			'desc'			=> esc_html__( 'Add Your Tools', 'kalkulat' ),
			'id'			=> $prefix . 'portfolio_tools',
			'type'			=> 'text',
			'show_on_cb'	=> 'portfolio_hide_if_no_cats'
		) );

	}
}
add_action( 'cmb2_admin_init', 'kalkulate_portfolio_metabox' );

//Team metabox
if(!function_exists('kalkulate_team_metabox')){
	function kalkulate_team_metabox(){

		// Start with an underscore to hide fields from custom fields list
		$prefix = '__kalkulate__';

		/**
		* Initiate the metabox
		*/

		$cmb = new_cmb2_box( array(
			'id'			=> 'kalkulate_team_metabox',
			'title'			=> esc_html__( 'Team Metabox', 'kalkulat' ),
			'object_types'	=> array('team'), // post type
			'context'		=> 'normal',
			'priority'		=> 'high',
			'show_names'	=> true
		) );

		// custom field start 
		$cmb->add_field( array(
			'name'			=> esc_html__( 'Team Designation', 'kalkulat' ),
			'desc'			=> esc_html__( 'add Your Team Designation', 'kalkulat' ),
			'id'			=> $prefix . 'team_designation',
			'type'			=> 'text',
			'show_on_cb'	=> 'kalkulate_hide_if_no_cats'
		) );
		$cmb->add_field( array(
			'name'			=> esc_html__( 'Team Contact Number', 'kalkulat' ),
			'desc'			=> esc_html__( 'add Your Contact Number', 'kalkulat' ),
			'id'			=> $prefix . 'contact_number',
			'type'			=> 'text',
			'show_on_cb'	=> 'kalkulate_hide_if_no_cats'
		) );

		// social custom field
		$kalkulate_team_social = $cmb->add_field( array(
			'id'			=> $prefix . 'team_social',
			'type'			=> 'group',
			'options'		=> array(
				'group_title'	=> esc_html__( 'Social Profile', 'kalkulat' ),
				'add_button'	=> esc_html__( 'Add Another Social Profile', 'kalkulat' ),
				'remove_button'		=> esc_html__( 'Remove Social Profile', 'kalkulat' ),
				'sortable'		=> true,
				'closed'		=> true
			)
		) );
		$cmb->add_group_field($kalkulate_team_social, array(
			'name'			=> esc_html__( 'Social Icon', 'kalkulat' ),
			'id'			=> $prefix . 'team_social_icon_class_name',
			'description'	=> esc_html__( 'add your social icon class name. Example: fa-facebook', 'kalkulat' ),
			'type'	=> 'text'
		) );
		$cmb->add_group_field($kalkulate_team_social, array(
			'name'			=> esc_html__( 'Social Link', 'kalkulat' ),
			'id'			=> $prefix . 'team_social_icon_link',
			'description'	=> esc_html__( 'add your social link. Example: https://www.facebook.com/', 'kalkulat' ),
			'type'	=> 'text'
		) );

	}
}
add_action( 'cmb2_admin_init', 'kalkulate_team_metabox' );

//portfolio metabox
if(!function_exists('kalkulate_service_metabox')){
	function kalkulate_service_metabox(){

		// Start with an underscore to hide fields from custom fields list
		$prefix = '__kalkulate__';

		/**
		* Initiate the metabox
		*/

		$cmb = new_cmb2_box( array(
			'id'			=> 'kalkulate_service_metabox',
			'title'			=> esc_html__( 'service Metabox', 'kalkulat' ),
			'object_types'	=> array('service'), // post type
			'context'		=> 'normal',
			'priority'		=> 'high',
			'show_names'	=> true
		) );
		//Icon custom field
		$cmb->add_field( array(
			'name'			=> esc_html__( 'Social Icon', 'kalkulat' ),
			'id'			=> $prefix . 'services_social_icon_class_name',
			'description'	=> esc_html__( 'add your social icon class name. Example: speech-bubble', 'kalkulat' ),
			'type'	=> 'text'
		) );

	}
}
add_action( 'cmb2_admin_init', 'kalkulate_service_metabox' );