<?php
if(!function_exists('kalkulate_customizer_register')){
	function kalkulate_customizer_register($kalkulate_customizer){

		/**
		*  Add Panel
		*/
		$kalkulate_customizer->add_panel('kalkulate_theme_option', array(
			'priority'			=> 10,
			'capability'		=> 'edit_theme_options',
			'theme_supports'	=> '',
			'title'				=> esc_html__( 'kalkulat Theme Options', 'kalkulat' )
		));

		/**
		* General Option
		*/
		$kalkulate_customizer->add_section('general', array(
			'title'		=> esc_html__( 'General Options', 'kalkulat' ),
			'priority'	=> 10,
			'panel'		=> 'kalkulate_theme_option'
		));
		// preloader
		$kalkulate_customizer->add_setting('preloader_status', array(
			'default'	=> '',
			'transport'	=> 'refresh'
		));
		$kalkulate_customizer->add_control( 'preloader_status', array(
			'type' 			=> 'checkbox',
			'section' 		=> 'general', 
			'setting'		=> 'preloader_status',
			'label' 		=> __( 'Preloader ON', 'kalkulat' ),
		) );
		// menu search status
		$kalkulate_customizer->add_setting('menu_search_status', array(
			'default'	=> '',
			'transport'	=> 'refresh'
		));
		$kalkulate_customizer->add_control( 'menu_search_status', array(
			'type' 			=> 'checkbox',
			'section' 		=> 'general', 
			'setting'		=> 'menu_search_status',
			'label' 		=> __( 'Menu Search OFF', 'kalkulat' ),
		) );
		// breadcrumb 
		$kalkulate_customizer->add_setting('breadcrumb_status', array(
			'default'	=> '',
			'transport'	=> 'refresh'
		));
		$kalkulate_customizer->add_control( 'breadcrumb_status', array(
			'type' 			=> 'checkbox',
			'section' 		=> 'general', 
			'setting'		=> 'breadcrumb_status',
			'label' 		=> __( 'Breadcrumb OFF', 'kalkulat' ),
		) );
		// map api
		$kalkulate_customizer->add_setting('map_api', array(
			'default'		=> '',
			'transport'		=> 'refresh'
		));
		$kalkulate_customizer->add_control('map_api', array(
			'section'	=> 'general',
			'label'		=> esc_html__( 'Google Map Api', 'kalkulat' ),
			'description' => '<a href="'.esc_url( 'https://goo.gl/MhguAQ' ).'" target="_blank">'.esc_html__( 'Click Here', 'kalkulat' ).'</a>' . esc_html__( ' for get Google Map Api', 'kalkulat' ),
			'type'		=> 'textarea',
			'setting'	=> 'map_api'
		));
		// portfolio single (title)
		$kalkulate_customizer->add_setting('mostview_title', array(
			'default'	=> '',
			'transport'	=> 'refresh'
		));
		$kalkulate_customizer->add_control('mostview_title', array(
			'section'	=> 'general',
			'label'		=> esc_html__( 'Most View Title (portfolio single)', 'kalkulat' ),
			'type'		=> 'text',
			'setting'	=> 'mostview_title'
		));
		// portfolio single (sub title)
		$kalkulate_customizer->add_setting('mostview_subtitle', array(
			'default'	=> '',
			'transport'	=> 'refresh'
		));
		$kalkulate_customizer->add_control('mostview_subtitle', array(
			'section'	=> 'general',
			'label'		=> esc_html__( 'Most View Sub Title (portfolio single)', 'kalkulat' ),
			'type'		=> 'textarea',
			'setting'	=> 'mostview_subtitle'
		));



		/**
		*  Header Option
		*/
		$kalkulate_customizer->add_section('header', array(
			'title'		=> esc_html__( 'Header Options', 'kalkulat' ),
			'priority'	=> 10,
			'panel'		=> 'kalkulate_theme_option'
		));
		// header logo
		$kalkulate_customizer->add_setting('header_logo', array(
			'default'		=> get_template_directory_uri() . '/images/logo.png',
			'transport'		=> 'refresh'
		));
		$kalkulate_customizer->add_control(
			new WP_Customize_Image_Control($kalkulate_customizer, 'header_logo', array(
				'section'	=> 'header',
				'label'		=> esc_html__( 'Header Logo', 'kalkulat' ),
				'setting'	=> 'header_logo'
			))
		);
		// Page Title BG
		$kalkulate_customizer->add_setting('header_background', array(
			'default'		=> get_template_directory_uri() . '/images/page-title.jpg',
			'transport'		=> 'refresh'
		));
		$kalkulate_customizer->add_control(
			new WP_Customize_Image_Control($kalkulate_customizer, 'header_background', array(
				'section'	=> 'header',
				'label'		=> esc_html__( 'Header Background', 'kalkulat' ),
				'setting'	=> 'header_background'
			))
		);
		// choose menu
		$kalkulate_customizer->add_setting('menu_style', array(
			'default'	=> '',
			'transport'	=> 'refresh'
		));
		$kalkulate_customizer->add_control( 'menu_style', array(
			'type' 			=> 'radio',
			'section' 		=> 'header', 
			'setting'		=> 'menu_style',
			'label' 		=> esc_html__( 'Choose Menu Style', 'kalkulat' ),
			'choices' 		=> array(
				'one' 	=> esc_html__( 'Default Menu', 'kalkulat' ),
				'two' 	=> esc_html__( 'Menu Style Two', 'kalkulat' ),
				'three' => esc_html__( 'Menu Style Three', 'kalkulat' ),
				'four' 	=> esc_html__( 'Menu Style four', 'kalkulat' ),
				'five' 	=> esc_html__( 'Menu Style Five', 'kalkulat' ),
			),
		) );

		// Location Icon
		$kalkulate_customizer->add_setting('topbar_Location_icon', array(
			'default'	=> '',
			'transport'	=> 'refresh'
		));
		$kalkulate_customizer->add_control( 'topbar_Location_icon', array(
			'type' 			=> 'checkbox',
			'section' 		=> 'header', 
			'setting'		=> 'topbar_Location_icon',
			'label' 		=> __( 'Location Icon off', 'kalkulat' ),
		) );
		// Location
		$kalkulate_customizer->add_setting('topbar_Location', array(
			'default'	=> '',
			'transport'	=> 'refresh'
		));
		$kalkulate_customizer->add_control('topbar_Location', array(
			'section'	=> 'header',
			'label'		=> esc_html__( 'Location', 'kalkulat' ),
			'type'		=> 'textarea',
			'setting'	=> 'topbar_Location'
		));


		// Mail Icon
		$kalkulate_customizer->add_setting('topbar_mail_icon', array(
			'default'	=> '',
			'transport'	=> 'refresh'
		));
		$kalkulate_customizer->add_control( 'topbar_mail_icon', array(
			'type' 			=> 'checkbox',
			'section' 		=> 'header', 
			'setting'		=> 'topbar_mail_icon',
			'label' 		=> __( 'Mail Icon off', 'kalkulat' ),
		) );
		// contact
		$kalkulate_customizer->add_setting('topbar_mail', array(
			'default'	=> '',
			'transport'	=> 'refresh'
		));
		$kalkulate_customizer->add_control('topbar_mail', array(
			'section'	=> 'header',
			'label'		=> esc_html__( 'Mail', 'kalkulat' ),
			'type'		=> 'textarea',
			'setting'	=> 'topbar_mail'
		));
		// contact 2
		$kalkulate_customizer->add_setting('topbar_mail_two', array(
			'default'	=> '',
			'transport'	=> 'refresh'
		));
		$kalkulate_customizer->add_control('topbar_mail_two', array(
			'section'	=> 'header',
			'label'		=> esc_html__( 'Mail (for header style two)', 'kalkulat' ),
			'setting'	=> 'topbar_mail_two'
		));

		// Phone Icon
		$kalkulate_customizer->add_setting('topbar_phone_icon', array(
			'default'	=> '',
			'transport'	=> 'refresh'
		));
		$kalkulate_customizer->add_control( 'topbar_phone_icon', array(
			'type' 			=> 'checkbox',
			'section' 		=> 'header', 
			'setting'		=> 'topbar_phone_icon',
			'label' 		=> __( 'Phone Icon off', 'kalkulat' ),
		) );
		// call us
		$kalkulate_customizer->add_setting('topbar_phone', array(
			'default'	=> '',
			'transport'	=> 'refresh'
		));
		$kalkulate_customizer->add_control('topbar_phone', array(
			'section'	=> 'header',
			'label'		=> esc_html__( 'Phone', 'kalkulat' ),
			'type'		=> 'textarea',
			'setting'	=> 'topbar_phone'
		));
		// call us two
		$kalkulate_customizer->add_setting('topbar_phone_two', array(
			'default'	=> '',
			'transport'	=> 'refresh'
		));
		$kalkulate_customizer->add_control('topbar_phone_two', array(
			'section'	=> 'header',
			'label'		=> esc_html__( 'Phone (for header style two)', 'kalkulat' ),
			'setting'	=> 'topbar_phone_two'
		));
		/**
		 * Social media
		 */
		$kalkulate_customizer->add_section('social', array(
			'title'		=> esc_html__( 'Social Options', 'kalkulat' ),
			'priority'	=> 20,
			'panel'		=> 'kalkulate_theme_option'
		));
		// facebook
		$kalkulate_customizer->add_setting('facebook', array(
			'default'	=> '',
			'transport'	=> 'refresh'
		));
		$kalkulate_customizer->add_control('facebook', array(
			'section'	=> 'social',
			'label'		=> esc_html__( 'Facebook', 'kalkulat' ),
			'type'		=> 'text',
			'setting'	=> 'facebook'
		));
		// twitter
		$kalkulate_customizer->add_setting('twitter', array(
			'default'	=> '',
			'transport'	=> 'refresh'
		));
		$kalkulate_customizer->add_control('twitter', array(
			'section'	=> 'social',
			'label'		=> esc_html__( 'Twitter', 'kalkulat' ),
			'type'		=> 'text',
			'setting'	=> 'twitter'
		));
		// google_plus
		$kalkulate_customizer->add_setting('google_plus', array(
			'default'	=> '',
			'transport'	=> 'refresh'
		));
		$kalkulate_customizer->add_control('google_plus', array(
			'section'	=> 'social',
			'label'		=> esc_html__( 'Google Plus', 'kalkulat' ),
			'type'		=> 'text',
			'setting'	=> 'google_plus'
		));
		// youtube
		$kalkulate_customizer->add_setting('youtube', array(
			'default'	=> '',
			'transport'	=> 'refresh'
		));
		$kalkulate_customizer->add_control('youtube', array(
			'section'	=> 'social',
			'label'		=> esc_html__( 'youtube', 'kalkulat' ),
			'type'		=> 'text',
			'setting'	=> 'youtube'
		));
		// pinterest
		$kalkulate_customizer->add_setting('pinterest', array(
			'default'	=> '',
			'transport'	=> 'refresh'
		));
		$kalkulate_customizer->add_control('pinterest', array(
			'section'	=> 'social',
			'label'		=> esc_html__( 'Pinterest', 'kalkulat' ),
			'type'		=> 'text',
			'setting'	=> 'pinterest'
		));
		// linkedin
		$kalkulate_customizer->add_setting('linkedin', array(
			'default'	=> '',
			'transport'	=> 'refresh'
		));
		$kalkulate_customizer->add_control('linkedin', array(
			'section'	=> 'social',
			'label'		=> esc_html__( 'Linkedin', 'kalkulat' ),
			'type'		=> 'text',
			'setting'	=> 'linkedin'
		));
		// skype
		$kalkulate_customizer->add_setting('skype', array(
			'default'	=> '',
			'transport'	=> 'refresh'
		));
		$kalkulate_customizer->add_control('skype', array(
			'section'	=> 'social',
			'label'		=> esc_html__( 'Skype', 'kalkulat' ),
			'type'		=> 'text',
			'setting'	=> 'skype'
		));
		// instagram
		$kalkulate_customizer->add_setting('instagram', array(
			'default'	=> '',
			'transport'	=> 'refresh'
		));
		$kalkulate_customizer->add_control('instagram', array(
			'section'	=> 'social',
			'label'		=> esc_html__( 'Instagram', 'kalkulat' ),
			'type'		=> 'text',
			'setting'	=> 'instagram'
		));

		/**
		*  Footer Option
		*/
		$kalkulate_customizer->add_section('footer', array(
			'title'		=> esc_html__( 'Footer Options', 'kalkulat' ),
			'priority'	=> 20,
			'panel'		=> 'kalkulate_theme_option'
		));
		//Call to action
		$kalkulate_customizer->add_setting('cta_title', array(
			'default'	=> esc_html__( 'The most impressive template youll find.', 'kalkulat' ),
			'transport'	=> 'refresh'
		));
		$kalkulate_customizer->add_control('cta_title', array(
			'section'	=> 'footer',
			'label'		=> esc_html__( 'CTA Title', 'kalkulat' ),
			'type'		=> 'textarea',
			'setting'	=> 'cta_title'
		));
		$kalkulate_customizer->add_setting('cta_sub_title', array(
			'default'	=> esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit,', 'kalkulat' ),
			'transport'	=> 'refresh'
		));
		$kalkulate_customizer->add_control('cta_sub_title', array(
			'section'	=> 'footer',
			'label'		=> esc_html__( 'CTA Sub title', 'kalkulat' ),
			'type'		=> 'textarea',
			'setting'	=> 'cta_sub_title'
		));
		$kalkulate_customizer->add_setting('cta_btn', array(
			'default'	=> esc_html__( 'Get Started.', 'kalkulat' ),
			'transport'	=> 'refresh'
		));
		$kalkulate_customizer->add_control('cta_btn', array(
			'section'	=> 'footer',
			'label'		=> esc_html__( 'CTA Btn text', 'kalkulat' ),
			'type'		=> 'text',
			'setting'	=> 'cta_btn'
		));
		$kalkulate_customizer->add_setting('cta_btn_url', array(
			'default'	=> '#',
			'transport'	=> 'refresh'
		));
		$kalkulate_customizer->add_control('cta_btn_url', array(
			'section'	=> 'footer',
			'label'		=> esc_html__( 'CTA Btn url', 'kalkulat' ),
			'type'		=> 'text',
			'setting'	=> 'cta_btn_url'
		));

		//copyright
		$kalkulate_customizer->add_setting('copyright', array(
			'default'	=> esc_html__( '&copy; Copyright 2019 ThemeLayer. All rights reserved.', 'kalkulat' ),
			'transport'	=> 'refresh'
		));
		$kalkulate_customizer->add_control('copyright', array(
			'section'	=> 'footer',
			'label'		=> esc_html__( 'Copyright', 'kalkulat' ),
			'type'		=> 'textarea',
			'setting'	=> 'copyright'
		));

		/**
		*  Footer Two
		*/
		$kalkulate_customizer->add_section('footer-two', array(
			'title'		=> esc_html__( 'Footer Shop', 'kalkulat' ),
			'priority'	=> 30,
			'panel'		=> 'kalkulate_theme_option'
		));
		// All currency status
		//paypal
		$kalkulate_customizer->add_setting('paypal_status', array(
			'default'	=> '',
			'transport'	=> 'refresh'
		));
		$kalkulate_customizer->add_control( 'paypal_status', array(
			'type' 			=> 'checkbox',
			'section' 		=> 'footer-two', 
			'setting'		=> 'paypal_status',
			'label' 		=> __( 'Paypal', 'kalkulat' ),
		) );
		//visa
		$kalkulate_customizer->add_setting('visa_status', array(
			'default'	=> '',
			'transport'	=> 'refresh'
		));
		$kalkulate_customizer->add_control( 'visa_status', array(
			'type' 			=> 'checkbox',
			'section' 		=> 'footer-two', 
			'setting'		=> 'visa_status',
			'label' 		=> __( 'Visa', 'kalkulat' ),
		) );
		//mastercard
		$kalkulate_customizer->add_setting('mastercard_status', array(
			'default'	=> '',
			'transport'	=> 'refresh'
		));
		$kalkulate_customizer->add_control( 'mastercard_status', array(
			'type' 			=> 'checkbox',
			'section' 		=> 'footer-two', 
			'setting'		=> 'mastercard_status',
			'label' 		=> __( 'Mastercard', 'kalkulat' ),
		) );
		//amex
		$kalkulate_customizer->add_setting('amex_status', array(
			'default'	=> '',
			'transport'	=> 'refresh'
		));
		$kalkulate_customizer->add_control( 'amex_status', array(
			'type' 			=> 'checkbox',
			'section' 		=> 'footer-two', 
			'setting'		=> 'amex_status',
			'label' 		=> __( 'Amex', 'kalkulat' ),
		) );



		/************* Color ***********/
		/**
		* General Option
		*/
		$kalkulate_customizer->add_section('kalkulat_color_option', array(
			'title'		=> esc_html__( 'Kalkulat Color Options', 'kalkulat' ),
			'priority'	=> 10,
			
		));


		// main color
		$txtcolors[] = array(
			'slug'=>'kal_main_color', 
			'default' => '#1490d7',
			'label' => 'Main Color'
		);



		// add the settings and controls for each color
		foreach( $txtcolors as $txtcolor ) {
			
			// SETTINGS
			$kalkulate_customizer->add_setting(
				$txtcolor['slug'], array(
					'default' => $txtcolor['default'],
					'type' => 'option', 
					'capability' => 
					'edit_theme_options'
				)
			);
			// CONTROLS
			$kalkulate_customizer->add_control(
				new WP_Customize_Color_Control(
					$kalkulate_customizer,
					$txtcolor['slug'], 
					array('label' => $txtcolor['label'], 
					'section' => 'kalkulat_color_option',
					'settings' => $txtcolor['slug'])
				)
			);
		}

	}
}
add_action( 'customize_register', 'kalkulate_customizer_register' );