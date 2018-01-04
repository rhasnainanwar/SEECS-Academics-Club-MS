/* Default */
$(function () {
	$('.subnavbar').find ('li').each (function (i) {
	
		var mod = i % 3;
		
		if (mod === 2) {
			$(this).addClass ('subnavbar-open-right');
		}
		
	});
});

/* Edit Dialogue */
$(document).ready(function(){
	$(".fa-pencil-square-o").click(function(){
		$("#myModal").modal('show');
		var courseID = $(this).parents('tr').find('td:eq(0)').html();
		var courseName = $(this).parents('tr').find('td:eq(1)').html();

		document.cookie = "id=" + courseID;
		$('.modal-title').text( 'Edit ' + courseID + ' Data');
		$('.modal-body #cid').attr('value', courseID);
		$('.modal-body #cname').attr('value', courseName);
	});
});

/* Confirm */
$(document).ready(function(){
	$(".fa-minus-circle").click(function(){
		//window.location.href = "course.php?cnum=" + $(this).parents('tr').find('td:eq(0)').html();
		$("#delete_message h2").html("Are you sure you want to delete " + $(this).parents('tr').find('td:eq(1)').html()+"?");
		document.cookie = "id=" + $(this).parents('tr').find('td:eq(0)').html();
		document.cookie = "name=" + $(this).parents('tr').find('td:eq(1)').html();
		$("#delete_message").slideDown();
	});

	$("#cancel").click(function(){
		$("#delete_message").slideUp();
	});
});