$(function(){
	$("#search_list ").css('opacity','0').hide();
//autocomplete for matr_no	
	$("#nam").keyup(function(){
			var result=$(this).val();
			$('.search_field').removeClass('move');
			$("#search_list ").css('opacity','1').show();
			 
				if(result!=null && result!=" ")
			{
				$.post("staff_student_php.php",{search:result},function(data){
				if(data=="")
					{
						$("#search_list ul").html("no student found");
					}
				else
				  {
						$("#search_list ul").html(data);
						$("#search_list ul li").click(function(){
							var mat=$(this).attr('id');
							$.post("staff_student_php.php",{full:mat},function(data){
							$("#search_list").hide();
							 
								$("#search_result p").html("<div id='search_banner'>  Search Result </div>"+data);
							 
						});
						});
				  }
				  });
			}
	});
			
			 
	 
	
	$("#matr_no").keyup(function(){
			var result=$(this).val();
			$('.search_field').removeClass('move');
			$("#search_list ").css('opacity','1').show();
			request_details(result);
			 
	});

		
		function request_details(result)
			{
				if(result!=null && result!=" ")
			{
				$.post("staff_student_php.php",{search_mat:result},function(data){
				if(data=="")
				{
					$("#search_list ul").html("no student found");
				}
				else
				{
				$("#search_list ul").html(data);
				$("#search_list ul li").click(function(){
					var mat=$(this).attr('id');
				$.post("staff_student_php.php",{full:mat},function(data){
					$("#search_list").hide();
					 
					 	$("#search_result p").html("<div id='search_banner'>  Search Result </div>"+data);
					 
				});
					});
				}
			});
			}
			}
			
		$("#submit").click(function(){
			var mat_val=$("#matr_no").val();
			var nam_val=$("#nam").val();
		if(mat_val!="" && nam_val!="")
			{
				request_details(mat_val);
				
			}
		});
 	
	
	
});