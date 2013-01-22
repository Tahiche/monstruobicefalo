<?php get_header();

//dump_wp();
//d($templates);

 ?>
<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>

<div id="mainpage">

	<div class="page_content fullblack slimblack">
    <div id="taxo_textos">
 <h1 class="tit_trabajo lowercase "><?php echo $term->name; ?></h1>
<?php
if ( tag_description() !== '' ) { ?>
<div class="tag-desc">
<?php echo tag_description(); ?>
</div>
<?php } ?>
</div>

    	<div id="portfolio_content">
		
        <div id="content-fullwidth-portfolio">
	<ul class="three-column">
        <?php if ( have_posts() ) : while ( have_posts() ) :
		/*dump_post();*/
		the_post(); 
		$thumb = get_post_thumbnail_id(); 
		//$image = vt_resize( $thumb,'' , 249, 140, true, 70 );
		$image = vt_resize( $thumb,'' , 145, 145, true, 70 );
		?>
      	<li>
          <div class="portfolio_thumbnail"> 
          <a href="<?php  the_permalink(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
           <img class="vermas" src="<?php echo STYLESHEETDIR; ?>/images/vermas_proyecto.png" alt="<?php echo $lbtitle; ?>"/>
           
           
           
           <h2><span class="thumb_title"><?php the_title(); ?></span></h2>
           		<?php echo '<img src="'.$image[url].'" width="'.$image[width].'" height="'.$image[height].'" alt="'.$lbtitle.'" class="front" /></a>'; ?>
                
                </a>
          </div>
      	</li>
     
        <?php endwhile; endif; ?>
         </ul>
      </div> <!-- fin content-fullwidth-portfolio -->
		</div>
     <?php wp_pagenavi(); ?>
	</div>
</div>



<?php wp_reset_query(); ?>
<?php get_footer(); ?>