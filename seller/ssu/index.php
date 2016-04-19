



<?php

//session_name('sessiona');
session_start();
require_once ('includes/config.inc.php');

date_default_timezone_set("Asia/Hong_Kong");


$row = $r=$rowreprint= FALSE;
$display_result =1;
$error_string="";
 // Handle the form.
if(isset($_SESSION['company_email']))
{
	$display_result=2;
	//unset ($_SESSION['company_email']);
	//session_destroy();  
}
require_once ('mysqli_connect.php');
require_once ('login.php');
$tracking_no = $order_no = $del_company = $error = $lead_status = $days_in_current_status = $picklist_tags = $br_uploaded = $rejection_reasons = $step = FALSE;
//echo $display_result;
					
	?>



  

<!DOCTYPE html>
<!-- saved from url=(0022)http://www.lazada.com/ -->
<html class=" js flexbox flexboxlegacy canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths" lang="en"><!--<![endif]--><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style type="text/css">.sysblock{border:solid 1px red;}.sysblockcont{color:black;background-color:red;font-size: 13px;font-weight: bold;}</style>
        <link href="./Lazada.com_files/css" rel="stylesheet" type="text/css">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><script type="text/javascript" src="./Lazada.com_files/a6e87d609d"></script><script src="./Lazada.com_files/nr-852.min.js"></script><script type="text/javascript" id="www-widgetapi-script" src="./Lazada.com_files/www-widgetapi.js" async=""></script><script src="./Lazada.com_files/iframe_api"></script><script type="text/javascript" async="" src="./Lazada.com_files/ga.js"></script><script type="text/javascript">window.NREUM||(NREUM={}),__nr_require=function(t,e,n){function r(n){if(!e[n]){var o=e[n]={exports:{}};t[n][0].call(o.exports,function(e){var o=t[n][1][e];return r(o||e)},o,o.exports)}return e[n].exports}if("function"==typeof __nr_require)return __nr_require;for(var o=0;o<n.length;o++)r(n[o]);return r}({QJf3ax:[function(t,e){function n(){}function r(t){function e(t){return t&&t instanceof n?t:t?a(t,i,o):o()}function c(n,r,o){t&&t(n,r,o);for(var i=e(o),a=f(n),c=a.length,u=0;c>u;u++)a[u].apply(i,r);return i}function u(t,e){p[t]=f(t).concat(e)}function f(t){return p[t]||[]}function s(){return r(c)}var p={};return{on:u,emit:c,create:s,listeners:f,context:e,_events:p}}function o(){return new n}var i="nr@context",a=t("gos");e.exports=r()},{gos:"7eSDFh"}],ee:[function(t,e){e.exports=t("QJf3ax")},{}],3:[function(t,e){function n(t){return function(){r(t,[(new Date).getTime()].concat(i(arguments)))}}var r=t("handle"),o=t(1),i=t(2);"undefined"==typeof window.newrelic&&(newrelic=window.NREUM);var a=["setPageViewName","addPageAction","setCustomAttribute","finished","addToTrace","inlineHit","noticeError"];o(a,function(t,e){window.NREUM[e]=n("api-"+e)}),e.exports=window.NREUM},{1:12,2:13,handle:"D5DuLP"}],gos:[function(t,e){e.exports=t("7eSDFh")},{}],"7eSDFh":[function(t,e){function n(t,e,n){if(r.call(t,e))return t[e];var o=n();if(Object.defineProperty&&Object.keys)try{return Object.defineProperty(t,e,{value:o,writable:!0,enumerable:!1}),o}catch(i){}return t[e]=o,o}var r=Object.prototype.hasOwnProperty;e.exports=n},{}],D5DuLP:[function(t,e){function n(t,e,n){return r.listeners(t).length?r.emit(t,e,n):void(r.q&&(r.q[t]||(r.q[t]=[]),r.q[t].push(e)))}var r=t("ee").create();e.exports=n,n.ee=r,r.q={}},{ee:"QJf3ax"}],handle:[function(t,e){e.exports=t("D5DuLP")},{}],XL7HBI:[function(t,e){function n(t){var e=typeof t;return!t||"object"!==e&&"function"!==e?-1:t===window?0:i(t,o,function(){return r++})}var r=1,o="nr@id",i=t("gos");e.exports=n},{gos:"7eSDFh"}],id:[function(t,e){e.exports=t("XL7HBI")},{}],G9z0Bl:[function(t,e){function n(){if(!v++){var t=l.info=NREUM.info,e=f.getElementsByTagName("script")[0];if(t&&t.licenseKey&&t.applicationID&&e){c(p,function(e,n){t[e]||(t[e]=n)});var n="https"===s.split(":")[0]||t.sslForHttp;l.proto=n?"https://":"http://",a("mark",["onload",i()]);var r=f.createElement("script");r.src=l.proto+t.agent,e.parentNode.insertBefore(r,e)}}}function r(){"complete"===f.readyState&&o()}function o(){a("mark",["domContent",i()])}function i(){return(new Date).getTime()}var a=t("handle"),c=t(1),u=window,f=u.document;t(2);var s=(""+location).split("?")[0],p={beacon:"bam.nr-data.net",errorBeacon:"bam.nr-data.net",agent:"js-agent.newrelic.com/nr-852.min.js"},d=window.XMLHttpRequest&&XMLHttpRequest.prototype&&XMLHttpRequest.prototype.addEventListener&&!/CriOS/.test(navigator.userAgent),l=e.exports={offset:i(),origin:s,features:{},xhrWrappable:d};f.addEventListener?(f.addEventListener("DOMContentLoaded",o,!1),u.addEventListener("load",n,!1)):(f.attachEvent("onreadystatechange",r),u.attachEvent("onload",n)),a("mark",["firstbyte",i()]);var v=0},{1:12,2:3,handle:"D5DuLP"}],loader:[function(t,e){e.exports=t("G9z0Bl")},{}],12:[function(t,e){function n(t,e){var n=[],o="",i=0;for(o in t)r.call(t,o)&&(n[i]=e(o,t[o]),i+=1);return n}var r=Object.prototype.hasOwnProperty;e.exports=n},{}],13:[function(t,e){function n(t,e,n){e||(e=0),"undefined"==typeof n&&(n=t?t.length:0);for(var r=-1,o=n-e||0,i=Array(0>o?0:o);++r<o;)i[r]=t[e+r];return i}e.exports=n},{}]},{},["G9z0Bl"]);</script>
        <title>Lazada.com</title>

        <meta property="og:title" content="Lazada.com">
        <meta property="og:image" content="/images/share-logo.png">

        <meta name="robots" content="noindex, follow">
         <meta name="alexaVerifyID" content="Jp47ccpfdku4pVnQrH1JG4MMv7g">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       
        <link rel="icon" type="image/png" href="localhost/ssu/seller/favicon.png">
        <link rel="stylesheet" href="./Lazada.com_files/main.css">
		 <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
 <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="js/index.js"></script>	
		   <link rel="stylesheet" href="css/style.css">
	
		
