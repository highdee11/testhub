<?php
require_once("includes/functions_st.php");
connect();

if(isset($_POST['search']))
	{global $connection;
       $return_result='';
		$search_word=$_POST['search'];
		if(empty($search_word) )
			{
				echo "no entry";
			}
		else
			{
				$result=mysqli_query($connection,"SELECT *FROM student_tbl WHERE name LIKE '%".$search_word."%'");
		 
		while($res=mysqli_fetch_array($result))
			{
				 
				if($res==true)
					{
						echo "<li id='{$res['matric_no']}'><h4>{$res['name']}</h4>matric:{$res['matric_no']}<b>|</b>level:{$res['level']}</li>";
					}
				}
		 				

		}
	}


if(isset($_POST['search_mat']))
	{global $connection;
			
		$search_word=$_POST['search_mat'];
		if(empty($search_word) )
			{
				echo "no entry";
			}
		else
			{
				$result=mysqli_query($connection,"SELECT *FROM student_tbl WHERE matric_no LIKE '%".$search_word."%'");
					while($res=mysqli_fetch_array($result))
				{
				 
					if($res==true)
						{
						 	echo "<li id='{$res['matric_no']}'><h4>{$res['name']}</h4>matric:{$res['matric_no']}<b>|</b>level:{$res['level']}</li>";
						 
						}
					 
				}
		 
		}
	}






	
	if(isset($_POST['full']))
		{
			$search_det=$_POST['full'];
			$result=mysqli_query($connection,"SELECT *FROM student_tbl WHERE matric_no ='{$search_det}'");
			while($det=mysqli_fetch_array($result))
			{
				if($det==true)
					{ $pic="student_images/{$det['image_name']}";
						echo	"<img width='250px' height='200px' src={$pic} />
								"."First Name:".$det['firstname']."</br>".
									"Last Name:".$det['lastname']."</br>".
								"Matric No:".$det['matric_no']."</br>".
								"Level:".$det['level']."</br>".
								"Department:".$det['department']."</br>".
								"Phone Number:".$det['phone_number']."</br>".
								"Gender:".$det['gender']."</br>".
								"Date of Birth:".$det['dob']."</br>".
								"Email:".$det['email']."</br>".
								"Address:".$det['address']."</br>";
					}
			}

		}








?>