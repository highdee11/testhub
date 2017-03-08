<?php session_start();?>
<?php
require_once("includes/functions_st.php");
?>
<?php connect();
 ?>
  <?php
				
				if(isset($_POST['set']))
				{
				  //this block queries for the 1st question that will be revealed when the user clicks start button.
				  //$qsid is the array that first take all the id of question that correlate to the current subject.
						//$sbj=$_GET['qsubj'];
						
					$_SESSION['noofquestion']=$_POST['noquest'];//getting the max no of question a student can attempt.
						 $set_name=$_POST['set'];
							$qsid=array();
						$sbj=$_POST['subj'];
						$_SESSION['setname']=$set_name;
						 $_SESSION['current_subject']=$sbj;
							$_SESSION['setname']=$set_name;
					$query="SELECT *FROM $set_name WHERE subject='{$sbj}' ";
						$res=mysqli_query($connection,$query);
						
						while($rs=mysqli_fetch_array($res)) 
						{
								$qsid[]=$rs['id'];
								
						}
						$_SESSION['tid_array']=array();
						$_SESSION['id_array']=$qsid;
						//randomizing a particulare set of question for user
						if($qsid==null)
						{
							echo "question not ready.";
						}
						else
						{
							$noquest=mysqli_num_rows($res);
						 if($noquest < $_SESSION['noofquestion']) //checking if the no_of_question set by the staff is more than the question iin the set.
							{
								$_SESSION['noofquestion']=$noquest;
								$noquest=$_SESSION['noofquestion'];//taking back the max question so as to use it in the loop.
							}
						 else
						   {
							 $noquest=$_SESSION['noofquestion'];//assigning the max number of question to the loop.
						   }
					for($c=0;$c<$noquest;$c++)
						{
							$_SESSION['tid_array'][]=$qsid[mt_rand(0,count($qsid)-1)];
							
						}	
					
						$position=0;
					    $_SESSION['score']=0;
						
						$_SESSION['position']=$position;
					    
					    $qid=$_SESSION['tid_array'];
						
					    $questions=array();
					    $count=0;
					foreach($qid as $id)
					{	
					   $res=mysqli_query($connection,"SELECT *FROM $set_name WHERE id={$id} LIMIT 1");
					   $rs=mysqli_fetch_array($res);
					   $questions[]=array("{$rs['question']}","{$rs['option1']}","{$rs['option2']}","{$rs['option3']}","{$rs['option4']}","{$count}","{$rs['answer']}");
					   $count+=1;
					}
					$_SESSION['questions']=array();
					$_SESSION['questions']=$questions;
					$_SESSION['question_count']=count($questions);
				
				 
				  
				}
						
				} 
	if(isset($_GET['start']))
	{
		$sbj=$_SESSION['current_subject'];
		$set=$_SESSION['setname'];

		//getting the time to be spent for this quiz 
		$time_query=mysqli_query($connection,"SELECT *FROM $sbj WHERE question_set='{$set}'");
		$time=mysqli_fetch_array($time_query);
		$hours=$time['hours'];
		$mins=$time['mins'];
		$secs=$time['secs'];
		$_SESSION['time']=$hours.':'.$mins.':'.$secs;
		//setting the start time and date of the quiz
		$_SESSION['start_time']=date('h:i:s');
		$_SESSION['start_date']=date('Y:M:D');
		$matr="ansfor".$_SESSION['matric_no'];
		
	    $query="CREATE TABLE $matr ( id int(11) NOT NULL auto_increment,
					question_id int(11) NOT NULL,
					question_ans int(1) NOT NULL,
					user_ans  int(1) NOT NULL,
					PRIMARY KEY (id) )";
			$res=mysqli_query($connection,$query);
		if($res)
		{
			echo $_SESSION['time'];
		}
		else 
		{ 
			//echo "wasnot setup".mysqli_error($connection);
		}
		
	}

 
			
 
 
