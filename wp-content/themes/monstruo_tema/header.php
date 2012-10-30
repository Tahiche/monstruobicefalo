<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html <?php language_attributes(); ?>> 
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<?php if(get_option('site_favicon')) { ?><link rel="shortcut icon" href="<?php echo get_option('site_favicon'); ?>" /> <?php } ?>
<style type="text/css" media="screen">
@import url( <?php bloginfo('template_url'); ?>/style/prettyPhoto.css );
<?php
$cg_custom_bg_image = get_post_meta(get_the_id(), 'cg_custom_bg_image', true);
if(!$cg_custom_bg_image) { ?>
@import url( <?php bloginfo('template_url'); ?>/style/supersized.css );
<?php } ?>
@import url( <?php bloginfo('stylesheet_url');?> );
@import url( <?php bloginfo('template_url'); ?>/style/skin.php );


@import url( <?php bloginfo('stylesheet_directory'); ?>/styles/slides/css/slides.css ); 
@import url( <?php bloginfo('stylesheet_directory'); ?>/styles/animate-custom.css ); 


<?php if(get_option('custom_css')) { echo get_option('custom_css'); } ?>
</style>
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Oswald">
<!--[if IE 7]>
<style type="text/css">
@import url(<?php bloginfo('template_url'); ?>/style/ie7style.css);
</style>
<![endif]-->
<!--[if IE 8]>
<style type="text/css">
@import url(<?php bloginfo('template_url'); ?>/style/ie8style.css);
</style>
<![endif]-->
<!--[if IE 9]>
<style type="text/css">
@import url(<?php bloginfo('template_url'); ?>/style/ie9style.css);
</style>
<![endif]-->

<?php wp_head(); ?>

<?php if(is_singular('portfoliocpt')) { ?>
<script type="text/javascript">
$(function(){
	$('#slides').slides({
		preload: true,
		preloadImage: 'images/loading.gif',
		/*generateNextPrev: true,*/
		effect: 'fade',
		crossfade:true,
		play: 5000,
		pause: 2500,
		hoverPause: false
	});
});
</script>
<?php } ?>

<?php 
if($cg_custom_bg_image != "") { ?>
<script type="text/javascript">
$.backstretch("<?php echo $cg_custom_bg_image; ?>");
</script>
<?php } ?>

