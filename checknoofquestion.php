<?php
require_once("includes/functions_st.php");
connect();
if(isset($_POST['noq']))
	{
		global $connection;
		$set=$_POST['set'];
		$subj=$_POST['subj'];
		$subj_result=mysqli_query($connection,"SELECT *FROM $subj WHERE question_set='{$set}'");
		$query="SELECT *FROM $set WHERE subject='{$subj}'";
		$set_result=mysqli_query($connection,$query);
		$subj_res=mysqli_fetch_array($subj_result);
		$noofquest_attmpt=$subj_res['no_of_question'];
			 $set_res=mysqli_num_rows($set_result);
			
			if($noofquest_attmpt>$set_res)
				{
					echo "invalid";
				}
			else
				{
					echo "valid";
				}
	}





?>