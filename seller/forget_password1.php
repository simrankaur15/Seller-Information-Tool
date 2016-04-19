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



echo $fp_result;
	
	
	
  //echo $output;

  
  
  ?>