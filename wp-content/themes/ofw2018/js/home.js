(function ($, root, undefined) {
  
	
	$(function () {
		
		'use strict';
		
		// DOM ready, take it away
		
		$('#banner-carousel').find('.carousel-item').first().addClass('active');

		$(function() {
		  $('a.scroll').on('click', function(e) {
		    e.preventDefault();
		    $('html, body').animate({ scrollTop: $($(this).attr('href')).offset().top}, 500, 'linear');
		  });
		});

		$('#partners-carousel').find('.carousel-item').first().addClass('active');
		$('#partners-carousel .carousel-indicators').find('li').first().addClass('active');

		$('#feat-prod-list').find('div:nth-child(2)').addClass('grid-item-large');
    	$('#feat-prod-list').find('div:nth-child(6)').last().addClass('grid-item-large');

    	$('.grid').masonry({
		    itemSelector: '.grid-item',
		    columnWidth: '.grid-sizer',
  			percentPosition: true
		});
    
	});
	
})(jQuery, this);