<script type="text/javascript">
<?php
$lightbox_theme = get_option('lightbox_theme');
$show_lb_title = get_option('show_lb_title');
$allow_resize = get_option('allow_resize');
$animation_speed = get_option('lb_animation_speed');
$opacity = get_option('opacity');
$default_width = get_option('default_width');
$default_height = get_option('default_height');
if($default_width == "") {
	$default_width = "600";
}
if($default_height == "") {
	$default_height = "400";
}
if($opacity == "") {
	$opacity = "0.8";
}
if($animation_speed == "") {
	$animation_speed = "1000";
}
if($lightbox_theme == "Dark Rounded") {
	$theme = "dark_rounded";
} elseif($lightbox_theme == "Dark Square") {
	$theme = "dark_square";
} elseif($lightbox_theme == "Facebook") {
	$theme = "facebok";
} elseif($lightbox_theme == "Light Rounded") {
	$theme = "light_rounded";
} elseif($lightbox_theme == "Light Square") {
	$theme = "light_square";
} else {
	$theme = "dark_rounded";
}
?>
$(document).ready(function(){
	$("a[rel^='prettyPhoto']").prettyPhoto({
		theme: '<?php echo $theme; ?>',
		animation_speed: '<?php echo $animation_speed; ?>',
		allow_resize: <?php if(!$allow_resize) { echo "true"; } else { echo "false"; } ?>,
		show_title: <?php if(!$show_lb_title) { echo "true"; } else { echo "false"; }?>,
		default_height: <?php echo $default_height; ?>,
		default_width: <?php echo $default_width; ?>,
		opacity: <?php echo $opacity; ?>
	});
});
<?php if(!$cg_custom_bg_image) { ?>
jQuery(function($){
	$.supersized({
	<?php 
	// Get slideshow settings
	$slideshow_onoff = get_option('slideshow_onoff');
	$start_slide = get_option('start_slide');
	$random_images = get_option('random_images');
	$pause_slideshow = get_option('pause_slideshow');
	$transition_effect = get_option('transition_effect');
	$transition_time = get_option('transition_time');
	$slide_interval = get_option('slide_interval');
	$keyboard_nav = get_option('keyboard_nav');
	$image_protect = get_option('image_protect');
	$performance = get_option('performance');
	
	// Get transition effect selected
	if($transition_effect == "Fade") {
		$teffect = 1;
	} elseif($transition_effect == "Slide Top") {
		$teffect = 2;
	} elseif($transition_effect == "Slide Right") {
		$teffect = 3;
	} elseif($transition_effect == "Slide Bottom") {
		$teffect = 4;
	} elseif($transition_effect == "Slide Left") {
		$teffect = 5;
	} elseif($transition_effect == "Carousel Right") {
		$teffect = 6;
	} elseif($transition_effect == "Carousel Left") {
		$teffect = 7;
	} else {
		$teffect = 1;
	}
	
	// Get performance settings
	if($performance == "Normal") {
		$performance = 0;
	} elseif($performance == "Hybrid speed/quality") {
		$performance = 1;
	} elseif($performance == "Optimize image quality") {
		$performance = 2;
	} elseif($performance == "Optimize transition speed (firefox/IE, not webkit)") {
		$performance = 3;
	} else {
		$performance = 0;
	}
	
	// Get interval time
	if($slide_interval == "") {
		$slide_interval = 4000;
	}
	
	// Get transition time
	if($transition_time == "") {
		$transition_time = 1000;
	}
	?>
	//Functionality
	startwidth: 640,  
	startheight: 480,
	vertical_center: 1,
	navigation: 0,
	thumbnail_navigation: 0,
	slideshow               :   <?php if(!$slideshow_onff) { echo 1; } else { echo 0; } ?>,		//Slideshow on/off
	autoplay				:	1,		//Slideshow starts playing automatically
	start_slide             :   <?php if(!$start_slide) { echo 1; } else { echo 0; } ?>,		//Start slide (0 is random)
	random					: 	<?php if(!$random_images) { echo 1; } else { echo 0; } ?>,		//Randomize slide order (Ignores start slide)
	slide_interval          :   <?php echo $slide_interval; ?>,	//Length between transitions
	transition              :   <?php echo $teffect; ?>, 		//0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
	transition_speed		:	<?php echo $transition_time; ?>,	//Speed of transition
	pause_hover             :   <?php if(!$pause_slideshow) { echo 1; } else { echo 0; } ?>,		//Pause slideshow on hover
	keyboard_nav            :   <?php if(!$keyboard_nav) { echo 1; } else { echo 0; } ?>,		//Keyboard navigation on/off
	performance				:	<?php echo $performance; ?>,		//0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
	image_protect			:	<?php if(!$image_protect) { echo 1; } else { echo 0; } ?>,		//Disables image dragging and right click with Javascript
	slide_counter: 0,
	slide_captions: 0,
	slides 				:  	[		//Slideshow Images
	<?php 
	$bg_images = get_post_meta(get_the_id(), 'cg_bg_image', false);
	$default_image = get_post_meta(get_the_id(), 'cg_default_image', true);
	$default_bg_image = get_option('default_bg_image');
	
	//d(is_category());
	/* Get image/slideshow settings to 
	display on the homepage */
		
	if(is_home()) {
		
		$cg_home_image = get_post_meta(get_the_id(), 'cg_home_image', true);
		$homepage_slide_count = get_option('homepage_slide_count');
		if($homepage_slide_count == "") {
			$homepage_slide_count = "10";
		}
      	query_posts(array('post_type' => 'fondo_home', 'posts_per_page' => $homepage_slide_count));
    	$c=0;    //FH: new, 13.04.2011
        while(have_posts()) {
        the_post();
		if( function_exists( 'attachments_get_attachments' ) )
  {
	  $c=0;    //FH: new, 13.04.2011
    $attachments = attachments_get_attachments();
	//d($attachments);
    $total_attachments = count( $attachments );
	for( $i=0; $i<$total_attachments; $i++ ){
		$content=$attachments[$i]['location'];
		echo ($i > 0) ? ',' : '';         // FH: new, 13.04.2011
		echo "{image : '".$content."'}";    //   echo "{image : '".$content."'},";
		$c++;                // FH: new, 13.04.2011*/
		}
  }
         
        }

		wp_reset_query();
		
	} 
	else if ( $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ) ){
		 $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		if($term->term_id==5){
			//d($term);
			echo "{image : 'http://www.monstruobicefalo.com/wp-content/uploads/2012/10/fondobus.jpg'}"; 
			}
		if($term->term_id==4){
			//d($term);
			echo "{image : 'http://www.monstruobicefalo.com/wp-content/uploads/2012/10/fondo1.jpg'}"; 
			}
		}
	else /*If not homepage */ {



		if($default_image == "y") {
			if($default_bg_image != "") {
				echo "{image : '".$default_bg_image."'}";
			} 
		} elseif($default_image == "") {
			echo "{image : '".$default_bg_image."'}";
		} elseif($default_image == "n") {
			$nb = count($bg_images);
			$i = 0;
			foreach ($bg_images as $bg_image) {
    			$i++;
   				echo "{image : '".$bg_image."'}";
    			echo ($i != $nb) ? ',' : '';
			}
		} elseif($default_image == "h") {
			 $cg_home_image = get_post_meta(get_the_id(), 'cg_home_image', true);
		$homepage_slide_count = get_option('homepage_slide_count');
		if($homepage_slide_count == "") {
			$homepage_slide_count = "10";
		}
        query_posts(array('post_type' => 'homepage_slider', 'posts_per_page' => $homepage_slide_count));
    	$c=0;    //FH: new, 13.04.2011
        while(have_posts()) {
        the_post();
            $content = strip_tags(get_the_content());
        	echo ($c > 0) ? ',' : '';         // FH: new, 13.04.2011
            echo "{image : '".$content."'}";    //   echo "{image : '".$content."'},";
        	$c++;                // FH: new, 13.04.2011
        }

		wp_reset_query();
		}
	}
	?>
	]						
	});
});
<?php } ?>

