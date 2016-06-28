$('document').ready(function() {
	$('#btn-customer').click(function(e) {		
		var data1 = $("#customer-form").serialize();
		$.ajax({
		    type : 'POST',
		    url  : 'response/newcustomer.php',
		    data : data1,
		    beforeSend: function()
		    { 
		      	$('#response').html(response).fadeIn().animate({scrollTop:$('#response').offset().top - 20}, 'fast');
    			$("#btn-customer").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Creating Customer ...');
		    },
		     success: function(response){
     			$('#response').html(response);
     			$("html, body").animate({ scrollTop: 0 }, 200);
     			$("#btn-customer").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Create Customer');
			}			    			     
		});
		e.preventDefault();
	});

	$('#btn-edit-customer').click(function(e) {		
		var data1 = $("#customer-form").serialize();
		$.ajax({
		    type : 'POST',
		    url  : 'response/editcustomer.php',
		    data : data1,
		    beforeSend: function()
		    { 
		      	$('#response').html(response).fadeIn().animate({scrollTop:$('#response').offset().top - 20}, 'fast');
    			$("#btn-edit-customer").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Editing Customer ...');
		    },
		     success: function(response){
     			$('#response').html(response);
     			$("html, body").animate({ scrollTop: 0 }, 200);
     			$("#btn-edit-customer").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Edit Customer');
			}			    			     
		});
		e.preventDefault();
	});



	$('table#dataTables-example td a#deleteCustomer2').click(function()
		{
			if (confirm("Are you sure you want to delete this Customer?"))
			{
				var id = $(this).parent().parent().attr('id');
				var data = 'id=' + id ;
				var parent = $(this).parent().parent();

				$.ajax(
				{
					   type: "POST",
					   url: "response/deletecustomer.php",
					   data: data,
					   cache: false,
					   beforeSend: function()
					    { 
					      	$('#response').html(response).fadeIn().animate({scrollTop:$('#response').offset().top - 20}, 'fast');
					    },
					   success: function(response)
					   {
							$('#response').html(response).fadeIn().animate({scrollTop:$('#response').offset().top - 20}, 'fast');
							parent.fadeOut('slow', function() {$(this).remove();});
							
					   }
				 });				
			}
		});
});