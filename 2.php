<?php

 $error_string = $error = FALSE;
 $step=FALSE;
 $tasks_to_complete=FALSE;
 $tasks_complete=FALSE;
 $comment=$comment1=$app_status=$check1=FALSE;

if($display_result==2||(isset($_SESSION['company_email']))){
   
  if(isset($_SESSION['executed_once'])!=1){
  
  
  $lead_status=$result1['lead_status'];
  $days_in_current_status=$result1['days_in_current_status'];
  $picklist_tags=$result1['picklist_tags'];
  $br_uploaded=$result1['br_uploaded'];
  $rejection_reasons=$result1['rejection_reasons'];
  $doc_verified=$result1['document_verified'];
  $seller_center_last_login_date=$result1['seller_center_last_login_date'];
  $payoneer_status=$result1['payoneer_status'];
  $rejection_reasons=$result1['rejection_reasons'];
  $onboarding_test_score=$result1['onboarding_test_score'];
  $no_of_sku_approved=$result1['no_of_sku_approved'];
  $no_of_sku_rejected=$result1['no_of_sku_rejected'];
  $no_of_sku_uploaded=$result1['no_of_sku_uploaded'];
  $seller_center_id=$result1['seller_center_id'];
  $seller_name=$result1['company'];
  $lead_comments=$result1['lead_overall_comments'];
  $lead_id=$result1['lead_id'];
  $partner=$result1['partner'];
  $lead_owner=$result1['lead_owner'];
  $email_owner=$result1['email_owner'];
  //change first letter uppercase
  
  $seller_name=ucwords($seller_name);
  
  $lead_status=strtolower($lead_status);
  $email=$result1['email'];
  //$phone=$result1['phone'];
  $country=$result1['seller_origin'];
  $lead_owner=$result1['lead_owner'];
  
  if($no_of_sku_approved=="") $no_of_sku_approved=0;
  if($no_of_sku_uploaded=="") $no_of_sku_uploaded=0;
  if($no_of_sku_rejected=="") $no_of_sku_rejected=0;
 
 //steps in the process
 //Signup : 1
 //Seller Centre Account : 2
 //upload Sku's : 3
 //onboarding : 4
 //Seller live : 5
 
  if($lead_status==strtolower("ACF And Contract Sent To Seller")||$lead_status==strtolower("Contract Received")||$lead_status==strtolower("Open")||$lead_status==strtolower("Create SellerCenter"))
  {
   $step=1;
  }
 
  if($lead_status==strtolower("Seller Center Created"))
  {
   $step=2;
  }
  if($lead_status==strtolower("Pending SKU upload")||$lead_status==strtolower("SKU Uploaded")||$lead_status==strtolower("SKUs uploaded")||$lead_status==strtolower("Wrong SKU upload"))
  {
   $step=3;
   
  }
  if($lead_status==strtolower("Onboarding done")||$lead_status==strtolower("Onboarding scheduled"))
  {
   $step=4;
  }
  if($lead_status==strtolower("Seller Live"))
  {
   $step=5;
  } 
  if($lead_status==strtolower("On Hold"))
  {  $step=100;
    $app_status="On Hold";
    $comment='Your application has been set aside because you have declared you are from a country outside of China (Mainland), Hong-Kong or Korea. If not, please send a request to <a href="http://lazada.com/partnersupport/" target="_blank">Partner Support</a>  and we will update your information.';
  }
  
  if($lead_status==strtolower("Not contactable"))
  {  $step=100;
    $app_status="Not Contactable";
    $comment='Your application has been set aside because we have not been able to reach you. If you want to use new contact information, please send a request to <a href="http://lazada.com/partnersupport/" target="_blank">Partner Support</a> and we will update it.';
  }
  
  if($lead_status==strtolower("not interested"))
  {  $step=100;
    $app_status="Not Interested";
    $comment='Your application has been set aside because you have not completed the different steps despite our reminders. If you want to resume your application process, please send a request to <a href="http://lazada.com/partnersupport/" target="_blank">Partner Support</a> and we update will your information.';
  }
  
  if($lead_status==strtolower("Duplicate Lead"))
  {  $step=100;
    $app_status="Duplicate Lead";
    $comment='Your application has been set aside because you have already used your email address. If you want to resume your application process, please send a request to <a href="http://lazada.com/partnersupport/" target="_blank">Partner Support</a> and we will your information.';
  }
  if($lead_status==strtolower("junk lead"))
  {  $step=100;
    $app_status="Not Interested";
    $comment='Your application has been set aside because you have not completed the different steps despite our reminders or your products are not allowed (branded items, counterfeits/replica, part of our prohibited list...). If you want to resume your application process, please send a request to <a href="http://lazada.com/partnersupport/" target="_blank">Partner Support</a> and we will your information.';
  }
  
   
  
  

    if($step==1||$step==100)
    {
     if($step==100)
      {
       $tasks_to_complete='<i class="fa fa-square-o" style="color:#F57224;"></i> Fill in the detailed form &nbsp&nbsp'.$tasks_to_complete;
       
      }
     if($lead_status==strtolower("ACF and Contract Sent to Seller")||$lead_status==strtolower("Open"))
      {
       $tasks_to_complete='<i class="fa fa-square-o" style="color:#F57224;"></i> Fill in the detailed form&nbsp&nbsp<a href="#" id="color_change" class="one"><i class="fa fa-envelope"  > <span style="color:#183546; font-size:14px;">Click to RESEND!</span></i></a>'.$tasks_to_complete;
       $app_status="First sign up form received";
       $comment="<br>Please complete the application form (including accepting econtract and uploading a valid BR document).";
      }
     if($lead_status==strtolower("Contract Received"))
      { $tasks_complete="<i class='fa fa-check-square-o' style='color:#F57224;'></i> Form Filled and Econtract Received";
       $app_status="Application Form under review";
       if($rejection_reasons!='')
        {
          $comment="<br>Your Seller Center account got rejected because some of your information are not valid. Please check your emails and review information.";
        }
        if($rejection_reasons=="") {
        $comment= "<br>Your application is under review. Just wait 1 or 2 days for further instructions.";}
      }
     if($lead_status==strtolower("Create SellerCenter"))
      { $tasks_complete="<i class='fa fa-check-square-o' style='color:#F57224;'></i> &nbsp Form Filled and Econtract Received<br><i class='fa fa-check-square-o' style='color:#F57224;'></i> &nbspEcontract Recieved";
       $app_status="Seller Center account under creation";
       if($doc_verified=='1')
       {
       if($rejection_reasons=="") {
        $comment= "<br>Your application is under review. Just wait 1 or 2 days for further instructions.";} 
       }
       if($rejection_reasons!='')
        {
        $comment="<br>Your Seller Center account got rejected because some of your information are not valid. Please check your emails and review information. ";
        }
       
       
      }
    }
    
    if($step==2)
    {
     $app_status="Seller Center Setup";
      
      if($seller_center_last_login_date=='')
      { 
       $tasks_to_complete= '<i class="fa fa-square-o" style="color:#F57224;"></i> Sign-in to it MY Seller Centre for verification<br>';
       $comment="<br>Reset your password in your MY Seller Center for verification. ";
      }
      if($seller_center_last_login_date!='')
      {
       $tasks_complete= "<i class='fa fa-check-square-o' style='color:#F57224;'></i>  Seller Center MY verified<br>";
       
      }
      // Payoneer Status check start
      if($payoneer_status==''||$payoneer_status=='Rejected')
      {
       $tasks_to_complete= $tasks_to_complete.'<i class="fa fa-square-o" style="color:#F57224;"></i> Payoneer Approval ';
       $comment="Don't forget to link your Payoneer account with your Seller Center MY. Note that Payoneer approval  takes around 5 days.";
      }
      if($payoneer_status=='Approved')
      {
       $tasks_complete= $tasks_complete."<i class='fa fa-check-square-o' style='color:#F57224;'></i> Payoneer Approved<br>";
       
      }
      // Payoneer Status check end
      
      if($onboarding_test_score=="")
          {
           $tasks_to_complete= $tasks_to_complete.'<i class="fa fa-square-o" style="color:#F57224;"></i> Appear for Onboarding Online test&nbsp&nbsp<a href="#" id="color_change" class="two" ><i class="fa fa-envelope" > <span style="color:#183546; font-size:14px; ">Click to RESEND!</span></i></a><br>';
          }
          
          if($onboarding_test_score!=""&&($onboarding_test_score>0&&$onboarding_test_score<84))
          { $tasks_to_complete= '<i class="fa fa-square-o" style="color:#F57224;"></i> Onboarding online test&nbsp&nbsp<a href="#" id="color_change" class="two" ><i class="fa fa-envelope" > <span style="color:#183546; font-size:14px;">Click to RESEND!</span></i></a><br>';
           $comment1="<br>You haven't successfully cleared the Onboarding Test. Your score is ".$onboarding_test_score.". You will have to appear for the test again.";
          } 
          if($onboarding_test_score>84)
          {
           $tasks_complete= "<i class='fa fa-check-square-o' style='color:#F57224;'></i> Appear for Onboarding Online Test&nbsp&nbsp</a><br>";
           
          }  
      
      

    }  
      
      if($step==3)
       {
        $app_status="Waiting for SKU approval";
       
        if($no_of_sku_uploaded>=0 &&$no_of_sku_uploaded<50 )
        {
         $tasks_to_complete= $tasks_to_complete."<i class='fa fa-square-o' style='color:#F57224;'></i> Upload atleast 50 SKU's.<br>";
        }
        if($no_of_sku_uploaded>=50)
        {
         $tasks_complete= $tasks_complete."<i class='fa fa-check-square-o' style='color:#F57224;'></i> Upload atleast 50 SKU's.<br>";
         $comment="Please wait for further instrunctions.";
        }
        
        if($no_of_sku_approved<50)
        {$tasks_to_complete= $tasks_to_complete."<i class='fa fa-square-o' style='color:#F57224;'></i> Get atleast 50 SKU's approved.<br>";}
        
        
        if($no_of_sku_rejected>0||$lead_status=="Wrong SKU upload"){
         $comment=$comment. "<br>Please check the Malayia Seller Centre for more information about the rejected SKU's.";
         
        }
        $comment="Please upload 50 SKUs in Seller Center MY and make sure to get them approved by quality check team. Note that QC check can take up to 7 days. ";
        if($no_of_sku_approved>50)
        {
         $tasks_complete= $tasks_complete."<i class='fa fa-check-square-o' style='color:#F57224;'></i> Get atleast 50 SKU's approved.<br>";
         $comment="Please wait for further instrunctions.";
        }
        
       }
       
           
      //Onboarding Test Check
      
      
      if($step==4){
       
        If($lead_status==strtolower("Onboarding done"))
        { $app_status="Waiting for final approval";
         $tasks_complete= "<i class='fa fa-check-square-o' style='color:#F57224;'></i> Onboarding Complete<br>";
         $comment= "Your application is under final review. Just wait for 1 day.";
         if($picklist_tags!="Low Quality"){
         $comment=$comment."<br>You may get trained by our Seller Training Specialists"; 
         }
        }

        If($lead_status==strtolower("Onboarding scheduled"))
        { $app_status="Onboarding scheduled";
         $tasks_to_complete= "<i class='fa fa-square-o'></i> Schedule Onbarding Session<br>";
         $comment="Please join the onboarding session that your account manager has set up.";
        }
       
      }
   
  If($step==5)
  {
   $comment="<br>Congratulations, you can now sell on Lazada MY. You can also, now start selling in all the countries.";
  }
  
  If(($step==1||$step==100)&&($lead_comments=="MY"||$lead_comments=="VT"||$lead_comments=="SG"||$lead_comments=="PH"||$lead_comments=="TH"||$lead_comments=="ID" ))
  {
   $comment="We have noticed you are not registering on the right webpage according to the information you have provided to us. Please register on the local Lazada webpage according to where your operations take place. <br>
 Here is the list of our local platforms:<br>
&nbsp &nbsp&nbsp <a target='_blank' href='http://www.lazada.com.my/marketplace'>Malaysia</a>, <a target='_blank' href='http://www.lazada.sg/marketplace'>Singapore</a>, <a target='_blank' href='http://www.lazada.co.th/marketplace'> Thailand</a>, <a target='_blank' href='http://www.lazada.co.id/marketplace'>Indonesia</a>, <a target='_blank' href='http://www.lazada.com.ph/marketplace'>Philippines</a>, <a target='_blank' href='http://www.lazada.vn/marketplace'> Vietnam</a> ";
  }
   
  if(($picklist_tags=="CM priority"||$picklist_tags=="Top Quality")&&$step!=100){
  $comment1="<br>You can have further information from your own manager at LAZADA <a href='mailto:".$email_owner."'>".$lead_owner."</a>.";}
 
 
  
$_SESSION['comment']=$comment;
$_SESSION['comment1']=$comment1;
$_SESSION['step']=$step;
$_SESSION['seller_name']=$seller_name;
$_SESSION['tasks_to_complete']=$tasks_to_complete;
$_SESSION['tasks_complete']=$tasks_complete;
$_SESSION['email']=$email;
$_SESSION['country']=$country;
$_SESSION['app_status']=$app_status;
$_SESSION['lead_id']=$lead_id;
$_SESSION['partner']=$partner;

$_SESSION['executed_once']=1;
  }

}//end of IF($display_result==2)
?>  


  <div class="content-wrapper" style="min-height:590px;">
                    <!-- First Row -->
    <div class="row map-row" >
        <div class="container" style="max-width:100%">
   
            <div class="col-4 intro-home" style="z-index:4;">
   
    <p style="width:750px;  padding-left:15px; padding-top:80px;margin-bottom: 5px; margin-top:5px;">
    <?php echo "Hi, ".$_SESSION['seller_name']."<br>";
    if($_SESSION['step']<5 || $_SESSION['step']==100){ echo '<span style="font-size:14px">Your application status: </span><span style="font-size:16px; font-weight:bold;color:#F57224;"  >'.$_SESSION['app_status'].' </span>';}?></p>
    <div  style="z-index:8;">
    
  <div class="progress" style="padding-right:350px;"">
  <div class="circle">
    <span class="label" title="Seller needs to [br]&nbsp&nbsp&nbsp1.Sign-Up[br]&nbsp&nbsp&nbsp2.Submit the E-Contract">1</span> 
    <span class="title" style="margin-left:-9px;">Sign&nbspUp </span>
  </div>
  <span class="bar"></span>
  <div class="circle">
    <span class="label" title="Seller needs to [br]&nbsp&nbsp&nbsp1.Login SC MY[br]&nbsp&nbsp&nbsp2.Get Payoneer Approval[br]&nbsp&nbsp&nbsp3.Appear for Online Test">2</span>
    <span class="title" style="margin-left:-17px;">Verification</span>
  </div>
  <span class="bar"></span>
  <div class="circle ">
    <span class="label" title="Seller needs to [br]&nbsp&nbsp&nbsp1.Upload 50 SKU's[br]&nbsp&nbsp&nbsp2.Get 50 SKU's Appoved">3</span>
    <span class="title" style="margin-left:-19px;">Upload&nbspSKU's</span>
  </div>
  <span class="bar"></span>
  <div class="circle">
    <span class="label" title="<?php if($picklist_tags=="CM priority"||$picklist_tags=="Top Quality") echo "Seller needs to [br]&nbsp&nbsp&nbsp1.Attend Onboarding Session"; else echo"Seller may opt for an Onboarding Session";?>" >4</span>
    <span class="title" style="margin-left: -19px;">Onboarding</span>
  </div>
  <span class="bar"></span>
  <div class="circle" >
    <span class="label" title="You will be a live seller">5</span>
    <span class="title" style="margin-left:-19px;" >Seller&nbspLive </span>
  </div>
