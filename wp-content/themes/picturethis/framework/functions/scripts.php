<?php

/* Deregister jQuery included with WordPress */
if(!is_admin()) {
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js' );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script('supersized.3.1.3.min', CADEN_JS . '/supersized.3.1.3.min.js');
	//wp_enqueue_script('custom', CADEN_JS . '/custom.js');
	
	if(!is_home()) {
	wp_enqueue_script('jquery.prettyPhoto', CADEN_JS . '/jquery.prettyPhoto.js');
	wp_enqueue_script('slides.min.jquery', CADEN_JS . '/slides.min.jquery.js');
	wp_enqueue_script('contact', CADEN_JS . '/contact.js');
	wp_enqueue_script('jquery.backstretch.min', CADEN_JS . '/jquery.backstretch.min.js');
	}
	
	
	wp_enqueue_script('cufon-yui', CADEN_JS . '/cufon-yui.js');
	wp_enqueue_script('Bebas_Neue_400.font', CADEN_JS . '/Bebas_Neue_400.font.js');
	wp_enqueue_script('cufon.init', CADEN_JS . '/cufon.init.js');
	
	if ( is_singular() ) wp_enqueue_script( "comment-reply" );
}

?>