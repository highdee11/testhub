var username="";
function bot_message(message)
	{
		$("#container").html(message);
	}
 function chatbot()
	{
		var msg="hello, what is your name pls";
		$("#container").html("<span class='bot'>Chatbot: </span>"+msg);
	}
	function response(message)
		{	
			bot_message("Nice to meet you "+message+" ,how are you doing?");
			
		}
	
	
	$(function(){
		
		chatbot();
		$("#txtarea").keypress(function(event){
		
			if(event.which==13)
				{
					if($("#enter").prop("checked") )
						{
							
							event.preventDefault();
							$("#send").click();
						}
				}				
				
		});
		
		$("#send").click(function(){
			var recent_text=$("#container").html();
			var current_text=$("#txtarea").val();
			
			var current_text="<span class='main_text'>"+current_text+"</span>";
			
			var username="<span class='username'>You:</span>";
		if (recent_text==0)
				{
					
					recent_text="";
				}
			else
				{
					 recent_text=$("#container").html()+"<br/>";
				}
			if(current_text!="")
				{
					$("#container").html(recent_text+username+current_text);
				}
			$("#txtarea").val("");
			$("#container").scrollTop($("#container").prop("scrollHeight"));
			response(current_text);
		});
	
	
	 
	
	
	
	});
	

