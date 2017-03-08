<?php session_start();?>
<?php
require_once("includes/functions_st.php");
?>
<?php connect();
 ?>
  <?php 
	if(!isset($_SESSION['matric_no'] )|| !isset($_GET['pgst_id']))
	{?>
		<script type="text/javascript">
			window.location="Home.php";
		</script>
	<?php }
 ?>
 <?php 
   if (isset($_GET['pgst_id']))
		{ 
			 $pgid=$_GET['pgst_id'];
			 $pu=find_selected_page($pgid);
			 $nam="";
			 //$det=request_details($_GET['user'],$nam);
     	}
?>


<html lang="en">
 <head>
  <title>Document</title>
 
 <link rel="stylesheet" href="csdesign.css"/>
  <script type="text/javascript" src="jquery-3.1.0.min.js"></script>
<script type="text/javascript" src="jquery-ui.js"></script>
 <script type='text/javascript' src='quizpage.js'></script>
 <script type='text/javascript' src=''></script>
 </head>
 <?php
	if(isset($_SESSION['matric_no']))
		{
			$matr="ansfor".$_SESSION['matric_no'];
			$result=mysqli_query($connection,"SELECT *FROM $matr ");
			if($result==true)
				{?>
					
					<script type='text/javascript'>
					$.post("questiongenerator.php",{finish:1},function( ){
						 
					});
					
					</script>
						
			<?php
				}
		}
	
?>
 <body class="body"> 
   
  <div id="hg"><h1>  </h1></div>

		
			 <?php 
			  
 
				  //   if(isset($_SESSION['matric_no']) && isset($_GET['pgst_id']))
					// { ?>

					<div id="menu"><ul> 
					 <li><a href="Home.php">Home</a></li>						
					 <li><a href="quizpage.php?pgst_id=2&subj=1">Quiz</a></li>						
					 <li><a href="aboutpage.php?pgst_id=3">About</a></li>						
					 </ul>
					 
					 <div id="user_icon" >
		
					<?php 
					// user profile block
						$image=$_SESSION['image'];
					?>
				<table>
					   <tr>
						 <th rowspan=2>
							<img style="width:30px;height:30px;" src="<?php echo 'student_images/'.$image; ?>" >
						 </th>
						 <td>
							<?php 	echo $_SESSION['name']; ?></br>
						 </td>
					   </tr>
					<tr>
					  <td>
						<edit><a href="quizpage.php?pgst_id=2&edit=1">Edit profile</a></edit>
					  </td>
					</tr>
				</table>
					
	</div>
					 </div>
                 
<div id="container">
 
		 
			 <?php
			 if(isset($_GET['pgst_id']))
			 {?> <div id="page_title"><h1><?php
		 if(isset($_GET['edit']))
		 {
			 echo "Edit Profile";
		 }
		else
		{
			 
		}
			 ?> </h1> <?php }?>
			</div>
			 
			 
		<?php  //subject block..loads outs all available subjects;
               	if(isset($_GET['subj']))
			{ 
				$subj_query="SELECT *FROM subjects";
				$res=mysqli_query($connection , $subj_query);
				
				?><div id='container_block'>
				<?php if(isset($_GET['msg']))
					{ $msg= $_GET['msg'] ; 
						echo "<div id='msg'> $msg</div>";
					
					
					}
					
					?>
				<div id='text_block'><h4>Select Your Desire Course</h4> </div>
				<div class="block_subj slidein">
			 
				<ul>
				<?php 
			    while($rs=mysqli_fetch_array($res))
				{  
					?>
					
					<li><a class='<?php echo str_replace(' ','',$rs['subject_name']);?>' onclick='return false' href="quizpage.php?pgst_id=2&subject_name=<?php echo str_replace('_',' ',$rs['subject_name']);?>" ><?php echo str_replace('_',' ',$rs['subject_name']);?></a></li></br>
					
					 <div id="<?php echo str_replace(' ','',$rs['subject_name']); ?>"class='set_div' >
					<ul>
					<?php
						$subje=str_replace('_','',$rs['subject_name']);
						 
						$set_res=mysqli_query($connection,"SELECT *FROM $subje WHERE visible=1");
							if($set_res!=Null)
							{ 
								  while($set_rs=mysqli_fetch_array($set_res))
									{ $noquest=$set_rs['no_of_question'];
										
										echo "<li><a onclick='return false' id='{$subje}' noquest='{$noquest}' class='sets ' href='quizpage.php?pgst_id=2'>".$set_rs['question_set']."</a></li></br>";
									}
							 
							}?>
					</ul>
					</div>
		        
				<?php } ?>
				 
				</ul>
			</div>
			<div id='set_details'>
				<div class='set_dt'>
				<h5>No set has been selected </h5>
				<p></p>
				 <h6>Select  a subject to see a list of available set in it. </h6>
					 <button id='strt' class='start'>Start</button>
					 
				</div>
			</div>
			</div>
			<?php
			}?>
	
			
			<?php //question_set block
			//this block get all question set available under the subject name
				if(isset($_GET['subject_name'])){
					$sbj=$_GET['subject_name'];
					$_SESSION['current_subject']=$sbj;
					$visible=1;
				$set_query="SELECT *FROM $sbj WHERE visible={$visible}";
				$set=mysqli_query($connection,$set_query);
		        if(mysqli_num_rows($set)<=0)// checking if question sets is visible or not
				{
					echo "question is not ready.";
				}
				else
				{?>
			<div id="block_set">
			<?php
				 while($rs=mysqli_fetch_array($set))
					{  ?>
				
					<a href="quizpage.php?pgst_id=3&set=<?php echo urlencode($rs['question_set']);?>&noquest=<?php echo urlencode($rs['no_of_question']);?>"> <?php echo $rs['question_set'] ;?></a>
					
					<?php 
					}
				}?>
				</div>
        <?php
		}?>
				<?php
				
				if(isset($_GET['set']))
				{
				  //this block queries for the 1st question that will be revealed when the user clicks start button.
				  //$qsid is the array that first take all the id of question that correlate to the current subject.
						//$sbj=$_GET['qsubj'];
						
					$_SESSION['noofquestion']=$_GET['noquest'];//getting the max no of question a student can attempt.
						 $set_name=$_GET['set'];
							$qsid=array();
						$sbj=$_GET['subj'];
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
				
				 
				  
				}
						
				} ?>
				
					<?php
	 
