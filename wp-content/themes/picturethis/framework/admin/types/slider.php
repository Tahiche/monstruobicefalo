<?php
function homepage_slider() {
	register_post_type( 'homepage_slider',
		array(
			'labels' => array(
			'name' => __('Homepage Slider'),
			'singular_name' => __('Homepage Slide'),
			'add_new_item' => __('Add New'),
            'edit_item' => __('Edit'),
            'new_item' => __('Add New'),
            'view_item' => __('View'),
		),
		'public' => true,
		'supports' => array( 'title', 'editor', 'thumbnail'),
		'capability_type' => 'post'
		)
	);
}
add_action('init', 'homepage_slider');


?>