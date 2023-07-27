$(document).ready( function(){
	
	$(".calendario").hide();

	$(".exibeCalendario").click(function(){
		$(".calendario").toggle("slow");
	});

})