<?php
require_once("includes/functions_st.php");
?>
<!doctype html>
<html lang="en">
 <head>
  <title>Document</title>
   <link rel="stylesheet" href="csdesign.css">
 </head>
 <body > 
<?php if(isset($_GET['error']))
             {echo $_GET['error'];}
    ?>
	<?php connect();?>
 <?php 
 if(isset($_POST['submit']))
 {
	 
			$username=$_POST['username'];
		$name =mysqli_prep(trim($username));
	$chk=request_admindetails($name);
	 if($chk==true)
	 {
			header("Location:create_form.php?error=username alraedy exist");
			exit;
	 }
		else{
			
			$image_name=$_FILES['file']['name'];
				$move=move_uploaded_file($_FILES['file']['tmp_name'],'staff_images/'.$_FILES['file']['name']);
			if(!$move)
			{
				die("image not uploaded");
			}

			
			$username=$_POST['username'];
		$name =mysqli_prep(trim($username));
		$phone_number=mysqli_prep(trim($_POST['tel']));
		$gender=mysqli_prep(trim($_POST['gender']));
		$password=mysqli_prep(trim($_POST['password']));
		$pswd=md5($password);
		$email=mysqli_prep(trim($_POST['email']));
		}		
			$query="INSERT INTO staff_tbl (username,phone_number,gender,password,email,image_name)
	 VALUES('{$name}',{$phone_number},'{$gender}','{$pswd}','{$email}','{$image_name}')";
	
	 if(mysqli_query($connection,$query))
	 {  
  ?> <script type="text/javascript">
          	 alert("Registeration was succefull");
	 
	 window.location="staff_login.php?admin";
	 </script>
	 <?php }
	 else{
		 die(mysqli_error($connection));
	 }
	 
  }  	 
  
 ?>

	  <div class="form">
     <form action="create_form.php" method="POST" enctype="multipart/form-data">
		<fieldset >
			<table >
			    <tr>
					<td>
						<input type="file" name="file" >
					</td>
				</tr>
				<tr>
					<td><label for="lfirstname">UserName </td>
					<td ><input type="text" name="username" id="lfirstname" maxlength="15" value=""  pattern="^[A-Za-z]+" title="no number is allowed in this field" required> </td>
				</tr>
				
				<tr>
					<td><label for="ltel">Tel No</td>
					<td><input type="tel" name="tel" id="ltel" maxlength="30" value="234"  pattern="^[0-9+]+" title="no alphabet is allowed in this field" required></td>
				</tr>
				<tr>
					<td> Gender</td>
					<td><select name="gender">
						<option value="gender">gender</option>
						<option value="male">male</option>
						<option value="female">female</option>
					</select> 
					</td>
				
				</tr>
				
				<tr>
					<td><label for="lpassword">Password</td>
					<td><input type="password" name="password" id="lpassword" maxlength="15" value=""   pattern="^[A-Za-z0-9]+" required ></td>
    				
    			</tr>
				<td>
						Email</td><td><input type="text" name="email" value="" pattern="^[A-Za-z0-9@.]+"  required>
					</td>
				
				
				<td> <input type="submit" name="submit"  value="Proceed"/> </td> 
			</fieldset>	
			</table>
	</form>
	</div>
</body>
</html>