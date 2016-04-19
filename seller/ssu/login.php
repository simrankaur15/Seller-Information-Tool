<?php
$result1=FALSE;
if(isset($_POST['submitted'])) { // Handle the form.
	// Trim all the incoming data:
	$trimmed = array_map('trim', $_POST);
	$seller_search = mysqli_real_escape_string ($dbc, $trimmed['seller_search']);
	$password=mysqli_real_escape_string ($dbc, $trimmed['seller_search_paswd']);
	$pass_compare=md5($password);
	if($seller_search=='')
		{ 
			$error_string='Username or password is incorrect.';		
		}
	
	else {
				$query1 = "SELECT * FROM user_info where (seller_center_id='$seller_search' or email='$seller_search') and password='$pass_compare'";
				$result_query1= mysqli_query ($dbc, $query1) or trigger_error("Query: $query1\n<br />MySQL Error: " . mysqli_error($dbc));
				$num_rows1 = mysqli_num_rows($result_query1);
				
				if ($num_rows1<1)
				{	$error=1;
					$error_string='Username or password is incorrect.';
					echo '<script> $(function() {
							$( "#login_dialog" ).dialog();
							});
						  </script>';
					mysqli_close($dbc);
				} 
				else
				{
				$query1 = "SELECT * FROM ssu_detail where (seller_center_id='$seller_search' or email='$seller_search') ";
				$result_query1= mysqli_query ($dbc, $query1) or trigger_error("Query: $query1\n<br />MySQL Error: " . mysqli_error($dbc));
				$num_rows1 = mysqli_num_rows($result_query1);
					if($num_rows1<1)
					{
						$error=1;
						$error_string='Username or password is incorrect.';
						echo '<script> $(function() {
								$( "#login_dialog" ).dialog();
								});
							  </script>';
						mysqli_close($dbc);
					}
				
				
				}
				if($error_string=="")
				{
					$_SESSION['company_email']=$seller_search;
					 $display_result = 2;
					 $result1 = mysqli_fetch_array($result_query1);
					 //print_r ($result1);
					mysqli_close($dbc);
				}
		} 

}//end

?>