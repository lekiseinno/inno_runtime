$(document).ready(function(){
	//var width = $(window).width();
	$('.panel-content').css({
		width : $(window).width(),
		height : ($(window).height() - ($('#hnavs').height()) - ($('#hfooter').height()))
	});
	$('#card-overflows').css({
		height : (($('#hcontent').height()) - 20)
	});
});