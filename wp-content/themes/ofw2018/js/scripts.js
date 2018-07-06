(function ($, root, undefined) {
  
  $(window).on('load', function() { // makes sure the whole site is loaded 
	  $('#status').fadeOut(); // will first fade out the loading animation 
	  $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website. 
	  $('body').delay(350).css({'overflow':'visible'});
	});
	
	$(function () {
		
		'use strict';
		
		// DOM ready, take it away
		
		$("html").easeScroll();


		$('.incremental-item .add').click(function() {
			var html = $(this).parent().data('itemhtml');
			$(this).siblings('ul').append(html);
		})

		$(document).on('click', '.incremental-item .remove', function() {
			var no_items = $(this).parents('ul').children('li').size();
			console.log(no_items);
			if (no_items == 1) {
				alert('You should provide atleast 1 benefit for the members');
			} else {
				$(this).parent('.item').remove();
			}
		})

		$('.carousel-testi').matchHeight();

		$('#testi-carousel').find('.carousel-item').first().addClass('active');
		$('#testi-carousel .carousel-indicators').find('li').first().addClass('active');

    	var msg_from = $('.contact-admin').data('from');
    	var msg_email = $('.contact-admin').data('email');
    	$('.contact-admin input.your-name').val(msg_from);
    	$('.contact-admin input.your-email').val(msg_email);

    	$('.logo-cont').matchHeight();

    	var home_url = $('.header .mid-header a').attr('href');
    	$('.ms-edit-profile').attr('href', home_url+'/edit-my-personal-details/');

    	$('#edit_profile_form').prepend('<h2>'+$('.edit-my-personal-details section h1').text()+'</h2>')

    	document.getElementById("profile_picture").onchange = function () {
		    var reader = new FileReader();
		    reader.onload = function (e) {
		        document.getElementById("profile_photo").src = e.target.result;
		    };
		    reader.readAsDataURL(this.files[0]);
		};

		var useremail = $('.sendtouser').data('toemail');
		var name = $('.sendtouser').data('name');
		$('.sendtouser .your-name input').val(name);
		$('.sendtouser .your-email input').val(useremail);
		$('.sendtouser .your-message textarea').val('this is a message from ofw power club');
		$('.sendtouser .your-subject input').val('OFW Power Club Membership Payment Options');
    
	});
	
})(jQuery, this);
