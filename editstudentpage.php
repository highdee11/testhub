<?php
require_once("includes/functions_st.php");
?>
<?php connect();?>
<!doctype html>
<html lang="en">
 <head>
  <title>Document</title>
 </head>
 <body> 	   <?php if(isset($_GET['error'])){echo $error;}?>
  	  <?php
        if(isset($_GET['mat']))
		{			
		   
		 $det=edit_details($_GET['mat']);
	    }
		
	?>

	 <?php
	       if(isset($_POST['save']))
		   { 
         	  	
			
            
		if(isset($_POST['new_password']) || isset($_POST['current_password']))
		{
		 if($det['password']==$_POST['current_password'] || empty($_POST['current_password']) || empty($_POST['new_password']))
		 {		 
		$name =mysqli_prep(trim( $_POST['name']));
		$department=mysqli_prep(trim($_POST['dept']));
		$phone_number=mysqli_prep(trim($_POST['tel']));
		$address=mysqli_prep(trim($_POST['address']));
		$gender=mysqli_prep(trim($_POST['gender']));
		$level=mysqli_prep(trim($_POST['level']));
		$query="UPDATE student_tbl SET name='{$name}',
											department='{$department}',
											phone_number={$phone_number},
											address='{$address}',
											 
											gender='{$gender}',
											level={$level}			 								
											WHERE matric_no={$_POST['matric']}";						
	 												
	 if(mysqli_query($connection,$query))
	 {   echo "succecful";
	   redirect_to("editstudentpage.php?error=Registerationsuccefull");
	 }
	 else
	 {
		 echo "unable to insert";
	 }
		}
		}
	} 		   
	//	else{echo "formal passsword doesnt match";}
	
	
			
		
     	?>
		
     <form action="editstudentpage.php?mat=<?php echo urlencode($det['matric_no']);?>" method="POST">
		<fieldset align="center">
			<table>
				<tr>
					<td><label for="lfirstname">NAME </td>
					<td><input type="text" name="name" id="lfirstname" maxlength="15"   value="<?php echo $det['name'];?>" required> </td>
				</tr>
				<tr>
					<td><label for="lmatricno">Matric No</td>
					<td><input type="number" name="matric" id="lmatricno" maxlength="6" value="<?php echo $det['matric_no'];?>" required></td>
					
					<td><label for="llevel">Current Level</td>
					<td><input type="number" name="level" id="llevel"   maxlength="7"  value="<?php echo $det['level'];?>"required></td>
					
				</tr>
				<tr>
					<td><label for="ldept">Department</td>
					<td><input type="text" name="dept" id="ldept" maxlength="30" value="<?php echo $det['department'];?>"required></td>
					
					<td><label for="ltel">Tel No</td>
					<td><input type="tel" name="tel" id="ltel" maxlength="30" value="<?php echo $det['phone_number'];?>"required></td>
				</tr>
				 
				<tr>
					<td><label for="laddress">Address</td>
					<td><textarea  name ="address" id="laddress" rows="3" cols="25" required><?php echo $det['address'];?></textarea></td> 
				     <td> Gender 
					<select name="gender"><option
					value="
					<?php 
					$arry=array("male","female",);
					foreach($arry as $str) {
						if($det['gender']==$str)
						{
								echo $det['gender'];
						}else{ $sec=$str; }	}?>">  <?php echo $det['gender'];?></option>
						<option value="<?php echo $str ;?>"><?php echo $str;?> </option>
					
					</select> 
			
           			</td>
			  <td> <input type="submit" name="save"  value="Save"/> </td>
				</tr>
				 
			</fieldset>	
			
			</table>
	</form>
</body>
</html>