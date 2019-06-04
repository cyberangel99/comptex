<?php
if(!function_exists('kalkulat_typography_customizer_enqueue')){
	function kalkulat_typography_customizer_enqueue(){
		
		wp_enqueue_style( 'chosen', plugins_url('css/chosen.min.css', __FILE__) );

		
		// chosen jquery
		wp_register_script('chosen-jquery', plugins_url('js/chosen.jquery.js', __FILE__), array('jquery'), null, true);
    	wp_enqueue_script('chosen-jquery');

    	// chosen jquery active
		wp_register_script('kalkulat-chosen-active', plugins_url('js/chosen_active.js', __FILE__), array('jquery'), null, true);
    	wp_enqueue_script('kalkulat-chosen-active');
	}
}
add_action('admin_enqueue_scripts', 'kalkulat_typography_customizer_enqueue', 10);




/**************** fonts ****************/
	
if(!class_exists('kalkulat__google_fonts')){
	class kalkulat__google_fonts {

		public static function get_google_fonts(){
			$api_url  = '&key=AIzaSyD52Ei8raqbLK6lRku5HvgRMlJs8y5Uf64';
			$response = wp_remote_get( "https://www.googleapis.com/webfonts/v1/webfonts?sort=alpha{$api_url}", array( 'sslverify' => false ) );

			// Check it is a valid request
			if ( ! is_wp_error( $response ) ) {
				$font_list = json_decode( $response['body'], true );
				// Make sure that the valid response from google is not an error message
				if ( ! isset( $font_list['error'] ) ) {
					$json = $response['body'];

				} else {
					$json  = wp_remote_fopen( plugin_dir_path( __FILE__ ) . 'fonts/webfonts.json' );
				}
			}else {
				$json  = wp_remote_fopen( plugin_dir_path( __FILE__ ) . 'fonts/webfonts.json' );
			}

			/**
			 * get all fonts in variable
			 *
			 */
			$font_output = json_decode( $json, true );


			
			foreach ( $font_output['items'] as $item ) {

				$urls = array();

				// Get font properties from json array.
				foreach ( $item['variants'] as $variant ) {

					$name = str_replace( ' ', '+', $item['family'] );
					$urls[ $variant ] = "https://fonts.googleapis.com/css?family={$name}:{$variant}";

				}

				$atts = array(
					'name'         => $item['family'],
					'category'     => $item['category'],
					'font_type'    => 'google',
					'font_weights' => $item['variants'],
					'subsets'      => $item['subsets'],
					'files'        => $item['files'],
					'urls'         => $urls
				);

				// Add this font to the fonts array
				$id           = strtolower( str_replace( ' ', '_', $item['family'] ) );
				$fonts[ $id ] = $atts;

			}

			return $fonts;
			
		} // end get_google_fonts
		
		public static function get_google_fonts_json(){
			$api_url  = '&key=AIzaSyD52Ei8raqbLK6lRku5HvgRMlJs8y5Uf64';
			$response = wp_remote_get( "https://www.googleapis.com/webfonts/v1/webfonts?sort=alpha{$api_url}", array( 'sslverify' => false ) );

			// Check it is a valid request
			if ( ! is_wp_error( $response ) ) {
				$font_list = json_decode( $response['body'], true );
				// Make sure that the valid response from google is not an error message
				if ( ! isset( $font_list['error'] ) ) {
					$json = $response['body'];

				} else {
					$json  = wp_remote_fopen( plugin_dir_path( __FILE__ ) . 'fonts/webfonts.json' );
				}
			}else {
				$json  = wp_remote_fopen( plugin_dir_path( __FILE__ ) . 'fonts/webfonts.json' );
			}

			/**
			 * get all fonts in variable
			 *
			 */
			$font_output = $json;


		
			return $font_output;
			
		} // end get_google_fonts_json

	}
}
		







		


