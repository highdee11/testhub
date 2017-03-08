<?php
require_once("includes/functions_st.php");
connect();
if(isset($_POST['subje']))
	{global $connection;
		$subje=$_POST['subje'];
		$set=$_POST['set'];
		 
		$result=mysqli_query($connection,"SELECT *FROM $subje WHERE question_set='{$set}'");
		$res=mysqli_fetch_array($result);
		echo "<h4>".$res['question_set']."</h4> </br> </br><hr><b> Subject:</b>".
		$subje."</br><hr><b>No Of Question In one: </b>"
		.$res['no_of_question']."  </br> <hr> <b>Time:</b>"
		.$res['hours']."<b>hours </b>".$res['mins']."<b> minutes</b> "
		.$res['secs']."<b> seconds </b><hr></br></br> ";
		
	}


if(isset($_POST['tym']))
	{
		global $connection;
		$subje=$_POST['sbje'];
		$set=$_POST['set'];
		$result=mysqli_query($connection,"SELECT *FROM $subje WHERE question_set='{$set}'");
		$res=mysqli_fetch_array($result);
		echo $res['secs'].",".$res['mins'].",".$res['hours'];
	}
?>