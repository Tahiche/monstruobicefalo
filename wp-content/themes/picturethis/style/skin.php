<?php require_once( '../../../../wp-load.php' );
Header("Content-type: text/css");

/**** GET CUSTOM COLORS/TEXTURES ****/
$sidebar_bg_color = get_option('sidebar_bg_color');
$sidebar_texture = get_option('sidebar_texture');
$logo_color = get_option('logo_color');
$nav_link_color = get_option('nav_link_color');
$nav_subtext_color = get_option('nav_subtext_color');
$nav_divider_color = get_option('nav_divider_color');
$nav_text_color = get_option('nav_text_color');
$page_bg_color = get_option('page_bg_color');
$grid_title_bg_color = get_option('grid_title_bg_color');
$grid_title_color = get_option('grid_title_color');
$page_content_bg_color = get_option('page_content_bg_color');
$page_content_text_color = get_option('page_content_text_color');
$h1_color = get_option('h1_color');
$h2_color = get_option('h2_color');
$h3_color = get_option('h3_color');
$h4_color = get_option('h4_color');
$h5_color = get_option('h5_color');
$h6_color = get_option('h6_color');
$pagi_bg_color = get_option('pagi_bg_color');
$pagi_current_color = get_option('pagi_current_color');
$pagi_link_color = get_option('pagi_link_color');
$font_family = get_option('font_family');
$pagi_font = get_option('pagi_font');
$texture_url = get_option('texture_url');
$texture = get_option('texture');
$search_text_color = get_option('search_text_color');
$search_bg_color = get_option('search_bg_color');
$page_text_link_color = get_option('page_text_link_color');
$widget_border_color = get_option('widget_border_color');
$sidebar_opacity = get_option('sidebar_opacity');
$sidebar_list_border_color = get_option('sidebar_list_border_color');
$blog_title_color = get_option('blog_title_color');
$blog_title_hover = get_option('blog_title_hover');
$blog_title_page = get_option('blog_title_page');
$sidebar_text_color = get_option('sidebar_text_color');
$sidebar_link_color = get_option('sidebar_link_color');
$sidebar_link_hover = get_option('sidebar_link_hover');
$page_text_link_hover_color = get_option('page_text_link_hover_color');
$tag_link_color = get_option('tag_link_color');
$tag_link_hover = get_option('tag_link_hover');
$logo_bg_color = get_option('logo_bg_color');
$logo_color = get_option('logo_color');
$nav_link_bg_color = get_option('nav_link_bg_color');
$nav_link_text_color = get_option('nav_link_text_color');
$dd_bg_color = get_option('dd_bg_color');
$dd_link_color = get_option('dd_link_color');
$dd_link_hover_color = get_option('dd_link_hover_color');

$logo_width = get_option('logo_width');
if($logo_width == "") {
	$logo_width = 152;
}
$margin_left = $logo_width + 80;

if($sidebar_list_border_color == "") {
	$sidebar_list_border_color = "#000";
}

$h1_size = get_option('h1_size');
$h2_size = get_option('h2_size');
$h3_size = get_option('h3_size');
$h4_size = get_option('h4_size');
$h5_size = get_option('h5_size');
$h6_size = get_option('h6_size');
$font_size = get_option('font_size');

/**** MAIN FONT FAMILY ****/
if($font_family == "Lucida Sans Unicode, Lucida Grande, Garuda, sans-serif") {
	$font_family = '"Lucida Sans Unicode", "Lucida Grande", Garuda, sans-serif';
}
if($font_family == "Georgia, Nimbus Roman No9 L, serif") {
	$font_family = 'Georgia, "Numbus Roman No9 L", serif';
}
if($font_family == "Trebuchet MS, Helvetica, Jamrul, sans-serif") {
	$font_family = '"Trebuchet MS", Helvetica, Jamrul, sans-serif';
}
if($font_family == "Times New Roman, Times, FreeSerif, serif") {
	$font_family = '"Times New Roman", Times, FreeSerif, serif';
}

