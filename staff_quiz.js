$(function(){
 $("#quiz_ul ul li a").click(function(){	 
		 var clas=$(this).attr('class');
		 clas+='!';
		 document.cookie="class="+clas+";";
		 
	});
	$(".quiz").click(function(){
		clas="";
		 document.cookie="class="+clas+";";
	});
	 active();
function active()
	{ 
		if(document.cookie)
		{
		 var result=document.cookie;
		// alert(document.cookie);
			result=result.slice(result.indexOf('class'),result.indexOf('!'));
			result=result.split('=');
			 
			$('.'+result[1]).addClass('actyve');
		}
		 
	}
	
	
	
	
	
	
	

});