
 $(function(){
	 
	 
	 
	 if($(window).scrollTop()> block2offset)
		{
				$(".block2").addClass("blk2");
		}
		 
		
		//$(".white").hide().addClass('wyt').fadeIn(1500).animate({left:"100%"},2000).fadeOut();
		//welcome animation for <welcome>
	setTimeout(function(){$(".banner_text").removeClass("hidden");},100);
	//welcome animation for <p>
	setTimeout(function(){$(".under_text").removeClass("hid");},1500);
	 
	$(".under_text").show();
	
	

		//getting offset of menu
		var block2offset=$(".block2").offset().top;	 
	 $(window).scroll(function(){
		//var ofs=window.pageYOffset;
	//$("#container").css('top',ofs*-1+'px');
	 //alert(block2offset+'and'+$(this).scrollTop());
		//menu block fixed algorithm.
		 if($(this).scrollTop()> block2offset)
		  {
			 //$("#header").addClass('header');
			$(".block2").addClass("blk2");
			  $("#container").addClass('indexcont');
			  
		  }
		  else{
			  $(".block2").removeClass("blk2");
			   $("#container").removeClass('indexcont');
		  }
	  });
	  
	  
//click button Quiz
	 $('.quiz').click(function(){
		// window.location="quizpage.php?pgst_id=2&subj=1";
		test();
	 });
//click button take a tour
	  $('.tat').click(function()
	  {
		  event.preventDefault();
		  var cont=$("#cont_block2").offset().top;
		  $("html body").animate({ scrollTop:cont},1000);
	  });
//click attempt quiz button
		$('#attempt_quiz').click(function(){
			//window.location="quizpage.php?pgst_id=2&subj=1";
			test();
		});
//checking if the user has login
	   function test()
		{
			
			$.post("loginpage.php",{test:1},function(data){
				 
				if(data==1)
				{
					window.location="quizpage.php?pgst_id=2&subj=1";
				}
				else
				{
					$("html body").animate({scrollTop:$("#block1").offset().top},500);
					$("#dark_login").show();
					
				}
			});
		}
	 $("#cont_block3 ul li").click(function(){
		//window.location='quizpage.php?pgst_id=2&subj=1';
		test();
	 });  
	    $("#logout").click(function(event){
 		    window.location='logout.php?student=1';
		   
	   });
	    
	   $("#login").click(function(event){
 		   $("#dark_login").show();
		   
	   });
	   $(".c_dark_login").click(function(event){
 		   $(this).hide();
	   });
	   $("#login_form").click(function(event){
 		  event=event||window.event;
		  if(event.stopPropagation)
			{
				event.stopPropagation();
			}
		else
			{
				event.cancelBubble=true;
			}
	   });
	   
	   $("#login_button").click(function()
	   {
		   var mat=$(".mat").val();
		   var pas=$(".pas").val();
		 
		   $.post("loginpage.php",{matric_no:mat,ps:pas},function(data){
			   if(data.match('password'))
				{
					 alert(data);
					  
					 $.get('Home.php',{msg:1},function(){ });
					  $("#dark_login").show();
				}
				else
				{
					$("#dark_login").hide();
 					 window.location="Home.php";
				}
		   });
		   
	   });
	   
	   
	   
	   	 $("#cont_block3 ul li img").mouseover(function(){
			 
			 $(this).animate({height:'200px'},300,'linear');
			 $(this).animate({height:'200px'},300,'linear');
			 
		 });
		 $("#cont_block3 ul li img").mouseout(function(){
			 
			 $(this).animate({height:'270px'},300,'linear');
		 
			 //$().animate({height:'270px'},300,'linear');
			 
		 });

	   
	   
	   
 });

 
 
 