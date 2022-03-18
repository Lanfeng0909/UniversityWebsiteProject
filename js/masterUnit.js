
//DC use Modal open and close to edit unit name, coordinator, time and campus//
function openModal() {	
		editModal.style.cssText = "display: block;";	
}

function closeModal() {
		editModal.style.cssText = "display: none;";
}

//DC use delete button to delete unit//
$(document).ready(function(){
	$(".delete").click(function(){
	  $(this).parent().parent().hide();
	});
});