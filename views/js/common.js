/**
 * 
 */
$(window).ready(function(){
	$(".login_outer,#login_email,#login_password").hover(function(){
		$(this).css('border','2px solid lightblue');
	},
	function(){
		$(this).css('border','');
	}
	);
	$('#login_email,#login_password').click(function(){
		$('.error').html("");
	});
});