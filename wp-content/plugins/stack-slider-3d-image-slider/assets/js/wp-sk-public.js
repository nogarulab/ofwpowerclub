jQuery(document).ready(function($){    
	// For Carousel Slider
	$( '.wpsk-swiper-carousel' ).each(function( index ) {
		
		var slider_id   = $(this).parent().attr('id');
		var slider_conf = $.parseJSON( $(this).closest('.wpsk-carousel-wrap').find('.wpsk-carousel-conf').text());
		
		if( typeof(slider_id) != 'undefined' && slider_id != '' ) {	
	
			var swiper = new Swiper('#'+slider_id, {
				paginationHide		: (slider_conf.pagination) == "true" 			? false 		: true,
		        paginationType 		: (slider_conf.pagination_type == 'fraction') 	? 'fraction' 	: 'bullets',
		        autoplay 			: (slider_conf.autoplay) == "true" ? parseInt(slider_conf.autoplay_speed) : '' ,
		        spaceBetween 		: parseInt(slider_conf.space_between),
		        speed 				: parseInt(slider_conf.speed),
		        loop 				: (slider_conf.loop) == "true" 					? true 			: false,
		        autoplayStopOnLast 	: (slider_conf.auto_stop) == "true" 			? true 			: false,		       
		        pagination 			: '.swiper-pagination',
		        paginationClickable : true,
		        nextButton			: '.swiper-button-next',
		        prevButton 			: '.swiper-button-prev',
				effect: 'coverflow',
				grabCursor 			: (slider_conf.grab_cursor) == "true" 		? true 			: false,	
				centeredSlides		: (slider_conf.centermode) == "true" 			? true 			: false,
				slidesPerView 		: parseInt(slider_conf.slide_to_show),
				slidesPerGroup 		: parseInt(slider_conf.slide_to_column),
				coverflow: {
							rotate: 0,
							stretch: 0,
							depth:  parseInt(slider_conf.depth),
							modifier:  parseInt(slider_conf.modifier),
							slideShadows : false
						},
				breakpoints: {
				    // when window width is <= 320px
				    320: {
					  	
				      slidesPerView: 1,
				    },
				    // when window width is <= 480px
				    480: {					 			
				      slidesPerView: (parseInt(slider_conf.slide_to_show) > 2) ? 2 : parseInt(slider_conf.slide_to_show),
				    },
				    // when window width is <= 640px
				    640: {				     
					  slidesPerView 	: (parseInt(slider_conf.slide_to_show) > 3) ? 3 : parseInt(slider_conf.slide_to_show),
				    }
				}
	    	});
		}
	});
});