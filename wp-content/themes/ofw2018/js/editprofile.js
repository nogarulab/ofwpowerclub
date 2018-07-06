$(function() {
	var home_url = $('.header .mid-header a').attr('href');
	$('.ms-edit-profile').attr('href', home_url+'/edit-my-personal-details/');

	$('#edit_profile_form').prepend('<h2>'+$('.edit-my-personal-details section h1').text()+'</h2>');

	document.getElementById("profile_picture").onchange = function () {
	    var reader = new FileReader();
	    reader.onload = function (e) {
	        document.getElementById("profile_photo").src = e.target.result;
	    };
	    reader.readAsDataURL(this.files[0]);
	};
})