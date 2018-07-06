(function ($, root, undefined) {
  
	
	$(function () {
		
		'use strict';
		
		// DOM ready, take it away
		

		$('.main-img').slick({
		    slidesToShow: 1,
		    infinite: true,
			slidesToScroll: 1,
			arrows: false,
			fade: true,
			asNavFor: '.thumb-prods'
		  });

		$('.thumb-prods').slick({
		    slidesToShow: 1,
			slidesToScroll: 1,
			asNavFor: '.main-img'
		  });
    
	});
	
})(jQuery, this);



