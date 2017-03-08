<?php session_start();?>
<?php
	require_once("includes/functions_st.php");
?>
  <?php
  //setting all session empty.
	$_SESSION=array();
	if(isset($_COOKIE[session_name()]))
	{
			setcookie(session_name,'',time()-50000,'/');
		
	}
     session_destroy();
	 if(isset($_GET['student']))
	 {
	 redirect_to("Home.php");
	 }
	 else
	 {
			 redirect_to("staff_login.php?admin=1");

	 }
  ?>