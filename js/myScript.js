$(document).ready(function(){
	$(".login").hide();
	$(".loginBtn").on("click", function(e){
		
		$(".login").slideToggle();
	});
});