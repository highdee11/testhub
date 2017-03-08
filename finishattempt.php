<?php
//session_start();
 require_once("includes/functions_st.php");
 connect();
 
 $matr="ansfor".$_SESSION['matric_no'];

// this  block marks the answer of the students and saves it.
							global $connection;
							$query="SELECT *FROM $matr WHERE question_ans=user_ans";
							$res=mysqli_query($connection,$query);
							$result=mysqli_num_rows($res);
							$msg="your answers were submitted succecfully.check your mail for your result later{$result}.";
							$name=$_SESSION['name'];
							$matric_no=$_SESSION['matric_no'];
							$percentage_score=($result/5) *100;
							$subject=$_SESSION['current_subject'];
							$set=$_SESSION['setname'];
							$start_time=$_SESSION['start_time'];
							$date=$_SESSION['start_date'];
							$query="INSERT INTO student_score (student_name,student_matric,score,subject,question_set,percentage_score,start_time,date) VALUE (
													'{$name}',{$matric_no},{$result},'{$subject}','{$set}' ,{$percentage_score},'{$start_time}','{$date}' )";
							
							$res=mysqli_query($connection,$query);
							
							  mysqli_query($connection,"DROP TABLE $matr");
							header("Location:quizpage.php?pgst_id=1&msg=$msg");
							 exit;

		
 
 

?>