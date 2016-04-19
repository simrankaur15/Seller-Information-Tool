<?php
session_start();
date_default_timezone_set("Asia/Hong_Kong");

include_once('ssu_1.php');


if($_GET['one']==1)
{
include_once('ssu_1.php');
}

if($_GET['two']==1)
{
	if($_SESSION['country']=="Korea, Republic of")
		include_once('ssu_2_kr.php');
	else if($_SESSION['country']=="China"||$_SESSION['country']=="Chinese Taipei")
		include_once('ssu_2_cn.php');
	else include_once('ssu_2_en.php');
}

ini_set( sendmail_from, "noreply@lazada.com" );  
ini_set( SMTP, "smtp2.wtt-mail.com" );  
//ini_set( smtp_port, 25 ); 


$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//$to=$_SESSION['email'];
$to      = 'simran.kaur@lazada.com';


$headers .= 'From: noreply@lazada.com';



// use wordwrap() if lines are longer than 70 characters
//$msg = wordwrap($msg,70);
mail($to, $subject, $message, $headers);
// send email
//mail("simran.kaur@lazada.com","My subject",$msg);



//print_r($_GET);
 $output =1;
  //echo $output;
?>