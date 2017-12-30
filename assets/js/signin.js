$(function () {
	
	jQuery.support.placeholder = false;
	test = document.createElement('input');
	if('placeholder' in test) jQuery.support.placeholder = true;
	
	if (!$.support.placeholder) {
		
		$('.field').find ('label').show ();
		
	}
	
});

//toggle mentor section display
$(document).ready(function(){
    $('input[type="checkbox"]').click(function(){
        var inputValue = $(this).attr("value");
        $("." + inputValue).toggle();
    });
});