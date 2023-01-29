$( document ).ready(function() {
	
	// Feather Icons
	feather.replace();
	
	// Equal Height
	$('.equal-height').matchHeight({ byRow: false, property: 'height' });
	
	// Input group focus
	$(".input-group > input").focus(function(e){
        $(this).parent().addClass("input-group-focus");
    }).blur(function(e){
        $(this).parent().removeClass("input-group-focus");
    });
	
	const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
	const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
	
});