
$(function(){
	 
	 
		setTimeout(function(){$(".block_subj").removeClass('slidein');},100);
		$(".set_div").addClass('hyd');
		 $("#strt").hide();	
//tracking block_subj clicking so as to bring in set underneath
			$(".block_subj ul li a").click(function(){
		 
			id=$(this).attr('class');
			id=id.replace(' ','',id);
		if($("#"+id).hasClass('hyd'))
			{
				 
				 $(".set_div").addClass('hyd');
				 $("#"+id).removeClass('hyd');
			
			}
		else{
				$("#"+id).addClass('hyd');
			}
			 
			});
//end of tracking block_subj
	 var subje,setname,noofquest;
	$(".set_div ul li a").click(function(){
			$(".set_dt h6").hide();
			$(".set_dt h5").hide();
			  subje=$(this).attr('id');
			 setname=$(this).html();
			   noofquest=$(this).attr('noquest');
			  
//posting to check if no of question is more than d noofquest for an attempt
			$.post("checknoofquestion.php",{noq:0,set:setname,subj:subje},function(data){
			 
			if(data!="valid")
				{
					 $("#strt").addClass('notready').removeClass('start').html("Not Ready").show();
				}
			else
				{
					$("#strt").addClass('start').removeClass('notready').html('Start').show();
					$("#strt").css("opacity","1.0");
				}
			});	
				
//posting to collect info about the selected set.  
			$.post("set_details.php",{subje:subje, set:setname},function(data){
			 $(".set_dt p").html(data);
			   });
 //posting to get questions ready for d attempt
			$.post("questiongenerator.php",{set:setname,noquest:noofquest,subj:subje},function(data){
				 
			});
			
			
		  
		 
	 });
	 
	  $("#strt").click(function(){
			  var clas=$(this).attr('class');
				if(clas=="start")
					{
					  var result=confirm("Are you sure you want an attempt?");
						if(result==true)
							{	$.post("questiongenerator.php",{set:setname,noquest:noofquest,subj:subje},function(data){
							
									});
									$.get("questiongenerator.php",{start:0},function(data){});
									$.get("questiongenerator.php",{collecttym:0},function(data){ document.cookie="time="+data+":,";;});
										window.location="attemptpage.php";
										
							}
						else
							{
								return;
							}
					}
				 else
					 {
						  
					 }
	  });
	 
	
	 
	 
	 
	 
	 
	 
	 
	 
});