<?php 
require_once("init.php");
require_once("config_db.php");
require_once("config.php");
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
		$to = "reachus@makeuber.com";
		$subject = "Enquiry Form";
		$from = "decore@gmail.com";
		$message = "Hello Admin you got a mail \n\n";
		$message .= "Name: ".$name."\n\n";
		$message .= "Mobile: ".$mobile."\n\n";
		$message .= "Email: ".$email."\n\n";
		$message .= "Message: ".$messag;
	
		
		if(mail($to,$subject,$message,$from)){
			
			$flag['g'] = 1;		
			
		}
		
		else {
			
			$flag['e'] = 'r';
			
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
	<link rel ="stylesheet" href="css/bootstrap.min.css">
	
	
    <?php include("include/header.php"); ?>
     <?php if($flag['g'] <> ''){
?>
<meta http-equiv="refresh" content="3; URL=<?php echo $this_parent;?>">
<?php } ?>
			
</head>

<body>
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
   var expert = $('#expert').val();
  // alert(response_array[2]);
  // break;
  	 if(data=='share'){
		    $(location).attr('href','index.php');
			
	   }
	   else if(expert !=''){
		    $(location).attr('href','expert_portfolio.php?id='+expert);
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
			$(location).attr('href',window.location.href); 
			//salert($('#budget').val());
			//if($('#budget').val() != '' || $('#budget').val() !== undefined){
				//alert("hi");
				//$("#projectform").submit();
			//}else{
				//alert("bye");
				//alert(window.location.reload());
				$(location).attr('href',window.location.href); 
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


<!-- --------------------- FAKE HEADER --------------------------- -->
<img src="img/contact.jpg"> 

<!-- ---------------------MODAL ------------------------------- -->

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span> </button>
        <div class="modal-title">
          <h2>Login</h2>
        </div>
      </div>
      <div class="modal-body">
        <ul class="nav nav-tabs" role="tablist">
          <li class="active"><a href="#" onclick="usertype(0)" role="tab" data-toggle="tab">Users</a></li>
          <li><a role="tab" onclick="usertype(1)" data-toggle="tab">Experts</a></li>
        </ul>
        <br>
        <div class="tab-content">
          <form id="loginform" name="login">
          <input type="hidden" id="sharetxt" name="share" value="" />
          <input type="hidden" id="expert" name="expert" value="" />
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
              <button type="button" onclick="login1()" class="btn btn-success">Sign In</button>
              &nbsp;&nbsp;&nbsp;
              Or connect with <br>
              <br>
              <div id="usersocial"> <a href="fb_login.php?type=0&do=<?php echo $_GET['do'];?>&id=<?php echo $_GET['id'];?>">
                <button type="button" class="btn btn-primary"><i class="fa fa-facebook"></i> Facebook</button>
                </a> <a href="google_login.php?type=0&do=<?php echo $_GET['do'];?>&id=<?php echo $_GET['id'];?>">
                <button type="button" class="btn btn-primary"><i class="fa fa-google"></i> Google</button>
                </a> <a href="twitter_login.php?type=0&do=<?php echo $_GET['do'];?>&id=<?php echo $_GET['id'];?>">
                <button type="button" class="btn btn-primary"><i class="fa fa-twitter"></i> Twitter</button>
                </a> </div>
              <div id="expertsocial" style="display:none"> <a href="fb_login.php?type=1&do=<?php echo $_GET['do'];?>&id=<?php echo $_GET['id'];?>">
                <button type="button" class="btn btn-primary"><i class="fa fa-facebook"></i> Facebook</button>
                </a> <a href="ex_google_login.php?type=1&do=<?php echo $_GET['do'];?>&id=<?php echo $_GET['id'];?>">
                <button type="button" class="btn btn-primary"><i class="fa fa-google"></i> Google</button>
                </a> </div>
            </div>
          </form>
          <div class="tab-pane fade"></div>
        </div>
      </div>
      <div class="modal-footer">
				<span class="pull-left">Don't have an account? <a href="register">Sign up</a> now!</span>
			</div>
    </div>
  </div>
</div>


          <p id="requirements" title="Sorry" style="display:none;font-family:Helvetica Neue,Helvetica,Arial,sans-serif !important;">please fill in details about your project</p>

<div id="content" class="bot-1"> 
  <div class="container">
     
    <div class="row">
        <div class="col-sm-4 col-md-4 col-lg-4">
       
          <!--<h3>Addresses</h3>-->
          <address class="address">
            <p>

A-112, Manar Manha ,<br/>
Somsunderpallya Main Road, Kudlu Gate,<br/> Bangalore-560068 </p>
            
            <span>Telephone:</span>+(91) 9900071655<br>
            E-mail: <a href="#" >reachus@makeuber.com</a></p>
           
          </address>
      </div>
      <div class="col-sm-8 col-md-8 col-lg-8">
          <h3>Contact Us</h3>
          <h3><?php echo print_messages($flag, $error_message, $success_message);?></h3>
          <form class="contact-form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
           
            <fieldset>
              <div class="coll-1">
                <label class="name">
                  <input type="text"  placeholder="Name*" name="name" value="<?php echo $name; ?>"><br>
                   </label>
              </div>
              <div class="coll-2">
                <label class="email">
                  <input type="email" placeholder="Email*" name="email" value="<?php echo $email; ?>"><br>
                   </label>
              </div>
              <div class="coll-3">
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
              <div class="buttons-wrapper" style="margin-top:10px;"><input style="margin-top: 10px;" type="submit" class="btn" data-type="submit" name="submit" value="Submit Comment"></div>
            </fieldset>
          </form>
      </div>    
    </div>   
  </div>
</div>
<br/><br/>
<?php include "include/footer.php"; ?></body>
</html>