//checking if ans was picked by the user if true den insert into d db the question id and question ans ans user ans for marking at the end off the attempt
			
		if(isset($_GET['start']) || isset($_POST['start']))
		{ //n1   
						$matr="ansfor".$_SESSION['matric_no'];
		 				$questions=array();
						$questions=$_SESSION['questions'];
	    				$ans=array();
						$position=$_SESSION['position'];
						$question_id=$questions[$position][5];
						$question_ans=$questions[$position][6];
						$matric_no=$_SESSION['matric_no'];
						 
				 
				// $question_id=$questions[$position][5];
					
					
		 
				 
				 if(isset($_POST['ans']))
							 { 	
						 
									$matr="ansfor".$_SESSION['matric_no'];
									$user_ans=$_POST['ans'];
									//checking if ans is already in the db,maybe the user wants to change his/her answer.
									$res=mysqli_query($connection,"SELECT *FROM $matr WHERE question_id={$question_id} LIMIT 1");
									$rs=mysqli_fetch_array($res);
									if($rs)
									{//update the user answer IF THE USER CHANGES IT
										mysqli_query($connection,"UPDATE $matr SET user_ans = {$user_ans} WHERE question_id={$question_id}");
										echo mysqli_error($connection);
									
									}
									else
									{//writes the ans ans to the db since the user is just is just picking d answer 
										$user_ans=$_POST['ans'];
										mysqli_query($connection,"INSERT INTO $matr (question_id , question_ans , user_ans) VALUE ({$question_id},{$question_ans},{$user_ans}) ");
										echo mysqli_error($connection);
									}
							 }
					
				 
//looping tru the question with next and previous button by adding and subtracting 1 from the position.
	if(isset($_POST['current_question']))
				{
					$_SESSION['position']=$_SESSION['position'];
					$position=$_SESSION['position'];
					$return_pack=gen_quest($position);
					echo $return_pack;
					
				}
	if(isset($_POST['q_module']))
				{
					$_SESSION['position']=$_POST['q_module'];
					$position=$_SESSION['position'];
					$return_pack=gen_quest($position);
					echo $return_pack;
					
				}
	if(isset($_POST['next']))
				{
					if($_SESSION['position']>=count($questions)-1)
						{
							$_SESSION['position']=$_SESSION['position'];
							
						}
					else
						{
							$_SESSION['position']=$_SESSION['position']+1;
						}	
					 
						$position=$_SESSION['position'];
						$return_pack=gen_quest($position);
						echo $return_pack; 
				}
	 	
	if(isset($_POST['previous']))
					{
						if($_SESSION['position']==0)
						{
							$_SESSION['position']=0;
						}
						else
						{
							$_SESSION['position']=$_SESSION['position']-1;
						}
						$position=$_SESSION['position'];
						 $return_pack=gen_quest($position);
							echo $return_pack;
					}
		}
// this  block marks the answer of the students and saves it.				
if(isset($_POST['finish']))
				{
					$matr="ansfor".$_SESSION['matric_no'];

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

				}
				
		
function gen_quest($position)
			{
				$matr="ansfor".$_SESSION['matric_no'];
				global $connection;
				 $questions=array();
						$questions=$_SESSION['questions'];
	    				 $ans=array();
						$position=$_SESSION['position'];
						$question_id=$questions[$position][5];
						$question_ans=$questions[$position][6];
						 $matric_no=$_SESSION['matric_no'];
						 
					 $res=mysqli_query($connection,"SELECT *FROM $matr WHERE question_id={$question_id} LIMIT 1");
						 $rs=mysqli_fetch_array($res);
						 $check=false;
						 $user_ans=0;
						 if($rs['question_id']!=null)
							{
								$check=true;
								$user_ans=$rs['user_ans'];
							}
							$quest_pack=$questions[$position][0]."|".
							$questions[$position][1]."|".	
							$questions[$position][2]."|".		
							$questions[$position][3]."|".		
							$questions[$position][4]."|".$user_ans;			
						 
							return $quest_pack;
					 
			}
 	    // echo  "<div class='question'><h4>{$questions[$position][0]}</h4></div>";

//setting time into session
if(isset($_GET['collecttym']))
{
	if(isset($_SESSION['time']))
			{
				$time=$_SESSION['time'];
				echo $time;
			
			}
			
}
 
 if(isset($_GET['savetym']))
	{
		if($_GET['savetym']==0)
			{
					
			}
		else{
			$_SESSION['time']=$_GET['savetym'];
			echo $_SESSION['time'];
			}
	}
 
 if(isset($_POST['answered']))
	{
		$matr="ansfor".$_SESSION['matric_no'];
		$result=mysqli_query($connection,"SELECT *FROM $matr");
		 
			while($res=mysqli_fetch_array($result))
				{
					echo $res['question_id'].',';
				}
		
		}
 
 
 
 
 
 
 
 
 
 
 
 
 ?>
