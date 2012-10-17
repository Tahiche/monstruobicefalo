<?php 
/*
Template Name: Contact
*/
get_header(); ?>

<div id="mainpage">
<!-- start page background -->
<div class="page_content">
	
    <!-- start content area -->
	<div id="content">
	 	<?php the_post(); ?>
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
		
		<!-- Contact Form -->
			<div id="contact">
		            <div id="message"></div>
		            <form method="post" action="<?php bloginfo("template_url"); ?>/js/contact.php" name="contactform" id="contactform">
		            <fieldset>
		            <input name="name" type="text" id="name" class="l-input" size="30" value="" /> 
                    <label for=name accesskey=U><span class="required"></span> &nbsp;Name:</label>
		            <br />
		            <input name="email" type="text" id="email" class="l-input" size="30" value="" />
                    <label for=email accesskey=E><span class="required"></span> &nbsp;Email:</label>
		            <br />
		            <input name="subject" type="text" id="subject" class="l-input" size="30" value="" />
		            <label for=subject accesskey=S><span class="required"></span> &nbsp;Subject:</label>
		            <br />
		            <textarea name="comments" cols="40" rows="12"  id="comments" class="textarea" style="overflow: hidden;"></textarea>
		            <br />
					<input type="submit" class="l-submit" id="submit" value="Submit Message" />
		            </fieldset>
		            </form>
			</div><!--  End of contact form  -->
        
	</div><!-- end of content -->
	<?php get_sidebar(); ?> 
</div><!-- end page container -->
</div>


<?php get_footer(); ?>