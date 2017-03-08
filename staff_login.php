 <?php 
session_start();
?>
<?php
require_once("includes/functions_st.php");
?>
<?php connect();
 ?>
 <?php 
	// validating login page.
if(isset($_POST['submit']))
{
if(isset($_POST['user']) && isset($_POST['pas'])){
	$nam="";
	$pas=md5($_POST['pas']);
    $det=request_admindetails($_POST['user']);
	if($det['username']==$_POST['user'] && $det['password']!=$pas)
	{
		$_SESSION['user']=$det['username'];
	?>
<script type="text/javascript">
	window.location="staff_home1.php?pgst_id=1";
</script>
<?php 
  }
else {?>
	<script type="text/javascript">
     alert("incorrect password or username");
		window.location="staff_login.php?admin=1";
    </script>
   <?php }
}
}elseif(isset($SESSION['user']))
{
	redirect_to("staff_home1.php?pgst_id=1");
}

     	
?>
<!doctype html>
<html lang="en">
 <head>
  <title>Document</title>
  <link rel="stylesheet" href="staffcsdesign.css">
 </head>
 <body id="login_body">
 <?php 
if(isset($_GET['admin']))
{?><div id="staff_logincontainer">
<div id="hg_login" align="center"> Welcome To Cpanel </div>
<h4>Admin Login</h4>
<form id="login_form" align="center" action="staff_login.php"  method="post">
	         <input id="username_login" type="username"  name="user" placeholder="Username" value=""/></br>
	         <input id="password_login" type="password" name="pas"   placeholder="Password" value=""/></br>
	<input id="login_button" type="submit" name="submit" value="    Login   "/></br>
 </form>
 <!--<a href="create_form.php">create an account</a>-->
 </div>
<?php } ?>

</body>
</html>
<?php close_connection($connection);?>
 
		