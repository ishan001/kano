/*
 * ------------------------------------------------------------------------
 * Copyright (C) 2009 - 2013 The YouTech JSC. All Rights Reserved.
 * @license - GNU/GPL, http://www.gnu.org/licenses/gpl.html
 * Author: The YouTech JSC
 * Websites: http://www.smartaddons.com - http://www.cmsportal.net
 * ------------------------------------------------------------------------
*/
// Correctly calculate dimensions of hidden elements 
/* Accordion Block */
jQuery(document).ready(function($) {
	$("ul.yt-accordion li").each(function() {
		if($(this).index() > 0) {
			$(this).children(".accordion-inner").css('display', 'none');
		}
		else {
			$(this).find(".accordion-heading").addClass('active');
		}
		
		var ua = navigator.userAgent,
		event = (ua.match(/iPad/i)) ? "touchstart" : "click";
		$(this).children(".accordion-heading").bind(event, function() {
			$(this).addClass(function() {
				if($(this).hasClass("active")) return "";
				return "active";
			});
	
			$(this).siblings(".accordion-inner").slideDown(350);
			$(this).parent().siblings("li").children(".accordion-inner").slideUp(350);
			$(this).parent().siblings("li").find(".active").removeClass("active");
		});
	});
	
	
	
});


/* Gallery Block */
jQuery(document).ready(function($) {
	// MixItUp plugin
	$(".tabnav li").click(function (){
			var clas = $(this).attr('class');
			if(clas.substr(0,7)=='showall')
			{
				$('.yt-gallery-tabbed').find('.tabnav .'+clas.substr(8)+'').removeClass('active');
			}
			else
			{
				$('.yt-gallery-tabbed').find('.tabnav .'+clas+'').removeClass('active');
			}
			$(this).addClass('active');
			var al =$(this).attr('id');
			$("."+clas+".masonry-brick ").css('display','none');
			if(clas.substr(0,7)=='showall')
			{
				$("."+clas.substr(8,37)+".masonry-brick").css('display','block');
			}
			else
			{
				$('.'+al+'').css('display','block');
			}
	})
	
     
	$('.gallery-list').magnificPopup({
	  delegate: 'a',
	  type: 'image',
	  tLoading: 'Loading image #%curr%...',
	  mainClass: 'mfp-img-mobile',
	  gallery: {
		enabled: true,
		navigateByImgClick: true,
		preload: [0,1] // Will preload 0 - before current, and 1 after the current image
	  }
	});
      
    
});

