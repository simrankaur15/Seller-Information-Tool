
step = step + 1;
var i = 1;

$('.progress .circle').removeClass().addClass('circle');
$('.progress .bar').removeClass().addClass('bar');



setInterval(function() {
while (i < step){
  $('.progress .circle:nth-of-type(' + i + ')').addClass('active');
  
  $('.progress .circle:nth-of-type(' + (i-1) + ')').removeClass('active').addClass('done');
  
  $('.progress .circle:nth-of-type(' + (i-1) + ') .label').html('&#10003;');
  
  $('.progress .bar:nth-of-type(' + (i-1) + ')').addClass('active');
  
  $('.progress .bar:nth-of-type(' + (i-2) + ')').removeClass('active').addClass('done');
  
 i++;
 sleep(800);
 }
 
  if (i==0) {
    $('.progress .bar').removeClass().addClass('bar');
    $('.progress div.circle').removeClass().addClass('circle');
    i = 1;
  }
},600);

//mail function
$(document).ready(function(){
	 
    $("#color_change").click(function(){
		var email=this.className+"=1";
        $.ajax({url: "email.php?",data: email, success: function(result){
         $( "#conf_dialog" ).css("visibility", "visible");
      $( "#conf_dialog" ).dialog( "open" );
	// alert (result);
       } });
    });
});

////////////////////
$(function() {
    $( "#conf_dialog" ).dialog({
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
});	
	
 
	$( "#conf_close" ).click(function() {
      $( "#conf_dialog" ).dialog( "close" );
    });
	
	
	
	
	//////////////////forget password mail function

//mail function
$(document).ready(function(){
	 
    $("#forget_password").click(function(){
		var email_id="Hi";
        $.ajax({url: "forget_password.php?",data: email, success: function(result){
         $( "#forget_password_conf_dialog" ).css("visibility", "visible");
      $( "#forget_password_conf_dialog" ).dialog( "open" );
		alert (result);
       } });
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
});	
	
 
	$( "#forget_password_conf_close" ).click(function() {
      $( "#forget_password_conf_dialog" ).dialog( "close" );
    });
	
	
	
