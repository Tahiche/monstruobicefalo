<?php
/*
Template Name: Fullwidth
*/
get_header(); ?>

<div id="mainpage">
<!-- start page background -->
<div class="page_content">
	
	<?php while ( have_posts() ) : the_post() ?>
    	<!-- start post content -->
    	<div class="fullwidth_content">
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

		<?php the_content(); ?>

        </div>

    <?php endwhile; ?>
    
</div><!-- end .page -->
</div>

<?php get_footer(); ?>