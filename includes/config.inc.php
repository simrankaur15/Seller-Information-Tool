<?php 
// ************ SETTINGS ************ //

// Flag variable for site status:
define('LIVE', TRUE);

// Admin contact address:
define('EMAIL', 'simran.kaur@lazada.com');

// Site URL (base for all redirections):
define ('BASE_URL', '');
define ('BASE_URL1', '/seller/');//for activation code

// Location of the MySQL connection script:
define ('MYSQL','/seller/mysqli_connect.php');

// Adjust the time zone for PHP 5.1 and greater:
date_default_timezone_set ('Asia/Hong_Kong');

// ************ SETTINGS ************ //
// ********************************** //


// ****************************************** //
// ************ ERROR MANAGEMENT ************ //

// Create the error handler:
function my_error_handler ($e_number, $e_message, $e_file, $e_line, $e_vars) {

	// Build the error message.
	$message = "<p>An error occurred in script '$e_file' on line $e_line: $e_message\n<br />";
	
	// Add the date and time:
	$message .= "Date/Time: " . date('n-j-Y H:i:s') . "\n<br />";
	
	// Append $e_vars to the $message:
	$message .= "<pre>" . print_r ($e_vars, 1) . "</pre>\n</p>";
	
	if (!LIVE) { // Development (print the error).
	
		echo '<div class="error">' . $message . '</div><br />';
		
	} else { // Don't show the error:
	
		// Send an email to the admin:
		//mail(EMAIL, 'Site Error!', $message, 'From: email@example.com');
		
		// Only print an error message if the error isn't a notice:
		if ($e_number != E_NOTICE) {
			echo '<div class="error">A system error occurred. We apologize for the inconvenience.</div><br />';
		}
	} // End of !LIVE IF.

} // End of my_error_handler() definition.


// ************ ERROR MANAGEMENT ************ //
// ****************************************** //

?>
