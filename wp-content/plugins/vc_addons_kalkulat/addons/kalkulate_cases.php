<?php 

add_shortcode( 'kalkulate_cases', function($atts, $content = null){
	extract(shortcode_atts(array(
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

    global $post;
	$query = new WP_Query(array( 'post_type' => 'cases', 'posts_per_page' => $post_limit, 'order' => $post_order ));

	if($query->have_posts()){
		$output .='<div class="portfolio-main-content">
		    <div class="row">
		        <div class="col-md-12">';
			        while($query->have_posts()) : $query->the_post();
						$categories = get_the_terms( $post->ID, 'category' );
						if(!empty($categories)){
							foreach( $categories as $category ) {
							    $allCategorys[$category->slug] = $category->name;
							}
						}
					endwhile;
		            $output .='<div class="gallery-filter cases-filter text-center">
		                <ul>
		                    <li><a href="#!" class="selected" data-filter="*">'.esc_html__( 'All', 'kalkulat' ).'</a></li>';
		                    if(!empty($allCategorys)){
		                    	foreach ($allCategorys as $catSlug => $catName) {
									$output .='<li><a href="#!" data-filter=".'.$catSlug.'">'.$catName.'</a></li>';	
								}
		                    }
		                $output .='</ul>
		            </div>
		        </div>
		    </div>
	        <div class="gallery-grid">';
	            if($query->have_posts()) :
	            	$i = (($animation == 1) ? $animation_delay : '0');
					while($query->have_posts()) : $query->the_post();
						//animation-style
						$animation_styles = (($animation == 1) ? 'data-wow-duration="'.$animation_duration.'s" data-wow-delay="'.$i.'s"' : '');
						//category-post
						$post_categories = get_the_terms( $post->ID, 'category' );
						if ( ! empty( $post_categories ) && ! is_wp_error( $post_categories ) ) {
						    $currentCategories = wp_list_pluck( $post_categories, 'slug' );
						}
						if(!empty($currentCategories)){
							$currentCategories_cases = implode('', $currentCategories);
						}
	                    $output .='<div class="grid-item cases-item '.$currentCategories_cases.'">
	                        <div class="inner-grid '.$is_animation.'" '.$animation_styles.'>';

								$output .='<div class="media">
									<div class="media-left">
										'.get_the_post_thumbnail( null, 'kalkulate-cases-thumb', array('class'=> 'img-responsive')).'
									</div>
									<div class="media-body">
										<h3><a class="title" href="'.get_the_permalink().'">'.get_the_title().'</a></h3>
										<p>'.wp_trim_words( get_the_content(), 12, null ).'</p>
										<a class="learn-more" href="'.get_the_permalink().'">LEARN MORE</a>
									</div>
								</div>
	                        </div>
	                    </div>';
	                    $i = $i+ 0.2;
	                endwhile;
					wp_reset_postdata();
				endif;
	        $output .='</div>
		</div>';
	}

	return $output;

});


// Visual Composer
if(class_exists('WPBakeryVisualComposerAbstract')){
	vc_map(array(
		'name'			=> esc_html__( 'kalkulat Cases', 'kalkulat' ),
		'base'			=> 'kalkulate_cases',
		'class'			=> '',
		'description'	=> esc_html__( 'Add kalkulate Cases', 'kalkulat' ),
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
				'value'			=> '1.0',
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