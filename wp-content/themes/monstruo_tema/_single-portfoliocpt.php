<?php get_header(); ?>

<div id="mainpage">
<!-- start page background -->
<div class="page_content fullblack">
	
    <!-- start content area -->
	<div id="content" class="content_portfolio">
	<?php while ( have_posts() ) : 
	//dump_post();
	the_post() ;
	
	?> 
    <?php 
	$img_style = get_option('single_img_style');
	?>
    	<!-- start post content -->
    	<div class="blog_post">
       
    <?php
	// Example call with all arguments:
//wpo_monstruo_get_images('w510','0','0','large',"$post->ID",'1','attachment-image','div','small-thumb');

//wpo_get_images('250','0','0','large',"$post->ID",'1','attachment-image','div','small-thumb');
?>


<?php
  if( function_exists( 'attachments_get_attachments' ) )
  {
    $attachments = attachments_get_attachments();
    $total_attachments = count( $attachments );
    if( $total_attachments ) : ?>
      <div id="slides">
            	<div class="slides_container">
      <?php for( $i=0; $i<$total_attachments; $i++ ) : ?>
        <!-- <li><?php echo $attachments[$i]['title']; ?></li>
        <li><?php echo $attachments[$i]['caption']; ?></li>
        <li><?php echo $attachments[$i]['id']; ?></li>
        <li><?php echo $attachments[$i]['location']; ?></li> -->
        <?php 
		if($attachments[$i]['id']) @$image=vt_resize( $attachments[$i]['id'],'' , 800, 450, true, 70 );
		//d($image);
		?>
     <?php if ($image): ?>
		<img src="<?php echo $image['url']; ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>" class="front" />
	<?php endif; ?>
    	
      <?php endfor; ?>
      </div></div>
    <?php endif; ?>
<?php } // fin attachments_get_attachments?>

 <h1 class="tit_trabajo"><?php the_title();?></h1>
		
        <div id="desc_proyect">
		<?php the_content(); ?>
        </div>
        
        </div><!-- end .blog_post -->
    <?php endwhile; ?>
     
    
    </div><!-- end #content -->
    

    
</div><!-- end .page -->
</div>
   <?php 
	 wp_pagenavi(); 
    //get_sidebar(); ?>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>