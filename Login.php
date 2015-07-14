<?php
require_once("init.php");
require_once("config_db.php");
require_once("config.php"); ?>
<!DOCTYPE HTML>
<html>
	<head>
		<title> 
			 MakeUber | Hire Interior Designers, Architects for Design, Decorating &amp; Remodeling Ideas 
		</title> 
		<!..Bootstrap Intialization.. >
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="/Muber\css/custom.css">

			<!-- Optional theme -->
			
			
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	
			<link rel="stylesheet" type="text/css" href="css/menu.css">
			<link rel="stylesheet" type="text/css" href="css/Style.css">
			
			
			<link rel="stylesheet" type="text/css" href="css/demo.css" />
			<link rel="stylesheet" type="text/css" href="css/style1.css" />
			<link rel="stylesheet" type="text/css" href="css/jquery.jscrollpane.css" media="all" />
	
			<script type="text/javascript" src="js/jquery.js"></script>
			<script src = "js/jsfunction.js" type="text/javascript"></script>
			
			
			<!..Change.. >


<script src ="js/bootstrap.min.js" type="text/javascript"></script>

	
	<style>
	html, body 
	{
		max-width: 100%;
		overflow-x:hidden;
	}
	#searchBelowLinks
	{
		background-color: #000;
		filter: alpha(opacity=80)\9;
		width: 100%;
		height: 95px;
		position:relative;
		bottom: 0px;
	}

	.searchBelowLinksList
	{
		width:900px;margin:auto;

	}
	.searchBelowLinksList .searchBelow2 
	{
		top no-repeat;
		text-decoration:none;
		color:#fff;
		display:block;
		float:left;
		height:80px;
		padding-left:32px;
		color:#fff;
		background:url(images/searchLinkSep.png) right top no-repeat;
		
	}
	.searchBelowLinksList .searchBelow3
	{
		top no-repeat;
		text-decoration:none;
		color:#fff;
		display:block;
		float:left;
		height:80px;
		padding-left:32px;
		color:#fff;
		background:url(images/searchLinkSep.png) left top no-repeat;
		
	}
	
	.searchBelowLinksList span
	{
		font-size:16px;
		color:#d9d9d9;
		display:block;
				
	}

	.searchBelowLinksList .searchBelow2
	{
		width:332px;
		position:absolute;
		left:80px;
	}
	.searchBelowLinksList .searchBelow3
	{
		width:332px;
		position:absolute;
		left:950px;
	}

	#homeSearchContainer .searchBelowLinksList .searchBelow4
	{
		width:185px;
	}
	#homeSearchContainer .searchBelowLinksList .searchBelow1
	{
		padding-left:15px;
	}
	#homeSearchContainer .searchBelowLinksList a.searchBelow4 .bgSep
	{
		background-image:none;
		
	}
	p.bgSep img
	{ 
	position : relative; 
	bottom :-5px; 
	left: 80px; 
	}
	p.bgSep span 
	{
		position : relative ; 
		bottom :-18px; 
		left: 0px; 
	}



	
	</style>
	<?php
	$sql_stories = "select * from home_stories where status='1'";
	$exec_stories = mysql_query($sql_stories);
