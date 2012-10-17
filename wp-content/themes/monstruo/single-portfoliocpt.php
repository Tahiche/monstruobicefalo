<?php get_header(); ?>

<div id="mainpage">
<!-- start page background -->
<div class="page_content">
	
    <!-- start content area -->
	<div id="content">
	<?php while ( have_posts() ) : 
	//dump_post();
	the_post() ;
	
	?> 
    <?php 
	$img_style = get_option('single_img_style');
	?>
    	<!-- start post content -->
    	<div class="blog_post">
        <h2><?php the_title(); 
		//echo "XXXXXXXXXXXXXXX";
		
	
	?></h2>
    <?php
	// Example call with all arguments:
wpo_get_images('w510','0','0','large',"$post->ID",'1','attachment-image','div','small-thumb');

//wpo_get_images('250','0','0','large',"$post->ID",'1','attachment-image','div','small-thumb');
?>
<?php $attachments = attachments_get_attachments(); 
//d($attachments);
?>

<?php
  if( function_exists( 'attachments_get_attachments' ) )
  {
    $attachments = attachments_get_attachments();
    $total_attachments = count( $attachments );
    if( $total_attachments ) : ?>
      <ul>
      <?php for( $i=0; $i<$total_attachments; $i++ ) : ?>
        <!-- <li><?php echo $attachments[$i]['title']; ?></li>
        <li><?php echo $attachments[$i]['caption']; ?></li>
        <li><?php echo $attachments[$i]['id']; ?></li>
        <li><?php echo $attachments[$i]['location']; ?></li> -->
        <?php //$image=vt_resize( $attachments[$i]['id'],'' , 530, 220, true, 70 );
		$image = image_downsize( $attachments[$i]['id'], 'w510' ); 
		/*$img_preview = $preview_array[0]; // thumbnail or medium image to use for preview.
 		$img_width = $preview_array[1];
 		$img_height = $preview_array[2];*/
		//d($image);
		?>
		<img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" class="front" />
		
      <?php endfor; ?>
      </ul>
    <?php endif; ?>
<?php } ?>


        <?php if(!$img_style) { ?>
			
        <?php } ?>
		<?php the_content(); ?>
        </div><!-- end .blog_post -->
    <?php endwhile; ?>
    </div><!-- end #content -->
    
    <?php get_sidebar(); ?>
    
</div><!-- end .page -->
</div>

<?php get_footer(); ?>