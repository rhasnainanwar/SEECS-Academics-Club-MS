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
        $select = $("." + inputValue+" select");
        // make the field required if their parent is selected
       	if ($select.attr('required')) {
	        $select.removeAttr('required');
	    } else {
	        $select.attr('required', 'required');
	    }
    });
});