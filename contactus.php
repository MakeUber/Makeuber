<?php 
require_once("init.php");
require_once("config_db.php");
require_once("config.php");
 //error_reporting(E_ALL);
// echo 'hih';exit;
    //require 'PHPMailer_5.2.4/PHPMailer.php';
//	require("PHPMailer_5.2.4/class.smtp.php");
require("include/PHPMailer_5.2.4/class.pop3.php");
require("include/PHPMailer_5.2.4/class.phpmailer.php");

   //echo 'hih';exit;
    ini_set('display_errors', '1');
	
 if(isset($_POST['submit']))
 {
$name = $_POST['name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$messag = $_POST['msg'];

 if($name == '') {
   $flag[1] = 'r';
 }
   elseif($email == '')	{
	  $flag[3] = 'r';	
	}

    elseif($mobile == '')	{
		$flag[6] = 'r';
		
	}
	elseif($messag == '')	{
		$flag[11] = 'r';
		
	}
	
 
    else{
	  $mail = new PHPMailer();
    $mail->IsSMTP();
	$mail->SMTPDebug=2; 
	$mail->From = "nirajbohra@gmail.com";
	$mail->FromName ="nirajbohra@gmail.com";
    $mail->Host = "smtp.gmail.com"; // Your SMTP PArameter
	$mail->SMTPSecure = "tls";//"ssl";"tls"; // Check Your Server's Connections for TLS or SSL
    $mail->Port = 587;//465; // Your Outgoing Port
    $mail->SMTPAuth = true; // This Must Be True
    $mail->Username = "nirajbohra@gmail.com"; // Your Email Address
    $mail->Password = "niraj124"; // Your Password
	
		   $mail->AddAddress("lisa.mohapatra17@gmail.com");
		   $mail->AddCC("nirajbohra@gmail.com");
		   $mail->IsHTML(true);

		 $mail->Subject = "Enquiry Form";
		$from = "decore@gmail.com";
		$mail->Body =  "Hello Admin you got a mail \n\n <br> ";
		$mail->Body .=  "Name: ".$name."\n\n <br>";
		$mail->Body .=  "Mobile: ".$mobile."\n\n <br>";
		$mail->Body .= "Email: ".$email."\n\n <br>";
		$mail->Body .=  "Message: ".$messag;
	
		
		try{
    if(!$mail->Send())
    {
      // echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
    else
   {
       $flag['g'] = 1;	;
   }
	//$mail->Send();
	} 
	catch (phpmailerException $e) { 
 echo $e->errorMessage(); //error messages from PHPMailer
} 
		
		
		
	}
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $site_name; ?></title>
    <meta charset="utf-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
	<link rel="stylesheet" href="./css/custom.css">

			<!-- Optional theme -->
			
			
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	
			<link rel="stylesheet" type="text/css" href="./css/menu.css">
			<link rel="stylesheet" type="text/css" href="./css/Style.css">
			
			
			<link rel="stylesheet" type="text/css" href="./css/demo.css" />
			<link rel="stylesheet" type="text/css" href="./css/style1.css" />
			<link rel="stylesheet" type="text/css" href="./css/jquery.jscrollpane.css" media="all" />
	
			<script type="text/javascript" src="./js/jquery.js"></script>
			<script src = "./js/jsfunction.js" type="text/javascript"></script>
			
			
			<!..Change.. >


<script src ="./js/bootstrap.min.js" type="text/javascript"></script>
			<script src = "./js/jsfunction.js" type="text/javascript"></script>
     <?php if($flag['g'] <> ''){
?>
<meta http-equiv="refresh" content="3; URL=<?php echo $this_parent;?>">
<?php } ?>
<style> 
.contact-form {
	position: relative;
	vertical-align: top;
	z-index: 1;
	margin: 0;
}
.contact-form .txt-form {
	display: none;
}
.contact-form .coll-1, .contact-form .coll-2, .contact-form .coll-3 {
	float: left;
	width: 253px;
}
.contact-form .coll-1, .contact-form .coll-2 {
	margin-right: 5px;
}
.contact-form fieldset {
	border: none;
	padding: 0;
	width: 50%;
	position: relative;
	z-index: 10;
}
.contact-form label {
	display: inline-block;
	min-height: 57px;
	position: relative;
	margin: 0;
	padding: 0;
	float: left;
	width: 100%;
}
.contact-form .message {
	display: block;
	width: 100%;
}
.contact-form input, .contact-form textarea {
	font-family: 'Open Sans', sans-serif;
	padding: 10px 10px 10px 10px;
	margin: 0;
	font-size: 15px;
	line-height: 20px;
	color: #b4b4b4;
	background: #fff;
	outline: none;
	width: 50%;
	border: 1px solid #b7b7b7;
	-webkit-box-shadow: none;
	box-shadow: none;
	float: left;
	border-radius: 0px;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	font-weight: normal;
}
.contact-form input {
	height: 42px;
}

.contact-form .area .error {
	float: none;
}
.contact-form textarea {
	width: 100%;
	height: 152px;
	resize: none;
	overflow: auto;
}
.contact-form .success {
	border: 1px solid #b7b7b7;
	display: none;
	position: absolute;
	left: 0;
	top: 0;
	font-size: 15px;
	line-height: 17px;
	background: #fff;
	padding: 14px 0px;
	text-transform: none;
	text-align: center;
	z-index: 20;
	width: 0%;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	border-radius: 0px;
}
.contact-form .error, .contact-form .empty {
	color: #f00;
	font-size: 10px;
	line-height: 1.2em;
	display: none;
	overflow: hidden;
	padding: 0px 4px 0px 0;
	text-transform: none;
	position: absolute;
	font-weight: normal;
	bottom: 3px;
	right: 0;
}
.contact-form .message .error, .contact-form .message .empty {
	bottom: -15px;
}
.contact-form .buttons-wrapper {
	position: relative;
	padding-top: 30px;
}
.contact-form .buttons-wrapper input {
	cursor: pointer;
	background: #ff6961;
border: none;
border-radius: 5px;
color: #FFF;
font-weight: bold; width:200px; float:right;
 
font-size: 17px;
text-indent: 0px;
-webkit-box-shadow: 0 3px 6px rgba(0,0,0,0.4);
-moz-box-shadow: 0 3px 6px rgba(0,0,0,0.4);
box-shadow: 0 3px 6px rgba(0,0,0,0.4);
}
.contact-form .buttons-wrapper input:hover {

	color: #DDD;

}
#content{width:100%}
@media only screen and (max-width:930px) {
    .num1{width:55%;
	min-width:150px;
	margin-left:20px;}
}
a:hover{color:white;
text-decoration:none;}

</style>			

<script>
function submit_form(){
	//alert($('#feedbackform').serialize());
	//exit;
	$.ajax({
   type: "POST",
   data: $('#feedbackform').serialize(),
   url: "ajax.php",
      success: function(rep)
    {
 //alert(rep);
  var response_array = rep.split('|::|');
  if(response_array[0] == 'Error')
  {
  //alert(response_array[2]);
    $("#errormsg1").show();
   $("#errormsg1").html(response_array[1]);
   $("#errormsg1").fadeOut(2000);

  }
  if(response_array[0] == 'Success')
  {
    $("#errormsg1").show();
   $("#errormsg1").html(response_array[1]);
   $("#errormsg1").fadeOut(4000);
   setInterval('hidefeddback()',3000);

  }
 }
  });
  return false;
}
function hidefeddback(){
	$('.feedback').animate({right:'-32.7%'},1000);
	$('.feedback').data('hidden','false');
	$('.blur').remove();
}
function usertype(types){
		//alert(types);
		document.getElementById('usertype').value = types;
		if(types == 1){
			$('#expertsocial').show();
			$('#usersocial').hide();
		}else{
			$('#usersocial').show();	
			$('#expertsocial').hide();
		}
			
		//$('#usertype').val = types;
}
function feedback_type(feedback_type){
			document.getElementById('feedback_type').value = feedback_type;

}
    function archive_fun()
{
 if(confirm("Are you sure you want to delete this Project"))
 {
  return true;
 }
 else
 {
  return false; 
 }  
}


</script>
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="//v2.zopim.com/?35HWLYHjHRZIffiJOElwqt2kf7zJhOHX";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
</head>

<body style="overflow-x:hidden;background-color:#302720;">
<!--==============================header=================================-->

<!-- ---------------------Header ------------------------------- -->

<script language="javascript">
function login1(){
	//alert("hi");
	
	//alert($('#loginform').serialize());
	$.ajax({
   type: "POST",
   data: $('#loginform').serialize(),
   url: "ajax.php",
      success: function(rep)
    {
   //alert(rep);
  var response_array = rep.split('|::|');
  if(response_array[0] == 'Error')	
  {
  //alert(response_array[2]);
    $("#errormsg").show();
   $("#errormsg").html(response_array[1]);
   $("#errormsg").fadeOut(2000);
  }
  if(response_array[0] == 'Success')
  {
   $("#errormsg").html(response_array[1]);
   //////////////////////////it is used to check the person has click on share requirements//////////////////////
   //alert($('#sharetxt').val());
   var data = $('#sharetxt').val();
  // alert(response_array[2]);
  // break;
  	 if(data=='share'){
		    $(location).attr('href','Index.php');
			
	   }
	   else{
		     if(response_array[2] == '1'){
	   		//alert($('#budget').val());
	   
			//if($('#budget').val() != '' && $('#budget').val() !== undefined){
			//alert("got");//
			//$("#projectform").submit();
			//}else{
			$(location).attr('href','designer_profile.php');
			//}
		}else{
			$(location).attr('href', 'user_profile.php'); 
			//salert($('#budget').val());
			//if($('#budget').val() != '' || $('#budget').val() !== undefined){
				//alert("hi");
				//$("#projectform").submit();
			//}else{
				//alert("bye");
				//alert(window.location.reload());
			
			//}
   }
	   }
	/////////////////////////////////////else portion//////////////////////////////////////
  }
 }
  });
  return false;
 	
}
function submit_form(){
	//alert($('#feedbackform').serialize());
	//exit;
	$.ajax({
   type: "POST",
   data: $('#feedbackform').serialize(),
   url: "ajax.php",
      success: function(rep)
    {
 //alert(rep);
  var response_array = rep.split('|::|');
  if(response_array[0] == 'Error')
  {
  //alert(response_array[2]);
    $("#errormsg1").show();
   $("#errormsg1").html(response_array[1]);
   $("#errormsg1").fadeOut(2000);

  }
  if(response_array[0] == 'Success')
  {
    $("#errormsg1").show();
   $("#errormsg1").html(response_array[1]);
   $("#errormsg1").fadeOut(4000);
   setInterval('hidefeddback()',3000);

  }
 }
  });
  return false;
}
function hidefeddback(){
	$('.feedback').animate({right:'-32.7%'},1000);
	$('.feedback').data('hidden','false');
	$('.blur').remove();
}
function usertype(types){
		//alert(types);
		document.getElementById('usertype').value = types;
		if(types == 1){
			$('#expertsocial').show();
			$('#usersocial').hide();
		}else{
			$('#usersocial').show();	
			$('#expertsocial').hide();
		}
			
		//$('#usertype').val = types;
}
function feedback_type(feedback_type){
			document.getElementById('feedback_type').value = feedback_type;

}
    function archive_fun()
{
 if(confirm("Are you sure you want to delete this Project"))
 {
  return true;
 }
 else
 {
  return false; 
 }  
}


</script>

<?php include "./include/header.php" ?>
		

<!-- --------------------- FAKE HEADER --------------------------- -->
<img src="./img/connectdown.jpg"  style="width:100%;max-width:100%; height:auto;">


	  
<div id="content" class="bot-1" > 

      <div class="row" style="position:relative;left:47%;">
          <h3 style="color:#fff;"><?php echo print_messages($flag, $error_message, $success_message);?></h3>
          <form class="contact-form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
           
            <fieldset>
              <div class="col-1">
                <label class="name">
                  <input type="text"  placeholder="Name*" name="name" value="<?php echo $name; ?>"><br>
                   </label>
              </div>
              <div class="col-2">
                <label class="email">
                  <input type="email" placeholder="Email*" name="email" value="<?php echo $email; ?>"><br>
                   </label>
              </div>
              <div class="col-3">
                <label class="phone notRequired">
                  <input type="tel" placeholder="Phone*" name="mobile" value="<?php echo $mobile; ?>"><br>
                   </label>
              </div>
              <div class="clear"></div>
              <div>
                <label class="message">
                  <textarea placeholder="Message*" name="msg"><?php echo $messag; ?></textarea><br>
                  </label>
              </div>
              <div class="clear"></div>
              <br/>
              <div class="buttons-wrapper" style="margin-top:10px;"><input style="margin-top: 10px;" type="submit" class="btn" data-type="submit" name="submit" value="Submit"></div>
            </fieldset>
          </form>
      </div>    
	  
    </div>   
<img src="./img/iconnectdown.jpg" style="position:relative;bottom:300px;right:120px;" class="num1">
<!-- ---------------------MODAL ------------------------------- -->
				<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span> </button>
        <div class="modal-title">
          <h2 style="color:black;">Login</h2>
        </div>
      </div>
      <div class="modal-body">
        <ul class="nav nav-tabs" role="tablist">
          <li class="active"><a href="#" onclick="usertype(0)" role="tab" data-toggle="tab" style="color:black; font-size:15px;">Users</a></li>
          <li><a role="tab" onclick="usertype(1)" data-toggle="tab" style="color:black; font-size:15px;">Experts</a></li>
        </ul>
        <br>
        <div class="tab-content">
          <form id="loginform" name="login">
          <input type="hidden" id="sharetxt" name="share" value="" />
            <div class="tab-pane fade in active">
              <div align="center" id="errormsg"></div>
              <div class="input-group input-modal"> <span class="input-group-addon icon-user"></span>
                <input type="text" id="username" name="username" class="form-control" required placeholder="Username">
                <input type="hidden" id="usertype" name="type" value="0" />
                <input type="hidden" name="do" value="login" />
              </div>
              <br>
              <div class="input-group input-modal"> <span class="input-group-addon icon-lock"></span>
                <input type="password" name="password" class="form-control" required placeholder="Password">
              </div>
              <br>
              <button type="button" onclick="login1();" class="btn btn-success">Sign In</button>
              &nbsp;&nbsp;&nbsp;
<span style="font-size:15px;color:black;"> Or connect with </span><br>
              <br>
             <div id="usersocial"> <a href="fb_login.php?type=0&path=<?php echo full_url();?>&id=<?php echo $_GET['id'];?>">
                <button type="button" class="btn btn-primary"><i class="fa fa-facebook"></i> Facebook</button>
                </a> <a href="google_login.php?type=0&path=<?php echo full_url();?>&id=<?php echo $_GET['id'];?>">
                <button type="button" class="btn btn-primary"><i class="fa fa-google"></i> Google</button>
                </a><!-- <a href="twitter_login.php?type=0&path=<?php echo $page;?>&id=<?php echo $_GET['id'];?>">
                <button type="button" class="btn btn-primary"><i class="fa fa-twitter"></i> Twitter</button>
                </a>--> </div>
              <div id="expertsocial" style="display:none"> <a href="fb_login.php?type=1&path=<?php echo full_url();?>&id=<?php echo $_GET['id'];?>">
                <button type="button" class="btn btn-primary"><i class="fa fa-facebook"></i> Facebook</button>
                </a> <a href="google_login.php?type=1&path=<?php echo full_url();?>&id=<?php echo $_GET['id'];?>">
                <button type="button" class="btn btn-primary"><i class="fa fa-google"></i> Google</button>
                </a> </div>
            </div>
          </form>
          <div class="tab-pane fade"></div>
        </div>
      </div>
      <div class="modal-footer">
				<span class="pull-left" style="font-size:15px;color:black;font-family:sans-serif;">Don't have an account? <a href="Register.php" style="color:blue;" >Sign up</a> now!</span>
			</div>
    </div>
  </div>
</div>
          <p id="requirements" title="Sorry" style="display:none;font-family:Helvetica Neue,Helvetica,Arial,sans-serif !important;">please fill in details about your project</p>

<br/><br/>
<?php include "./include/footer.php" ?> 
</body>
</html>