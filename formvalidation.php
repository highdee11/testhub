<?php
require_once("includes/functions_st.php");
?>
<!doctype html>
<html lang="en">
 <head>
  <title>Document</title>
 </head>
 <body>
 <?php connect();?>
 <?php 
	  $chk=check_student($_POST['matric']);
		if($chk==true)
		{
			header("Location:staff_student.php?msg=alraedy exist");
			exit;
		}
		else{
			$firstname=$_POST['firstname'];
			$lastname=$_POST['lastname'];
		$fulname=$firstname.$lastname;
		$name =mysqli_prep(trim($fulname));
		$matric_no=mysqli_prep(trim($_POST['matric']));
		$department=mysqli_prep(trim($_POST['dept']));
		$phone_number=mysqli_prep(trim($_POST['tel']));
		$address=mysqli_prep(trim($_POST['address']));
		$dob=mysqli_prep(trim($_POST['dob']));
		$gender=mysqli_prep(trim($_POST['gender']));
		$level=mysqli_prep(trim($_POST['level']));
		}		
		$query="INSERT INTO student_tbl (name,matric_no,department,phone_number,address,dob,gender,level)
	 VALUES('{$name}',{$matric_no},'{$department}',{$phone_number},'{$address}',{$dob},'{$gender}',{$level})";
	 if(mysqli_query($connection,$query))
	 {  
	   redirect_to("staff_student.php?msg=Registerationsuccefull");
	 }
	 else{
		 echo "unable to insert";
	 }
	 
    	 
 ?>
 
 </body>
</html>