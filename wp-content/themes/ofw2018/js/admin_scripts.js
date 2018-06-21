$(function() {

	$('.benefit-list .add').click(function() {
		var html = $(this).parent().data('itemhtml');
		$(this).siblings('ul').append(html);
	})

	$(document).on('click', '.benefit-list .remove', function() {
		var no_items = $('.benefit-list li').size();
		console.log(no_items);
		if (no_items == 1) {
			alert('You should provide atleast 1 benefit for the members');
		} else {
			$(this).parent('.item').remove();
		}
	})

})