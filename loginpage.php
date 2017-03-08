<?php session_start();
require_once("includes/functions_st.php");
 connect();
// validating login page.
 if(!isset($_SESSION['matric_no'])){
	 if(isset($_POST['matric_no']) && isset($_POST['ps'])){
	$nam="";
	$ps=md5($_POST['ps']);
    $det=request_details($_POST['matric_no'],$nam);
	if($det['matric_no']==$_POST['matric_no'] && $det['password']==$ps)
		
				{
					$_SESSION['matric_no']=$det['matric_no'];
					$_SESSION['name']=$det['name'];
					$_SESSION['image']=$det['image_name'];
					header("Location:Home.php");
					exit;
				}
	else {
				echo "incorrect matric_no or password.";
		}
	}
 }
else if(isset($SESSION['matric_no']))
{
	redirect_to("Home.php");
}

if(isset($_POST['test']))
	{
		if(isset($_SESSION['matric_no']))
			{
				echo 1;
			}
		else
			{
				echo 0;
			}
	}
 close_connection($connection);?>