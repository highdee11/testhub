<?php
require_once("includes/functions_st.php");
?>   
<?php connect();?>

<?php
  if(isset($_POST['update']))
  {
			$chk=check_student($_POST['matric']);
  
		if($_POST['matric']==$_GET['matr'] || $chk==false)
		{
		 $matr=$_GET['matr'];
		 $image_type=$_FILES['file']['type'];
			$image_nam=$_FILES['file']['name'];
			
			$firstname=mysqli_prep(trim($_POST['firstname']));
			$lastname=mysqli_prep(trim($_POST['lastname']));
		$fulname=$firstname." ".$lastname;
		$name =mysqli_prep(trim($fulname));
		$matric_no=mysqli_prep(trim($_POST['matric']));
		$department=mysqli_prep(trim($_POST['dept']));
		$phone_number=mysqli_prep(trim($_POST['tel']));
		$address=mysqli_prep(trim($_POST['address']));
		$dob=mysqli_prep(trim($_POST['dob']))."";
		$gender=mysqli_prep(trim($_POST['gender']));
		$level=mysqli_prep(trim($_POST['level']));
		$password=mysqli_prep(trim($_POST['password']));
		$pswd=md5($password);
		$email=mysqli_prep(trim($_POST['email']));
		if(isset($_POST['file']))
			{
				$move=move_uploaded_file($_FILES['file']['tmp_name'],'student_images/'.$_FILES['file']['name']);
				$query="UPDATE student_tbl SET firstname='{$firstname}',lastname='{$lastname}',name='{$fulname}',matric_no={$matric_no},department='{$department}',
				phone_number={$phone_number},address='{$address}',dob={$dob},gender='{$gender}',level={$level},image_name='{$image_nam}' ,email='{$email}' 
                 WHERE matric_no={$matr}";
		    }
			else
			{
					$query="UPDATE student_tbl SET firstname='{$firstname}',lastname='{$lastname}',name='{$fulname}',matric_no={$matric_no},department='{$department}',
				phone_number={$phone_number},address='{$address}',dob={$dob},gender='{$gender}',level={$level},email='{$email}' 
                 WHERE matric_no={$matr}";
					
			}
		$result=mysqLi_query($connection,$query);
		header("Location:quizpage.php?pgst_id=1");
		exit;
		}
		elseif($chk==true && $_POST['matric']!=$_GET['matr'])
		{
			
			header("Location:quizpage.php?pgst_id=2&edit=1&error=Matric number alraedy exist");
			exit;
		
        }
  }
?>
<html>
 <head>
  <title>Document</title>
   <link rel="stylesheet" href="csdesign.css">
 
 </head>
 <body> 
<?php if(isset($_GET['error']))
             {echo $_GET['error'];}
		 elseif(isset($_GET['msg']))
             {echo  $_GET['msg'];}
    ?>
<?php
	if(isset($_POST['submit']))
	{		$chk=check_student($_POST['matric']);
		if($chk==true)
		{
			header("Location:studentcreate_form.php?error=Matric number alraedy exist");
			exit;
		}
		else{
			$image_type=$_FILES['file']['type'];
			$image_nam=$_FILES['file']['name'];
			$move=move_uploaded_file($_FILES['file']['tmp_name'],'student_images/'.$_FILES['file']['name']);
			if(!$move)
			{
				die("image not uploaded");
			}
			$firstname=mysqli_prep(trim($_POST['firstname']));
			$lastname=mysqli_prep(trim($_POST['lastname']));
		$fulname=$firstname." ".$lastname;
		$name =mysqli_prep(trim($fulname));
		$matric_no=mysqli_prep(trim($_POST['matric']));
		$department=mysqli_prep(trim($_POST['dept']));
		$phone_number=mysqli_prep(trim($_POST['tel']));
		$address=mysqli_prep(trim($_POST['address']));
		$dob=mysqli_prep(trim($_POST['dob']))."";
		$gender=mysqli_prep(trim($_POST['gender']));
		$level=mysqli_prep(trim($_POST['level']));
		$password=mysqli_prep(trim($_POST['password']));
		$pswd=md5($password);
		$email=mysqli_prep(trim($_POST['email']));
		$query="INSERT INTO student_tbl (name,firstname,lastname,matric_no,department,phone_number,address,dob,gender,level,password,email,image_name)
	 VALUES('{$name}','{$firstname}','{$lastname}',{$matric_no},'{$department}',{$phone_number},'{$address}',{$dob},'{$gender}',{$level},'{$pswd}','{$email}','{$image_nam}')";
	 if(mysqli_query($connection,$query))
	 {  
  ?> <script type="text/javascript">
          	 alert("Registeration was succefull");
	 window.location="Home.php";
	 </script>
	 <?php }
	 else{
		 die(mysqli_error($connection));
	 }
	 
   	
		}		
	}	
	  
		 
 ?>
 
 

