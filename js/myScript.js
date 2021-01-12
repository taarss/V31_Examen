$(document).ready(function(){
	$(".register").hide();
	$(".registerBtn").on("click", function(e){
		
		$(".register").slideToggle();
	});
});

$(document).ready(function(){
	$(".login").hide();
	$(".loginBtn").on("click", function(e){
		
		$(".login").slideToggle();
	});
});

