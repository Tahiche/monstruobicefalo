<?php get_header(); ?>

<div id="mainpage">
<!-- start page background -->
<div class="page_content">
	
    <!-- start content area -->
	<div id="content">
	<?php while ( have_posts() ) : the_post() ?> 
    	<!-- start post content -->
    	<div class="blog_post">
        <h2><?php the_title(); ?></h2>
		<!-- post info -->
		<div class="metaInfo">
			By <?php the_author_link(); ?> / <?php the_time('F, j, Y') ?> / <a href="<?php comments_link(); ?>"><?php comments_number('0','1','%'); ?> comments</a>
		</div>
		<?php if(has_post_thumbnail()) { ?>
		<div class="post_thumbnail">
			<?php 
			$thumb = get_post_thumbnail_id(); 
			$image = vt_resize( $thumb,'' , 510, 220, true, 70 );
			?>
			<img src="<?php echo $image[url]; ?>" width="<?php echo $image[width]; ?>" height="<?php echo $image[height]; ?>" class="front" /></a>
		</div>
        <?php } ?>
		<?php the_content(); ?>
        </div><!-- end .blog_post -->
    <?php endwhile; ?>
            
	<?php comments_template(); ?>
    </div><!-- end #content -->
    
    <?php get_sidebar(); ?>
    
</div><!-- end .page -->
</div>

<?php get_footer(); ?>