<script> 
	$(function() {
    $( document ).tooltip({
      track: true,
	content: function () {
    return $(this).attr('title').replace(/\[br\]/g,"<br />");
			}
    });
  });
		</script>
		
		<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-73702130-1', 'auto');
  ga('send', 'pageview');

</script>





  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

  
  <!-- To open the dialog box that contains user information-->
  <script>
  $(function() {
    $( "#dialog" ).dialog({
		modal: true,
	dialogClass: "no-close",		
      autoOpen: false,
      show: {
        duration: 700
      },
      hide: {
        
        duration: 500
      },
	  width: "auto",
  
  create: function( event, ui ) {
    // Set maxWidth
    $(this).css("maxWidth", "100%");
  },
  create: function (event, ui) {
        $(".ui-widget-header").hide();
    },
    });
 
    $( "#opener" ).click(function() {
		 $( "#dialog" ).css("visibility", "visible");
      $( "#dialog" ).dialog( "open" );
    });
	
	$( "#close" ).click(function() {
      $( "#dialog" ).dialog( "close" );
    });
	
  });
 </script>

 
 <!-- To open the dialog box that contains login information-->
<script>
		var execution=0;
		var error_string = <?php echo json_encode($error_string); ?>;
		
		if (error_string == "") execution=0;
  
		if(execution==1) error_string="";
  
  
  $(function() {
	  
    $( "#login_dialog" ).dialog({
		modal: true,
	dialogClass: "no-close",		
      autoOpen: true,
      show: {
        duration: 100
      },
      hide: {
        
        duration: 300
      },
	  width: "auto",  

  create: function( event, ui ) {
    // Set maxWidth
    $(this).css("maxWidth", "100%");
	   },
  create: function (event, ui) {
        $(".ui-widget-header").hide();
    },
	 open:function(){
		 $( "#login_dialog" ).css("visibility", "visible");
      $( "#login_dialog" ).dialog( "open" );
	  document.getElementById("error_value").innerHTML = error_string ;
	  error_string="";
	 }
    });
 
   $( "#login_opener" ).click(function() {
		 $( "#login_dialog" ).css("visibility", "visible");
      $( "#login_dialog" ).dialog( "open" );
	  document.getElementById("error_value").innerHTML = error_string ;
	  error_string="";
    });
	
	$( "#login_close" ).click(function() {
		 
		
      $( "#login_dialog" ).dialog( "close" );
    });
	
  });
 </script>

  <!-- To open the dialog box that contains forget_password information-->
