function portfolio() {
	$('#content-fullwidth-portfolio ul li a').hover(function() {
		$(this).children('.front').stop().animate({"opacity": ".4"}, 500);
	}, function() {
		$(this).children('.front').stop().animate({"opacity": "1"}, 500);
	});
}
function menu() {
	$('.navigation').fadeIn();
	jQuery('ul.menu li').hover(function() {
		jQuery(this).not('ul.sub-menu li').find('a:eq(0)').stop().animate({
			paddingLeft: '20px'}, {queue:false, duration: 100
		})
		
		jQuery(this).find('ul:eq(0)').show();
	},
	function(){
		jQuery(this).not('ul.sub-menu li').find('a:eq(0)').stop().animate({
			paddingLeft: '10px'}, {queue:false, duration: 100
		})
		
		jQuery(this).find('ul').hide();
	});
}
$(document).ready(function() {
	menu();
	portfolio();
});