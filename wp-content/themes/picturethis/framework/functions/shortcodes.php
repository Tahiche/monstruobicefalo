<?php

// Remove Randomly Generated Paragraph & newline tags
function remove_wpautop($content) { 
    $content = do_shortcode( shortcode_unautop($content) ); 
    $content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );
    return $content;
}

/*###################################################
# BLOG SHORTCODE
###################################################*/
function blog_shortcode( $atts, $content = null, $code) {
	global $wp_filter;
	$the_content_filter_backup = $wp_filter['the_content'];
	extract(shortcode_atts(array(
		'max'		=> 3,
		'cat' 		=> '',
		'meta'		=> '',
		'thumb'		=> '',
		'width'		=> '',
		'height'	=> '',
		), $atts));
		
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$query = array(
			'post_type' => 'post', 
			'posts_per_page' => $max,
			'paged' => $paged,
		);
		if(!$cat){
			$query['cat'] = "1";
		}
		
		$r = new WP_Query($query);
	if ($r->have_posts()):
		while ($r->have_posts()) : $r->the_post();

			$output .= '<div class="blog_post">';
			$output .= '<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
			if($meta == "true" || $meta == "") {
				$output .= '<div class="metaInfo">Posted By ';
				$output .= get_the_author_link();
				$output .= ' / ';
				
				$output .= get_the_time('F, j, Y'); 
				$output .= ' / <a href="';
				
				$output .= get_comments_link(); 
				$output .= '">';
				$output .= get_comments_number('0','1','%');
				$output .= ' comments</a></div>';
			}
				
			if(has_post_thumbnail()) { 
				if($thumb == "full" || $thumb == "") {
					$output .= '<div class="post_thumbnail">';
				} elseif($thumb == "left") { 
					$output .= '<div class="post_thumbnail_left">';
				}
				
				$thumbnail = get_post_thumbnail_id(); 
				
				if($thumb == "full" || $thumb == "") {
					$img = vt_resize( $thumbnail,'' , 510, 280, true, 70 );
				} elseif($thumb == "left") { 
					$img = vt_resize( $thumbnail,'' , 260, 240, true, 70 );
				}
			
				$output .= '<a href="'.get_permalink().'"><img src="'.$img[url].'" width="'.$img[width].'" height="'.$img[height].'" alt="'.$lbtitle.'" /></a>';
				
				$output .= '</div>';
					
			}
			
			$output .= apply_filters('the_content',get_the_content());

			$output .= '</div>';
		
		endwhile; endif;
	
		ob_start();
		wp_pagenavi();
		$output .= ob_get_clean();

		wp_reset_query();
	$wp_filter['the_content'] = $the_content_filter_backup;
	return $output;
}
add_shortcode('blog', 'blog_shortcode');


/*###################################################
# GALLERY SHORTCODES
###################################################*/
function cg_gallery_shortcode ( $atts, $content = null) {
	global $wp_filter;
	$the_content_filter_backup = $wp_filter['the_content'];
	extract(shortcode_atts(array(
		'cols'		=> '',
		'max'		=> '',
		'gallery' 	=> '',
		'cat'		=> '',
		), $atts));
		
		$output = '<div id="gallery">';
		if($cols == "1") {
			$output .= '<ul class="gallery-two-column">';
		} elseif($cols == "2") {
			$output .= '<ul class="gallery-two-column">';
		} elseif($cols == "3") {
			$output .= '<ul class="gallery-three-column">';
		} elseif($cols == "4") {
			$output .= '<ul class="gallery-four-column">';
		} 
		if($cols == "") {
			$output .= '<ul class="one-column">';
		}
		
		$c = explode(',', $cat);

		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$query = array(
			'tax_query' => array(
				array(
					'post_type' => 'gallerycpt',
					'posts_per_page' => $max,
					'taxonomy' => 'gallery_category',
					'field' => 'slug',
					'terms' => $c,
					'paged' => $paged,
					'orderby' => 'menu_order',
					'order' => 'ASC'
				)
			)
		);
		
		$r = new WP_Query($query);
	if ($r->have_posts()):
		while ($r->have_posts()) : $r->the_post();
			
			$output .= '<li>';
			
			$lbtitle = get_post_meta(get_the_id(), "_lbtitle", true);
			$url = get_post_meta(get_the_id(), "_lburl", true);	
			$thumb = get_post_thumbnail_id(); 
			if($cols == "0" || $cols == "") {
				$image = vt_resize( $thumb,'' , 390, 240, true, 70 );
			} elseif($cols == "1") {
				$image = vt_resize( $thumb,'' , 390, 240, true, 70 );
			} elseif($cols == "2") {
				$image = vt_resize( $thumb,'' , 390, 240, true, 70 );
			} elseif($cols == "3") {
				$image = vt_resize( $thumb,'' , 250, 170, true, 70 );
			} elseif($cols == "4") {
				$image = vt_resize( $thumb,'' , 190, 130, true, 70 );
			}
			
			if($gallery == "true") {
				$output .= '<a href="'.$url.'" rel="prettyPhoto[cg_gal]"><img src="'.$image[url].'" width="'.$image[width].'" height="'.$image[height].'" alt="'.$lbtitle.'" /></a>';
			} else {
				$output .= '<a href="'.$url.'" rel="prettyPhoto"><img src="'.$image[url].'" width="'.$image[width].'" height="'.$image[height].'" alt="'.$lbtitle.'" /></a>';	
			}

			
			$output .= '</li>';
		
		endwhile; endif;
		
		$output .= '</ul>';
		$output .= '</div>';
		
		ob_start();
		wp_pagenavi();
		$output .= ob_get_clean();
		
		wp_reset_query();
		$wp_filter['the_content'] = $the_content_filter_backup;
		return $output;
}
add_shortcode('gallery', 'cg_gallery_shortcode');


