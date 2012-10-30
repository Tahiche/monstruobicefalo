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
	//jQuery('#cover_black').stop().show();
			
		//jQuery(this).find('ul:eq(0)').show().removeClass('animated fadeOutLeft').addClass('animated fadeInLeft');
		// jQuery(this).find('ul:eq(0)').show();
		jQuery(this).find('ul:eq(0)').animate({ opacity: 'toggle', height: 'toggle' }, "slow");
		//jQuery(this).find('ul:eq(0)').fadeIn();
	},
	function(){
		jQuery(this).not('ul.sub-menu li').find('a:eq(0)').stop().animate({
			paddingLeft: '10px'}, {queue:false, duration: 100
		})
		//jQuery(this).find('ul:eq(0)').fadeOut();
		jQuery(this).find('ul:eq(0)').animate({ opacity: 'toggle', height: 'toggle' }, "slow");
		//jQuery(this).find('ul').removeClass('animated fadeInLeft').addClass('animated fadeOutLeft');
		//jQuery(this).find('ul').hide();
		//jQuery('#cover_black').stop().hide();
	});
	
$('#menu-item-14').hover(function() {
    $('#cover_black').stop(true, true).fadeIn({ duration: 500, queue: false });

}, function() {
    $('#cover_black').stop(true, true).fadeOut({ duration: 500, queue: false });
});

	
	jQuery('.menu-item-object-portfolio_category a').hover(function() {
	$(this).stop().animate({opacity: "0.4"}, 'fast');
    },
    function() {
      $(this).stop().animate({opacity: "1"}, 'fast');
    });
		
	
}
$(document).ready(function() {
	menu();
	portfolio();
});