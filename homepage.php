
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
			window.location="loginpage.php";
		</script>
	<?php }
 ?>
 <?php 
   if (isset($_GET['pgst_id']))
		{  $user=$_SESSION['matric_no'] ;
			 $pgid=$_GET['pgst_id'];
			 $pu=find_selected_page($pgid);
			 $nam="";
			 //$det=request_details($_GET['user'],$nam);
     	}
?>

<html lang="en">
 <head>
  <title>Document</title>
  <link rel="stylesheet" href="csdesign.css">
 </head>
  <body class="body"> 
 <div id="hg"><h1> HIGHDEE INC </h1></div>

		
			 <?php 
				     if(isset($_SESSION['matric_no']) && isset($_GET['pgst_id']))
					 { ?> <div id="menu"><ul>
				 <?php
					 $result = get_pages_student();
					 while($resu=mysqli_fetch_array($result))
					{ ?>
				
					 <li><a href="<?php echo $resu['url'];?>?pgst_id=<?php echo urlencode($resu['id']);?>" ><?php echo $resu['menu-name'];?></a></li>						
					<?php
					}?></ul></div><?php
					 }
                 ?> 
<div id="container">
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
							<?php 	echo $_SESSION['name'];?></br>
						 </td>
					   </tr>
					<tr>
					  <td>
						<edithome><a href="quizpage.php?pgst_id=2&edit=1">Edit profile</a></edithome>
					  </td>
					</tr>
				</table>
					
	</div>
		 
	<div id="page_title">
			 <h1>
			 <?php  echo $pu['menu-name']; ?>
			 </h1>
    </div>

		<div id="main_text">
		highdee text</div>
			 </div>
			 
			 
			 
     <div id="footer">
   &copy; HIGHDEE INC
	 <a href="logout.php?student" >Logout</a>
	</footer>
	</div>
	 
</body>
</html>
<?php close_connection($connection);?>					