<div id="containerform">
<div id="dark">
</div>
<div id="reg_banner"><h3>Create An Account</h3></div>
	<div id="create_form">
     <form action="studentcreate_form.php" method="POST" enctype="multipart/form-data">
		
				<div id="file"> Upload image<input class='file' type="file" name="file" ></div>
	
		<table id="table">
			 
				<tr  id="line1">
					<td><label for="lfirstname">First Name </td>
					<td><input class="lfirstname" type="text" name="firstname" maxlength="15" value=""   pattern="^[A-Za-z]+" title="no number is allowed in this field" required> </td>
				 
					<td><label for="llastname">  Last Name </td>
					<td><input type="text" name="lastname" class="llastname" maxlength="25" value=""  title="no number is allowed in this field" required> </td>
				</tr>
				<tr id="line2">
					<td ><label for="ldept">Department</td>
					<td><input type="text" name="dept" class="ldept" maxlength="50" value=""    title="no number is allowed in this field" required></td>
		
					
					<td><label for="lmatricno">Matric No</td>
					<td><input class="lmatricno" type="number" name="matric"  maxlength="6" value="" pattern="^[0-9]+" title="no alphabet is allowed in this field" required></td>
					
				</tr>	
				<tr id='line3'>	
					<td><label for="ltel">Tel No</td>
					<td><input type="tel" name="tel" class="ltel" maxlength="30" value="234"  pattern="^[0-9+]+" title="no alphabet is allowed in this field" required></td>
			
				
					<td><label for="llevel">Current Level</td>
					<td><input type="number" name="level" class="llevel"   maxlength="7"  value=""  pattern="^[0-9]+" title="no alphabet is allowed in this field" required></td>
				
				</tr>
			 
				<tr id="line4">
					
				<td> Gender</td>
					<td><select class="lgender" name="gender">
						<option value="gender">gender</option>
						<option value="male">male</option>
						<option value="female">female</option>
					</select> 
					</td>
				
				<td>Email</td>
					<td><input type="text" class="lemail" name="email" value="" pattern="^[A-Za-z0-9@.]+"  required></td>
				
				</tr>
				 <tr id="line5">
					<td><label for="ldob">Date Of Birth</td>
					<td><input type="date" name="dob" class="ldob" maxlength="11" value="" required></td>
				
					
					<td><label for="laddress">Address</td>
					<td><textarea  name ="address" class="laddress" rows="3" cols="25" required></textarea></td> 
			
					
				</tr>
				<tr id="line6">
					<td><label for="lpassword">Password</td>
					<td><input type="password" name="password" class="lpassword" maxlength="15" value=""   pattern="^[A-Za-z0-9]+" required ></td>
					 
    			</tr>
				<tr>
				<td> <input  type="submit"  class="proceed" name="submit" onclick="setcookie()"  value="Proceed"/> </td>	
				</tr>
					
				
			
			</table>
	</form>
	</div>
		<div id="create_form_placeholder">
		
			<span id="back_to_login"><a href="Home.php"> Login Page</a></span>
				 
		</div>
	</div>
	<script type="text/javascript">
	//creating custom object for saving student details into a cookie so that the user/student wont have to refiil d fields from d start again
 function setcookie()
		{
				var user_details={}; 
			 user_details.firstname=document.getElementById('lfirstname').value;
			 user_details.lastname=document.getElementById('llastname').value;
			 user_details.matric=document.getElementById('lmatricno').value;
			 user_details.level=document.getElementById('llevel').value;
			 user_details.dept=document.getElementById('ldept').value;
			 user_details.tel=document.getElementById('ltel').value;
			 user_details.gender=document.getElementById('lgender').value;
			 user_details.date=document.getElementById('ldob').value;
			 user_details.email=document.getElementById('lemail').value;
			 user_details.address=document.getElementById('laddress').value;
	  	 
  
	
		
		
			var jason=JSON.stringify(user_details);
			document.cookie="details="+jason;
		}
		window.onload=getcookie();
		function getcookie()
		{
			if(document.cookie.length!=0)
			{	//alert(document.cookie);
				
				  var cookie=document.cookie.split("=");
				  var result=JSON.parse(cookie[1]);
				  alert(result.firstname);
				  document.getElementById('lfirstname').value=result.firstname;
				  document.getElementById('llastname').value=result.lastname;
				  document.getElementById('lmatricno').value=result.matric;
				  document.getElementById('llevel').value=result.level;
				  document.getElementById('ldept').value=result.dept;
				  document.getElementById('ltel').value=result.tel;
				  document.getElementById('lgender').value=result.gender;
				  document.getElementById('ldob').value=result.date;
				  document.getElementById('lemail').value=result.email;
				  document.getElementById('laddress').value=result.address;
			} 
		}
		

 </script>
	
	
	
</body>
</html>	