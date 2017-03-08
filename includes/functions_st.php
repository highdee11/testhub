<?php
//open connection
function connect()
 { global $connection;
    require_once("constant_st.php");
 global $myconnection;
 $connection=mysqli_connect(DB_SERVER ,DB_USER ,DB_PASS);
 if(!$connection)
 {die ("cant connect to databse:".mysqli_error($connection));}
 $database=mysqli_select_db($connection,"student_db");
 if (!$database)
  {
    die("cant select databse:".mysqli_error());
  } 
}
 
 
 function start_ses()
 {
	 session_start();
 }
 
 
 //confirm your database query
 function confirm_query($result)
 {  	global $connection;
		 if(!$result)
	 {
		 die("cannot query".mysqli_error($connection));
	 }		 
	   
	
 }
 
 
function get_pages_staff()
 {    global $connection;
	 $query="SELECT * FROM pages_staff  ";
     $result_st=mysqli_query($connection,$query);
	confirm_query($result_st);
	  return $result_st;
 }
 
 
 function get_pages_student()
 {   global $connection;
	 $query="SELECT *FROM pages_student";
	 $result=mysqli_query($connection,$query);
	// confirm_query($result);
	 if(!$result)
	 {
		 echo "cnt get pages now";
	 }
	 else{
	 return $result;
	 }
	 
 }
 
 
 //close connection
 function close_connection($connection)
 {
	 if(isset($connection))
	 {
		mysqli_close($connection);
	 }
 }
  
  function get_pages_by_id($value)
  {
	  global $connection;
  $query="SELECT *FROM pages_student  WHERE id=".$value." LIMIT 1";
	  $result=mysqli_query($connection,$query);
	  confirm_query($result);
	  $pg_name=mysqli_fetch_array($result);
	  if (!$pg_name)
	  {
		return null;
	  }
	  else
	  {
		  return $pg_name;
	  }
  }
  //get pages id for staff area
   function get_pages_by_sid($value)
  {
	  global $connection;
      $query=$query="SELECT *FROM pages_staff  WHERE id=".$value." LIMIT 1";
	  $result=mysqli_query($connection,$query);
	  if(!$result)
	 {
		 die("cnt query for staffpagesid".mysqli_error($connection));
	 }
   
	  $pg_name=mysqli_fetch_array($result);
	  if (!$pg_name)
	  {
		return null;
	  }
	  else
	  {
		  return $pg_name;
	  }
  }
  
  
  //search validation 
 
  
  
      //get the pages for staff area
  function find_selected_spage($value)
  {
	  global $connection;
	  $pu;
	  if(isset($value))
	  {
		$pu = get_pages_by_sid($value);
		return $pu;
	  }
	  else
	  {   
		  $pu="";
		  return $pu;
	  }
  }
  
  
  
  
  
  function redirect_to($value=null)
{
	if($value!=null)
	{
		header("Location:{$value}");
		exit;
	}
}
  
  
function mysqli_prep($value)
		{    global $connection;
			$magic_quotes_active=get_magic_quotes_gpc();
			$new_enough_php=function_exists("mysqli_real_escape_string");
			if($new_enough_php)
				{
					if($magic_quotes_active)
					{
						$value=stripslashes($value);
					}
					$value=mysqli_real_escape_string($connection,$value);
					
				}
			else
				{
					if(!$magic_quotes_active)
					{
						$value=addslashes($value);
					}
					$value=mysqli_real_escape_string($connection,$value);

				}
				return $value;	
		}
  
  
  //get the pages name by using
  function find_selected_page($value)
  {
	  global $connection;
	  $pu;
	  if(isset($value))
	  {
		$pu = get_pages_by_id($value);
		return $pu;
	  }
	  else
	  {   
		  $pu="";
		  return $pu;
	  }
  }
  
  

  
  function request_details($mat,$nam)
  {   global $connection;
      $message=array();
    if(empty($mat) && empty($nam))
	{
		// echo "pls enter the matric_no or name";
		
	}

  elseif((!empty($mat) && !empty($nam)) ||(!empty($mat)))
  {  $error=array();
	  $query="SELECT *FROM student_tbl WHERE matric_no=".$mat." LIMIT 1" ;
	  $result=mysqli_query($connection ,$query);
	  	 if(!$result)
	 {
		 die("cnt query for details".mysqli_error($connection));
	 }
	  $details=mysqli_fetch_array($result);
	 if($details['name']==null)
		  {
				  return 1;
		  }
     else
			{
				return $details;	  
			}	
	}
elseif((!empty($nam))&& ($mat==null))
	{ 
		
		 $result=mysqli_query($connection,"SELECT *FROM student_tbl WHERE name='{$nam}'");
		 $res=mysqli_fetch_array($result);
		 if($res)
			 {
				 return $res;	
			 }
		 else
			 {
			 return 1;
			 }
	}
 
  }
  
  
  
  
     //edit details
	 
  function edit_details($mat)
  {   global $connection;
      $message=array();
      $error=array();
	  $query="SELECT *FROM student_tbl WHERE matric_no=".$mat." LIMIT 1" ;
	  $result=mysqli_query($connection ,$query);
	  	 if(!$result)
	 {
		 die("cnt query for details".mysqli_error($connection));
	 }
	  $details=mysqli_fetch_array($result);
	  return $details;
  }
  
  
  
  
  function check_student($value)
   {  global $connection;
      $query="SELECT *FROM student_tbl WHERE matric_no=".$value ;
	   $result_set=mysqli_query($connection,$query);
	  $result=mysqli_fetch_array($result_set);
	 return $result;
   }
     
  
  function request_subj()
  {
	  global $connection;
	  $subj_query="SELECT *FROM subjects";
	  $result=mysqli_query($connection,$subj_query);
	  confirm_query($result);

	   return $result;
  }
  
  
   
 function request_set($subj)
  {
	  global $connection;
	 
	  $subj_query="SELECT *FROM $subj";
	  $result=mysqli_query($connection,$subj_query);
	  confirm_query($result);

	   return $result;
  }
  
  
  
  
  
  function request_admindetails($user)
  {   global $connection;
      
  $query="SELECT *FROM staff_tbl WHERE username='{$user}' LIMIT 1" ;
	  $result=mysqli_query($connection ,$query);
	  	 if(!$result)
	 {
		 die("cnt query for details".mysqli_error($connection));
	 }
	  $details=mysqli_fetch_array($result);
	  if(!$details)
	  {
		  return null;
	  }
      else
	  {
		  return $details;
	  }		  

  	  }
  
  
  
  
  
  
  
  
?>