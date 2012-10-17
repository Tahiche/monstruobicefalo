<?php 
/*
Template Name: Blog Fullwidth Thumbnail
*/
get_header(); ?>


<div id="mainpage">
	<div class="page_content">
    	<div id="content">
		
        <?php
        	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        	$query = array(
            	'post_type' => 'post',
            	'paged' => $paged,
        	);
			query_posts($query);
			if (have_posts()) : while (have_posts()) : the_post(); ?>
        
        <div class="blog_post">
        	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        	<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        	<div class="metaInfo">Posted By <?php the_author_link(); ?> / <?php the_time('F, j, Y'); ?> / <a href="<?php comments_link(); ?>"><?php comments_number('0','1','%'); ?> comments</a></div>
                
			<?php if(has_post_thumbnail()) { ?>

                <div class="post_thumbnail">
                    <?php
                    $thumbnail = get_post_thumbnail_id(); 
                    $img = vt_resize( $thumbnail,'' , 510, 280, true, 70 );
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
        </div>
		
        <?php endwhile; endif; ?>
            <div class="blog_pagenavi">
                <?php wp_pagenavi(); ?>
            </div>
		</div>
		<?php get_sidebar(); ?>
	</div> 
</div>

<?php wp_reset_query(); ?>
<?php get_footer(); ?>