/*###################################################
# LIGHTBOX SHORTCODE
###################################################*/
function image_lightbox ( $atts, $content = null) {
	extract(shortcode_atts(array(
		'link'		=> '',
		'title' 	=> '',
		), $atts));
		
		$out = "<a href=\"" .$link. "\" rel=\"prettyPhoto\" title=\"" .$title. "\" alt=\"" .$title. "\">" .remove_wpautop($content). "</a>";
		
		return $out;
}
add_shortcode('lightbox', 'image_lightbox');

/*###################################################
# LIST SHORTCODES
###################################################*/
function list_styles ( $atts, $content = null) {
	extract(shortcode_atts(array(
		'style'		=> '',
		), $atts));
		
		$out = "<div class=\"list_".$style."\">".remove_wpautop($content)."</div>";
		
		return $out;
}
add_shortcode('list', 'list_styles');


/*###################################################
# BUTTON SHORTCODES
###################################################*/
function caden_button( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'link'      => '',
		'color'     => '',
		'size'      => '',
		'type'		=> '',
    ), $atts));

	if($type == "") {
		$out = "<a href=\"" .$link. "\" class=\"button b_" .$color. " b_" .$size. "\">" .remove_wpautop($content). "</a>";
	} else {
		$out = "<div class=\"button b_" .$color. " b_" .$size. "\">" .remove_wpautop($content). "</div>";
	}
    
    return $out;
}
add_shortcode('button', 'caden_button');


/*###################################################
# Toggle Shortcode
###################################################*/
function theme_shortcode_toggle($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'title' => false
	), $atts));
	return '<div class="toggle"><h4 class="toggle_title">' . $title . '</h4><div class="toggle_content">' . remove_wpautop($content) . '</div></div>';
}
add_shortcode('toggle', 'theme_shortcode_toggle');



/*###################################################
# Highlight Shortcodes
###################################################*/
function caden_highlight( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'color'     => '',
    ), $atts));

	return '<span class="highlight_' .$color. '">' .do_shortcode($content). '</span>';
}
add_shortcode('highlight', 'caden_highlight');



/*###################################################
# Blockquote Shortcodes
###################################################*/
function caden_blockquote( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'align'     => '',
		'cite'		=> '',
    ), $atts));

	if($align == "") {
		return '<blockquote class="block">' .do_shortcode($content). '<br /><cite>- ' .$cite. '</cite></blockquote>';
	}  else {
		return '<blockquote class="align'.$align.'">' .do_shortcode($content). '</blockquote>';
	}
}
add_shortcode('blockquote', 'caden_blockquote');



/*###################################################
# Image Shortcodes
###################################################*/
function caden_imagealign( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'align'     => '',
    ), $atts));

	return '<div class="image' .$align. '">' .do_shortcode($content). '</div>';
}
add_shortcode('image', 'caden_imagealign');



/*###################################################
# Styled Boxes Shortcodes
###################################################*/

// Error styled box
function caden_errorbox( $atts, $content = null ) {
	return '<div class="error"><img src="' .get_template_directory_uri(). '/images/erroricon.gif" class="icon" />' . do_shortcode($content) . '</div>';
}
add_shortcode('error', 'caden_errorbox');

// Success styled box
function caden_successbox( $atts, $content = null ) {
	return '<div class="success"><img src="' .get_template_directory_uri(). '/images/successicon.gif" class="icon" />' . do_shortcode($content) . '</div>';
}
add_shortcode('success', 'caden_successbox');

// Info styled box
function caden_infobox( $atts, $content = null ) {
	return '<div class="info"><img src="' .get_template_directory_uri(). '/images/infoicon.gif" class="icon" />' . do_shortcode($content) . '</div>';
}
add_shortcode('info', 'caden_infobox');

// Note box
function caden_notebox( $atts, $content = null ) {
	return '<div class="note"><img src="' .get_template_directory_uri(). '/images/noteicon.gif" class="icon" />' . do_shortcode($content) . '</div>';
}
add_shortcode('note', 'caden_notebox');



