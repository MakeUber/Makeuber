<?php
include('init.php');
include('config_db.php');
include('config.php');


$dvar['category']= $_GET['category'];

 
?>
<!DOCTYPE html>
<html>
<head>

<title>
<?php echo $site_name;?>
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset = "UTF-8">
<meta name="title" content=" We Help You Make Your Dream Home | MakeUber">
<meta name="description" content=" MakeUber helps you find and select the best interior designers, architects, custom furniture sellers and other experts for all your home interior and design needs. Browse photos, chat withus and get professional advice.">

<link rel ="stylesheet" href="./css/bootstrap.min.css">
<link rel ="stylesheet" href="./css/Style.css">

<script src = "./js/jquery.js" type="text/javascript"></script>
<script src = "./js/jquery-ui.min.js" type="text/javascript"></script>
<script src ="./js/bootstrap.min.js" type="text/javascript"></script>
<script src = "./js/jquery.lazy.min.js" type="text/javascript"></script>
<script type="text/javascript" src="./js/expert.js"></script>
<script type="text/javascript" src="./js/jsfunction.js"></script>
<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>
	<link rel="shortcut icon" href="./favicon.ico">
		<link href='http://fonts.googleapis.com/css?family=Raleway:400,800,300' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="./css/zoedesign.css" />
		<link rel="stylesheet" type="text/css" href="./css/zoedesign2.css" />
		<link rel="stylesheet" type="text/css" href="./css/zoedesign3.css" />
		

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
			$(location).attr('href','user_profile.php' ); 
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
    function archive_fun() {

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
	$(document).ready(function(){
		
		$('.photo-modal').data('show','false');
		$('.photo-wrap').click(function(e){
			e.preventDefault();
			var id = $(this).attr("id");
			//alert(id);
			$('body').append('<div class="blur"></div>');
			$('#photo-modal'+id).fadeIn();
			$('#photo-modal'+id).data('show','true');
		});
	
		$('.close').click(function(e){
			e.preventDefault();
			$('.photo-modal').fadeOut();
			$('.blur').remove();
			$('#photo-modal'+id).data('show','false');
		});
		
		
		
	});
	function sel_city1(){
	 var city = $('.city').val();
	//alert(city); 
  $.ajax({
   type: "GET",
   data: "",
   url: "ajax.php?do=sel_city&city="+city,
      success: function(rep)
    {
  //alert(rep);
  var response_array = rep.split('|::|');
  if(response_array[0] == 'Error')
  {
   //alert(response_array[0]);
   //$("span#review_error").html(response_array[1]);
   // $("span#review_error").fadeOut(5000);
  }

  if(response_array[0] == 'Success')
  {
   //alert(response_array[1]);
   //$("span#review_error").html(response_array[1]);
    //$("span#review_error").fadeOut(5000);
    //setTimeout("location.reload(true);",2000);
	$('.area').html('');
	$('.area').append(response_array[1]);
	setTimeout($("#frm").submit(),5000);
	//$("#frm").submit();
  }
 }
  });
  return false;
 }
 
 $(document).on('click','.readmore',function(){
		var id=$(this).data('id');
		$('#expert').val(id);
	});

</script>
	<?php
					 //select  categories 2 = Interior Designer
					$categ="select * from main_cat where (id = 2 ); ";
					$cat2=mysql_query($categ);
					while ($cat_row2 = mysql_fetch_assoc($cat2)) { 
					$count_user="select * from user where (category='".$cat_row2['id']."' or category1='".$cat_row2['id']."')  and status='1'";
					$exec_user = mysql_query($count_user);
					$InteriorDesigner_user = mysql_num_rows($exec_user); } 
	?>
		<?php
					 //select  categories 1 = Architect
					$categ="select * from main_cat where (id = 1 ); ";
					$cat2=mysql_query($categ);
					while ($cat_row2 = mysql_fetch_assoc($cat2)) { 
					$count_user="select * from user where (category='".$cat_row2['id']."' or category1='".$cat_row2['id']."')  and status='1'";
					$exec_user = mysql_query($count_user);
					$Architect_user = mysql_num_rows($exec_user); } 
	?>
<?php
					 //select  categories 11 = Flooring
					$categ="select * from main_cat where (id = 11 ); ";
					$cat2=mysql_query($categ);
					while ($cat_row2 = mysql_fetch_assoc($cat2)) { 
					$count_user="select * from user where (category='".$cat_row2['id']."' or category1='".$cat_row2['id']."')  and status='1'";
					$exec_user = mysql_query($count_user);
					$Flooring_user = mysql_num_rows($exec_user); } 
	?>
<?php
					 //select  categories 4 = Tiles and Stones
					$categ="select * from main_cat where (id = 4 ); ";
					$cat2=mysql_query($categ);
					while ($cat_row2 = mysql_fetch_assoc($cat2)) { 
					$count_user="select * from user where (category='".$cat_row2['id']."' or category1='".$cat_row2['id']."')  and status='1'";
					$exec_user = mysql_query($count_user);
					$TaS_user = mysql_num_rows($exec_user); } 
	?>
<?php
					 //select  categories 12 = Curtains and Blinds
					$categ="select * from main_cat where (id = 12 ); ";
					$cat2=mysql_query($categ);
					while ($cat_row2 = mysql_fetch_assoc($cat2)) { 
					$count_user="select * from user where (category='".$cat_row2['id']."' or category1='".$cat_row2['id']."')  and status='1'";
					$exec_user = mysql_query($count_user);
					$CaB_user = mysql_num_rows($exec_user); } 
	?>
<?php
					 //select  categories 8 = outdoor and gardens
					$categ="select * from main_cat where (id = 8 ); ";
					$cat2=mysql_query($categ);
					while ($cat_row2 = mysql_fetch_assoc($cat2)) { 
					$count_user="select * from user where (category='".$cat_row2['id']."' or category1='".$cat_row2['id']."')  and status='1'";
					$exec_user = mysql_query($count_user);
					$OaG_user = mysql_num_rows($exec_user); } 
	?>
<?php
					 //select  categories 6 = wallpapers 
					$categ="select * from main_cat where (id = 6 ); ";
					$cat2=mysql_query($categ);
					while ($cat_row2 = mysql_fetch_assoc($cat2)) { 
					$count_user="select * from user where (category='".$cat_row2['id']."' or category1='".$cat_row2['id']."')  and status='1'";
					$exec_user = mysql_query($count_user);
					$Wallpaper_user = mysql_num_rows($exec_user); } 
	?>
<?php
					 //select  categories 7 = Customized furniture 					 
					$categ="select * from main_cat where (id = 7 ); ";
					$cat2=mysql_query($categ);
					while ($cat_row2 = mysql_fetch_assoc($cat2)) { 
					$count_user="select * from user where (category='".$cat_row2['id']."' or category1='".$cat_row2['id']."')  and status='1'";
					$exec_user = mysql_query($count_user);
					$CF_user = mysql_num_rows($exec_user); } 
	?>
<?php
					 //select  categories 10 = Interior furnishings 					 
					$categ="select * from main_cat where (id = 10 ); ";
					$cat2=mysql_query($categ);
					while ($cat_row2 = mysql_fetch_assoc($cat2)) { 
					$count_user="select * from user where (category='".$cat_row2['id']."' or category1='".$cat_row2['id']."')  and status='1'";
					$exec_user = mysql_query($count_user);
					$IF_user = mysql_num_rows($exec_user); } 
	?>
<?php
					 //select  categories 14 = Home decor 					 
					$categ="select * from main_cat where (id = 14 ); ";
					$cat2=mysql_query($categ);
					while ($cat_row2 = mysql_fetch_assoc($cat2)) { 
					$count_user="select * from user where (category='".$cat_row2['id']."' or category1='".$cat_row2['id']."')  and status='1'";
					$exec_user = mysql_query($count_user);
					$HD_user = mysql_num_rows($exec_user); } 
	?>
	
	
	
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="//v2.zopim.com/?35HWLYHjHRZIffiJOElwqt2kf7zJhOHX";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
<style> 
a { color :white; text-decoration:none; } 
a:hover { color:white; text-decoration:none; } 


</style>
</head>
<body style="font-family:'Ubuntu',sans-serif;font-size:15px;">

	<?php include "./include/header.php" ?>
		<!--.........................HEADER ENDS.........................-->

		
				<div class="container">
			<!-- Top Navigation -->
			<div class="content">
				<div class="grid">
					
					<figure class="effect-zoe">
					<a href="startproj.php">
						<img src="./img/bidengine.jpg" alt="Bidengine"/>
						<figcaption>
							<p class="icon-links" >
								<span>bid engine </span>
							</p>
						</figcaption>	
					</a>
					</figure>
						<figure class="effect-zoe">
						<a href="project.php">
						<img src="./img/viewprojects.jpg" alt="viewproject"/>
						<figcaption>
							<p class="icon-links">
								<span> View Projects </span>
							</p>
						</figcaption>
						</a> 
					</figure>
					<figure class="effect-zoe">
					<a href="expert.php?cat=2">
						<img src="./img/interiordesigner.jpg" alt="InteriorDesigner"/>
						<figcaption>
							<p class="icon-links">
								<span>  We have found <?php echo $InteriorDesigner_user;?> experts </span>
							</p>
						</figcaption>	
						</a>						
					</figure>
				
				<figure class="effect-zoe">
						<a href="expert.php?cat=1">
						<img src="./img/architect.jpg" alt="Architect"/>
						<figcaption>
							<p class="icon-links">
								<span> we have found <?php echo $Architect_user;?> experts</span>
							</p>
						</figcaption>	
							</a>						
					</figure>
					<figure class="effect-zoe">
						<img src="./img/deals.jpg" alt="Deals"/>
						<figcaption>
							<p class="icon-links">
								<span>  coming soon  </span>
							</p>
						</figcaption>			
					</figure>
					<figure class="effect-zoe">
					<a href="expert.php?cat=7">
						<img src="./img/customfurniture.jpg" alt="CustomizedFurniture"/>
						<figcaption>
							<p class="icon-links">
									<span> We have found <?php echo $CF_user;?> experts </span> 
							</p>
						</figcaption>		
					</a> 
					</figure>
					<figure class="effect-zoe">
						<a href="expert.php?cat=11">
						<img src="./img/flooring.jpg" alt="flooring"/>
						<figcaption>
							<p class="icon-links">
									<span> we have found <?php echo $Flooring_user;?> experts </span>
							</p>
						</figcaption>			
						</a> 
					</figure>
					<figure class="effect-zoe">
						<img src="./img/advice.jpg" alt="AskUs"/>
						<a href="tmpAsk.php"> 
						<figcaption>
							<p class="icon-links">
								<span>  Ask us  </span>
							</p>
						</figcaption>	
						</a> 
					</figure>
					<figure class="effect-zoe">
						<a href="expert.php?cat=4">
						<img src="./img/stonestiles.jpg" alt="Stones & Tiles"/>
						<figcaption>
							<p class="icon-links">
								<span> We have found <?php echo $TaS_user;?> experts </span>
							</p>
						</figcaption>
							</a>
					</figure>
					<figure class="effect-zoe">
					<a href="expert.php?cat=12"> 
						<img src="./img/curtains.jpg" alt="Curtains&Blinds"/>
						<figcaption>
							<p class="icon-links">
									<span> We have found <?php echo $CaB_user;?> experts </span>
							</p>
						</figcaption>			
						</a>
					</figure>
					<figure class="effect-zoe">
					<a href="expert.php?cat=8">
						<img src="./img/outdoor.jpg" alt="Outdoor and Gardens"/>
						<figcaption>
							<p class="icon-links">
								<span> We have found <?php echo $OaG_user;?> experts </span>
							</p>
						</figcaption>	
						</a>						
					</figure>
					<figure class="effect-zoe">
					   <a href="expert.php?cat=6"> 
						<img src="./img/wallpaer.jpg" alt="Wallpapers"/>
						<figcaption>
							<p class="icon-links">
									<span> We have found <?php echo $Wallpaper_user;?> experts </span>
							</p>
						</figcaption>			
						</a>
					</figure>
						<figure class="effect-zoe">
						<a href="expert.php?cat=10"> 
						<img src="./img/furnishings.jpg" alt="Interior Furnishing"/>
						<figcaption>
							<p class="icon-links">
								<span>  We have found <?php echo $IF_user;?> experts </span>
							</p>
						</figcaption>			
						</a> 
					</figure>
						
						<figure class="effect-zoe">
						<a href="expert.php?cat=14"> 
						<img src="./img/homedecor.jpg" alt="Decor"/>
						<figcaption>
							<p class="icon-links">
								<span>  We have found <?php echo $HD_user;?> experts </span> 
							</p>
						</figcaption>	
						</a> 
						</figure>
						<figure class="effect-zoe">
						<img src="img/material.jpg" alt="Materials"/>
						<figcaption>
							<p class="icon-links">
								<span>  coming soon </a> 
							</p>
						</figcaption>			
						</figure>
						<figure class="effect-zoe">
						<img src="img/landscape.jpg" alt="Landscape"/>
						<figcaption>
							<p class="icon-links">
								<span>  coming soon </a> 
							</p>
						</figcaption>			
						</figure>
			
					
	
				</div> <!--Grid--> 
			  
			</div> <!--Content--> 
		</div> <!-- /container -->
		
	
						<div id='container-1' class='ad-container' style="width:16%;position:relative;left:1100px;bottom:870px;"></div>
					<div id='container-2' class='ad-container'  style="width:16%;position:relative;left:1100px;bottom:820px;"></div>
	
					<script type="text/javascript">
						//REQUIRED
					var program = '5581508d560428110089d896';
 
					//REQUIRED (Select all the dom elements where you would like to inject your ads)
					var elements = document.getElementsByClassName('ad-container');
 
					//OPTIONAL
					var keywords = ['timber', 'wood', 'logs', 'tree'];
 
					ma('ad', program, elements);
					</script>
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

<?php include "./include/footer.php"?>
 <p id="requirements" title="Sorry" style="display:none;font-family:Helvetica Neue,Helvetica,Arial,sans-serif !important;">please fill in details about your project</p>

</body>
</html>