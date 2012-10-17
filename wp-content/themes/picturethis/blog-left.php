<?php 
/*
Template Name: Blog Left Thumbnail
*/
get_header(); ?>

<div id="mainpage">
<div class="page_content">
	<div id="content">
    
    <?php
        $title = get_post_meta(get_the_id(), 'cg_page_title', true);
		$custom_title = get_post_meta(get_the_id(), 'cg_custom_title', true);
		if($title == "y" || $title == "") {
			if($custom_title != "") { ?>
            	<h1><?php echo $custom_title; ?></h1>
            <?php } else { ?>
				<h1><?php the_title(); ?></h1>
            <?php } ?>
		<?php } ?>
  
	<?php
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$query = array(
		'post_type' => 'post', 
		'paged' => $paged,
	);
		
	$r = new WP_Query($query);
	if ($r->have_posts()):
	while ($r->have_posts()) : $r->the_post();
	?>
    
	<div class="blog_post">
    
	<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    
		
	<div class="metaInfo">Posted By <?php the_author_link(); ?> / <?php the_time('F, j, Y'); ?> / <a href="<?php comments_link(); ?>"><?php comments_number('0','1','%'); ?> comments</a></div>
    
			
	<?php if(has_post_thumbnail()) { ?>
    	<div class="post_thumbnail_left">
        
			<?php	
            $thumbnail = get_post_thumbnail_id(); 
            $img = vt_resize( $thumbnail,'' , 260, 240, true, 70 );
            ?>
                
            <a href="<?php the_permalink(); ?>">
            <?php echo '<img src="'.$img[url].'" width="'.$img[width].'" height="'.$img[height].'" alt="'.$lbtitle.'" /></a>'; ?>
				
		</div>
        <?php } ?>
			
		<?php
			$show_excerpt = get_option('show_excerpt');
			if(!$show_excerpt) { 
				the_excerpt(); 
			} else {
        		the_content();
			} ?>
			
	</div>
    <?php endwhile; endif; ?>
    
        <div class="blog_pagenavi">
            <?php wp_pagenavi(); ?>
        </div>

	</div>
	<?php get_sidebar(); ?>
</div>
<?php wp_pagenavi(); ?>
</div>


<?php get_footer(); ?>