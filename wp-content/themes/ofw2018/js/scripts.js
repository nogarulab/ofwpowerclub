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

    	var useremail = $('.sendtouser').data('toemail');
		var name = $('.sendtouser').data('name');
		var message = 'Hello '+name+', You have successfully sent your application for OFW Power Club Membership. Your OFW Power Club USERNAME is: '+useremail+' To complete your application you can pay through bank transfer (Bank Name: Bank of the Philippine Islands | Account Number: 45987612313 | Account Name: Ricky Rueda Sadiosa) or just visit us in our office (Address: Unit 1230 Block B, Profit Industrial Building, 1-15 Kwai Fung Crescent Kwai Chung N. T).';
		$('.sendtouser .your-name input').val(name);
		$('.sendtouser .your-email input').val(useremail);
		$('.sendtouser .your-message textarea').val(message);
		$('.sendtouser .your-subject input').val('OFW Power Club Membership Payment Options');

		var home_url = $('.header .mid-header a').attr('href');
		$('.ms-edit-profile').attr('href', home_url+'/edit-my-personal-details/');

		$.urlParam = function(name){
			var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
			return results[1] || 0;
		}

		$('#terms .btn-accept').click(function() {
			$('input.termsinput').attr('checked', 'checked');
		})

		var m_useremail = $('.ms-member.register .logged-in-account span').data('memberemail');
		var m_userlogin = $('.ms-member.register .logged-in-account span').data('memberlogin');
		var m_username = $('.ms-member.register .logged-in-account span').data('membername');
		var m_message = 'Hello '+m_username+', You have successfully sent your application for OFW Power Club Membership blah blah blah. Your OFW Power Club USERNAME is: '+m_userlogin+'. To complete your application you can pay through bank transfer (Bank Name: Bank of the Philippine Islands | Account Number: 45987612313 | Account Name: Ricky Rueda Sadiosa) or just visit us in our office (Address: Unit 1230 Block B, Profit Industrial Building, 1-15 Kwai Fung Crescent Kwai Chung N. T).';
		$('.ms-member.register .emailtomember .your-name input').val( m_username);
		$('.ms-member.register .emailtomember .your-email input').val(m_useremail);
		$('.ms-member.register .emailtomember .your-message textarea').val(m_message);
		$('.ms-member.register .emailtomember .your-subject input').val('OFW Power Club Membership Payment Options');

		$('.sendtouser .wpcf7').siblings('#wp_addmember_form').hide();

		$('.no-permission').siblings().hide();
    
	});
	
})(jQuery, this);
