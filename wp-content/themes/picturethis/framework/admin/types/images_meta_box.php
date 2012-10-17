<?php
/**
 * Registering meta boxes
 *
 * In this file, I'll show you how to extend the class to add more field type (in this case, the 'taxonomy' type)
 * All the definitions of meta boxes are listed below with comments, please read them carefully.
 * Note that each validation method of the Validation Class MUST return value instead of boolean as before
 *
 * You also should read the changelog to know what has been changed
 *
 * For more information, please visit: http://www.deluxeblogtips.com/2010/04/how-to-create-meta-box-wordpress-post.html
 *
 */

/********************* BEGIN EXTENDING CLASS ***********************/

/**
 * Extend RW_Meta_Box class
 * Add field type: 'taxonomy'
 */
class RW_Meta_Box_Taxonomy extends RW_Meta_Box {
	
	function add_missed_values() {
		parent::add_missed_values();
		
		// add 'multiple' option to taxonomy field with checkbox_list type
		foreach ($this->_meta_box['fields'] as $key => $field) {
			if ('taxonomy' == $field['type'] && 'checkbox_list' == $field['options']['type']) {
				$this->_meta_box['fields'][$key]['multiple'] = true;
			}
		}
	}
	
	// show taxonomy list
	function show_field_taxonomy($field, $meta) {
		global $post;
		
		if (!is_array($meta)) $meta = (array) $meta;
		
		$this->show_field_begin($field, $meta);
		
		$options = $field['options'];
		$terms = get_terms($options['taxonomy'], $options['args']);
		
		// checkbox_list
		if ('checkbox_list' == $options['type']) {
			foreach ($terms as $term) {
				echo "<input type='checkbox' name='{$field['id']}[]' value='$term->slug'" . checked(in_array($term->slug, $meta), true, false) . " /> $term->name<br/>";
			}
		}
		// select
		else {
			echo "<select name='{$field['id']}" . ($field['multiple'] ? "[]' multiple='multiple' style='height:auto'" : "'") . ">";
		
			foreach ($terms as $term) {
				echo "<option value='$term->slug'" . selected(in_array($term->slug, $meta), true, false) . ">$term->name</option>";
			}
			echo "</select>";
		}
		
		$this->show_field_end($field, $meta);
	}
}

/********************* END EXTENDING CLASS ***********************/

/********************* BEGIN DEFINITION OF META BOXES ***********************/

// prefix of meta keys, optional
// use underscore (_) at the beginning to make keys hidden, for example $prefix = '_rw_';
// you also can make prefix empty to disable it
$prefix = 'cg_';

$meta_boxes = array();

$meta_boxes[] = array(
	'id' => 'background',
	'title' => 'Background Image(s)',
	'pages' => array('post', 'page', 'portfoliocpt'),

	'fields' => array(
		array(
			'name' => 'Use Default Background Image',
			'id' => $prefix . 'default_image',
			'type' => 'radio',						// radio box
			'options' => array(						// array of key => value pairs for radio options
				'y' => 'Default Background Image',
				'n' => 'Custom Slideshow',
				'h' => 'Homepage Slideshow'
			),
			'std' => 'y',
			'desc' => 'If yes is selected, when viewed, this page/post will show just the default background image set in the theme options panel. If selected no, images uploaded below (or custom background image) will be used.'
		),
		array(
			'name' => 'Custom Background Image',					// field name
			'desc' => 'If you want to display a custom background image instead of using the default background image or image slideshow, enter the URL here.',	// field description, optional
			'id' => $prefix . 'custom_bg_image',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => '',					// default value, optional
		),
		array(
			'name' => 'Background Images',
			'desc' => 'Upload the images you want to use for the background slider. You can upload as many as you want.',
			'id' => $prefix . 'bg_image',
			'type' => 'image'						// image upload
		)
	)
);

$meta_boxes[] = array(
	'id' => 'pages',
	'title' => 'Page Title',
	'pages' => array('page'),

	'fields' => array(
		array(
			'name' => 'Show/Hide Page Title',
			'id' => $prefix . 'page_title',
			'type' => 'radio',						// radio box
			'options' => array(						// array of key => value pairs for radio options
				'y' => 'Show',
				'n' => 'Hide'
			),
			'std' => 'y',
			'desc' => 'If "Show" is selected, by default the page title will be included above the page content'
		),
		array(
			'name' => 'Custom Page Title',					// field name
			'desc' => 'If you want to display a page title different from the title entered above, enter it here.',	// field description, optional
			'id' => $prefix . 'custom_title',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => '',					// default value, optional
		)
	)
);

