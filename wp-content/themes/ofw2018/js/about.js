(function ($, root, undefined) {
  
	
	$(function () {
		
		'use strict';
		
		// DOM ready, take it away
		

		$('.slick-prof').slick({
		    slidesToShow: 1,
		    infinite: true,
			slidesToScroll: 1,
			arrows: false,
			fade: true,
			asNavFor: '.slick-content'
		  });

		$('.slick-content').slick({
		    slidesToShow: 1,
		    infinite: true,
			slidesToScroll: 1,
			asNavFor: '.slick-prof',
			nextArrow: '<i class="fas slick-prev transition fa-long-arrow-alt-right"></i>',
  			prevArrow: '<i class="fas slick-next transition fa-long-arrow-alt-left"></i>'
		  });
    
	});
	
})(jQuery, this);



