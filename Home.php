<?php session_start(); 
require_once("includes/functions_st.php");
connect();
?>
<html>
<head>
<title>Home</title>
<link rel='stylesheet' href='newstudent.css'>
<script type='text/javascript' src='jquery-3.1.0.min.js'></script>
<script type='text/javascript' src='jquery-ui.js'></script>
<script type='text/javascript' src='newstudent.js'></script>

<body> 
 
 <div class='c_dark_login' id='dark_login'>
	<?php  
			if(!isset($_SESSION['matric_no'])){
		 ?>		 <div id="login_form">
				 <img src='images/loginbanner.jpg'  />
				<?php if(isset($_GET['msg'])){echo "<h5>incorrect password or username</h5>";}?>
	      
		
				<input type="number" class='mat' id="text_field" name="matric_no" placeholder="Matric Number"  required></br> 
				<input id="text_field" class='pas' type="password" name="ps" placeholder="Password" pattern="^[A-Za-z0-9]+"  required></br>
				<input id="login_button" type="submit" name="submit" value="Login"/>
			
		 
		<div id="login_bottom_banner"><a class='create_account' href="studentcreate_form.php" >Create account</a>
		<a class='forgot' href=''>Forgot passowrd?</a></div>
		
		
		 <?php }
?>         </div>
</div>
 
<div  id='header'>
<div  id='block1'>
<div class='logo'><span id='ii'> </span></div>

 <div class='logo_name'><h3><center>CBT Online</center></h3> </div>
		<div class='block1_menu'>
			<ul>
				<li class='faq'><button>FAQ</button></li>
				<?php if(!isset($_SESSION['matric_no']) )
						{
							echo "<li id='login' class='log_out'><button>Login</button></li>";
						}
						
				  if(isset($_SESSION['matric_no']) )
						{
							echo "<li id='logout' class='log_out'><button>Logout</button></li>";
				   }?>
			</ul>
		</div>
</div>

 <div id='banner'>
	<div class='dark'></div>
	<div class='white'></div>
	<div class="banner_text hidden">
	<ul>
			<li>W</li>
			<li>E</li>
			<li>l</li>
			<li>C</li>
			<li>O</li>
			<li>M</li>
			<li>E</li>	
	</ul>
	
	<p class='under_text  hid'>Test your ability by taking online test of your courses here</p>
	 </div>
	<img id='img' class='banner' src='images/bkgrd1.jpg' />
			<div class='menu'>
				<ul>
					<li ><button class='tat'><h5>Take A Tour</button></h5></li>
					<li ><button class='quiz'><h5>Quiz</h5></button></li>
				</ul>
			</div>
			
	
</div>


<div class="block2">
	<ul class='block2_menu'>
		<li class='home' ><a  href='Home.php'>Home</a></li>
		<li class='Quiz'><a >Quiz</a></li>
		<li class='About'><a href='aboutpage?pgst_id=3'>About</a></li>
	</ul>
</div>
</div>
	
<div id='container'>

<div id='cont_block1'>
<h4> We Use Information Technology To Promote Academics</h4></br>
<p> And also prepare you for International Exams</p>
</div>

	<div id='cont_block2'>
		<div class='img'><img  src="images/Z(2).jpg" /></div>
	 
	<p>	Quiz will be administered to applicant after </br> proper registeration in order to test</br> their knowledge about their </br>course of studies.
			<button id='attempt_quiz'>Attempt Quiz</button>
			</p>
		
	
	</div>
	 
	<?php 
	global $connection;
	$result=mysqli_query($connection,"SELECT *FROM subjects LIMIT 5");

	?>
	<div id='cont_block3'>
	<p>Featured Courses</p>
		<ul>
			 
						<li><img src='images/phy.jpg'  /><span><h5>Physics</h5></span></li>
						<li><img src='images/bio.jpg'  /><span><h5>Biology</h5></span></li>
						<li><img src='images/cs.jpg'  /><span><h5>Computer Science</h5></span></li>
						<li><img src='images/mth.jpg'  /><span><h5>Mathematics</h5></span></li>
						<li><img src='images/chm.jpg'  /><span><h5>Chemistry</h5></span></li>

			
		
		</ul>
	</div>
	
	<div id="footer">
    &copy; HIGHDEE INC
	 <a href="logout.php?student" >Logout</a>
	</footer>
	</div>
</div>
 
	
</body>
</html>