<script>
		/*--function IsEmpty(){ 
			if(document.form.forget_password_email.value == "")
				{
				alert("empty");
				}
				return;
		}*/
	
  
  $(function() {
	  
    $( "#forget_password_dialog" ).dialog({
		modal: true,
	dialogClass: "no-close",		
      autoOpen:false,
      show: {
        duration: 700
      },
      hide: {
        
        duration: 500
      },
	  width: "auto",  

  create: function( event, ui ) {
    // Set maxWidth
    $(this).css("maxWidth", "100%");
	   },
  create: function (event, ui) {
        $(".ui-widget-header").hide();
    },
	
    });
 
   $( "#forget_password_opener" ).click(function() {
		$( "#login_dialog" ).dialog( "close" ); 
		$( "#forget_password_dialog" ).css("visibility", "visible");
		$( "#forget_password_dialog" ).dialog( "open" );
	   
    });
	
	$( "#forget_password_close" ).click(function() {
      $( "#forget_password_dialog" ).dialog( "close" );
    });
	
  });
  
 

//submit for sending confirmation mail function
  <!-- To open the dialog box that contains forget_password reset information-->

$(document).ready(function(){
	 
    $("#password_conf_form").submit(function(){
		var email="email="+document.getElementById("forget_password_email").value;
		if(email==""){var error_string2="Email is required"; document.getElementById("error_value2").innerHTML = error_string2 ; }
	else{
        $.ajax({url: "forget_password.php?",data: email, success: function (result){
			
			if (result==1)
			{
				$( "#forget_password_dialog" ).dialog("close");
				$( "#forget_password_conf_dialog" ).css("visibility", "visible");
				$( "#forget_password_conf_dialog" ).dialog( "open" );		
			}
			else
			{
				document.getElementById("error_value3").innerHTML = result ;
				document.getElementById("error_value2").innerHTML = "";
			}
	
			} });
		}
    });
});

