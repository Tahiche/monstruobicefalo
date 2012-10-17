<?php get_header(); ?>

<div id="mainpage">
<!-- start page background -->
<div class="page_content">
	
    <!-- start content area -->
	<div id="content">
	<?php while ( have_posts() ) : the_post() ?> 
    <?php 
	$img_style = get_option('single_img_style');
	$image_one = get_post_meta(get_the_id(), 'p_image_one', true);
	$image_two = get_post_meta(get_the_id(), 'p_image_two', true);
	$image_three = get_post_meta(get_the_id(), 'p_image_three', true);
	$image_four = get_post_meta(get_the_id(), 'p_image_four', true);
	$image_five = get_post_meta(get_the_id(), 'p_image_five', true);
	
	?>
    	<!-- start post content -->
    	<div class="blog_post">
        <h2><?php the_title(); ?></h2>
        <?php if(!$img_style) { ?>
			<?php if(has_post_thumbnail()) { ?>
            <div class="post_thumbnail">
                <?php 
                $thumb = get_post_thumbnail_id(); 
                $image = vt_resize( $thumb,'' , 530, 220, true, 70 );
                ?>
                <img src="<?php echo $image[url]; ?>" width="<?php echo $image[width]; ?>" height="<?php echo $image[height]; ?>" class="front" />
                <?php
				if($image_one != "") { echo '<img src="'.$image_one.'" alt="" width="530" />'; }
				if($image_two != "") { echo '<img src="'.$image_two.'" alt="" width="530" />'; }
				if($image_three != "") { echo '<img src="'.$image_three.'" alt="" width="530" />'; }
				if($image_four != "") { echo '<img src="'.$image_four.'" alt="" width="530" />'; }
				if($image_five != "") { echo '<img src="'.$image_five.'" alt="" width="530" />'; }
				?>
            </div>
            <?php } ?>
        <?php } else { ?>
        	<div id="slides">
            	<div class="slides_container">
					<?php
                    if($image_one != "") { echo '<a href="#"><img src="'.$image_one.'" alt="" width="530" /></a>'; }
                    if($image_two != "") { echo '<a href="#"><img src="'.$image_two.'" alt="" width="530" /></a>'; }
                    if($image_three != "") { echo '<a href="#"><img src="'.$image_three.'" alt="" width="530" /></a>'; }
                    if($image_four != "") { echo '<a href="#"><img src="'.$image_four.'" alt="" width="530" /></a>'; }
                    if($image_five != "") { echo '<a href="#"><img src="'.$image_five.'" alt="" width="530" /></a>'; }
                    ?>
                </div>
            </div>
        <?php } ?>
		<?php the_content(); ?>
        </div><!-- end .blog_post -->
    <?php endwhile; ?>
    </div><!-- end #content -->
    
    <?php get_sidebar(); ?>
    
</div><!-- end .page -->
</div>

<?php get_footer(); ?>