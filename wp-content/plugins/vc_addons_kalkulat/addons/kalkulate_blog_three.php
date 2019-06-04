<?php 

add_shortcode( 'kalkulate_blog_three', function($atts, $content = null){
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

	$output .='<div class="blog-style-two-section">
    	<div class="row row-eq-rs-height">';
			$order = (!empty($post_order) ? $post_order : 'DESC');
			$blog_query = new WP_Query(array('post_type'=> 'post', 'order'=> $order, 'posts_per_page' => $post_limit));
			if($blog_query->have_posts()) : 
				$i = (($animation == 1) ? $animation_delay : '0');
				while($blog_query->have_posts()) : $blog_query->the_post();
					//animation-style
					$animation_styles = (($animation == 1) ? 'data-wow-duration="'.$animation_duration.'s" data-wow-delay="'.$i.'s"' : '');
					$output.='<div class="'.(!empty($post_grid) ? $post_grid : 'col-md-4').' col-sm-6 col-xs-12">
	                    <div class="blog-item blog-style-two blog-style-three '.$is_animation.'" '.$animation_styles.'>
	                        <div class="image">
	                           	'.get_the_post_thumbnail( null, 'kalkulate-blog-thumbnail', array('class'=> 'img-responsive') ).'
	                        </div>
	                        <div class="blog-text">
	                            <h4><a href="'.get_the_permalink().'">'.get_the_title().'</a></h4>
                              <div class="post-metta">
                                <span>
                                  <i class="fa fa-user" aria-hidden="true"></i>
                                  '.get_the_author().'
                                </span>
                                <span>
                                  <i class="fa fa-calendar" aria-hidden="true"></i>
                                  '.get_the_time('M d, Y').'
                                </span>
                                '.((get_comments_number() != 0) ? '<span>
                                  <i class="fa fa-comments-o" aria-hidden="true"></i>
                                  '.get_comments_number().'
                                </span>' : '').'
                              </div>
	                            <p>'.wp_trim_words( get_the_content(), 17, null ).'</p>
	                            <a href="'.get_the_permalink().'" class="kal-button">'.esc_html__( 'READ MORE', 'kalkulat').'</a>
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
		'name'			=> esc_html__( 'kalkulat blog Three', 'kalkulat' ),
		'base'			=> 'kalkulate_blog_three',
		'class'			=> '',
		'description'	=> esc_html__( 'add kalkulat blog post', 'kalkulat' ),
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