</div>
    
    <!--p style="width:800px; height:80px;  margin-top: 20px; margin-bottom: 10px;"> 
    <button style="width: 130px; height:45px;  font-size: 15px; <?php ?> opacity:1; " title="Seller needs to [br]&nbsp&nbsp&nbsp1.Sign-Up[br]&nbsp&nbsp&nbsp2.Submit the E-Contract" >Sign Up</button>
    
    <button style="width: 130px; height:45px;  font-size: 15px; <?php if($_SESSION['step']>1&&$_SESSION['step']<6) echo "opacity:1"; else echo "opacity:0.7";?>  " title="Seller needs to [br]&nbsp&nbsp&nbsp1.Login SC MY[br]&nbsp&nbsp&nbsp2.Get Payoneer Approval" >Seller Center Account</button>
    
    <button style="width: 130px; height:45px;  font-size: 15px;  <?php if($_SESSION['step']>2&&$_SESSION['step']<6) echo "opacity:1"; else echo "opacity:0.7";?> " title="Seller needs to <?php if($picklist_tags!="CM priority"||$picklist_tags!="Top Quality") echo "[br]&nbsp&nbsp&nbsp1.Appear for Online Test[br]&nbsp&nbsp&nbsp2"; else echo "[br]&nbsp&nbsp&nbsp1"?>.Upload 50 Appoved SKU's">Upload SKU's</button>
    
    <button style="width: 130px; height:45px;  font-size: 15px;   <?php if($_SESSION['step']>3&&$_SESSION['step']<6) echo "opacity:1"; else echo "opacity:0.7";?> "  title="<?php if($picklist_tags=="CM priority"||$picklist_tags=="Top Quality") echo "Seller needs to [br]&nbsp&nbsp&nbsp1.Attend Onboarding Session"; else echo"Seller may opt for an Onboarding Session";?>">Onboarding</button>
    
    <button style="width: 130px; height:45px;  font-size: 15px;   <?php if($_SESSION['step']>4&&$_SESSION['step']<6) echo "opacity:1"; else echo "opacity:0.7";?> "  >Seller Live</button>
    
    </p--> 
    </div>

    <br>
    
    <?php
    
    if(($_SESSION['step']<5 || $_SESSION['step']==100)&&$_SESSION['step']!=""){
     echo '
    <table style=" width:600px;margin-left:40px;font-size:19px; color: #dde2e4; text-align:left; " cellpadding="10">
    <tr><th style="width:50%;font-size:22px;">Tasks for Seller in this step<br><br></th></tr>
    
    <tr style="vertical-align: text-top;"><td>'.$_SESSION['tasks_to_complete'].'</td></tr>
    <tr style="vertical-align: text-top;"><td>'.$_SESSION['tasks_complete'].'</td></tr>
    </table>'
    ;
    } 

    
    ?>

    <p style="width:800px; font-size:16px;"><br><br><br><?php echo $_SESSION['comment'].$_SESSION['comment1'];?></p>






      
            </div>
            <div class="col-8 svg-column">
                <div id="svgout" style="padding-left:30px;" >
    <!-- Include the svg map -->
    <?PHP require_once ('svg.html'); ?>

   
