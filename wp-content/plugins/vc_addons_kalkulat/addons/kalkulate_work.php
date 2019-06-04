<?php 

add_shortcode( 'kalkulate_our_work', function($atts, $content = null){
	extract(shortcode_atts(array(
		'post_order' => '',
		'post_limit' => '',


	), $atts));

	$output = '';

	$output .='<div class="work-sction">
            	<div class="work-carousel owl-carousel owl-theme">';
					
					$order = (!empty($post_order) ? $post_order : 'DESC');
					$our_work_query = new WP_Query(array('post_type'=> 'portfolio', 'order'=> $order, 'posts_per_page' => $post_limit));

					if($our_work_query->have_posts()) : 
						while($our_work_query->have_posts()) : $our_work_query->the_post();

						$output.='<div class="work-carousel-item">
				                    <div class="work-item">
				                        <div class="image portfolio-thumb">
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
		'name'			=> esc_html__( 'kalkulat works', 'kalkulat' ),
		'base'			=> 'kalkulate_our_work',
		'class'			=> '',
		'description'	=> esc_html__( 'add kalkulat works', 'kalkulat' ),
		'category'		=> esc_html__( 'kalkulat Shortcode', 'kalkulat' ),
		'params'		=> array(
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