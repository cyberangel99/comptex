<?php 

add_shortcode( 'kalkulate_protfolio_one', function($atts, $content = null){
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
	$query = new WP_Query(array( 'post_type' => 'portfolio', 'posts_per_page' => $post_limit, 'order' => $post_order ));

	if($query->have_posts()) {
		$output .='<div class="portfolio-main-content">
		    <div class="row">
		        <div class="col-md-12">';
			        while($query->have_posts()) : $query->the_post();
						$categories = get_the_terms( $post->ID, 'category' );
						foreach( $categories as $category ) {
						    $allCategorys[$category->slug] = $category->name;
						}
					endwhile;
		            $output .='<div class="gallery-filter text-center">
		                <ul>
		                    <li><a href="#!" class="selected" data-filter="*">'.esc_html__( 'All', 'kalkulat' ).'</a></li>';
		                    foreach ($allCategorys as $catSlug => $catName) {
								$output .='<li><a href="#!" data-filter=".'.$catSlug.'">'.$catName.'</a></li>';	
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
	                    $output .='<div class="grid-item '.implode(' ', $currentCategories).'">
	                        <div class="inner-grid '.$is_animation.'" '.$animation_styles.'>';

								$output .='<div class="portfolio-thumb">
									<a class="image-popup-vertical-fit" href="'.get_the_post_thumbnail_url( null, 'kalkulate-portfolio-two-thumb' ).'">
										'.get_the_post_thumbnail( null, 'kalkulate-portfolio-two-thumb', array('class'=> 'img-responsive')).'
										<div class="portfolio-icon">
											<i class="fa fa-search" aria-hidden="true"></i>
										</div>
									</a>
									<div class="portfolio-icon2">
										<a href="'.get_the_permalink().'">
											<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
										</a>
									</div>
								</div>
	                        	<div class="text">
			                        <h4><a href="'.get_the_permalink().'">'.get_the_title().'</a></h4>
			                        <span class="category">'.get_post_meta( get_the_ID(), '__kalkulate__portfolio_sub_title', true ).'</span>
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
		'name'			=> esc_html__( 'kalkulat Protfolio one', 'kalkulat' ),
		'base'			=> 'kalkulate_protfolio_one',
		'class'			=> '',
		'description'	=> esc_html__( 'Add kalkulate Protfolio', 'kalkulat' ),
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