<?php session_start();
echo "";
?>
<?php
require_once("includes/functions_st.php");
?>

<?php connect();
 ?>
  <?php 
	if(!isset($_SESSION['user'] )|| !isset($_GET['pgst_id']))
	{?>
		<script type="text/javascript">
			window.location="staff_login.php?admin=1";
		</script>
	<?php }?>
 <?php 
	if (isset($_GET['pgst_id']))
		{   
			 $pgid=$_GET['pgst_id'];
			 $pu=find_selected_spage($pgid);
			 
     	}
	?>
	<?php
	  if(isset($_POST['subj_name']))
	  {		//chk checks to see if d subject name already exit in dba_close
                $chk=0;
				$rt=request_subj();
				while($rtt=mysqli_fetch_array($rt))
				{
						if($rtt['subject_name']==$_POST['subj_name'])
					 {
						$chk=1;
						break;
					 }
				}
				if($chk==1)
						 {?>
						<script type="text/javascript">
							alert("subject already exit");
						</script>
					<?php }
					
				else
					{ 
						$subject_name=mysqli_prep($_POST['subj_name']);
							//$subject_img_name=$_FILES['file']['name'];
							$subject_name=str_replace(' ' ,'_',$subject_name);	
								
								
								
								
						echo $subject_name;
						//$move=move_uploaded_file($_FILES['file']['tmp_name'],'images_subject/'.$_FILES['file']['name']);
						 
								 $msg="subject not added,Enter a valid name";
								
								$query="CREATE TABLE  $subject_name ( id int(11) NOT NULL auto_increment,
											question_set varchar(100) NOT NULL,
											no_of_question int(7) NOT NULL,
											visible int(1) NOT NULL,
											hours int(2) NOT NULL,
											mins int(2) NOT NULL,
											secs int(2) NOT NULL,
											PRIMARY KEY (id)
											)  ";
								if(mysqli_query($connection,$query))
											{
												$subjt=str_replace('_',' ',$subject_name);
												$rees=mysqli_query($connection,"INSERT INTO subjects(subject_name) VALUE('{$subjt}')");
												  // echo mysqli_connection($connection);
												 
											?><script type="text/javascript">
												alert("Added succesfully.");
											</script>
										<?php }
								else
								  {	
									//header("Location:staff_quiz.php?pgst_id=2&adds=1&msg=$msg");
								//	exit;
								  }	
					  }
	   }
			 
	  ?> 
	  <?php
	  // validating the question set
		if(isset($_POST['submit_qs']))
		{  	$subject=mysqli_prep(trim($_POST['subj_select']));
			
			$setname=mysqli_prep(trim($_POST['question_setname']));

	    $chk=0;
		
			$query="CREATE TABLE $setname (
					id int(11) NOT NULL auto_increment,
					question varchar(500) NOT NULL,
					option1 varchar(400) NOT NULL,
					option2 varchar(400) NOT NULL,
					option3 varchar(400) NOT NULL,
					option4 varchar(400) NOT NULL,
					answer int(1) NOT NULL,
					subject varchar(60) NOT NULL,
					admin varchar(30) NOT NULL,
					PRIMARY KEY (id) )";
			$res=mysqli_query($connection,$query);
	if($res)
			{          $chk=0;
						//checking if the setname is already present in question set
						$reqs=mysqli_query($connection,"SELECT *FROM question_set");
					  
						while($rqs=mysqli_fetch_array($reqs))
						{
							if(strcasecmp($rqs['set_name'],$setname)==0)
								{
									$chk=1;
									break;
								}
							 
						}
						if ($chk==1)
						{
					
						}
						else{
							mysqli_query($connection,"INSERT INTO question_set (set_name) VALUE ('{$setname}')");
							
						}		  
								?>		
							 <script type="text/javascript">
							alert("Added succesfully.");
							</script>
	<?php }
		else
		{
			 
		}
		
					$chk=0;
						$res=mysqli_query($connection,"SELECT *FROM $subject WHERE question_set='{$setname}'");
						//checking if setname is already in the subject  
						 
						while($rs=mysqli_fetch_array($res))
						{
							if(strcasecmp($rs['question_set'],$setname)==0)
								{
									$chk=1;
									break;
								}
							else
								{
									$chk=0;
								}	
						}
						if ($chk==1)
						{
								echo "set already exists";
						}
						else
						{
							$noofquestion=$_POST['noofquestion'];
							$visible=0;
							 if(empty($_POST['hours']))
							{
								 $hours=0;
							 }
							 else
							 {
							 $hours=$_POST['hours'];
							 }
							 if(empty($_POST['mins']))
							 {
								 $mins=0;
							 }
							 else
							 {
							  $mins=$_POST['mins'];
							 }
							  
							 if(empty($_POST['secs']))
							 {
								 $secs=0;
							 }
							 else
							 {
							  $secs=$_POST['secs'];

							 }	
			         $reqs=mysqli_query($connection,"SELECT *FROM $subject");
					  
						while($rqs=mysqli_fetch_array($reqs))
						{
							if(strcasecmp($rqs['subject_name'],$setname)==0)
								{
									$chk=1;
									break;
								}
							 
						}
						if ($chk==1)
						{
					
						}
						else
						{
								mysqli_query($connection,"INSERT INTO $subject (question_set,no_of_question,visible,hours,mins,secs) VALUE ('{$setname}',{$noofquestion},{$visible},{$hours},{$mins},{$secs})");
						}		  
		
    }
				
				
		
	}	
		
	  ?>
	  <?php 
	  if(isset($_POST['submit_question']) || isset($_POST['update_question']))
	  { if(isset($_POST['submit_question']) )
		 {
				  $question=mysqli_prep(trim($_POST['question']));
				  $subject=mysqli_prep(trim($_GET['sbj']));
				  $optionA=mysqli_prep(trim($_POST['option1']));
				  $optionB=mysqli_prep(trim($_POST['option2']));
				  $optionC=mysqli_prep(trim($_POST['option3']));
				  $optionD=mysqli_prep(trim($_POST['option4']));
				  $answer=mysqli_prep(trim($_POST['ans']));
				  $set=mysqli_prep(trim($_POST['set_select']));
				  
				  $admin=$_SESSION['user'];
				  $admin_name=mysqli_prep(trim($admin));
						$query="INSERT INTO $set (question,option1,option2,option3,option4,answer,subject,admin )
								  VALUE('{$question}','{$optionA}','{$optionB}','{$optionC}','{$optionD}','{$answer}','{$subj}','{$admin_name}') ";
									if(mysqli_query($connection,$query))
										{?><script type="text/javascript">
										  alert( "Added succesfully.");
										  </script>
										<?php }
									else
								  {	
									echo "not added".mysqli_error($connection);
								  }
		 }
		 if(isset($_POST['update_question']))
			{
				  $question=mysqli_prep(trim($_POST['question']));
				  $subject=mysqli_prep(trim($_GET['sbj']));
				  $optionA=mysqli_prep(trim($_POST['option1']));
				  $optionB=mysqli_prep(trim($_POST['option2']));
				  $optionC=mysqli_prep(trim($_POST['option3']));
				  $optionD=mysqli_prep(trim($_POST['option4']));
				  $subj=mysqli_prep(trim($_POST['subj_select']));
				  $answer=mysqli_prep(trim($_POST['ans']));
				  $set=mysqli_prep(trim($_POST['set_select']));
				  $current_set=$_GET['cu_set'];
				  $admin=$_SESSION['user'];
				  $admin_name=mysqli_prep(trim($admin));
				  $qid=$_GET['id'];
				  if($current_set!=$set)
					{
									$query="INSERT INTO $set (question,option1,option2,option3,option4,answer,subject,admin )
									VALUE('{$question}','{$optionA}','{$optionB}','{$optionC}','{$optionD}','{$answer}','{$subj}','{$admin_name}') ";
									$result=mysqli_query($connection,$query);
										mysqli_query($connection,"DELETE FROM $current_set WHERE id=$qid");
					}
				else
					{
						$query="UPDATE $set SET question='{$question}',option1='{$optionA}',option2='{$optionB}',option3='{$optionC}',option4='{$optionD}',
						answer={$answer},subject='{$subject}',admin='{$admin_name}' WHERE id=$qid";
						$result=mysqli_query($connection,$query);
				
					}
				
				  if(!$result)
				{
					echo "not updated".mysqli_error($connection);
				}
				else 
				{
					echo "updated succesfully.";
					header("Location:staff_quiz.php?pgst_id=2&qs_name={$set}");
					exit;
				}
			}
   }	  
	?>