?>
	  
	  
	<?php if(isset($_GET['edit']))
	{
		$matric_no=$_SESSION['matric_no'];
		$result=mysqli_query($connection,"SELECT *FROM student_tbl WHERE matric_no={$matric_no} LIMIT 1");
		$res=mysqli_fetch_array($result);
		?>

	<div id="student_edit">
		
		<form action="studentcreate_form.php?update=1&matr=<?php echo urlencode($res['matric_no']) ;?>" method="POST" enctype="multipart/form-data">
		<img width="250px" height="200px" src="<?php echo 'student_images/'.$res['image_name'];?>" ></br>
				<?php if(isset($_GET['error']))
				{
					echo $_GET['error'];
				}
				?></br>
				<input type="file" name="file" >
	
		<table>
			 
				<tr>
					<td><label for="lfirstname" >First Name </td>
					<td id="input"><input type="text" name="firstname" id="lfirstname" maxlength="15" value="<?php echo $res['firstname'];  ?>"  pattern="^[A-Za-z]+" title="no number is allowed in this field" required> </td>
				</tr>
				<tr>
					<td><label for="llastname">  Last Name </td>
					<td id="input"><input type="text" name="lastname" id="llastname" maxlength="25" value="<?php echo $res['lastname'];  ?>"  title="no number is allowed in this field" required> </td>
				</tr>
				<tr>
					<td><label for="lmatricno">Matric No</td>
					<td  id="input"><input type="number" name="matric" id="lmatricno" maxlength="6" value="<?php echo $res['matric_no'];  ?>"  pattern="^[0-9]+" title="no alphabet is allowed in this field" required></td>
				</tr>	
				<tr>	
					<td><label for="llevel">Current Level</td>
					<td id="input"><input type="number" name="level" id="llevel"   maxlength="7"  value="<?php echo $res['level'];  ?>"  pattern="^[0-9]+" title="no alphabet is allowed in this field" required></td>
				
				</tr>
				<tr>
					<td><label for="ldept">Department</td>
					<td id="input"><input type="text" name="dept" id="ldept" maxlength="30" value="<?php echo $res['department'];  ?>"  pattern="^[A-Za-z]+" title="no number is allowed in this field" required></td>
				</tr>
				<tr>
					<td><label for="ltel">Tel No</td>
					<td id="input"><input type="tel" name="tel" id="ltel" maxlength="30" value="<?php echo $res['phone_number'];  ?>"  pattern="^[0-9+]+" title="no alphabet is allowed in this field" required></td>
				</tr>
				<tr>
					<td><label for="gender"> Gender</td>
					<td id="input"><select name="gender">
						<option value="gender" >gender</option>
						<option value="male"<?php if($res['gender']=="male"){echo "selected";}?>>male</option>
						<option value="female"<?php if($res['gender']=="female"){echo "selected";}?>>female</option>
					</select> 
					</td>
				
				</tr>
				 <tr>
					<td><label for="ldob">Date Of Birth</td>
					<td  id="input"><input type="date" name="dob" id="ldob" maxlength="11" value="<?php echo $res['dob'];  ?>" required></td>
				</tr>
				<tr>
					<td><label for="lpassword">Password</td>
					<td  id="input"><input type="password" name="password" id="lpassword" maxlength="15" value=""   pattern="^[A-Za-z0-9]+" ></td>
    				
    			</tr>
				<td>
					<label for="email">	Email</td>
					<td  id="input"><input type="text" name="email" value="<?php echo $res['email'];  ?>" pattern="^[A-Za-z0-9@.]+"  required>
					</td>
				<tr>
				
					<td><label for="laddress">Address</td>
					<td id="input"><textarea  name ="address" id="laddress" rows="3" cols="25" required><?php echo $res['address'];?></textarea></td> 
				</tr>
				
				<td id="update"> <input type="submit" name="update"  value="Update"/> </td> 
			
			</table>
	</form>
	
	<?php }?></div>
  
 
   	</div>
<div id="footer">
   &copy; HIGHDEE INC
   
	 <a href="logout.php?student" >Logout</a>
	</footer>	
	</div>
 
</body>
</html>
<?php close_connection($connection);?>