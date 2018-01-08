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
		var id = $(this).parents('tr').find('td:eq(0)').html();
		var name = $(this).parents('tr').find('td:eq(1)').html();

		document.cookie = "id=" + id;
		$('.modal-title').text( 'Edit ' + id + ' Data');
		$('.modal-body #cid').attr('value', id);
		$('.modal-body #cname').attr('value', name);
	bnvc});
});

/* Confirm */
$(document).ready(function(){
	$(".fa-minus-circle").click(function(){
		$("#delete_message h2").html("Are you sure you want to delete " + $(this).parents('tr').find('td:eq(1)').html()+"?");
		document.cookie = "id=" + $(this).parents('tr').find('td:eq(0)').html();
		document.cookie = "name=" + $(this).parents('tr').find('td:eq(1)').html();
		document.cookie = "cid=" + $(this).parents('tr').find('td:eq(5)').html();
		$("#delete_message").slideDown();
	 
		$("#cancel").click(function(){
			$("#delete_message").slideUp();
		})
	})
});

/* Adding */
$(document).ready(function(){
	$(".fa-plus").click(function(){
		document.cookie = "id=" + $(this).parents('tr').find('td:eq(0)').html();
		document.cookie = "event=add";
		document.cookie = "name=" + $(this).parents('tr').find('td:eq(1)').html();

		document.location.reload(true);
	})
});