$meta_boxes[] = array(
	'id' => 'portfolio_options',
	'title' => 'Portfolio Options',
	'pages' => array('page'),
	'fields' => array(
		array(
			'name' => 'Categories',
			'id' => $prefix . 'portfolio_cat',
			'type' => 'taxonomy',					// taxonomy
			'options' => array(
				'taxonomy' => 'portfolio_category',			// taxonomy name
				'type' => 'select',					// how to show taxonomy? 'select' (default) or 'checkbox_list'
				'args' => array()					// arguments to query taxonomy, see http://goo.gl/795Vm
			),
			'desc' => 'Choose the portfolio category that you want to display'
		),
		array(
			'name' => 'Posts Per Page',					// field name
			'desc' => 'Enter the number of portfolio items you want to display per page',	// field description, optional
			'id' => $prefix . 'items_per_page',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => '12',					// default value, optional
		),
		array(
			'name' => 'Use Lightbox Thumbnail Gallery',
			'id' => $prefix . 'lb_gallery',
			'type' => 'radio',						// radio box
			'options' => array(						// array of key => value pairs for radio options
				'y' => 'Yes',
				'n' => 'No'
			),
			'std' => 'y',
			'desc' => 'If yes is selected, when the lightbox is opened, the user will be able to navigate through the other images by clicking on the arrows/thumbnails.'
		),
	)
);

$meta_boxes[] = array(
	'id' => 'lightbox_options',
	'title' => 'Portfolio Options',
	'pages' => array('portfoliocpt'),
	'fields' => array(
	array(
			'name' => 'Image Link Options',
			'id' => $prefix . 'image_url',
			'type' => 'radio',						// radio box
			'options' => array(						// array of key => value pairs for radio options
				'y' => 'Lightbox',
				'n' => 'Page/Custom URL'
			),
			'std' => 'y',
			'desc' => 'If "lightbox" is selected, when the image is clicked the lightbox will open (enter URL below). If "Page/Custom URL" is selected, when the image is clicked, it will redirect to that specific portfolio item page. If you want to link to a custom URL instead of the single portfolio page, you can enter the URL below. If empty, when the image is clicked it will automatically redirect to the single item page.'
		),
		array(
			'name' => 'Custom Page URL (Only if "Page/Custom URL" is selected above)',					// field name
			'desc' => 'Enter the URL that you want to be redirected to when the portfolio image is clicked (only if "Page/Custom URL" is selected above). If left empty, the image will redirect to the single portfolio page.',	// field description, optional
			'id' => 'custom_image_url',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => '',					// default value, optional
		),
		array(
			'name' => 'Lightbox Video URL',					// field name
			'desc' => 'IF you want to use a video in the lightbox instead of an image, enter the URL of the video (youtube, vimeo) you want to display when the lightbox is opened. If this text field is not empty, it will take precedence over the thumbnail.',	// field description, optional
			'id' => '_lburl',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => '',					// default value, optional
		),
		array(
			'name' => 'Lightbox Title',					// field name
			'desc' => 'The title of the lightbox image/video URL.',	// field description, optional
			'id' => '_lbtitle',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => '',					// default value, optional
		),
		array(
			'name' => 'Lightbox Image/Video Description',					// field name
			'desc' => 'The description of the lightbox image/video URL.',	// field description, optional
			'id' => 'lbdesc',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => '',					// default value, optional
		),
	)
);

$meta_boxes[] = array(
	'id' => 'single_portfolio_page',
	'title' => 'Single Portfolio Item Page',
	'pages' => array('portfoliocpt'),
	'fields' => array(
		array(
			'name' => 'Image URL #1',					// field name
			'desc' => '530px x Unlimited',	// field description, optional
			'id' => 'p_image_one',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => '',					// default value, optional
		),
		array(
			'name' => 'Image URL #2',					// field name
			'desc' => '530px x Unlimited',	// field description, optional
			'id' => 'p_image_two',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => '',					// default value, optional
		),
		array(
			'name' => 'Image URL #3',					// field name
			'desc' => '530px x Unlimited',	// field description, optional
			'id' => 'p_image_three',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => '',					// default value, optional
		),
		array(
			'name' => 'Image URL #4',					// field name
			'desc' => '530px x Unlimited',	// field description, optional
			'id' => 'p_image_four',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => '',					// default value, optional
		),
		array(
			'name' => 'Image URL #5',					// field name
			'desc' => '530px x Unlimited',	// field description, optional
			'id' => 'p_image_five',				// field id, i.e. the meta key
			'type' => 'text',						// text box
			'std' => '',					// default value, optional
		),

	)
);

foreach ($meta_boxes as $meta_box) {
	$my_box = new RW_Meta_Box_Taxonomy($meta_box);
}

/********************* END DEFINITION OF META BOXES ***********************/

/********************* BEGIN VALIDATION ***********************/

/**
 * Validation class
 * Define ALL validation methods inside this class
 * Use the names of these methods in the definition of meta boxes (key 'validate_func' of each field)
 */
class RW_Meta_Box_Validate {
	function check_name($text) {
		if ($text == 'Anh Tran') {
			return 'He is Rilwis';
		}
		return $text;
	}
}

/********************* END VALIDATION ***********************/
?>