/*###################################################
# Typography Shortcodes
###################################################*/

function caden_dropcap( $atts, $content = null ) {
    return '<span class="dropcap">' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap', 'caden_dropcap');

function caden_dropcap_two( $atts, $content = null ) {
    return '<span class="dropcap2">' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap2', 'caden_dropcap_two');



/*###################################################
# Column Shortcodes
###################################################*/

function caden_onethird( $atts, $content = null ) {
	return '<div class="one_third">' . remove_wpautop($content) . '</div>';
}
add_shortcode('one_third', 'caden_onethird');

function caden_onethirdlast( $atts, $content = null ) {
	return '<div class="one_third last">' . remove_wpautop($content) . '</div>';
}
add_shortcode('one_third_last', 'caden_onethirdlast');

// One half
function caden_onehalf( $atts, $content = null) {
	return '<div class="one_half">' . remove_wpautop($content) . '</div>';
}
add_shortcode('one_half', 'caden_onehalf');

// One half last
function caden_onehalflast( $atts, $content = null) {
	return '<div class="one_half last">' . remove_wpautop($content) . '</div>';
}
add_shortcode('one_half_last', 'caden_onehalflast');

// One fourth column shortcode 
function caden_onefourth( $atts, $content = null) {
	return '<div class="one_fourth">' . remove_wpautop($content) . '</div>';
}
add_shortcode('one_fourth', 'caden_onefourth');

// One fourth column last shortcode 
function caden_onefourthlast( $atts, $content = null) {
	return '<div class="one_fourth last">' . remove_wpautop($content) . '</div>';
}
add_shortcode('one_fourth_last', 'caden_onefourthlast');

// Three fourth
function caden_threefourth( $atts, $content = null) {
	return '<div class="three_fourth">' . remove_wpautop($content) . '</div>';
}
add_shortcode('three_fourths', 'caden_threefourth');

// Three fourth last
function caden_threefourthlast( $atts, $content = null) {
	return '<div class="three_fourth last">' . remove_wpautop($content) . '</div>';
}
add_shortcode('three_fourths_last', 'caden_threefourthlast');

// Two thirds column shortcode 
function caden_twothirds( $atts, $content = null) {
	return '<div class="two_third">' . remove_wpautop($content) . '</div>';
}
add_shortcode('two_thirds', 'caden_twothirds');

// Two thirds column shortcode 
function caden_twothirdslast( $atts, $content = null) {
	return '<div class="two_third last">' . remove_wpautop($content) . '</div>';
}
add_shortcode('two_thirds_last', 'caden_twothirdslast');


// One fifth
function caden_onefifth( $atts, $content = null) {
	return '<div class="one_fifth">' . remove_wpautop($content) . '</div>';
}
add_shortcode('one_fifth', 'caden_onefifth');

// One fifth last
function caden_onefifthlast( $atts, $content = null) {
	return '<div class="one_fifth last">' . remove_wpautop($content) . '</div>';
}
add_shortcode('one_fifth_last', 'caden_onefifthlast');

// Two fifth
function caden_twofifth( $atts, $content = null) {
	return '<div class="two_fifth">' . remove_wpautop($content) . '</div>';
}
add_shortcode('two_fifths', 'caden_twofifth');

// Two fifth last
function caden_twofifthlast( $atts, $content = null) {
	return '<div class="two_fifth last">' . remove_wpautop($content) . '</div>';
}
add_shortcode('two_fifths_last', 'caden_twofifthlast');

// Three fifth
function caden_threefifth( $atts, $content = null) {
	return '<div class="three_fifth">' . remove_wpautop($content) . '</div>';
}
add_shortcode('three_fifths', 'caden_threefifth');

// Three fifth last
function caden_threefifthlast( $atts, $content = null) {
	return '<div class="three_fifth last">' . remove_wpautop($content) . '</div>';
}
add_shortcode('three_fifths_last', 'caden_threefifthlast');

// Four firths
function caden_fourfifth( $atts, $content = null) {
	return '<div class="four_fifth">' . remove_wpautop($content) . '</div>';
}
add_shortcode('four_fifths', 'caden_fourfifth');

// Four firths last
function caden_fourfifthlast( $atts, $content = null) {
	return '<div class="four_fifth last">' . remove_wpautop($content) . '</div>';
}
add_shortcode('four_fifths_last', 'caden_fourfifthlast');

// One sixth
function caden_onesixth( $atts, $content = null) {
	return '<div class="one_sixth">' . remove_wpautop($content) . '</div>';
}
add_shortcode('one_sixth', 'caden_onesixth');

// One sixth last
function caden_onesixthlast( $atts, $content = null) {
	return '<div class="one_sixth last">' . remove_wpautop($content) . '</div>';
}
add_shortcode('one_sixth_last', 'caden_onesixthlast');

?>