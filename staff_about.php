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
	<?php }?>
 <?php 
	if (isset($_GET['pgst_id']))
		{   
			 $pgid=$_GET['pgst_id'];
			 $pu=find_selected_spage($pgid);
			 
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
				 <div id="menu">
				 <?php
					 $result = get_pages_staff();
					 while($resu=mysqli_fetch_array($result))
					{ ?>
						<li><a  href="<?php echo $resu['url'];?>?pgst_id=<?php echo urlencode($resu['id']);?>"><?php echo $resu['menu-name'];?></a></li> </br>
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
				echo "<h1>{$pu['menu-name']}</h1>";
			?>
		</div>
		
		
		
		
		</div>
	
	</div>
</body>
</html>
<?php close_connection($connection);?>