<html lang="en">
 <head>
  <title>Document</title>
    <link rel="stylesheet" href="staffcsdesign.css">
 <script type='text/javascript' src='jquery-3.1.0.min.js'></script>
<script type='text/javascript' src='jquery-ui.js'></script>
<script type='text/javascript' src='staff_quiz.js'></script>

 </head>
 <body>

 
<div id="container">
 
			 <div id="sidebar">
			<?php
					$user=$_SESSION['user'];
			
					$admin_details=request_admindetails($user);
					?>
					<div id="admin_details">
						<img style="width:100px;height:70px;" src="<?php echo 'staff_images/'.$admin_details['image_name'];?>">
					<?php
						echo "<h4>".$admin_details['username']."</h4>";
						echo "<br/>";
						
			     	?>
					</div>
					<?php
				?>
	 <?php 
				      if(isset($_SESSION['user']))
					 { ?>
				 <div id="menu">
				 <?php
					 $result = get_pages_staff();
					 while($resu=mysqli_fetch_array($result))
					{ ?>
						<li><a class='<?php echo $resu['menu-name'];?>' href="<?php echo $resu['url'];?>?pgst_id=<?php echo urlencode($resu['id']);?>"><?php echo $resu['menu-name'];?></a></li> </br>
					<?php
					}
					
					echo "</div>";
					
					 }
							?> 
			</div> 
	
		<?php 
	 
		
			//middle content of the page starts here ?>
