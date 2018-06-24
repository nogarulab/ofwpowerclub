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
		$('.carousel-indicators').find('li').first().addClass('active');

		// $('#feat-prod-list').find('.featured-product-item').first().removeClass( "col-sm-4" ).addClass('col-sm-8');
  //   	$('#feat-prod-list').find('.featured-product-item').last().removeClass( "col-sm-4" ).addClass('col-sm-8');
    
	});
	
})(jQuery, this);



