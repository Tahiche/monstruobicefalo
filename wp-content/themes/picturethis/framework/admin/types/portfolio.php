<?php
function portfolio_posttype() {
	register_post_type( 'portfoliocpt',
		array(
			'labels' => array(
			'name' => __('Portfolio'),
			'singular_name' => __('Portfolio'),
			'add_new_item' => __('Add New'),
            'edit_item' => __('Edit'),
            'new_item' => __('Add New'),
            'view_item' => __('View'),
		),
		'public' => true,
		'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes'),
		'capability_type' => 'post',
		)
	);
}
add_action('init', 'portfolio_posttype');

register_taxonomy('portfolio_category','portfoliocpt',array(
	'hierarchical' => true,
	'labels' => array(
		'name' => _x( 'Categories', 'taxonomy general name' ),
		'singular_name' => _x( 'Portfolio Category', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Categories' ),
		'popular_items' => __( 'Popular Categories' ),
		'all_items' => __( 'All Categories' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit Portfolio Category' ), 
		'update_item' => __( 'Update Portfolio Category' ),
		'add_new_item' => __( 'Add New Portfolio Category' ),
		'new_item_name' => __( 'New Portfolio Category Name' ),
		'separate_items_with_commas' => __( 'Separate Portfolio category with commas' ),
		'add_or_remove_items' => __( 'Add or remove portfolio category' ),
		'choose_from_most_used' => __( 'Choose from the most used portfolio category' )
	),
	'show_ui' => true,
	'query_var' => true,
	'rewrite' => false,
));
?>