?>
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

	</head>
	<body >
	<!..body section  I.. >  
	<!.........................HEADER PART  ....................... >

				<div class="container-fluid" style="background-color:black;font-size:12pt;">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#"><img src="\Muber\img/FinalLogo.png"> </a>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-right">
							<li><a href="toolgrid.php"> tool grid <span class="sr-only"></span></a></li>
							<?php if ( $user_status == true ) 
							{?>
								<li><a href="startproj.php">quick quote</a></li>
							<?php } else { ?> <li><a href="#" data-toggle="modal" data-target="#loginModal" >quick quote</a></li> <?php 
							
							} ?>
							<li><a href="blog_front.php">blog<span class="sr-only"></span></a></li>
							<li><a href="aboutus.php">about us<span class="sr-only"></span></a></li>
							<li><a href="contactus.php">contact us<span class="sr-only"></span></a></li>
							<?php if($user_status <> 0){?>
				<span style="font-size: 14px;margin-top: 16px;margin-left: 3px;float: left;">
              <span class="icon-user" style="color:white;"></span>
              <?php if($fetch_user['type'] == '0'){?>
                <a href="user_profile.php"><?php echo $fetch_user['first_name'];?></a>
            <?php }else{?>
                <a href="designer_profile"><?php echo $fetch_user['first_name'];?></a>
            <?php }?>
            </span></a></li>
              <li><a style="float:left;" href="logout.php">Logout</a>
              
              </li>
              
              <?php }else{?>
              <li><a href="#" data-toggle="modal" data-target="#loginModal">login</a></li>
              <?php }?>						
			 
				</ul>
					</div>
					<!-- /.navbar-collapse -->
				</div>
				<!-- /.container-fluid -->
		
		<!.........................HEADER ENDS ................................> 

	
	<!.. .......................................SECTION VI : FOOTER................................................. ..  > 
	<div id="footer" class="row">
	<div class="col-sm-3" style="font-size:25pt;padding:20px;">
		<h6 style="color:white;"> Follow us on Social Media </h6>
		<a href="https://twitter.com/makeuber">
		<img title="Twitter" src="images/twit.png" alt="Twitter" width="25" height="25" />
		</a>
		<a href="[full link to your Pinterest]">
		<img title="Pinterest" src="images/pin.png" alt="Pinterest" width="25" height="25" />
		</a> 
		<a href="https://www.facebook.com/MakeUber">
		<img title="Facebook" src="images/facebook.png" alt="Facebook" width="25" height="25" />
		</a>
		<a href="https://plus.google.com/+MakeUber"><img title="google" src="images/google.png" alt="RSS" width="25" height="25" />
		</a>
				<a href="https://www.linkedin.com/company/makeuber"><img title="google" src="images/in.png" alt="RSS" width="25" height="25" />
		</a>
		</div>
	<div class="col-sm-6" style="text-align:center;color:white;">
		<span style="font-size:13px;font-family: 'Yanone Kaffeesatz', sans-serif;">Choose Your Expert II Take Inspirations II Ask for Advice II Talk to fellow Home Owners II 
		<br>Make Your Spaces the your Way</span>
	</div>
	<div class="col-sm-3" style="font-size:13px;color:white;">
		<p><strong>Contact Us @</strong><br>
		<span class="glyphicon glyphicon-envelope"> reachus@makeuber.com</span>&nbsp;&nbsp;<br>
		<span class="glyphicon glyphicon-earphone"> (91) 9900071655</span></p>
	</div>
	<div class="col-sm-12">
		<hr style="border:1px solid #111;margin-bottom:10px;">
	</div>
	<div class="col-sm-10">
		<ul class="footer-menu" style="font-size:13px;">
			<li class="active"><a href="Index.php">home</a></li>
			<li><a href="howitworks.html">How It Works</a></li>
			<li><a href="#">Experts</a></li>
			<li><a href="ask.html">Ask</a></li>
			<li><a href="blog.html">Blog</a></li>
			<li><a href="register.html"> Login Modal </a></li>
			<li><a href="#">About us</a></li>
		</ul>
	</div>
	<div class="col-sm-2">
		<strong style="color:white;font-size:13px;">&copy; 2014 | <a href="#">Privacy Policy</a></strong>
	</div>
</div>
<!.....................................END OF FOOOTER..................................>
<!....Modal ..  .>

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
          <li><a role="tab" onclick="usertype(1)" data-toggle="tab" style="color:black">Experts</a></li>
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
              Or connect with <br>
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
                </a> <a href="ex_google_login.php?type=1&path=<?php echo full_url();?>&id=<?php echo $_GET['id'];?>">
                <button type="button" class="btn btn-primary"><i class="fa fa-google"></i> Google</button>
                </a> </div>
            </div>
          </form>
          <div class="tab-pane fade"></div>
        </div>
      </div>
      <div class="modal-footer">
				<span class="pull-left">Don't have an account? <a href="register.php" style="color:blue">Sign up</a> now!</span>
			</div>
    </div>
  </div>
</div>


          <p id="requirements" title="Sorry" style="display:none;font-family:Helvetica Neue,Helvetica,Arial,sans-serif !important;">please fill in details about your project</p>


	<!-- Latest compiled and minified JavaScript -->
	
	<script src="C:\wamp\www\Muber\js\jquery-2.1.4.min.js"> </script> 
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	</body> 
</html> 