//submit for reset password
$(document).ready(function(){
	 
    $("#reset_password_form").submit(function(){
		var email=document.getElementById("confirm_email").value;
		var password=document.getElementById("reset_password").value;
		var confirm_password=document.getElementById("confirm_reset_password").value;
		var confirm_code=document.getElementById("confirm_code").value;
		var error_reset1="<div style='background-color: #b63333; padding: 3px 15px; color: #fff; font-size: 10px;'>Passwords do not match</div>";
		var error_reset2="<div style='background-color: #b63333; padding: 3px 15px; color: #fff; font-size: 10px;'>Please use between 6 and 40 characters</div>";
		document.getElementById("error_value_reset_password").innerHTML="";
		
	data_string={email:email,password:password,confirm_password:confirm_password,confirm_code:confirm_code};
	
		if(confirm_password === password)
		{
			if((password.length>5)&&(password.length<41))
			{ $.ajax({url: "forget_password.php", type:'POST', data: data_string, success: function (result){
			
			if (result==1)
			{
				document.getElementById("coverup").innerHTML="<div style='color:#183546 ;font-size:12px;>Please enter 4-digit verification code sent to your emailid and reset your password</div>";
				//$( "#forget_password_conf_dialog" ).css("visibility", "hidden");
				//$( "#forget_password_conf_dialog" ).dialog( "open" );		
			}
			else
			{
				document.getElementById("error_value_reset_password").innerHTML = result ;
				document.getElementById("error_value2").innerHTML = "";
			}
	
			} });
			}
			else{
				document.getElementById("error_value_reset_password").innerHTML = error_reset2 ;
				
			}
		}
		else{
				document.getElementById("error_value_reset_password").innerHTML = error_reset1 ;
			}
		
    });
});








$(function() {
    $( "#forget_password_conf_dialog" ).dialog({
		modal: true,
	dialogClass: "no-close",		
      autoOpen: false,
      show: {
        duration: 700
      },
      hide: {
        
        duration: 500
      },
	  width: "auto",
  
  create: function( event, ui ) {
    // Set maxWidth
    $(this).css("maxWidth", "100%");
  },
  create: function (event, ui) {
        $(".ui-widget-header").hide();
    },
    });
	$( "#forget_password_conf_close" ).click(function() {
      $( "#forget_password_conf_dialog" ).dialog( "close" );
		location.reload();
	  });
	
});	
	

	
	  
	
	</script>
	



	
	
	
	
		<style>
		
		body{

color: #F57224;
font-size: 18px;
}
.no-close .ui-dialog-titlebar-close {
  display: none;
}

