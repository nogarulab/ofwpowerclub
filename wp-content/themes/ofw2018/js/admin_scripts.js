$(function() {

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

})