<?php
if(is_home()) {?>
$(document).ready(function() {

jQuery('ul.menu li').find('ul:eq(0)').addClass('fadeOutLeft').hide().delay(1500).queue(function(){ 
//alert(jQuery(this));
 jQuery(this).removeClass('fadeOutLeft').show().addClass('animated fadeInLeft');
 jQuery(this).dequeue(); 
})
});
<?php
}
?>
</script>

</head>
<body <?php body_class(); ?>>

 <div id="cover_black"></div>
	<div id="header">
   
		<?php
		$custom_logo = get_option('custom_logo'); 
		$site_name = get_option('site_name');
		if($site_name) { ?>
			<div id="sitename">
				<a href="<?php echo home_url(); ?>"><?php echo get_bloginfo('name'); ?></a>
			</div>
		<?php } else { ?>
			<?php if($custom_logo) { ?>
				<div id="logo">
					<a href="<?php echo home_url(); ?>"><img src="<?php echo $custom_logo; ?>" /></a>
				</div>
			<?php } else { ?>
				<div id="sitename">
					<a href="<?php echo home_url(); ?>"><?php echo get_bloginfo('name'); ?></a>
				</div>
			<?php } ?>
		<?php } ?>
		<div class="navigation">
       		<?php if ( has_nav_menu( 'primary-menu' ) ) { /* if menu location 'primary-menu' exists then use custom menu */ ?>
        		<?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'menu', 'container' => 'ul' ) ); ?>
        	<?php } else { /* else use wp_list_pages */ ?>
        		<ul class="menu">
         			<?php wp_list_pages( array('title_li' => '')); ?>
         		</ul>
         	<?php } ?>
		</div>
	</div>

