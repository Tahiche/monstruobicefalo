</div>
<?php 
/*
Dumping variables is easy:

d($variable) will output a styled, collapsible container with your variable information
dd($variable) will do exactly as d() except halt execution of the script
s($variable) will output a simple, un-styled whitespace container
sd($variable) will do exactly as s() except halt execution of the script
Backtrace is also easy:

Kint::trace() The displayed information for each step of the trace includes the source snippet, passed arguments and the object at the time of calling
We've also baked in a few functions that are WordPress specific:

dump_wp_query()
dump_wp()
dump_post()
*/
 if (is_user_logged_in()) {
	//echo ' | '. get_template_name() ;
}
//$templates = get_page_templates();
//dump_wp();
//d($templates);
//dbug($GLOBALS);
wp_footer(); ?>
<?php 
$analytics = get_option('analytics'); 
if($analytics) { echo stripslashes($analytics); } ?>
</body>
</html>