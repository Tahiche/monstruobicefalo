<?php

// Define Directory Constants 
define('CADEN_FRAME', TEMPLATEPATH . '/framework');
define('CADEN_ADMIN', CADEN_FRAME . '/admin');
define('CADEN_FUNCTIONS', CADEN_FRAME . '/functions');
define('CADEN_INCLUDES', TEMPLATEPATH . '/includes');
define('CADEN_CLASSES', CADEN_FRAME . '/classes');
define('CADEN_JS', get_template_directory_uri() . '/js');
define('TEMPLATEPATH', get_template_directory_uri());

// Load Admin Options
require_once(CADEN_ADMIN . '/options.php');

// Load Admin Interface
require_once(CADEN_ADMIN . '/theme.php');

// Load Shortcodes 
require_once(CADEN_FUNCTIONS . '/shortcodes.php');

/* Load Custom Post Types */
// Portfolio Items
require_once(CADEN_ADMIN . '/types/portfolio.php');

// Homepage Slider
require_once(CADEN_ADMIN . '/types/slider.php');

// Meta Boxes for all post types
require_once(CADEN_ADMIN . '/types/meta_box.php');
require_once(CADEN_ADMIN . '/types/images_meta_box.php');

// Load Header Javascript Files
require_once(CADEN_FUNCTIONS . '/scripts.php');

// Load Custom Widgets
require_once(CADEN_FUNCTIONS . '/widgets.php');

// Load WP-PageNavi Advanced Pagination
require_once(CADEN_INCLUDES . '/wp-pagenavi/wp-pagenavi.php');

// Load Image/Thumb Resizing Script
require_once(CADEN_INCLUDES . '/thumb.php');

//Load Sidebar Generator Plugin
include(CADEN_INCLUDES . '/sidebar-generator.php');

// Add support for thumbnails and menus
add_theme_support( 'post-thumbnails' );
add_theme_support( 'menus' );

/*************************** Register the nav menu in the header */
register_nav_menus( array(
		'primary-menu' => __( 'Header Navigation', 'primary-menu' ),
) );

/*************************** Exclude Portfolio/Sliders from search */
function excludePages($query) {
if ($query->is_search) {
	$query->set('post_type', 'post');
}
	return $query; 
} 
add_filter('pre_get_posts','excludePages'); 

/*************************** Register sidebar */
if ( function_exists('register_sidebar') ) {
	register_sidebar(array('name' => 'Default Sidebar','before_widget' => '','after_widget' => '','before_title' => '<h3>','after_title' => '</h3>'));
}

function new_excerpt_more($more) {
	global $post;
	$show_readmore = get_option('show_readmore');
	$read_more = get_option('read_more');
	if($read_more == "") { $read_more = "Read More"; }
	if(!$show_readmore) {
		return '...<div class="read_more"><a href="'. get_permalink($post->ID) . '">'.$read_more.'</a></div>';
	} else {
		return '...';
	}
}
add_filter('excerpt_more', 'new_excerpt_more');


function new_excerpt_length($length) {
	$excerpt_length = get_option('excerpt_length');
	if($excerpt_length == "") { $excerpt_length = "55"; }
	return $excerpt_length;
}
add_filter('excerpt_length', 'new_excerpt_length');

add_theme_support('automatic-feed-links');

/************************************************* added **************************************************/
/*if ( function_exists( 'add_theme_support' ) ) {
	//echo "add_theme_supportadd_theme_supportadd_theme_supportadd_theme_supportadd_theme_support";
	add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 510, 300, true );
}*/
// this can live in /themes/mytheme/functions.php, or maybe as a dev plugin?
/*function get_template_name () {
	foreach ( debug_backtrace() as $called_file ) {
		foreach ( $called_file as $index ) {
			if ( !is_array($index[0]) AND strstr($index[0],'/themes/') AND !strstr($index[0],'footer.php') ) {
				$template_file = $index[0] ;
			}
		}
	}
	$template_contents = file_get_contents($template_file) ;
	preg_match_all("(Template Name:(.*)\n)siU",$template_contents,$template_name);
	$template_name = trim($template_name[1][0]);
	if ( !$template_name ) { $template_name = '(default)' ; }
	$template_file = array_pop(explode('/themes/', basename($template_file)));
	return $template_file . ' > '. $template_name ;
}*/
?>