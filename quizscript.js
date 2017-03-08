
$(function(){
	 
	function paint_answered()
		{
			$.post('questiongenerator.php',{answered:1},function(data){
				var answd=data.split(',');
				var cls='';
					 for(var c=0;c<answd.length;c++)
							{
								cls=parseInt(answd[c])+1;
								 
								$("#"+cls).addClass('paint');
								
							}
					
				
			});
		}
function displayquestion(data)
		{
			 
			  
		$("#options ul li input[type='radio']:checked").prop('checked',false);
			var result=data.split('|');
		 $("#question_field h4").html(result[0]);
		 $("#options ul li span.radio1").html(result[1]);
		 $("#options ul li span.radio2").html(result[2]);
		 $("#options ul li span.radio3").html(result[3]);
		 $("#options ul li span.radio4").html(result[4]);
		 var user_ans=result[5];
		//alert(user_ans);
		 	 $("#options ul li input").each(
				function(){
					if($(this).val()==user_ans)
						{
							$(this).prop('checked',true);
							user_ans=0;
						}
					
				});
		 
			paint_answered();
			 
			runtime();
		}	

	var time=0;
//printing question out first even when refreshed
	$.post("questiongenerator.php",{start:1,current_question:1},function(data){
			 displayquestion(data);
			
	});

//nexting the question	
	$("#next").click(function(){
		$(".rad").removeAttr('checked');
		stoptime();	 
		 
	$.post("questiongenerator.php",{start:1,next:1},function(data){
		displayquestion(data);
	
	});
 }); 
	
// previousing the question
	$("#previous").click(function(){
		$(".rad").removeAttr('checked');
			stoptime();  
	$.post("questiongenerator.php",{start:1,previous:1},function(data){
	displayquestion(data);
		
	});
	
 });	
//tracking if the user clicked an answer
	$("#options ul li input[type='radio']").click(function(){
		var ans=$(this).val();
		 
		$(this).attr('checked','checked');
		$.post("questiongenerator.php",{start:1,ans:ans},function(data){  });
		 paint_answered()
});
//tracking the click of the question modules
$("#question_modules ul li").click(function(){
	var numb=parseInt($(this).html())-1;
	 $.post("questiongenerator.php",{start:1,q_module:numb},function(data){
	 displayquestion(data)
	 });
});
//tracking the finish attempt button
		$("#finish").click(function()
		{
			var msg="your answers were submitted succecfully.check your mail for your result later{$result}.";
			var result=confirm("Are you Sure You Want To Submit?");
			if(result==true)
				 {
				 $.post("questiongenerator.php",{start:1,finish:1},function(){ });
				 window.location="quizpage.php?pgst_id=2&subj=1&msg="+msg;
				 }
			else
				{
					return;
				}
			
		});
	function submit()
		{
			 var msg="your answers were submitted succecfully.check your mail for your result later{$result}.";
			 window.location="quizpage.php?pgst_id=2&subj=1&msg="+msg;
				
		}
		 
	var settimeid='';
	 
//running a time for the quiz
function stoptime()
{
	 
	clearTimeout(settimeid);
}
function runtime( )
	{ 			
		var cookie_result=document.cookie;
		var sliced=cookie_result.slice(cookie_result.indexOf('time'),cookie_result.indexOf(','));
		sliced=sliced.split('=');
		var tyme=sliced[1].split(':');
		//alert(sliced);
	  var hrs=parseInt(tyme[0]);
	  var mins=parseInt(tyme[1]);
	  var secs=parseInt(tyme[2]);
			if(secs>0)
				{
					secs-=1;
				}
			else if(secs<=0)
				{	if(mins>0)
					{
						secs=60;
					}
					else if(mins<=0 && hrs<=0)
					{
						 
						 submit();
						return 0;
						
						
					}
					if(mins>0)
					{
						mins-=1;
					}
					else
					{
						  mins=0;
						if(hrs>0)
							{
								hrs-=1;
								mins=59;
							}
						else
							{
								hrs=0;
							}
					}
				}
			else if(secs==0 && mins==0 && hrs==0)
				{
					alert('timeout');
				}
					var timeresult=	hrs+':'+mins+':'+secs;
						time=timeresult;
						document.cookie="time="+time+":,";
					$("#time p").html(timeresult);
				//	savetime(timeresult);
			settimeid=setTimeout(function(){runtime(timeresult);},1000);
	}

 
	$("body").keypress(function(){
		 
			alert(event.which);
		 
	});
 
	
});