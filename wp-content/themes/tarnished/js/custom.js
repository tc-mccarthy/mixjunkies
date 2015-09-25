/*************************** Display Content ***************************/

jQuery(document).ready(function(){	
	jQuery("#accordion-switcher, .slider-wrapper, .slider").addClass("display");
});


/*************************** List Styling ***************************/

jQuery(document).ready(function(){	
	jQuery("ul li:first-child").addClass("li-first");
	jQuery("ul li:last-child").addClass("li-last");			
});


/*************************** Navigation Menus ***************************/

jQuery(document).ready(function(){	

	var nav = jQuery("#nav");

	nav.find("li").each(function() {
		if (jQuery(this).find("ul").length > 0) {
		
			jQuery("<span/>").html("&#9660;").appendTo(jQuery(this).children(":first"));
			
		}
	});

});

/*************************** Sticky Header ***************************/

jQuery(function() {
var wd = jQuery(window),
		bd = jQuery('body'),
		bh = (jQuery.browser.webkit) ? jQuery('body') : jQuery('html');
	
	wd.bind('scroll.b', function() {
		var st = bh.scrollTop(),
			fn = (st > 99) ? 'addClass' : 'removeClass';
		
		bd[fn]( 'fixed' );
	}).trigger('scroll.b');
});


/*************************** Accordion Slider ***************************/

// Accordion Slider Captions
jQuery(document).ready(function(){	
	
	jQuery(".accordion-slider .panel").hover(
	function() {
		jQuery(this).find(".caption-outer").stop().fadeTo(500, 0.95);
	},
	function() {
		jQuery(this).find(".caption-outer").stop().fadeTo(500, 0);
	});
	
});


/*************************** Lightbox ***************************/

jQuery(document).ready(function(){

	jQuery("div.gallery-item .gallery-icon a").prepend('<span class="hover-image"></span>');
	jQuery("div.gallery-item .gallery-icon a").attr("rel", "prettyPhoto[gallery]");
	var galleryimgWidth = jQuery("div.gallery-item .gallery-icon img").width();
	var galleryimgHeight = jQuery("div.gallery-item .gallery-icon img").height();
	jQuery("div.gallery-item .gallery-icon .hover-image").css({"width": galleryimgWidth, "height": galleryimgHeight});
	jQuery("div.gallery-item .gallery-icon a").css({"width": galleryimgWidth});

	jQuery("a[rel^='prettyPhoto']").prettyPhoto({
		theme: 'pp_default',
		animationSpeed: 'fast'
	});

});

/*************************** Image Hover ***************************/

jQuery(document).ready(function(){

	jQuery('.hover-image, .hover-video').css({'opacity':'0'});
	jQuery('.sc-image, .post-thumbnail, .portfolio-thumbnail, .slide, .accordion-slider .panel, div.gallery-item .gallery-icon').hover(
		function() {
			jQuery(this).find('.hover-image, .hover-video').stop().fadeTo(750, 1);
			jQuery(this).find("a[rel^='prettyPhoto'] .image, a[rel^='prettyPhoto'] .slider-image, a[rel^='prettyPhoto'] .accordion-image, .lightbox.caption-overlay, a[rel^='prettyPhoto'] .attachment-thumbnail").stop().fadeTo(750, 0.5);
		},
		function() {
			jQuery(this).find('.hover-image, .hover-video').stop().fadeTo(750, 0);
			jQuery(this).find("a[rel^='prettyPhoto'] .image, a[rel^='prettyPhoto'] .slider-image, a[rel^='prettyPhoto'] .accordion-image, .lightbox.caption-overlay, a[rel^='prettyPhoto'] .attachment-thumbnail").stop().fadeTo(750, 1);
		})
		
	jQuery('.accordion-slider .panel').hover(
		function() {
			jQuery('.accordion-slider').addClass("hide-preloader");
		})
		
});


/*************************** Image Preloader ***************************/

jQuery(function () {
	jQuery('.preload').hide();//hide all the images on the page
});

var i = 0;
var int=0;
jQuery(window).bind("load", function() {
	var int = setInterval("doThis(i)",150);
});

function doThis() {
	var images = jQuery('.preload').length;
	if (i >= images) {
		clearInterval(int);
	}
	jQuery('.preload:hidden').eq(0).fadeIn(750);
	i++;
}


/*************************** Accordion ***************************/

/*jQuery(document).ready(function(){
	jQuery(".accordion").accordion({ header: "h3.accordion-title", autoHeight: false });
	jQuery("h3.accordion-title").toggle(function(){
		jQuery(this).addClass("active");
		}, function () {
		jQuery(this).removeClass("active");
	});	
}); */

/*************************** Tabs ***************************/

jQuery(document).ready(function(){
	jQuery(".sc-tabs").tabs({
		fx: {
			height:'toggle',
			duration:'fast'
		}
	});	
});


/*************************** Toggle Content ***************************/

jQuery(document).ready(function(){
jQuery(".toggle-box").hide(); 

jQuery(".toggle").toggle(function(){
	jQuery(this).addClass("toggle-active");
	}, function () {
	jQuery(this).removeClass("toggle-active");
});

jQuery(".toggle").click(function(){
	jQuery(this).next(".toggle-box").slideToggle();
});
});


/*************************** Contact Form ***************************/

jQuery(document).ready(function(){
	
	jQuery('#contact-form').submit(function() {

		jQuery('.contact-error').remove();
		var hasError = false;
		jQuery('.requiredFieldContact').each(function() {
			if(jQuery.trim(jQuery(this).val()) == '') {
				jQuery(this).addClass('input-error');
				hasError = true;
			} else if(jQuery(this).hasClass('email')) {
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				if(!emailReg.test(jQuery.trim(jQuery(this).val()))) {
					jQuery(this).addClass('input-error');
					hasError = true;
				}
			}
		});
	
	});
				
	jQuery('#contact-form .contact-submit').click(function() {
		jQuery('.loader').css({display:"block"});
	});	

});


/*************************** Theme Options Box ***************************/

jQuery(document).ready(function(){
	jQuery(".trigger").click(function(){
		jQuery(".theme-box").toggle("fast");
		jQuery(this).toggleClass("active");
		return false;
	});
	
/*************************** Login Box ***************************/

//Login Box

jQuery(".sign").toggle(function() {
		jQuery(".fly").fadeIn("fast"); 
		jQuery(".sign").addClass("active");
		//activeSign();
	},
	function() {
		jQuery(".fly").fadeOut("fast"); 
		jQuery(".sign").removeClass("active");
		//activeSign();
	
	});


// Move outside the flyout closes it, might need additional work
jQuery('.fly').mouseleave(function() {jQuery(".sign").click();});

//Clear field
///input field placeholder text
	jQuery('input.clean').focus(function(){
		if(!jQuery(this).attr('defaultValue')){
			jQuery(this).attr('defaultValue', jQuery(this).val());
		}
	   if(jQuery(this).val() === jQuery(this).attr('defaultValue'))
	   	{
		   jQuery(this).val('');
	   	}
	});
jQuery('input.clean').blur(function(){
	if(jQuery(this).val() === '')
	{
		jQuery(this).val(jQuery(this).attr('defaultValue'));
	}
});

//Feedback form
// Sidebar Toggler
	jQuery('#feedback .close').click(function() {
		jQuery('#feedback .canv').trigger('click');			
	});
	
	jQuery('#feedback .canv').toggle(
	function() {
	  jQuery('#feedback').animate({
	    width: '246'
	  });
	  
	},
	function() {
	  jQuery('#feedback').animate({
	    width: '0'
	  });
	  
	}
	
	);
	
	
});