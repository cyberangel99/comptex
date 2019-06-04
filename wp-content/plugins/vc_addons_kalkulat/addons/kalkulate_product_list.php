<?php 
add_shortcode( 'kalkulate_product_list', function($atts, $content = null){
	extract(shortcode_atts(array(
		'product_cat_select' => '',
		'post_order' 		 => '',
		'post_limit' 		 => '',
		'title' 			 => '',

	), $atts));

	$output = '';

	if($product_cat_select == 2) {
		$output .='<div class="kalkulate-shop-vc">';
			//One Sale Query
	        $query = new WP_Query( array(
	        	'post_type' 		=> 'product',
	        	'posts_per_page'	=> $post_limit, 
	        	'order' 			=> $post_order,
	        	'meta_query'        => WC()->query->get_meta_query(),
	    		'post__in'          => array_merge( array( 0 ), wc_get_product_ids_on_sale() ),

	        ) );

	        if(!empty($title)){
				$output .='<h4 class="shop-product-list-title">'.$title.'</h4>';
			}
	        if($query->have_posts()) :
	            while($query->have_posts()) : $query->the_post();
		            global $product,$post;
		        	$output .='<div class="shop-product-list">
			        	<div class="media">
			        		<div class="media-left">
			        			'.get_the_post_thumbnail( null, 'kalkulate-shop-product-list', array('class'=> 'img-responsive')).'
			        		</div>
			        		<div class="media-body">
			        			<a href="'.get_the_permalink().'" class="title">'.get_the_title().'</a>
			        			<div class="price">'.$product->get_price_html().'</div>
			        		</div>
			        	</div>
			        </div>';
	            endwhile;
	            wp_reset_postdata();
	        endif;
	    $output .='</div>';
	}else if($product_cat_select == 3) {
		$output .='<div class="kalkulate-shop-vc">';
	        //feature Sale Query
			$tax_query[] = array(
			    'taxonomy' => 'product_visibility',
			    'field'    => 'name',
			    'terms'    => 'featured',
			    'operator' => 'IN', // or 'NOT IN' to exclude feature products
			);
			// The query
			$query = new WP_Query( array(
			    'post_type'           => 'product',
			    'post_status'         => 'publish',
			    'ignore_sticky_posts' => 1,
			    'posts_per_page'      => $post_limit,
			    'order'               => $post_order,
			    'tax_query'           => $tax_query,
			) );

	        if(!empty($title)){
				$output .='<h4 class="shop-product-list-title">'.$title.'</h4>';
			}
	        if($query->have_posts()) :
	            while($query->have_posts()) : $query->the_post();
		            global $product,$post;
		        	$output .='<div class="shop-product-list">
			        	<div class="media">
			        		<div class="media-left">
			        			'.get_the_post_thumbnail( null, 'kalkulate-shop-product-list', array('class'=> 'img-responsive')).'
			        		</div>
			        		<div class="media-body">
			        			<a href="'.get_the_permalink().'" class="title">'.get_the_title().'</a>
			        			<div class="price">'.$product->get_price_html().'</div>
			        		</div>
			        	</div>
			        </div>';
	            endwhile;
	            wp_reset_postdata();
	        endif;
	    $output .='</div>';
	}
	else if($product_cat_select == 4) {
		$output .='<div class="kalkulate-shop-vc">';
	        //Top Sale Query
			$args = array(
			    'post_type'      => 'product',
			    'posts_per_page' => $post_limit,
			    'order'          => $post_order,
			    'meta_query'     => array(
			        'relation' => 'OR',
			        array( // Simple products type
			            'key'           => '_sale_price',
			            'value'         => 0,
			            'compare'       => '>',
			            'type'          => 'numeric'
			        ),
			        array( // Variable products type
			            'key'           => '_min_variation_sale_price',
			            'value'         => 0,
			            'compare'       => '>',
			            'type'          => 'numeric'
			        )
			    )
			);
			$query = new WP_Query( $args );

	        if(!empty($title)){
				$output .='<h4 class="shop-product-list-title">'.$title.'</h4>';
			}
	        if($query->have_posts()) :
	            while($query->have_posts()) : $query->the_post();
		            global $product,$post;
		        	$output .='<div class="shop-product-list">
			        	<div class="media">
			        		<div class="media-left">
			        			'.get_the_post_thumbnail( null, 'kalkulate-shop-product-list', array('class'=> 'img-responsive')).'
			        		</div>
			        		<div class="media-body">
			        			<a href="'.get_the_permalink().'" class="title">'.get_the_title().'</a>
			        			<div class="price">'.$product->get_price_html().'</div>
			        		</div>
			        	</div>
			        </div>';
	            endwhile;
	            wp_reset_postdata();
	        endif;
	    $output .='</div>';
	}else {
		$output .='<div class="kalkulate-shop-vc">';
	        $query = new WP_Query( array(
	        	'post_type' 		=> 'product',
	        	'posts_per_page'	=> $post_limit, 
	        	'order' 			=> $post_order,

	        ) );

	        if(!empty($title)){
				$output .='<h4 class="shop-product-list-title">'.$title.'</h4>';
			}
	        if($query->have_posts()) :
	            while($query->have_posts()) : $query->the_post();
		            global $product,$post;
		        	$output .='<div class="shop-product-list">
			        	<div class="media">
			        		<div class="media-left">
			        			'.get_the_post_thumbnail( null, 'kalkulate-shop-product-list', array('class'=> 'img-responsive')).'
			        		</div>
			        		<div class="media-body">
			        			<a href="'.get_the_permalink().'" class="title">'.get_the_title().'</a>
			        			<div class="price">'.$product->get_price_html().'</div>
			        		</div>
			        	</div>
			        </div>';
	            endwhile;
	            wp_reset_postdata();
	        endif;
	    $output .='</div>';
	}
    

	return $output;
});                

// Visual Composer
if(class_exists('WPBakeryVisualComposerAbstract')){
	vc_map(array(
		'name'			=> esc_html__( 'kalkulat Product List', 'kalkulat' ),
		'base'			=> 'kalkulate_product_list',
		'class'			=> '',
		'description'	=> esc_html__( 'Kalkulat Woocommerce Posts', 'kalkulat' ),
		'category'		=> esc_html__( 'kalkulat Shortcode', 'kalkulat' ),
		'params'		=> array(
			array(
				'type'		=> 'dropdown',
				'heading'	=> esc_html__( 'Product List Category', 'kalkulat' ),
				'param_name' => 'product_cat_select',
				'value'		 => array(
					esc_html__( 'Recent', 'kalkulat' ) 		=> 1,
					esc_html__( 'On Sale', 'kalkulat' ) 	=> 2,
					esc_html__( 'Featured', 'kalkulat' ) 	=> 3,
					esc_html__( 'Top Sale', 'kalkulat' ) 	=> 4,
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
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Title', 'kalkulat' ),
				'param_name'	=> 'title',
				'value'         => ''
			),
		)
	));
}