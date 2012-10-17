<?php get_header();

//dump_wp();
//d($templates);
 ?>


<div id="mainpage">
	<div class="page_content">
    	<div id="content">
		XXXFJXXXFJXXXFJXXXFJXXXFJXXXFJXXXFJXXXFJXXXFJXXXF JXXXFJXXXFJXXXFJXXXFJXXXFJXXXFJXXXFJXXXFJXXXFJXXXFJ
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="blog_post">
        
        	<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        	<div class="metaInfo">Posted By <?php the_author_link(); ?> / <?php the_time('F, j, Y'); ?> / <a href="<?php comments_link(); ?>"><?php comments_number('0','1','%'); ?> comments</a></div>
                
			<?php if(has_post_thumbnail()) { ?>
            	<?php 
				$cat_blog_style = get_option('cat_blog_style');
				?>
                <div class="post_thumbnail<?php if($cat_blog_style) { echo "_left"; } ?>">
                    <?php
                    $thumbnail = get_post_thumbnail_id(); 
					if(!$cat_blog_style) {
                    	$img = vt_resize( $thumbnail,'' , 510, 280, true, 70 );
					} else { 
						$img = vt_resize( $thumbnail,'' , 260, 240, true, 70 );
					}
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
        
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>


<?php get_footer(); ?>