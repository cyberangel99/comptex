<?php 

add_shortcode( 'kalkulate_team_two', function($atts, $content = null){
	extract(shortcode_atts(array(
		'post_grid' 			=> '',
		'post_order' 			=> '',
		'post_limit' 			=> '',
		'animation'				=> '',
		'animation_style'		=> '',
		'animation_duration'	=> '',
		'animation_delay'		=> '',

	), $atts));

	$output = '';

	//animation style
	$is_animation = (($animation == 1) ? ' wow '.$animation_style : '');

	$output .='<div class="team-member-two">
    	<div class="row row-eq-rs-height">';
			$order = (!empty($post_order) ? $post_order : 'DESC');
			$team_query = new WP_Query(array('post_type'=> 'team', 'order'=> $order, 'posts_per_page' => $post_limit));
			if($team_query->have_posts()) : 
				$i = (($animation == 1) ? $animation_delay : '0');
				while($team_query->have_posts()) : $team_query->the_post();
					//animation style
					$animation_styles = (($animation == 1) ? 'data-wow-duration="'.$animation_duration.'s" data-wow-delay="'.$i.'s"' : '');
					$output.='<div class="'.(!empty($post_grid) ? $post_grid : 'col-md-3').' col-sm-6 col-xs-12">



	                    <div class="team-member team-member-2'.$is_animation.'" '.$animation_styles.'>
	                        <div class="front-part">
	                            <div class="image">
	                                '.get_the_post_thumbnail( null, 'kalkulate-team-thumbnail', array('class'=> 'img-responsive img-circle') ).'
	                            </div>
	                            <div class="front-text">
	                                <h4 class="member-name">'.get_the_title().'</h4>
	                                <span class="member-position">'.get_post_meta( get_the_ID(), '__kalkulate__team_designation', true ).'</span>';
	                            $output.='</div>
	                        </div>

	                        <div class="back-part">
	                            <div class="member-social-icons">';
	                            	$social_profiles = get_post_meta( get_the_ID(), '__kalkulate__team_social', true );
									$is_array = (is_array($social_profiles) ? true : false);
									if(!empty($social_profiles) && $is_array) {
		                                $output .='<ul class="social-icons">';
		                                	foreach($social_profiles as $social_profile){
		                                    	if(!empty($social_profile['__kalkulate__team_social_icon_class_name'])) {
		                                			$output .='<li><a target="_blank" href="'.(isset($social_profile['__kalkulate__team_social_icon_link']) ? $social_profile['__kalkulate__team_social_icon_link'] : '').'"><i class="fa '.$social_profile['__kalkulate__team_social_icon_class_name'].'"></i></a></li>';
		                                		}
		                                    }
		                                $output .='</ul>';
		                            }
	                            $output .='</div>
	                        </div>
	                    </div>
	                </div>';
		            $i = $i+ 0.3;   
				endwhile;
				wp_reset_postdata();
			endif;	
		$output.='</div>
	</div>';

	return $output;
});

// Visual Composer
if(class_exists('WPBakeryVisualComposerAbstract')){
	vc_map(array(
		'name'			=> esc_html__( 'kalkulat teams Two', 'kalkulat' ),
		'base'			=> 'kalkulate_team_two',
		'class'			=> '',
		'description'	=> esc_html__( 'add kalkulat team posts', 'kalkulat' ),
		'category'		=> esc_html__( 'kalkulat Shortcode', 'kalkulat' ),
		'params'		=> array(
			array(
				'type'			=> 'dropdown',
				'heading'		=> esc_html__( 'Post Grid', 'kalkulat' ),
				'param_name'	=> 'post_grid',
				'value'			=> array( 
					'col-md-12',
					'col-md-6',
					'col-md-4',
					'col-md-3',
					'col-sm-12',
					'col-sm-6',
					'col-sm-4',
					'col-sm-3',	
				)	
			),
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
				'type'			=> 'dropdown',
				'heading'		=> esc_html__( 'Post Order', 'kalkulat' ),
				'param_name'	=> 'post_order',
				'value'         => array('DESC','ASC')
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Post Limit', 'kalkulat' ),
				'param_name'	=> 'post_limit',
				'value'         => '-1',
				'save_always'   => true
			),
		)
	));
}


