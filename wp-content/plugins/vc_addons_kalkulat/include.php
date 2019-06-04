<?php
// product post type
function get_all_product_cat_id(){
	$list = array();
	$product_category = get_terms( array(
	    'taxonomy' => 'product_cat',
	    'hide_empty' => false,
	) );

	foreach ($product_category as $product_category_item) {
		$list[$product_category_item->name] = $product_category_item->term_id;
	}

	return $list;

}
