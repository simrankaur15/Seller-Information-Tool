<?php

/*	1.checks the query whether email exists
	2.if not exists echoes the error statement.
	3.If exists an email is sent with a verification code
	4.and a new dialog for entering the code and new password and confirm password
			a.code is incorrect
			b.code time has passed over 4 hours
			c.password and confirm password dont match
	5.Successful		
	
*/
require_once ('includes/config.inc.php');
date_default_timezone_set("Asia/Hong_Kong");
require_once ('mysqli_connect.php');
$fp_result=1;


if(isset($_GET['email']))
	{
		$trimmed = array_map('trim', $_GET);
		$email_id = mysqli_real_escape_string ($dbc, $trimmed['email']);
		
			
		$fp_query = "SELECT email,seller_center_id FROM user_info where email='$email_id' ";
		$fp_result_query= mysqli_query ($dbc, $fp_query) or trigger_error("Query: $fp_query\n<br />MySQL Error: " . mysqli_error($dbc));
		$fp_num_rows = mysqli_num_rows($fp_result_query);
		if($fp_num_rows<1)
		{
			$fp_query = "SELECT email,seller_center_id FROM ssu_detail where email='$email_id' ";
			$fp_result_query= mysqli_query ($dbc, $fp_query) or trigger_error("Query: $fp_query\n<br />MySQL Error: " . mysqli_error($dbc));
			$fp_num_rows = mysqli_num_rows($fp_result_query);
			$fp_result_query_result = mysqli_fetch_array($fp_result_query);
			$seller_center_id=$fp_result_query_result['seller_center_id'];
			$email_id=$fp_result_query_result['email'];
			if ($fp_num_rows<1)
					{	
						$error=1;
						//incorrect email address
						$fp_result="<div style='background-color: #b63333; padding: 5px 15px; color: #fff; font-size: 12px;'>Sorry, seems like an incorrect email address</div>";
					}
			else
				{	
					$confirmation_code= rand(4000, 9999);
					$confirmation_code_date=date("Y-m-d H:i:s");
					$fp_query1 = "INSERT INTO `user_info` ( `email`, `seller_center_id`,conf_code,conf_code_date) VALUES ( '$email_id', '$seller_center_id','$confirmation_code','$confirmation_code_date' )";
					$fp_result_query1= mysqli_query ($dbc, $fp_query1) or trigger_error("Query: $fp_query1\n<br />MySQL Error: " . mysqli_error($dbc));
					$fp_result=1;
					
					//mail function
				}
		}
	else
	{
		$confirmation_code= rand(4000, 9999);
		$confirmation_code_date=date("Y-m-d H:i:s");
		$fp_result_query_result = mysqli_fetch_array($fp_result_query);
		$seller_center_id=$fp_result_query_result['seller_center_id'];
		$email_id=$fp_result_query_result['email'];
		
				if ($fp_num_rows<1)
				{	
					$error=1;
					//incorrect email address
					$fp_result="<div style='background-color: #b63333; padding: 5px 15px; color: #fff; font-size: 12px;'>Sorry, seems like an incorrect email address</div>";
				}
				else
				{	
			$fp_query1 = "UPDATE `user_info` SET `conf_code`='$confirmation_code',`conf_code_date`='$confirmation_code_date' WHERE email='$email_id'";
					$fp_result_query1= mysqli_query ($dbc, $fp_query1) or trigger_error("Query: $fp_query1\n<br />MySQL Error: " . mysqli_error($dbc));
					$fp_result=1;
					
					//mail function
				}
			 
	}
		echo $fp_result;
	}
	if(isset($_POST['email']))
	{
		$trimmed = array_map('trim', $_POST);
		$email_id = mysqli_real_escape_string ($dbc, $trimmed['email']);
		$password = mysqli_real_escape_string ($dbc, $trimmed['password']);
		$confirm_password = mysqli_real_escape_string ($dbc, $trimmed['confirm_password']);
		$confirm_code = mysqli_real_escape_string ($dbc, $trimmed['confirm_code']);
		
		if($password==$confirm_password){
			// all logic
		$fp_query2 = "SELECT * FROM user_info where email='$email_id' ";
		$fp_result_query2= mysqli_query ($dbc, $fp_query2) or trigger_error("Query: $fp_query2\n<br />MySQL Error: " . mysqli_error($dbc));
		$fp_num_rows2 = mysqli_num_rows($fp_result_query2);
		
		if($fp_num_rows2>0)
		{
			$result1 = mysqli_fetch_array($fp_result_query2);
			$conf_code_db=$result1['conf_code'];
			$conf_code_date_db=$result1['conf_code_date'];
			if($confirm_code==$conf_code_db)
			{
				$conf_code_date=strtotime($conf_code_date_db);
				$today_date=strtotime(Date("Y-m-d H:i:s"));
				if(($today_date-$conf_code_date)<1800)
				{
					 $pass = md5( $password );
					$fp_query3 = "UPDATE user_info set `password`='$pass',`conf_code` = '',`conf_code_date` = ''  WHERE email='$email_id'";
					$fp_result_query3= mysqli_query ($dbc, $fp_query3) or trigger_error("Query: $fp_query3\n<br />MySQL Error: " . mysqli_error($dbc));
					$fp_result=1;
				}
				else
				{
					$fp_result="<div style='background-color: #b63333; padding: 5px 15px; color: #fff; font-size: 12px;'>Incorrect confirmation code </div>";
				}
			}
			else 
			{
				$fp_result="<div style='background-color: #b63333; padding: 5px 15px; color: #fff; font-size: 12px;'>Incorrect confirmation code </div>";
			}	
		}
		else 
			{
				$fp_result="<div style='background-color: #b63333; padding: 5px 15px; color: #fff; font-size: 12px;'>Incorrect email</div>";
			}
			
			
			
			
			
		}
		else
		{
			$fp_result="<div style='background-color: #b63333; padding: 5px 15px; color: #fff; font-size: 12px;'>Passwords do not match</div>";
		}
		//print_r ($_POST);
	
	echo $fp_result;	
	}


	
	
	
  //echo $output;

  
  
  ?>