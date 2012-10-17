<?php 
/*
Template Name: Portfolio 3 Column
*/
get_header(); ?>

<div id="mainpage">
<div class="page_content">
	<div class="portfolio_content">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php
		$lb_gallery = get_post_meta(get_the_id(), 'cg_lb_gallery', true);
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
        <?php
		$portfolio_cat = get_post_meta(get_the_id(), 'cg_portfolio_cat', true);
		$posts_limit = get_post_meta(get_the_id(), 'cg_items_per_page', true);
		?>
		<?php endwhile; endif; ?>
    </div>
	<div id="content-fullwidth-portfolio">
	<ul class="three-column">
		<?php
        $query = array(
        	'post_type' => 'portfoliocpt', 
            'posts_per_page' => $posts_limit,
            'taxonomy' => 'portfolio_category', 
            'term' => $portfolio_cat, 
            'paged' => $paged,
        );
        ?>

		<?php query_posts($query);
		while(have_posts()) {
		the_post();
		?>
			
			<li>
			<?php
			$lbtitle = get_post_meta(get_the_id(), "_lbtitle", true);
			$url = get_post_meta(get_the_id(), "_lburl", true);	
			$lbdesc = get_post_meta(get_the_id(), 'lbdesc', true);
			$cg_image_url = get_post_meta(get_the_id(), 'cg_image_url', true);
			$custom_image_url = get_post_meta(get_the_id(), 'custom_image_url', true);
			$thumb = get_post_thumbnail_id(); 
			$image = vt_resize( $thumb,'' , 253, 145, true, 70 );
			if($url == "") {
			$imgurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
} else {
$imgurl = get_post_meta(get_the_id(), "_lburl", true);
}
			?> 
			<div class="portfolio_thumbnail"> 
                
                <?php if($cg_image_url == "y" || $cg_image_url == "") { ?>			
				<a href="<?php echo $imgurl; ?>" title="<?php echo $lbdesc; ?>" rel="prettyPhoto<?php if($lb_gallery == "y") { echo "[gal]"; } ?>">
            <?php } else { 
				if($custom_image_url == "") { ?>
            		<a href="<?php the_permalink(); ?>" alt="<?php echo $lbtitle; ?>">
                <?php } else { ?>
                	<a href="<?php echo $custom_image_url; ?>" alt="<?php echo $lbtitle; ?>">
                <?php } ?>
            <?php } ?>
                
                <img style="position:absolute;left:34%;top:20%;" src="<?php bloginfo('template_url'); ?>/images/preview.png" alt="<?php echo $lbtitle; ?>"/>
           		<?php echo '<img src="'.$image[url].'" width="'.$image[width].'" height="'.$image[height].'" alt="'.$lbtitle.'" class="front" /></a>'; ?></a>
			</div>
			</li>
            
		<?php } ?>
		
		</ul>
		</div>
        <?php wp_pagenavi(); ?>
</div>
</div>

<?php wp_reset_query(); ?>
<?php get_footer(); ?>