<?php session_start();?>
<?php
require_once("includes/functions_st.php");
?>
<?php connect();
 ?>
<html lang="en">
 <head>
  <title>Document</title>
	<link rel="stylesheet" href="csdesign.css"/>
	<script src="jquery-3.1.0.min.js"></script>
    <script src="quizscript.js"></script>
  </head>
 <body id='attemptbody'>
		<div id='left'>	<div id='question_field'>
			<h4 class='question'></h4></div>
		<div id='options'>				
			<ul>
				<label for='radio1'> <li >	<input id='radio1' class='rad' type='radio' value='1' name='rad_ans'/><span class='radio1'></span></li>
				<label for='radio2'> <li >	<input id='radio2' class='rad' type='radio' value='2' name='rad_ans'/><span class='radio2'></span> </li>
				<label for='radio3'> <li >	<input id='radio3' class='rad' type='radio' value='3' name='rad_ans'/><span class='radio3'></span> </li>
				<label for='radio4'> <li >	<input id='radio4' class='rad' type='radio' value='4' name='rad_ans'/><span class='radio4'></span> </li>
			</ul>
		</div>
			
		<div id='controls'> 
		<button id='next'>NEXT</button>
		 <button id='previous'>PREVIOuS</button>
		 </div>
		 </div>		
 <div id='right'>
		
				<div id='time'><p></p></div>
				<?php 
				if(isset($_SESSION['question_count']))
					{
						echo "<div id='question_modules'><ul>";
						$numb=$_SESSION['question_count'];
							for($c=1;$c<=$numb;$c++)
								{
									 echo "<li id='$c' class='q_count_li'> $c </li>";
								}
						echo  "</ul></div>";
					}
				?>
				<button id='finish'>Finish Attempt</button>
		</div>
	</div>
		
	
 </body>
 </html>
 <?php close_connection($connection);?>