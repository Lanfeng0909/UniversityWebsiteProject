//remove button to remove enrolment
$(document).ready(function(){
	$(".removebutton").click(function(){
	  $(this).parents("tr").hide();
	});
});