/**** PAGINATION FONT FAMILT ****/
if($pagi_font == "Lucida Sans Unicode, Lucida Grande, Garuda, sans-serif") {
	$pagi_font = '"Lucida Sans Unicode", "Lucida Grande", Garuda, sans-serif';
}
if($pagi_font == "Georgia, Nimbus Roman No9 L, serif") {
	$pagi_font = 'Georgia, "Numbus Roman No9 L", serif';
}
if($pagi_font == "Trebuchet MS, Helvetica, Jamrul, sans-serif") {
	$pagi_font = '"Trebuchet MS", Helvetica, Jamrul, sans-serif';
}
if($pagi_font == "Times New Roman, Times, FreeSerif, serif") {
	$pagi_font = '"Times New Roman", Times, FreeSerif, serif';
}

/**** OUPUT CSS CODE ****/
echo <<<CSS

body {
	font-size: {$font_size}px;
	font-family: {$font_family};
}

#logo, #sitename {
	background-color: {$logo_bg_color};
}
#logo {
	width: {$logo_width}px;
}
#sitename a {
	color: {$logo_color};
}
.navigation ul.menu li a {
	background-color: {$nav_link_bg_color};
	color: {$nav_link_text_color};
}
.navigation ul.menu li ul li a {
	background-color: {$dd_bg_color};
	color: {$dd_link_color};
}
.navigation ul.menu li ul li a:hover {
	color: {$dd_link_hover_color};
}
h1 {
	font-size: {$h1_size}px;
}
h2, .blog_post h2 {
	font-size: {$h2_size}px;
}
h3 {
	font-size: {$h3_size}px;
}
h4 {
	font-size: {$h4_size}px;
}
h5 {
	font-size: {$h5_size}px;
}
h6 {
	font-size: {$h6_size}px;
}
p { 
	font-size: {$font_size}px;
	font-family: {$font_family}; 
}
#header #sitename a {
	color: {$logo_color};
}
#header #search input {
	background-color: {$search_bg_color};
	color: {$search_text_color};
}
#page li h2 a {
	color: {$grid_title_color};
}
#page li h2 {
	background-color: {$grid_title_bg_color};
}
#sidebar ul li {
	border-color: {$sidebar_list_border_color};
}
#mainpage {
	margin-left: {$margin_left}px;
}
.commentlist li {
	border-color: {$sidebar_list_border_color};
}
a, #content .metaInfo a, #content a, #sidebar a {
	color: {$page_text_link_color};
}
a:hover, #content .metaInfo a:hover, #content a:hover, #sidebar a:hover {
	color: {$page_text_link_hover_color};	
}
.page_content {
	background-color: {$page_content_bg_color};
}
.page_content, .page_content p, #sidebar, #sidebar p, body {
	color: {$page_content_text_color};
}

#content .blog_post h2 a {
	color: {$blog_title_color};
}
#content .blog_post h2 a:hover {
	color: {$blog_title_hover};
}
#content .blog_post h2 {
	color: {$blog_title_page};
}

#sidebar a {
	color: {$sidebar_link_color};
}
#sidebar a:hover {
	color: {$sidebar_link_hover};
}
#sidebar, #sidebar p, #sidebar .date {
	color: {$sidebar_text_color};
}
#sidebar .tagcloud a {
	color: {$tag_link_color};
}
#sidebar .tagcloud a:hover {
	color: {$tag_link_hover};
}
#sidebar .tagcloud a {
	background: {$widget_border_color};
}
.wp-pagenavi {
	font-family: {$pagi_font};
}
.wp-pagenavi a, .wp-pagenavi .current {
	background-color: {$pagi_bg_color};
}
.wp-pagenavi .current {
	color: {$pagi_current_color};
}
.wp-pagenavi a {
	color: {$pagi_link_color};
}
h1 {
	color: {$h1_color};
}
h2 {
	color: {$h2_color};
}
h3 {
	color: {$h3_color};
}
h4 {
	color: {$h4_color};
}
h5 {
	color: {$h5_color};
}
h6 {
	color: {$h6_color};
}
.thumbnail-list li img {
	border-color: {$widget_border_color};
}
.tagcloud a {
	background-color: {$widget_border_color};
}
CSS;
?>