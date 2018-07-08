(function ($, root, undefined) {
  
	
	$(function () {
		
		'use strict';
		
		// DOM ready, take it away
		

		$('#thumb-prods').slick({
		    slidesToShow: 4,
			slidesToScroll: 1,
			vertical: true,
			// centerMode: true,
			focusOnSelect: true,
			arrows: false,
			asNavFor: '#main-img'
		});

		$('#main-img').slick({
		    slidesToShow: 1,
		    infinite: true,
			arrows: false,
			fade: true,
			asNavFor: '#thumb-prods'
		});

		

    
	});
	
})(jQuery, this);



