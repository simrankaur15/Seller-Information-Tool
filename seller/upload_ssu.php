
<?php 
//upload ssu
set_time_limit(0);
date_default_timezone_set("Asia/Hong_Kong");

															require_once ('mysqli_connect.php');
												
															$target_path = "C:/Users/Simran kaur/Desktop/SSU/ssu.csv";
																	//echo $target_path;
																	
																	$enclosed_by = '"';
																	$sql = "LOAD DATA LOCAL INFILE '".$target_path."' 
																			INTO TABLE ssu_detail
																			FIELDS TERMINATED BY ',' 
																			OPTIONALLY ENCLOSED BY '\"' 
																			LINES TERMINATED BY '\\n'
																			";

																	echo $sql;
																	$result = mysqli_query ($dbc, $sql) or trigger_error("Query: $sql\n<br />MySQL Error: " . mysqli_error($dbc));

																	if (mysqli_affected_rows($dbc) > 1) {
																		echo "<br>The file was successfully updated!";
																	}

																	else {
																	   // restore_database();
																		$message = "The database update failed: ";
																		$message .= mysql_error(); 
																		$date=Date("Y-m-d");
																		$sql_delete="TRUNCATE ssu_detail";
																		$result = mysqli_query ($dbc, $sql) or trigger_error("Query: $sql_delete\n<br />MySQL Error: " . mysqli_error($dbc));
																		
																	}
?>