if(!function_exists('kalkulat_typography_customizer')){
	function kalkulat_typography_customizer($kalkulat_typo_customizer){
		
		
		class WP_Customize_Google_Font_family_Control extends WP_Customize_Control {
	 		public $type = 'select_google_font';
	 		public static $counter = 123;
	 		public static $selectedfont;
			public function render_content() {
				self::$counter++;
			?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					 <select  <?php $this->link(); ?> id="chosen_select" data-placeholder="<?php esc_attr_e( 'Choose a Country...', 'kalkulat' ); ?>" class="chosen_select chosen_select_<?php print self::$counter; ?> chosen-font-family-select" tabindex="2">
						<option value=""></option>
			            <?php
			            	$kalkulat_fonts = new kalkulat__google_fonts();
							$allfonts = $kalkulat_fonts::get_google_fonts(); 
							self::$selectedfont =  $this->value();
			            	foreach($allfonts as $font_item){
			            		print '<option '.selected( $this->value(), $font_item['name'] ).' value="'.$font_item['name'].'">'.$font_item['name'].'</option>';
								
							}
			            ?>
					</select>
				</label>
			<?php
				
			}
		}


		class WP_Customize_Google_Font_weight_Control extends WP_Customize_Control {
	 		public $type = 'select_google_font_weight';
	 		public static $count = 53012;
			public function render_content() {
				$countVal = self::$count++;
				$allfonts = kalkulat__google_fonts::get_google_fonts_json(); 
				$allfonts_two = kalkulat__google_fonts::get_google_fonts();
				$counter = WP_Customize_Google_Font_family_Control::$counter;
				
			?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					 <select  <?php $this->link(); ?> class="chosen_select_<?php print $countVal; ?>" data-placeholder="<?php esc_attr_e( 'Choose a Country...', 'kalkulat' ); ?>">
						<?php
							$get_selected_font_from_database = WP_Customize_Google_Font_family_Control::$selectedfont;
			            	foreach($allfonts_two as $font_item){
			            		if($font_item['name'] == $get_selected_font_from_database){
			            			foreach($font_item['font_weights'] as $font_item_weight){
			            				print '<option '.selected( $this->value(), $font_item_weight ).' value="'.$font_item_weight.'">'.$font_item_weight.'</option>';
			            			}
			            			break;
			            		}
							}
			            ?>
					</select>
					<?php
	            	print "<script>
	            		;(function($){
	            			'use strict'; 
							$(document).ready(function(){
								var allfont  = ".$allfonts.";
								var appendSelector = '.chosen_select_$countVal';

								$('.chosen_select_$counter').change(function(){
							    	var getFontName = $(this).find(':selected').text();
									
									$(appendSelector).empty();
									for(var i = 0; i < allfont.items.length; i++ ){
										if(allfont.items[i]['family'] == getFontName){
											for(var j = 0; j < allfont.items[i]['variants'].length; j++){
												$(appendSelector).append('<option value>'+allfont.items[i]['variants'][j]+'</option>');
											}
											break;
										}

									}
								});	
							});
	            		}(jQuery));
	            	</script>";
			    ?>
				</label>
			<?php
				
			}
		}


		/***
		* Customizer Firld start
		*/
		$kalkulat_typo_customizer->add_section('kalkulat_fonts', array(
			'title'		=> esc_html__( 'kalkulat Font Options', 'kalkulat' ),
			'priority'	=> 10,
		));


		/***
		* Body Font
		*/

		/** Active With Api key **/
		$kalkulat_typo_customizer->add_setting('gooogle_font_api_key', array(
			'default'	=> '',
			'sanitize_callback' 	=> 'body_family_sanitize_select',
			'transport'	=> 'refresh'
		));
		$kalkulat_typo_customizer->add_control( 'gooogle_font_api_key', array(
			'type'			=> 'textarea',
			'section' 		=> 'kalkulat_fonts', 
			'setting'		=> 'gooogle_font_api_key',
			'label' 		=> __( 'Google Fonts Api Key', 'kalkulat' ),
			'description' => '<a href="'.esc_url( 'https://developers.google.com/fonts/docs/developer_api' ).'" target="_blank">'.esc_html__( 'Click Here', 'kalkulat' ).'</a>' . esc_html__( ' for get Google Font Api Key', 'kalkulat' ),
		) );

		/**** Font Family ****/
		$kalkulat_typo_customizer->add_setting( 'body_font_family', array(
		  	'default'				=> '',
		  	'sanitize_callback' 	=> 'body_family_sanitize_select',
			'transport'				=> 'refresh'
		) );
		$kalkulat_typo_customizer->add_control(
			new WP_Customize_Google_Font_family_Control($kalkulat_typo_customizer, 'body_font_family', array(
				'section'	=> 'kalkulat_fonts',
				'label' 	=> esc_html__( 'Body Font Family', 'kalkulat' ),
				'type'		=> 'select_google_font',
				'setting'	=> 'body_font_family'
			))
		);
		function body_family_sanitize_select( $input) {
			return $input;
		}

		/**** Font Weight ****/
		$kalkulat_typo_customizer->add_setting( 'body_font_weight_id', array(
		  	'default'				=> '',
		  	'sanitize_callback' 	=> 'body_weight_sanitize_select',
			'transport'				=> 'refresh'
		) );
		$kalkulat_typo_customizer->add_control(
			new WP_Customize_Google_Font_weight_Control($kalkulat_typo_customizer, 'body_font_weight_id', array(
				'section'	=> 'kalkulat_fonts',
				'label' 	=> esc_html__( 'Body Font Weight', 'kalkulat' ),
				'setting'	=> 'body_font_weight_id'
			))
		);

		function body_weight_sanitize_select( $input) {
			return $input;
		}


		/***
		* Heading Font
		*/
		/**** Font Family ****/
		$kalkulat_typo_customizer->add_setting( 'heading_font_family', array(
		  	'default'				=> '',
		  	'sanitize_callback' 	=> 'heading_family_sanitize_select',
			'transport'				=> 'refresh'
		) );
		$kalkulat_typo_customizer->add_control(
			new WP_Customize_Google_Font_family_Control($kalkulat_typo_customizer, 'heading_font_family', array(
				'section'	=> 'kalkulat_fonts',
				'label' 	=> esc_html__( 'Heading Font Family', 'kalkulat' ),
				'type'		=> 'select_google_font',
				'setting'	=> 'heading_font_family'
			))
		);
		function heading_family_sanitize_select( $input) {
			return $input;
		}

		/**** Font Weight ****/
		$kalkulat_typo_customizer->add_setting( 'heading_font_weight_id', array(
		  	'default'				=> '',
		  	'sanitize_callback' 	=> 'heading_weight_sanitize_select',
			'transport'				=> 'refresh'
		) );
		$kalkulat_typo_customizer->add_control(
			new WP_Customize_Google_Font_weight_Control($kalkulat_typo_customizer, 'heading_font_weight_id', array(
				'section'	=> 'kalkulat_fonts',
				'label' 	=> esc_html__( 'Heading Font Weight', 'kalkulat' ),
				'setting'	=> 'heading_font_weight_id'
			))
		);

		function heading_weight_sanitize_select( $input) {
			return $input;
		}


		/***
		* Sub Heading Font
		*/
		/**** Font Family ****/
		$kalkulat_typo_customizer->add_setting( 'sub_heading_font_family', array(
		  	'default'				=> '',
		  	'sanitize_callback' 	=> 'sub_heading_family_sanitize_select',
			'transport'				=> 'refresh'
		) );
		$kalkulat_typo_customizer->add_control(
			new WP_Customize_Google_Font_family_Control($kalkulat_typo_customizer, 'sub_heading_font_family', array(
				'section'	=> 'kalkulat_fonts',
				'label' 	=> esc_html__( 'Sub Heading Font Family', 'kalkulat' ),
				'type'		=> 'select_google_font',
				'setting'	=> 'sub_heading_font_family'
			))
		);
		function sub_heading_family_sanitize_select( $input) {
			return $input;
		}

		/**** Font Weight ****/
		$kalkulat_typo_customizer->add_setting( 'sub_heading_font_weight_id', array(
		  	'default'				=> '',
		  	'sanitize_callback' 	=> 'sub_heading_weight_sanitize_select',
			'transport'				=> 'refresh'
		) );
		$kalkulat_typo_customizer->add_control(
			new WP_Customize_Google_Font_weight_Control($kalkulat_typo_customizer, 'sub_heading_font_weight_id', array(
				'section'	=> 'kalkulat_fonts',
				'label' 	=> esc_html__( 'Sub Heading Font Weight', 'kalkulat' ),
				'setting'	=> 'sub_heading_font_weight_id'
			))
		);

		function sub_heading_weight_sanitize_select( $input) {
			return $input;
		}

		

	}
}

add_action( 'customize_register', 'kalkulat_typography_customizer' );