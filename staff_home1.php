<?php session_start();?>
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
   <link rel="stylesheet" href="staffcsdesign.css">
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
				 <div id="menu" onmouseover="change('menu')">
				 <?php
					 $result = get_pages_staff();
					 while($resu=mysqli_fetch_array($result))
					{ ?>
						<li><a  href="<?php echo $resu['url'];?>?pgst_id=<?php echo urlencode($resu['id']);?>" ><?php echo $resu['menu-name'];?></a></li> </br>
					<?php
					}
					
					echo "</div>";
					
					 }
							?> 
						</div>
						
<div id="content2">
<div id="hg">
	<h2> DashBoard </h2><br/>
	 <a id="goto_website" href="loginpage.php">Go to website</a>
	 <a id="logout" href="logout.php?admin">Logout</a>
	</div>
	<br/>
<div id="page_title">
	<?php
				if(isset($_GET['pgst_id']))
					{
						echo "<h1>{$pu['menu-name']}</h1>"; 	
					}
			?>
			</div>
	
		
				<h3> Latest Update </h3>
			<?php //displaying last question updated by admin .
			 
			 $highest_id=array();
			 $qs="";
			 $qs_id=0;
			 $admin_name='';
			 $res=mysqli_query($connection,"SELECT *FROM question_set");
			 //trying to get the last updated question set by getting the max id of question set.
			 while($rs=mysqli_fetch_array($res))
			 {
				 $highest_id[]=$rs['id'];
				if($rs['id']==max($highest_id))
				{
					$qs=$rs['set_name'];
					$qs_id=$rs['id'];
					
				}
			
			 }
			 //tyring to use the the max id to get the question and admin name from the question set name.
				$quest=array(); //declaring an array
				$id=array();  //declaring an array
				$result=mysqli_query($connection,"SELECT *FROM $qs ");
				while($res=mysqli_fetch_array($result))
				{
					$id[]=$res['id'];
										
				}
				
				sort($id);//sorting the arrray of the question id 
				$max_index=count($id);
				$c=0;
				?>
			<div id="latestup">
				<fieldset class="lt_field" >
				<?php 
				for($c=1;$c<=5;$c++)
				{	
					
					if($max_index==0)
					{
						if($c==1)
					{
						
					  echo "<lt> NO QUESTION HAS BEING ADDED TO THE  <strong> ".$qs."</strong> CREATED YET </lt>" ;
						break;
					
					}	
				
						break;
					}
						$cid=$id[$max_index-1];
						
						$result=mysqli_query($connection,"SELECT *FROM $qs WHERE id=$cid ");
						if($result!=null)
				{
					
					$res=mysqli_fetch_array($result);
					
				?>
				 
					<?php echo "<li>";
                     echo "<lt>" .$res['question']."....";
					echo " </br> <lt_info> <b>subject:</b>".$res['subject']." <b>set:</b>" .$qs."   .<b>updated by</b>  ".$res['admin'].".</lt_admin>  </lt>";
					echo "</li>";
					?>
				
					<?php
					  
					}
					$max_index=$max_index-1;
					
				} 
				?>
					</fieldset>
	 </div>
	 
	 </div>
	 
</div>
</body>
</html>
<?php close_connection($connection);?>