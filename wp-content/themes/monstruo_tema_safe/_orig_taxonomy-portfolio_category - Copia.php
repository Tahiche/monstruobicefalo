<?php get_header();

//dump_wp();
//d($templates);
 ?>


<div id="mainpage">
	<div class="page_content">
    	<div id="content">
		this is portfolio category YAAAAAAAAAA!!!!!!!!!!!!!!!!!!!!
        <?php if ( have_posts() ) : while ( have_posts() ) :
		dump_post();
		the_post(); 
		 
		?>
       
        <div class="blog_post">
        
        	<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        	<div class="metaInfo">Posted By <?php the_author_link(); ?> / <?php the_time('F, j, Y'); ?> / <a href="<?php comments_link(); ?>"><?php comments_number('0','1','%'); ?> comments</a></div>
                
			<?php if(has_post_thumbnail()) { 
			// the_post_thumbnail();
			?>
            	<?php 
				$cat_blog_style = get_option('cat_blog_style');
				?>
                <div class="post_thumbnail<?php if($cat_blog_style) { echo "_left"; } ?>">
                <a href="<?php  the_permalink(); ?>">
                <?php 
				// tamaño definido en functions set_post_thumbnail_size
				the_post_thumbnail();?>
                </a>
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