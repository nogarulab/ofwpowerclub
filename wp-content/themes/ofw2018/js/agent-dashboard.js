
var $=jQuery.noConflict();

$(function() {
	
	var showform = $.urlParam('showform')
	if (showform == 1) {
		$('#agent-change-password').show();
	}

});