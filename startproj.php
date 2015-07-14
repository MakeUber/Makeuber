<?php 
include "init.php";
include "config_db.php";
include "config.php";
require("include/PHPMailer_5.2.4/class.pop3.php");
require("include/PHPMailer_5.2.4/class.phpmailer.php");
//print_r($_SESSION);
$tabl = 'category';
$sql_cat="select * from category where status='1'";
$exec_cat = mysql_query($sql_cat);
if(isset($_POST['submit'])){


	$cat = $_POST['cat'];

	//echo $cat;die;	
	$_SESSION['your_project']['design'] = explode(",",$cat);
	//print_r($_SESSION);die;
	if ( !($row_main['area'].selected) ) 
					{
						echo 'fill the feild' ;
					}
					else if ($row_main['area'] == $dvar['area'])
					{ 
					  echo "selected='seleccted'";
					  header("location:designtype.php");
	echo '<script language="javascript">window.location = "designtype.php"</script>';
					} 
					else {} 
				

}

if ( isset ( $_POST ['proceed'] ) )  {
	$mobile =  $_POST [ 'mobile' ] ; 
	if ( $mobile == '' ) 
	{	
		echo "Error : Please enter mobile number"; 
	}
	else
	{
		 ini_set('display_errors', '1');

  //  $name = $_POST["name"];
  //  $email = $_POST["email"];
  //  $subject = $_POST["subject"];
  //  $message = $_POST["message"];

    $mail = new PHPMailer();
    $mail->IsSMTP();
	$mail->SMTPDebug=2; 
	$mail->From = "reachus@makeuber.com";
	$mail->FromName ="noreply@makeuber.com";
    $mail->Host = "smtp.gmail.com"; // Your SMTP PArameter
	$mail->SMTPSecure = "tls";//"ssl";"tls"; // Check Your Server's Connections for TLS or SSL
    $mail->Port = 587;//465; // Your Outgoing Port
    $mail->SMTPAuth = true; // This Must Be True
    $mail->Username = "reachus@makeuber.com"; // Your Email Address
    $mail->Password = "printo22"; // Your Password
      $mail->AddAddress("reachus@makeuber.com");
	$mail->AddCC("nirajbohra@gmail.com");
    $mail->IsHTML(true);

    $mail->Subject = "Enquiry form";
/*
   $mail->Body =  "Hello Admin,<br>"
   $mail->Body .= "You received a new contact detail.";
   $mail->Body .= "Contact Number: ".$mobile  ; 
   //echo 'hihi';exit;*/
	try{
			if(!$mail->Send())
			{
			// echo 'Mailer Error: ' . $mail->ErrorInfo;
			}
			else
			{
				//echo 'success';
				echo "Mail sent successfully"; 
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
<title>
	<?php echo $site_name;?>
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset = "UTF-8">
<link rel ="stylesheet" href="css/bootstrap.min.css">
<link rel ="stylesheet" href="cssp/font-awesome.min.css">
<link rel ="stylesheet" href="css/style.css">
<script src = "js/jquery.js" type="text/javascript"></script>	
<script src ="js/bootstrap.min.js" type="text/javascript"></script>
<script src = "js/jquery.lazy.min.js" type="text/javascript"></script>
<script src = "js/tilearrange.js" type="text/javascript"></script>
<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>
<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="//v2.zopim.com/?35HWLYHjHRZIffiJOElwqt2kf7zJhOHX";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
<!--End of Zopim Live Chat Script-->
<script language="javascript">
function check_cat(val){
	var str = $('#cat').val();
	var n = str.search(val);
	//alert(n);
	if(n != -1){
		var len = str.indexOf(val);
		//alert(len);
		if(len==0){
				var data = str.replace(val+",","");
		}else{
				var data = str.replace(","+val,"");
		}
		$('#cat').val(data);
	}else{
		if($('#cat').val() !=''){
			$('#cat').val($('#cat').val()+','+val);
		}else{
			$('#cat').val(val);
		}
	}
}
</script>
<style> 

</style> 
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

  }
 }
  });
  return false;
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
<style>
.footer-menu li a:hover{color:white; text-decoration:none;}
</style>

</head>
<body style="font-family:'Ubuntu',sans-serif;font-size:15px;overflow-x:hidden;">

<div class="container-fluid" id="wrapper" style="background-color:#fff;opacity:0.9;overflow:hidden;">
</div>
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
</script>

<!-- ---------------------Header ------------------------------- -->


<?php include "include/header.php" ?>
		<!.........................HEADER ENDS ................................> 


		  <div class="clearfix"></div><br/>
            

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
				<span class="pull-left" style="font-size:15px;color:black;">Don't have an account? <a href="Register.php" style="color:blue;" >Sign up</a> now!</span>
			</div>
    </div>
  </div>
</div>



          <p id="requirements" title="Sorry" style="display:none;font-family:Helvetica Neue,Helvetica,Arial,sans-serif !important;">please fill in details about your project</p>


<!-- ------------------CONTACT MODAL ---------------------- -->

<div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
				</button>
				<div class="modal-title"><h3 class="head">We love numbers..Enter yours.. </h3></div>
			</div>
			<div class="modal-body">
				<span class="msg"><span> We shall reach you within 24 hrs <br/></span>
                <br/>
                            <div class="errormsg"></div>

                </span><br>
				<div class="input-group input-modal foot">
					<span class="input-group-addon icon-user"></span>
					<input type="text" class="form-control" id="phone_number" name="mobile" placeholder="Your Number" value="<?php echo $_SESSION['your_project']['phone'];?>"> 
				</div><br>
                <div class="button">
				<button type="button" name="proceed" class="btn btn-success">Proceed</button>
<!--<button type="button"  class="btn btn-success" data-dismiss="modal">
<span aria-hidden="true">OK</span>-->
				</button>                </div>
				
			</div>
		</div>
	</div>
</div>



<!-- ---------------------Main ------------------------------- -->
<div class="alert-success " style="margin-top:5px;background-color:#fff;color:red;position:relative;left:60px;font-size:10pt;"> Click on the checkbox to choose your functional requirement or &nbsp;<a href="#" data-toggle="modal" data-target="#contactModal" style="color:blue;">&nbsp;Click Here &nbsp;</a> to proceed telephonically </div>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" style="background-color:#fff;">
<div id="main" style="overflow:hidden;overflow-x:hidden;margin-left:40px;margin-top:15px;height:550px;">
<?php while($fetch_cat = mysql_fetch_assoc($exec_cat)){?>
	<div class="tile tile_bg " style="width:130px;" >
			<img src="pics/<?php if($fetch_cat['category_image'] <> ''){ echo $fetch_cat['category_image'];}else{ echo 'no_img.jpg';}?>" height="110px" width="130px"  class="parentimage" class="tile_text">			
			<span > <center> <?php echo $fetch_cat['category_name'];?> </center></span>
			<span> <center> <input type="checkbox" name="cn" onClick="check_cat(<?php echo $fetch_cat['id'];?>)"> </center></span>
	</div>
 <?php }?>

</div>	
	
<input type="hidden" id="cat" name="cat" value="">	
	
	
	
	<br><br>
<input type="submit" name="submit" value="Proceed" class="front-button " style="border:none;height:50px;position:relative;left:1040px; bottom:300px;">	
	<!--<a class="front-button col-sm-2 col-sm-offset-5" href="#" style="text-align:center;text-decoration:none;margin-top:7px;height:auto;">
		Choose Design Type
	</a>-->
    
    


</form><br><br>
<!-- ---------------------Footer ------------------------------- -->
<?php include "include/footer.php";?>

</body>
</html>