<div id="content2">

	<div id="hg">
	<h2> DashBoard </h2><br/>
	 <a id="goto_website" href="loginpage.php">Go to website</a>
	 <a id="logout" href="logout.php?admin">Logout</a>
	</div>
	<br/>
							
			 <?php
	if((!isset($_GET['qs_name'])) && (!isset($_GET['question'])))//making sure it doesnt display this block whenever you want to  edit question
			 {
				 ?><div class="page_title">
						<?php
								if(isset($_GET['pgst_id']))
								{
									echo "<h1>{$pu['menu-name']}</h1></br>";
									echo "<h3>Manage Quiz Content</h3> ";
								}?>
								 </div>
			   <?php echo "<div id='quiz_menu'>";?>
						
					<div id='quiz_ul' >
								<h5>Manage Subject</h5></br>
						<ul>
								<li><a class='adds' href="staff_quiz.php?pgst_id=2&adds=1">Add New Subject</a></li>
								<li><a class='edits' href="staff_quiz.php?pgst_id=2&editsubj=1">Edit Subjects</a></li>
						
						</ul>
							</br>
						<ul>		<h5>Manage Question Set</h5></br>
						
								<li><a class='addqs' href="staff_quiz.php?pgst_id=2&addqs=1">Add New Question Set</a></li>
								<li><a  class='editqs' href="staff_quiz.php?pgst_id=2&editqs=1">Edit Question Set</a></li>
								
						</ul>		</br>
							<ul><h5>Manage Question</h5></br>
						  
								<li><a class='addq' href="staff_quiz.php?pgst_id=2&addq=1">Add New Question</a></li>
								<li><a class='editq' href="staff_quiz.php?pgst_id=2&editq=1">Edit Questions</a></li>
							</ul>	
					</div>
								
								<script type="text/javascript">
									
									function change()
									{
										var id=document.getElementById('quiz_ul').getElementsByTagName('a');
											for(var c=0;c<id.length;c++)
											{
												id[c].onmouseover=function()
												{
													this.style.border="3px rgb(45,67,83) solid";
													this.style.height="52px";
												}
											}
											for(var c=0;c<id.length;c++)
											{
												id[c].onmouseout=function()
												{
													this.style.border="0px";
													this.style.height="50px";
												}
											}
									}
								
								</script>
			<div id='quiz_menu2'>
				
							
						
					<?php 
						 
						//editting subjects.
							if(isset($_GET['editsubj']))
							{  ?><div id="edit_subj">
									<?php
								
								$subjects=request_subj();
								if(!$subjects)
								{?>
									<?php
								echo "no subjects yet";
							 
								}
								else
								{?>
						 <?php  
									while($rs=mysqli_fetch_array($subjects))
									{ ?>
									<h> <?php echo str_replace('_',' ',$rs['subject_name']);?>
										<a href="staff_quiz.php?pgst_id=2&delsubj=<?php echo urlencode($rs['subject_name']);?>" >Delete</a></br>
											</h> <?php
									}
								}
						 ?>       </div>
							<?php
							}?>	
					 
							
								 
						 <?php
							//editting question set
							if(isset($_GET['editqs']))
							{ ?> <div id="edit_qs">
					<?php 	
								$res=mysqli_query($connection,"SELECT *FROM question_set");
								while($set=mysqli_fetch_array($res))
								{?>
									<h> <?php echo $set['set_name'];?>
									
									<a  href="staff_quiz.php?pgst_id=2&del=<?php echo urlencode($set['set_name']);?>">Delete</a></br>
									</h>
								<?php 
								}
								?>
								</br>
								<a id="edit_frmsubj" href="staff_quiz.php?pgst_id=2&frmsbj">Edit From Subject</a>
								</div>
					<?php 	}
							?>
							
								<?php 
							if(isset($_GET['frmsbj']))
							{?><div id="quest_subj">	
								
							<?php	$frmsbj=request_subj();
								if(!$frmsbj)
								{
									echo "no subjects yet.";
								}
								else
									
								{	while($rs=mysqli_fetch_array($frmsbj))
									{ ?>
										<a href="staff_quiz.php?pgst_id=2&frmsubj=<?php echo urlencode(str_replace('_',' ',$rs['subject_name']));?>"><?php echo str_replace('_',' ',$rs['subject_name']);?></a>
									<?php }
								?>
						<?php 	}?></div>
						<?php
							}?>
							
							
								
							
							<?php
							if(isset($_GET['frmsubj']) && !isset($_GET['frmset']))
							{ ?><div id="edit_set">
					<?php
							  $frmsubj=$_GET['frmsubj'];
							  $res=mysqli_query($connection,"SELECT *FROM $frmsubj");
							  if(mysqli_num_rows($res)==0)
							  {
								  echo "No question set was found in this subject.";
							  }
							  else
							  {?>
							
						  <?php if(!isset($_GET['frmset']))  //making sure the list of question set doesnt display after a question set has been choosen
						  {
						  while($rs=mysqli_fetch_array($res))
								{  ?><div id="sets">
									<a href="staff_quiz.php?pgst_id=2&vis=<?php echo urlencode($rs['visible']); ?>&frmset=<?php echo urlencode($rs['question_set']);?>
									&frmnoquest=<?php echo urlencode($rs['no_of_question']);?>&frmsubj=<?php echo urlencode($frmsubj); ?>
									&questsid=<?php echo urlencode($rs['id']); ?>"><?php echo $rs['question_set'];?></a>
									
									</div>
							 <?php   
							   }
						  }
							  }?>
							 </div>
							<?php }	?>
							</br>
							
							
							<?php
							if(isset($_GET['frmset']))
								{?><div id="sets_details">
							
									<?php $visible=$_GET['vis'];
								$id=$_GET['questsid'];
								$frmst=$_GET['frmset'];
								$frmd=$_GET['frmnoquest'];
								$frmsubj=$_GET['frmsubj'];
								
								$set_det=mysqli_query($connection,"SELECT *FROM $frmsubj WHERE question_set='{$frmst}'");
								//querying for questions with d selected subject so as to check if no_of_question
								//is greater than the question in d database.
								 
								if(!$set_det)
									 {
										 echo mysqli_error($connection);
								     }
								$set_details=mysqli_fetch_array($set_det);
					 
							?>       <h5>Edit your question set details here</h5>
								<form action="staff_quiz.php?pgst_id=2&questsid=<?php echo urlencode($id);?>&frmsubj=<?php echo urlencode($frmsubj);?>&updateqs" method="POST"> 
									<table>
									  <tr>
										<td>Edit Set Name</td> <td><input type="text" name="setname" value="<?php echo $set_details['question_set'];?>" required/></td>
									  </tr>
									  </br>
									 <tr>
										<td>No Of Question a student can atttempt</td>  <td><input type="number" name="setnoquest" value="<?php echo $frmd ;?>" required/>
										<?php
									 
										?>
										</td>
									 </tr>
									 </br>
									 <tr>
										<td>Make set visible for student</td> <td><select name="visibility">
																	<option value="1"  <?php if($visible==1){ echo "selected";}  ?>>Yes</option>
																	<option value="0" <?php if($visible==0){ echo "selected";}  ?>>No</option>
																	</select></td>
									  </tr>
									  <tr>
												<td>Time </td>
<td>												hrs:<input id="time" type="number" name="hours"  value="<?php echo $set_details['hours']; ?>"/>
											   
												mins:<input id="time" type="number" name="mins" value="<?php echo $set_details['mins']; ?>"/>
												secs:<input id="time" type="number" name="secs" value="<?php echo $set_details['secs']; ?>"/>
												</td>
											   
											</tr>
									  <tr >
										  <td><input id="submit_button" type="submit" name="update" value="Save" /></td>
									</tr>
									</table>
								</form>
									<a id="del_set" href="staff_quiz.php?pgst_id=2&del=<?php echo urlencode($frmst);?>&subject=<?php echo urlencode($frmsubj);?>">Delete</a>
								</div>
						<?php 	}?>
							
							
							
							
							
							
						
							

									
					 
					 
							<?php
							  if(isset($_GET['adds']))
							  {//creating a form for subjects.
								?> <div id="create_subj">
								<h4>Add a new subject	</h4>
								   <form name="subjectform" action="staff_quiz.php?pgst_id=2&adds=1&user=<?php echo urlencode($user);?>" method="post"  <!--enctype="multipart/form-data"-->
									
										<table>
										<tr>
											<td>
												Course Image:  <input type='file'  name='file'></br>
											</td>
										</tr>
											<tr>
											
												<td><label for="lsubject"/><h6>  </h6></td>
												</tr>
												<tr>
												<td><input type="text" name="subj_name" id="lsubject" placeholder="subject name" maxlength="25" value="" required></td>
											</tr>
											<tr>
												<td>
													<input id='lsubmit' type="submit" name="submit_subj" size="50" value="Submit"/>
												</td>
											</tr>
										</table>
												   </form>
												   <?php
												   if(isset($_GET['msg']))
												   {
													  echo "<msg>". $_GET['msg']."</msg>";
												   }?>
											</div>  
							<?php } ?>
						 
									
						<?php 
							 // form for question set 
							 if(isset($_GET['addqs']))
							 {  ?><div id="add_qs">
						
						<form href="staff_quiz.php?pgst_id=2&addqs" method="POST">
								<table>
								<tr>
											<td>
											Name<input type="text" name="question_setname" placeholder="Question set name" required/>
											</td>
										</tr>
									<tr>
									   <td>
									Select subject:<select name="subj_select">
											 <?php  $sjt=request_subj();
											 if(!$sjt)
								{
									echo "no subjects has been created yet";
								}
								else{
												while($subjects=mysqli_fetch_array($sjt))
												{?>
													<option value="<?php echo $subjects['subject_name'];?>"><?php echo str_replace('_',' ',$subjects['subject_name']);?> </option>
												<?php }?>
												</select>
												</td>
										</tr>
										
											<tr>
											 <td>Max No Of Question in an attempt</td>
										 
											<td>
												<input type="number" name="noofquestion"  placeholder="max number of question a student can ans in this set" required/>
											</td>
											</tr>
											<tr>
												<td>Time  <input id="time" type="number" name="hours"  placeholder="hours"/>
											   
												<input id="time" type="number" name="mins" placeholder="mins"/>
												<input id="time" type="number" name="secs" placeholder="secs"/>
												</td>
											   
											</tr>
											<tr>
										  <td>
												<input type="submit" name="submit_qs" value="        Add       " /> 
											</td>
											
										</tr>
									</table>
									</form>
									</div>
							 <?php }
							 } 
							?>
						

						
						 <?php   //creating form for question.
								if(isset($_GET['addq']))
									{?><div id="quest_subj">
										
									<?php
										$rs=request_subj();
										if(!$rs)
								{
									echo "no subjects yet";
								}
								else{
											while($sbj=mysqli_fetch_array($rs))
												{ ?> 
													<a href="staff_quiz.php?pgst_id=2&sbj=<?php echo urlencode(str_replace('_',' ',$sbj['subject_name'])); ?>" >
													<?php echo str_replace('_',' ',$sbj['subject_name']); ?></a>
											<?php } 
								   }?>	
								 </div> <?php }    ?>
									
						<?php	
						if(isset($_GET['sbj']))
							{  $sbj=$_GET['sbj']; ?>
						 <div id="add_question">
							<form action="staff_quiz.php?pgst_id=2&addq=1&sbj=<?php echo urlencode($sbj);?>" method="POST">
									<table> 
									  <tr> 
										 <td>
											Select set:<select name="set_select" required>
											 <?php 
												$sbj=$_GET['sbj'];
												$sjt=request_set($sbj);
												while($subjects=mysqli_fetch_array($sjt))
												{?>
													<option value="<?php echo $subjects['question_set'];?>"><?php echo $subjects['question_set'];?> </option>
										  <?php }
											?>
												</select> <br/>
												
												
										</td>
									  </tr>
									  <tr>
										<td><textarea name="question" rows="5" cols="50" value="" >Question</textarea></td>
									  </tr>
									  <tr>
										
										<td>Option A:<input type="text" name="option1" size="45" value=""/></td>
									  </tr>
										<tr><td>Option B:<input type="text" name="option2" size="45" value=""/></td></tr>
										<tr><td>Option C:<input type="text" name="option3" size="45" value=""/></td></tr>
										<tr><td>Option D:<input type="text" name="option4" size="45" value=""/></td></tr>
										 
										</tr>
										<tr><td>
										Answer:<select name="ans" >
												<option value="0"></option>
												<option value="1">A</option>
												<option value="2">B</option>
												<option value="3">C</option>
												<option value="4">D</option>
												</select>
									   </td></tr>
									  <tr>
										<td>
											<input type="submit" name="submit_question" value="submit">
										</td>
									  </tr>
								
									 </table>
									</form>
								
						  </div>
							<?php }?>
						
			
			
	 
	 
	 <?php // edit questions.
		   if(isset($_GET['editq']))
			{?>
		<div id="editq_set">
		<?php	
		$result=mysqli_query($connection,"SELECT *FROM question_set");
				while($res=mysqli_fetch_array($result))
				{
					?>
					<a href="staff_quiz.php?pgst_id=2&qs_name=<?php echo urlencode($res['set_name']);?>"><?php echo $res['set_name'];?></a>
				<?php
				}
				
			} echo "</div>";
			?>
			
			<?php echo"</div>";echo "</div>"; } ?> 

		<?php //end of quiz_menu2 tag?>
		<?php //end of quiz_menu tag?>
		
	
	
		 
			<?php
         //displaying selected question
			 if(isset($_GET['highdee']))
			 {  ?>
					  <div id="selected_question">
				<?php	  
							  $setname=$_SESSION['setname'];
							  $qid=$_GET['question'];
							$result=mysqli_query($connection,"SELECT *FROM $setname WHERE id=$qid ");
							
							$res=mysqli_fetch_array($result);
							$sbj=$res['subject'];
							?>
							<form action="staff_quiz.php?pgst_id=2&addq=1&sbj=<?php echo urlencode($sbj);?>&id=<?php echo urlencode($res['id']);?>" method="POST">
							Select set:<select name="set_select" required>
				           <?php 
							 $sjt=request_set($sbj);
							// getting the selection for question set.
							while($subjects=mysqli_fetch_array($sjt))
							{echo $qid."12";?>
								<option value="<?php echo $subjects['question_set'];?>"><?php echo $subjects['question_set'];?> </option>
				      <?php }
						?>
							</select> <br/>
						<textarea name="question" rows="5" cols="50" value="<?php echo $res['question'];?>"><?php echo $res['question'];?></textarea>
						<br/>
							 Option A:<input type="text" name="option1" size="45" value="<?php echo $res['option1'] ;?>"/>
						<br/>
							 Option B:<input type="text" name="option2" size="45" value="<?php echo $res['option2'] ;?>"/>
						<br/>
							 Option C:<input type="text" name="option3" size="45" value="<?php echo $res['option3'] ;?>"/>
						<br/>
							 Option D:<input type="text" name="option4" size="45" value="<?php echo $res['option4'] ;?>"/>
						<br/>	
							Answer:<select name="ans" >
								<option value="0" <?php if($res['answer']==0){ echo "selected";}?> ></option>
								<option value="1" <?php if($res['answer']==1){ echo "selected";}?>>A</option>
								<option value="2" <?php if($res['answer']==2){ echo "selected";}?>>B</option>
								<option value="3" <?php if($res['answer']==3){ echo "selected";}?>>C</option>
								<option value="4" <?php if($res['answer']==4){ echo "selected";}?>>D</option>
								</select>
				   	      <input type="submit" name="update_question" value="submit">
					
								<a href="staff_quiz.php?pgst_id=2&delquestion=<?php echo urlencode($qid);?>">Delete</a>
							</form>
						</div>
				<?php 						
				}?>	
	
		<script type='text/javascript'>
	 
	$(function(){
		$('.cont').css("opacity","0").hide();
		$("#question li a").click(function(){
		var id=$(this).attr('class');
		 $(".cont").hide(300);
		 	$('#'+id).css("opacity","1").slideToggle();
			 
		 });
		
	 
	});
	</script>    
	 
		<?php  //displaying questions
			if(isset($_GET['qs_name']))
				{ ?>
	
	<div id="edit_q">
				<?php
					$setname=$_GET['qs_name'];
					$_SESSION['setname']=$setname;
							$result=mysqli_query($connection , "SELECT *FROM $setname ");
							echo "<ol id='question'>";
								 
						while($res=mysqli_fetch_array($result))
							{ 	?>	
										<li><input type="checkbox" /><a onclick="return false" class="<?php echo  $res['id'] ;?>"   href="staff_quiz.php?pgst_id=2&question=<?php echo urlencode($res['id']);?>"><?php echo $res['question'].".....";?></a><b setname='<?php echo $setname;   ?>' ><center>Delete</center></b></li>
											<div class="cont" id="<?php  echo  $res['id']; ?>"> 
											 
													<form  class='fom' action='staff_quiz.php?pgst_id=2&addq=1&sbj=<?php echo urlencode($res['subject']); ?>&id=<?php echo urlencode($res['id']);?>&cu_set=<?php echo urlencode($setname); ?>' method='POST'>
														<!--set select-->
															Select Set<select class="select" name='set_select' required>	
																<?php 
																
																$id=$res['id'];
																//$result=mysqli_query($connection,"SELECT *FROM $setname WHERE id=$id");
																//$res=mysqli_fetch_array($result);
																$sbj=$res['subject'];
																			 $sjt=request_set($sbj);
																			// getting the selection for question set.
																			while($subjects=mysqli_fetch_array($sjt))
																			{ ?>
																				<option value="<?php echo $subjects['question_set'];?>" <?php  if(strcasecmp($setname,$subjects['question_set'])==0){ echo "selected";} ?> > <?php echo $subjects['question_set'];?> </option>
															  <?php			 }
																?>
																</select>
														<!--//subject select-->
																Select subject<select class="select_sbj" name='subj_select' required>
																<?php 
																
																$id=$res['id'];
																$subjects=mysqli_query($connection,"SELECT *FROM subjects");
															
																$sbj=$res['subject'];
																
																	$sjt=request_set($sbj);
																		$sjt=mysqli_fetch_array($sjt);
																		  // getting the selection for question set.
																			while($subj_res=mysqli_fetch_array($subjects))
																			{ 
																				?>
																				
																				<option value="<?php echo $subj_res['subject_name'];?>" <?php if(strcasecmp($sbj,$subj_res['subject_name']==0)){echo "selected";}  ?>  > <?php echo str_replace('_',' ',$subj_res['subject_name']);?> </option>
															  <?php			 }
																?>
																</select>
																</br>
																	<textarea name="question" rows="5" cols="50"><?php echo $res['question'];?></textarea>
																<br/>
																	 Option A:<input type="text" name="option1" size="45" value="<?php echo $res['option1'] ;?>"/>
																<br/>
																	 Option B:<input type="text" name="option2" size="45" value="<?php echo $res['option2'] ;?>"/>
																<br/>
																	 Option C:<input type="text" name="option3" size="45" value="<?php echo $res['option3'] ;?>"/>
																<br/>
																	 Option D:<input type="text" name="option4" size="45" value="<?php echo $res['option4'] ;?>"/>
																<br/>	 Answer:<select name="ans" >
																		<option value="0" <?php if($res['answer']==0){ echo "selected";}?> ></option>
																		<option value="1" <?php if($res['answer']==1){ echo "selected";}?>>A</option>
																		<option value="2" <?php if($res['answer']==2){ echo "selected";}?>>B</option>
																		<option value="3" <?php if($res['answer']==3){ echo "selected";}?>>C</option>
																		<option value="4" <?php if($res['answer']==4){ echo "selected";}?>>D</option>
																		</select>
																  <input type="submit" name="update_question" value="submit">
															
																		<a href="staff_quiz.php?pgst_id=2&delquestion=<?php echo urlencode($id);?>">Delete</a>
																										
																										
												
															</form>
													 
												</div>	
										<?php
										 
						    }
							echo "</ol>";
								
							 

						
					}?>		

	
	</div>
 
		</div><?php //end of content2 tag?>
	
	

	
	
	
	

					
		
	<?php	//deleting subjects.
		if(isset($_GET['delsubj']))
		{
			$subject=$_GET['delsubj'];
			$res=mysqli_query($connection,"DELETE FROM subjects WHERE subject_name='{$subject}'");
			mysqli_query($connection,"DROP TABLE $subject");
			header("Location:staff_quiz.php?pgst_id=2&editsubj=1");
					exit;
		}?>
    
	<?php
	// updating the question set.
	 if(isset($_POST['update']))
	 {	$id=$_GET['questsid'];
		$visible=$_POST['visibility'];
		$setname=$_POST['setname'];
		$noofquestion=$_POST['setnoquest'];
		 $subject=$_GET['frmsubj'];
		 if(empty($_POST['hours']))
		 {
			 $hours=0;
		 }
		 else
		 {
		 $hours=$_POST['hours'];
		 }
		 if(empty($_POST['mins']))
		 {
			 $mins=0;
		 }
		 else
		 {
		  $mins=$_POST['mins'];
		 }
		  
		 if(empty($_POST['secs']))
		 {
			 $secs=0;
		 }
		 else
		 {
		  $secs=$_POST['secs'];

		 }
		  
		
		 $secs=$_POST['secs'];
		 $query="UPDATE $subject SET question_set='{$setname}' ,no_of_question={$noofquestion} ,visible={$visible},hours={$hours},mins={$mins},secs={$secs} WHERE id={$id} ";
		 $rs=mysqli_query($connection,$query);
		 if($rs)
		 {
			 echo "set update succesfully.";
			 header("Location:staff_quiz.php?pgst_id=2&frmsbj");
				exit;
		 }
		 else
		 {
			 echo "set not updated.";
		 }
	 }
			?>

		<?php
		 // delete a question set
		  if(isset($_GET['del']))
		   {   
	           $qs=$_GET['del'];
			  
			   if(isset($_GET['subject']))
			   {
				   $subject=$_GET['subject'];
				   mysqli_query($connection,"DELETE FROM $subject WHERE question_set='{$qs}'");
				   mysqli_query($connection,"DELETE FROM $qs WHERE subject='{$subject}'");
				   header("Location:staff_quiz.php?pgst_id=2&frmsubj=($subject)");
				   exit;
			   }
			   else
			   {
				mysqli_query($connection,"DELETE FROM question_Set WHERE set_name='{$qs}'");
				mysqli_query($connection,"DROP TABLE $qs");
				$res= mysqli_query($connection,"SELECT *FROM subjects");
				while($rs=mysqli_fetch_array($res))
				{
					$sbj=$rs['subject_name'];
				    $rss= mysqli_query($connection,"DELETE FROM $sbj WHERE question_set='{$qs}' ");
				}
					echo "deleted";
					header("Location:staff_quiz.php?pgst_id=2&editqs=1");
					exit;
		       }
		   }
			
		 ?>
		
							<?php
					//deleting question 
			if(isset($_GET['delquestion']))
			{ $setname=$_SESSION['setname'];
				$qid=$_GET['delquestion'];
				
				$result=mysqli_query($connection,"DELETE FROM $setname WHERE id=$qid ");
				header("Location:staff_quiz.php?pgst_id=2&qs_name=$setname");
				exit;
			}?>

			

		



 
</div>


</body>
</html>
<?php close_connection($connection);?>