</div>
</div>
            </div>
        </div>
    </div>
 <!--DIV for The dialog box that contains user information -->
 
 <div id="dialog" title="User Details" style="font-size:12px; visibility:hidden" >
 <div style="text-align:right"><i  id="close" class='fa fa-times' title="Close" style='cursor:pointer;font-size:12px;color:#F57224;'></i></div>
 <div style="text-align:center; color:#F57224 ; font-size:22px;"><strong>User Details</strong></div>
 
  <p style="font-size:12px;">Please check your details. If there's any missing or incorrect information please feel free to contact us.</p>
  <div style="font-size:14px;" ><table style="width:100%">
  <tr>
   <td style="width:50%; text-align:right">Company Name&nbsp&nbsp</td>
   <td>&nbsp&nbsp<?php echo $_SESSION['seller_name']; ?></td> 
  </tr>
  <tr>
   <td style="width:50%; text-align:right">Email&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
   <td>&nbsp&nbsp<?php echo $_SESSION['email']; ?></td> 
  </tr>
  <!--tr>
  
  
 </table>

<div style="padding-top:25px; text-align:right"><button id="close" style="width: 80px; height:35px;  font-size: 15px;color:#F57224 ; background-color: #0D2435;">CLOSE</button></div>
</div>
  
  </div>

 <!-- End of div-->
<div id="conf_dialog" title="confirmation" style="font-size:12px; visibility:hidden" >
<div style="text-align:right"><i  id="conf_close" class='fa fa-times' title="Close" style='cursor:pointer;font-size:12px;color:#F57224;'></i></div>
 <div style="text-align:center; color:#F57224 ; font-size:22px;"><strong>Email Confirmation</strong></div>
  <p style="font-size:16px;">An Email has been sent to <?php echo $_SESSION['email'];?>. Please check your email. </p><p style="font-size:13px;">For any further queries, feel free to reach us.</p>
  

<div style="padding-top:25px; text-align:center"><button id="conf_close" style="width: 60px; height:30px; padding-right:0px; padding-left:0px; font-size: 13px;color:#F57224 ; background-color: #0D2435;">CLOSE</button></div>

  
  </div>
 
 
    <!-- Second Row -->
    <!-- Second Row -->
   