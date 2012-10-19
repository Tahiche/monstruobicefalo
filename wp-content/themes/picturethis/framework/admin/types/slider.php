<?php
function fondo_home() {
	register_post_type( 'fondo_home',
		array(
			'labels' => array(
			'name' => __('Fondo Home'),
			'singular_name' => __('Fondo Home'),
			'add_new_item' => __('Add New'),
            'edit_item' => __('Editar Fondo'),
            'new_item' => __('Add New'),
            'view_item' => __('View'),
		),
		'public' => true,
		'supports' => array( 'title', 'attachments'),
		'capability_type' => 'fondo_home',
		'map_meta_cap' => true,
		'capabilities' => array(
				'publish_posts' => 'publish_fondo_homes',
				'edit_posts' => 'edit_fondo_homes',
				'edit_others_posts' => 'edit_others_fondo_homes',
				'delete_posts' => 'delete_fondo_homes',
				'delete_others_posts' => 'delete_others_fondo_homes',
				'read_private_posts' => 'read_private_fondo_homes',
				'edit_post' => 'edit_fondo_home',
				'delete_post' => 'delete_fondo_home',
				'read_post' => 'read_fondo_home',
			),
		)
	);
}
 add_action('init', 'fondo_home');


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