.content-wrapper a:hover {
color: #F57224;}


button{

    font: inherit;
    color: #284153;
background-color: #F57224;
 margin-right:20px;
    border-color: #F57224;
	display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 600;
    line-height: 1.0;
    text-align: center;
    normal;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
	
}  
  
 
  .ui-tooltip, .arrow:after {
    background: #F5B524;
     border: none;
  }
  .ui-tooltip {
    padding: 10px 20px;
    color: black;
    font:  12px "Helvetica Neue", Sans-Serif;
   
   
  }
  
  
  
  .ui-button-text
  {
	  padding-bottom: 1px;
  }
  
  
</style>		
		
    </head>
    <body class="home_page">
        <!--[if lte IE 8]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="page-wrapper">
                            <!-- Fixed navbar -->
                <nav class="navbar row">
                
					 <div class="container 1">
                        <div class="row info-footer">
                            <div class="col-4" style="padding-top:10px" >
                                 <a  style="visibility:visible; opacity:1;" href="#"><img width="120"  height="30"  alt="logo" src="includes/Lazada logo white-01.jpg"></a> 
                                
                            </div>
                            <div class="col-8">
                                <ul class="main-menu">
                                    <li class="dropdown">
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a class="our_business" href="http://www.lazada.com/about-us/" target="_blank">Our Business</a></li>
                                                <li><a class="our_story" href="http://www.lazada.com/our-story/" target="_blank">Our Story</a></li>
                                           
                                        </ul>
                                        <a href="javascript:void(0)" class="business_achieve dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">WE ARE LAZADA</a>
                                    </li>
                                    <li><a class="contact_us" target="_blank"href="http://www.lazada.com/partnersupport/">CONTACT US</a></li>
                                   <?php if(!isset($_SESSION['company_email']))
								{
									echo '<li><a class="sell_with_us" href="http://www.lazada.com/sell/" target="_blank">SELL WITH US</a></li>
											<li><a id="login_opener"  style="cursor:pointer;width:100px;">LOGIN</a></li>';
								}
								?>
                                   
								
								<?php
								if(isset($_SESSION['company_email']))
								{
									echo '<li class="dropdown">
											<ul class="dropdown-menu" role="menu">
											<li><a id="opener"  style="width:100px;">User</a></li>
													<li><a class="our_business" href="/ssu/seller/logout.php" style="width:100px;">Logout</a></li>
											</ul>
											<a href="javascript:void(0)" class="business_achieve dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-cogs" style="font-size:40px;color:#F57224;padding-top:8px;"></i></a>
									</li>';
									
								}
								?>
									
									
                                </ul>
                            </div>
					
                        </div>
						
                    </div>
					
											
										<div class="row sell-with-us-nav" style="text-decoration:none;">
											<div class="container">
												<ul class="sell-with-us-nav__items ">
													<li class="sell-with-us-nav__item sell-with-us-nav__item--parent">
														<a href="/sell/university/">Lazada University</a>
															<ul class="navigation__subitems">
																<li class="navigation__subitem" style="width:142px;"><a href="http://lazada.com/sell/university/" target="_blank">Home</a></li>
																<li class="navigation__subitem" style="width:142px;"><a href="http://lazada.com/sell/university/courses/" target="_blank">Courses &amp; Schedules</a></li>
																<li class="navigation__subitem" style="width:142px;"><a href="http://lazada.com/sell/university/tutorials/" target="_blank">Tutorials</a></li>
															</ul>
													</li>
													<li class="sell-with-us-nav__item sell-with-us-nav__item--parent">
														<a href="#">Community</a>
														<ul class="navigation__subitems">
															<li class="navigation__subitem" style="width:119px;"><a href="http://lazada.com/sell/community/gallery/" target="_blank">Events &amp; Gallery</a></li>
															<li class="navigation__subitem" style="width:119px;"><a href="http://lazada.com/sell/community/success_stories/" target="_blank">Success Stories</a></li>
														</ul>
													</li>
													<li class="sell-with-us-nav__item">
														<a target="_blank" href="https://lazadahkpsc.zendesk.com/hc/en-us/categories/200558555">Support Center</a>
													</li>
												</ul>
											</div>
										</div>
					
                </nav>
				
															

				
            
                            <!-- Primary marketing message -->
             
			 <?php
			 
			 if($display_result==2||(isset($_SESSION['company_email'])))
				   include("2.php");
			 
			   if($display_result==1){
				//ECHO "<br><br>I am here".$display_result;
				include("1.php");
				}
			   
			   
				?>
            

   

    <!-- Features Home Row -->
   

    <!-- Fifth Row -->
   

 

   
</div>
            </div>
        </div>
    </div>

            </div>
            <!-- /container -->

			

			
			
    <script>        	
var step = <?php if($_SESSION['step']==100){$_SESSION['step']=1;} if($_SESSION['step']==5){$_SESSION['step']=6;}  echo json_encode($_SESSION['step']); ?>;
        </script>
        <script src="js/index.js"></script>	
		   <link rel="stylesheet" href="css/style.css">
                

            <script src="./Lazada.com_files/modernizr.min.js"></script>
            <script src="./Lazada.com_files/global.js"></script>
            <script src="./Lazada.com_files/app.js"></script>
        

    <script type="text/javascript">window.NREUM||(NREUM={});NREUM.info={"beacon":"bam.nr-data.net","licenseKey":"a6e87d609d","applicationID":"16929724","transactionName":"ZF0ANhZQDEoDVkcKDF0XNxANHgtXBlBLTRNbSA==","queueTime":0,"applicationTime":145,"atts":"SBoDQF5KH0Q=","errorBeacon":"bam.nr-data.net","agent":""}</script>
	
	
	
	
	

</body></html>


