<?php get_header(); ?>

<div id="mainpage">
<!-- start page background -->
<div class="page_content">
	
    <!-- start content area -->
	<div id="content">
	<?php
		$error = get_option('404_error');
		if($error == "") { ?>
			<h2>404 Not Found</h2>
			<p>Sorry, but what you are looking for is not here. Try using the search bar </p>
		<?php } else { 
			echo stripslashes($error);
		} ?>
		
		<h3>Pages</h3>
        <ul>
			<?php wp_list_pages(array('title_li' => '')); ?>
        </ul>
		
		<h3>Recent Posts</h3>
		<ul>
            <?php
            $postlist = get_posts('numberposts=40');
			foreach ($postlist as $post ) :
			setup_postdata($post);
			?>
			<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
            <?php endforeach; ?>
        </ul>
        </div>
    
    <?php get_sidebar(); ?>
    
</div><!-- end .page -->
</div>

<?php get_footer(); ?>