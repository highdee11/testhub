<?php
require_once("includes/functions_st.php");
?>
<?php connect();
 ?>
 <?php 
	if (isset($_GET['pgst_id']))
		{
			 $pgid=$_GET['pgst_id'];
			 $pu=find_selected_page($pgid);
			 
     	}
		
	if(!isset($_SESSION['user']))
		{
				header("Location:staff_login.php?admin=1	");
				exit;
		}
?>
<!doctype html>
<html lang="en">
 <head>
  <title>Document</title>
 </head>
 <body>
<div ><h1 class="hg"> HIGHDEE INC </h1></div>
<table>
	<tr>
		<td>
			
				 <?php
					$result = get_pages_staff();
					while($resu=mysqli_fetch_array($result))
					{  
						echo "<th cellspan=7>";   echo "<a href=\"".$resu['url']."?pgst_id=". urlencode($resu['id'])."\";>"; echo "{$resu['menu-name']}</a>"; echo "</th>";
					}
                 ?> 
			
		</td>
	</tr>
	<tr>
		<td>
			<?php
				echo "<h1>{$pu['menu-name']}</h1>";
			?>
		</td>
	</tr>

  </table>
</body>
</html>
<?php close_connection($connection);?>