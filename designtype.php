<?php 
include "init.php";
include "config_db.php";
include "config.php";
//print_r($_SESSION);
$tabl = 'project';

$sql_cat="select * from category where status='1'";
$exec_cat = mysql_query($sql_cat);

$projet = random_generator(10);
if ( $_POST['submitbut'] ) 
{	

		$dvar['project_id'] = $_POST['project'];
		$dvar['description'] = $_POST['description'];
		$dvar['user_id']  = $user_uniq;
		$dvar['price'] = $_POST['budget'];
		$dvar['floor_plan	'] = $_POST['floor_plan'];
		$dvar['phone'] = $_POST['phone'] ; 
		$dvar  ['email' ] = $_POST ['email'] ;
		$dvar['city'] = $_SESSION ['city'];
		$dvar['area'] = $_SESSION['area'];
		$dvar ['apartment'] = $_SESSION ['type'];  
		
		/* Configurations made by suresh are down i wonder if he saw the init file as i guess the file init is included in each file and would be using email sending firm there */
 error_reporting(E_ALL);
// echo 'hih';exit;
    //require 'PHPMailer_5.2.4/PHPMailer.php';
//	require("PHPMailer_5.2.4/class.smtp.php");
require("include/PHPMailer_5.2.4/class.pop3.php");
require("include/PHPMailer_5.2.4/class.phpmailer.php");

   //echo 'hih';exit;
    ini_set('display_errors', '1');

  //  $name = $_POST["name"];
  //  $email = $_POST["email"];
  //  $subject = $_POST["subject"];
  //  $message = $_POST["message"];

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
    
/* PLease help me configure the same code in one place where i understand how thsi works like */

  
 	$mail->AddAddress($to) ;  
    $mail->IsHTML(true);	
	$mail->Subject = 'Successfully submitted your requirement'; 
	$mail->Body ='Hi, 
				You have successfully submitted a requirement. We shall get back to your 
				in 24 hours.
				Your Requirements ' ; 
		   
//echo 'hihi';exit;
try{
    if(!$mail->Send())
    {
      // echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
    else
   {
        //echo 'success';
   }
	//$mail->Send();
	} 
	catch (phpmailerException $e) { 
  echo $e->errorMessage(); //error messages from PHPMailer
} 
/*catch (Exception $e) {
  echo $e->getMessage();
}*/
				
		$post_data = array(
    // 'From' doesn't matter; For transactional, this will be replaced with your SenderId;
    // For promotional, this will be ignored by the SMS gateway
    'From'   => '08039591930',
    'To'    =>  $_POST['phone'] ,
    'Body'  => 'Hi,Welcome to MakeUber. Reach us @ 08039591930. Cheers,
				www.makeuber.com'
				, //Incase you are wondering who Dr. Rajasekhar is http://en.wikipedia.org/wiki/Dr._Rajasekhar_(actor)
);
 
$exotel_sid = "makeuber"; // Your Exotel SID - Get it from here: http://my.exotel.in/Exotel/settings/site#api-settings
$exotel_token = "dd2df39a9eec2f44616ba496909e6d67ae0e929b"; // Your exotel token - Get it from here: http://my.exotel.in/Exotel/settings/site#api-settings
 
$url = "https://".$exotel_sid.":".$exotel_token."@twilix.exotel.in/v1/Accounts/".$exotel_sid."/Sms/send";
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FAILONERROR, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
 
$http_result = curl_exec($ch);
$error = curl_error($ch);
$http_code = curl_getinfo($ch ,CURLINFO_HTTP_CODE);
 
curl_close($ch);
 
print "Response = ".print_r($http_result);
	
		
		if($dvar['description'] == ''){
		$flag[31] = 'r';
		}
		else{
			$allowed_ext = array("gif","jpg","jpeg","png","GIF","JPG","JPEG","PNG");
			$file_field = 'floor_plan';
			
			$do = $_GET['do'];
			if($do == 'edit'){
				$validate = validate_file($file_field, $allowed_ext, '0', '0');
			}
			else{
				$validate = validate_file($file_field, $allowed_ext, '0', '0');
			}
			if($validate[0] <> '1'){
			$flag['file'] = $validate[0];
				}
				else if($validate[1] <> ''){
					$file = '1';
					$ext = $validate[2];
				}
				if(!empty($flag)){
					$flag_r = 'r';
				}
				else{
				if($file == '1'){
					$rand1 = random_generator(10);
					$image_name = $rand1.'.'.$ext;
					$path = "img/".$image_name;
				}
				$uniq = random_generator(10);
			$add_dvar = array( 'floor_plan' => $image_name, 'status' => '1', 'time' => time());
			
			$remove_dvar = array('image_delete','image_delete2');
//			$change_dvar = array('status' => '1');

			list($insert_q[0], $insert_q[1]) = insert_query($dvar, $add_dvar, $remove_dvar, $change_dvar);
			
			$sql_gal = "INSERT into $tabl(sort, $insert_q[0]) SELECT max(sort)+1, $insert_q[1] from $tabl";
			$fg = 'ad';
			
			if(mysql_query($sql_gal)){
			if($file == '1'){
				//echo "hi";di;
				  copy($_FILES[$file_field][tmp_name], $path);     //  upload the file to the server
    			  chmod("$path",0777);                 // set permission to the file.                // set permission to the file.
				 $thumb = 'img/'.$image_name;
       			 $ext = pathinfo($thumb, PATHINFO_EXTENSION);
				$max_width=800; // Fix the width of the thumb nail images
				$max_height=500; // Fix the height of the thumb nail image
							$extn = $ext;	$final = $thumb;	$res = '0';
				include("include/image_resize.php");
			}
			unset($_SESSION['your_project']);
			header("location:user_project.php");
			}else{
				echo mysql_error();	
			}
				
				}
		
	
		}
		
	
	
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="icon" type="img/Final_Logo.png" href="./img/Final_Logo">
<title>
	<?php echo $site_name;?>
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset = "UTF-8">
<link rel="stylesheet" href="./css/custom.css">
<link rel ="stylesheet" href="./css/Style.css">
<link rel ="stylesheet" href="./cssp/font-awesome.min.css">
<link rel="stylesheet" href="./css/uploadfile.css">
<script src = "./js/jquery.js" type="text/javascript"></script>
<script src ="./js/bootstrap.min.js" type="text/javascript"></script>
<script src = "./js/jquery.lazy.min.js" type="text/javascript"></script>
<script src="./js/jsfunction.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="./js/jquery.uploadfile.min.js"></script>

<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>
<script> 
function check_validation()
{
	//alert("hi");
	if($('#aprtment').val() == ''){ $('#errorModal').modal('show'); return false;}
	else if($('#email').val() == '0'){ $('#errorModal').modal('show'); return false;}
	else if($('#phone').val() == '0'){ $('#errorModal').modal('show'); return false;}
	else if($('#expert').val() == '0'){ $('#errorModal').modal('show'); return false;}
	else if($('#city').val() == '0'){ $('#errorModal').modal('show'); return false;}
	else if($('#area').val() == '0'){ $('#errorModal').modal('show'); return false;}
	//else if($('#expertname').val() == '0'){ alert("please fill in details about your project"); return false;}
	else if($('#budget').val() == ''){ $('#errorModal').modal('show'); return false;}
	return true;
}


</script>
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="//v2.zopim.com/?35HWLYHjHRZIffiJOElwqt2kf7zJhOHX";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
<style type="text/css">
	a.list-group-item.active,a.list-group-item.active:focus,a.list-group-item.active:hover{
		color: #fff;
		background-color: rgb(255,105,97);
		border-color: rgb(255,105,97);
	}
	
	.fileUpload {
	position: relative;
	overflow: hidden;
	margin: 10px;
}
.fileUpload input.upload {
	position: absolute;
	top: 0;
	right: 0;
	margin: 0;
	padding: 0;
	font-size: 20px;
	cursor: pointer;
	opacity: 0;
	filter: alpha(opacity=0);
}
@media only screen and (max-width: 768px){
.col-sm-3.list{
	width:320px;
}
#sublist{
	width:320px !important;
	text-align:center;
}
#item_choice{
	width:320px;
	margin-left:8% !important;
}
.front-button{
	margin-left:37% !important;
}
	
}

@media only screen and (max-width: 320px){
.col-sm-3.list{
	width:280px;
	margin-left:15px;
}
#sublist{
	width:280px !important;
	text-align:center;
}
#item_choice{
	width:280px;
	margin-left:12% !important;
}
.front-button{
	margin-left:29% !important;
}
	
}
@media only screen and (min-width: 480px) and  (max-width: 639px)  {
.col-sm-3.list{
	width:400px;
	margin-left:30px;
}
#sublist{
	width:400px !important;
	text-align:center;
}
#item_choice{
	width:440px;
	margin-left:7% !important;
}
.front-button{
	margin-left:35% !important;
}
	
}
@media only screen and (min-width: 640px) and  (max-width: 767px){
.col-sm-3.list{
	width:400px;
	margin-left:16%;
}
#sublist{
	width:400px !important;
	text-align:center;
}
#item_choice{
	width:440px;
	margin-left:17% !important;
}
.front-button{
	margin-left:35% !important;
}
	
}
@media only screen and (min-width: 768px) and (max-width: 1023px){
.col-sm-3.list{
	width:660px;
	margin-left:5%;
}
#sublist{
	width:660px !important;
	text-align:center;
}
#item_choice{
	width:660px;
	margin-left:8% !important;
}
.front-button{
	margin-left:37% !important;
}
.tile{
	cursor:pointer;
	background-color:#1E1E1E;
	box-shadow:0px 5px 0px #000; 
	color:#fff;
}

.footer-menu li a:hover{color:white; text-decoration:none;}
</style>
<script>
/*Works only with Chrome 
Inspired by Erik Deiner's concept :
http://dribbble.com/shots/435827-Concept-for-budget-price-slider
*/
  $('#range').on("change", function() {
    $('.output').val(this.value +",000  $" );
    }).trigger("change");
$(document).ready(function(){
  $('.tile_sm').click(function(){
	  var des = $(this).attr("data");
	  var des1 = $(this).attr("data1");
	//$('.tile_sm').removeClass("select_tile_sm");
    //$(this).addClass("select_tile_sm");
	//des.removeClass('select_tile_sm');
	if($(this).hasClass('select_tile_sm')){
		//alert("hi");
      //des.removeClass("select_tile_sm");
	    var project = $('#project').val();
	  var user_uniq = $('#user_uniq').val();
	  var design = $(this).attr("design");
	  var category = $(this).attr("category");
	  var material = $(this).attr("material");
	  var idinfo = $(this).attr("idinfo");
	  //$.ajax({
//   type: "GET",
//   data: "",
//   url: "ajax.php?do=delete_requirement&project="+project+"&user_uniq="+user_uniq+"&design="+design+"&category="+category+"&material="+material+"&id="+idinfo,
//      success: function(rep)
//    {
// 	//alert(rep);
//  var response_array = rep.split('|::|');
//  if(response_array[0] == 'Error')
//  {
//  //alert(response_array[2]);
//    $("#errormsg1").show();
//   $("#errormsg1").html(response_array[1]);
//   $("#errormsg1").fadeOut(2000);
//  }
//  if(response_array[0] == 'Success')
//  {
//    $("#errormsg1").show();
//   $("#errormsg1").html(response_array[1]);
//   $("#errormsg1").fadeOut(4000);
//
//  }
// }
//  });
//  return false;
    }else{
		//alert("hi");
	   $('.design'+des).removeClass('select_tile_sm');
       $(this).addClass("select_tile_sm");
	   
	    $('.material'+des1).removeClass('select_tile_sm');
       $(this).addClass("select_tile_sm");
	   
	   //alert($('#project').val());
	   //alert($('#user_uniq').val());
	   //alert($(this).attr("design"));
	   //alert($(this).attr("category"));
	  // alert($(this).attr("material"));
	  var project = $('#project').val();
	  var user_uniq = $('#user_uniq').val();
	  var design = $(this).attr("design");
	  var category = $(this).attr("category");
	  var material = $(this).attr("material");
  	  var idinfo = $(this).attr("idinfo");
	  //alert(category);

	  $.ajax({
   type: "GET",
   data: "",
   url: "ajax.php?do=add_requirement&project="+project+"&user_uniq="+user_uniq+"&design="+design+"&category="+category+"&material="+material+"&id="+idinfo,
      success: function(rep)
    {
  var response_array = rep.split('|::|');
  //alert(response_array[3]);
  $(".design"+category).attr("idinfo",response_array[3]);
  $(".material"+category).attr("idinfo",response_array[3]);
  if(response_array[0] == 'Error')
  {
  
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
  });
});

function assign(){
	//alert($('#feedbackform').serialize());
	//exit;
	//alert("hi");
	$.ajax({
   type: "POST",
   data: $('#feedbackform').serialize(),
   url: "ajax.php",
      success: function(rep)
    {
// alert(rep);
  var response_array = rep.split('|::|');
  if(response_array[0] == 'Error')
  {
  //alert(response_array[2]);
    $("#errormsgs").show();
   $("#errormsgs").html(response_array[1]);
   $("#errormsgs").fadeOut(2000);
  }
  if(response_array[0] == 'Success')
  {
    $("#errormsgs").show();
   $("#errormsgs").html(response_array[1]);
   $('.success1').html(response_array[2]);
   //$("#errormsg1").fadeOut(4000);
	window.location.href = "Index.php" ;

  }
	
 }
  });
  return false;
  

}

</script>
</head>
<body style="font-family:'Ubuntu',sans-serif;font-size:15px;margin:none;background-color:#fefefe;">


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

  }
 }
  });
  return false;
}
function submit_question(){
	//alert($('#questionform').serialize());
	//exit;
	$.ajax({
   type: "POST",
   data: $('#questionform').serialize(),
   url: "ajax.php",
      success: function(rep)
    {
 //alert(rep);
  var response_array = rep.split('|::|');
  if(response_array[0] == 'Error')
  {
  //alert(response_array[2]);
    $("#errormsgs").show();
   $("#errormsgs").html(response_array[1]);
   $("#errormsgs").fadeOut(2000);
  }
  if(response_array[0] == 'Success')
  {
    $("#errormsgs").show();
   $("#errormsgs").html(response_array[1]);
   $("#errormsgs").fadeOut(4000);
    $(location).attr('href','ask.php');

  }
 }
  });
  return false;
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
		<?php include "include/header.php" ?> 

<!-- ---------------------Main ------------------------------- -->

	<div id = "main" class="row" style="position:relative;left:30px;height:auto;background-color:#2B2D2E;" >
			<!--<a href="#" class="list-group-item active">Kitchen</a>
			<a href="#" class="list-group-item">Wardrobes</a>
			<a href="#" class="list-group-item">Dining Tables</a>
			<a href="#" class="list-group-item">Crockery Units</a>
			<a href="#" class="list-group-item">False Ceiling</a>
			<a href="#" class="list-group-item">Coffee Tables</a>
			<a href="#" class="list-group-item">Corner Tables</a>
			<a href="#" class="list-group-item">Dining Tables</a>
			<a href="#" class="list-group-item">Sofas</a>
			<a href="#" class="list-group-item">Bathrooms</a>
             -->
		
	<div class="col-md-6" style="margin-left:1.4%;color:#fff;position:relative;left:80px;">
		<h5 style="font-family:sans-serif"> click on the style you seek </h5> 
		<span class="glyphicon glyphicon-menu-down" style="position:relative;left:80px;">
	</div>  
	<div class="col-md-4" style="color:#fff;position:relative;left:80px;"> 
		<h5 style="sans-serif"> click on the material you seek </h5>  
		<span class="glyphicon glyphicon-menu-down" style="position:relative;left:80px;">
	</div>
	</div>
        
	<div class="col-sm-12" id="item_choice" style="margin-left:0%">
         <?php 
		foreach($_SESSION['your_project']['design'] as $key=>$val){
		 $sql_cate = "select * from category where id='$val'";	
		 $exec_cate = mysql_query($sql_cate);
		 $fetch_cate = mysql_fetch_assoc($exec_cate);
		?>
        <div class="panel panel-danger">
			<div class="panel-heading" style="background-color:#2B2D2E;border-color:#000;">
				<a name="<?php echo $fetch_cate['category_name'];?>" style="font-size:20px;color:#fff;"><?php echo $fetch_cate['category_name'];?></a></div>
        
        <div class="category panel-body" style="background-color:#2B2D2E;">
    <div class="col-sm-6">
    <?php
	 $sql_type = "select * from sub_categories where cat_id='".$fetch_cate['id']."'"; 
	 $exec_type = mysql_query($sql_type);
	 while($fetch_type = mysql_fetch_assoc($exec_type)){

	?>


	
    <div class="tile tile_sm design<?php echo $fetch_cate['id'];?>"style="font-size:10pt;" data="<?php echo $fetch_cate['id'];?>"  id="design" design="<?php echo $fetch_type['id'];?>" category="<?php echo $fetch_cate['id'];?>"><img src="./img/<?php echo $fetch_type ['image'];?>" width="130px" height="100px"> <?php echo $fetch_type['name'];?></div>
    <?php }?>
    </div>
    <div class="col-sm-6" >
   <?php
	 $sql_mat = "select * from material where cats_id='".$fetch_cate['id']."'"; 
	 $exec_mat = mysql_query($sql_mat);
	 while($fetch_mat = mysql_fetch_assoc($exec_mat)){
		 //print_r($fetch_mat);

	?>
    <div class="tile tile_sm material<?php echo $fetch_cate['id'];?>" id="material" data1="<?php echo $fetch_cate['id'];?>" material="<?php echo $fetch_mat['id'];?>" category="<?php echo $fetch_cate['id'];?>" style="width:150px;box-shadow:10px 0px 10px #000;text-align:center;border-radius:5px;"><?php echo $fetch_mat['material'];?></div>
    <?php }?>
    
    </div>
    </div>
        </div>
        
        <?php }?>
        
     <input type="hidden" id="user_uniq" name="user_uniq" value="<?php echo $user_uniq;?>">
	
    
    </div>
</div>
        
     <input type="hidden" id="user_uniq" name="user_uniq" value="<?php echo $user_uniq;?>">
	
    
    </div>
</div>

<br/>

<!---- -------------------SUBMIT MODAL ----------------- -->



<!...Login Modal ...  >
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

	
			
				 
				
				<div class="modal-title"><h4 style="color:#428bca;" id="errormsgs"><br>
                Fill in the details below (Mandatory)</h4>
			</div>
			<div class="modal-body success1">
                  <form method="POST" id="feedbackform" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
				  <select class="form-control city" name="city" onChange="sel_city()" style="width:15%;display:inline;font-family:sans-serif;">
              <option value="0" label="Select Your City"> Select your city </option>
              <?php
			  $select="select * from city where status='1'";
			  $main=mysql_query($select);
			   while ($row_main = mysql_fetch_assoc($main)) { ?>
                    <option value="<?php echo $row_main['city'];?>" <?php if($row_main['city'] == $dvar['city']){ echo "selected='seleccted'";} ?>><?php echo $row_main['city'];?></option>
                    
                     <?php }?>
              </select>			
       
			  <select class="form-control area" name="area" style="width:15%;display:inline;font-family:sans-serif;">
              <option value="0" label="Select Your Area"> Select Your Area</option>
             
              </select>
             
			  <select class="form-control " name="budget" style="width:15%;display:inline;font-family:sans-serif;" >
              <option value="0" label="Select Your Budget">Select Your Budget</option>
			   <?php
			  $bud="select * from budget where status='1'";
			  $exbud=mysql_query($bud);
			   while ($row_bud = mysql_fetch_assoc($exbud)) { ?>
                    <option value="<?php echo $row_bud['budget'];?>" <?php if($row_bud['budget'] == $dvar['budget']){ echo "selected='seleccted'";} ?>><?php echo $row_bud['budget'];?></option>
                    
                     <?php }?>
             
              </select>
          
			  <select class="form-control " name="apartment" style="width:15%;display:inline;font-family:sans-serif;font-size:12px;" required>
              <option value="" label="Project type">Select Apartment Type</option>
			   <?php
			  $apar="SELECT * FROM type";
			  $exapar=mysql_query($apar);
			   while ($row_apar = mysql_fetch_assoc($exapar)) { ?>
                    <option value="<?php echo $row_apar['type'];?>" <?php if($row_apar['type'] == $dvar['apartment']){ echo "selected='seleccted'";} ?>><?php echo $row_apar['type'];?> </option>
                    
                     <?php }?>
             
              </select>
				<br><br>
                  <div id="mulitplefileuploader" style="font-family:sans-serif;box-shadow:2px 2px 21px #000;">upload floor plans / site pictures</div>
 
                    <div id="status"></div>
                   
                    <script>
                    
                    $(document).ready(function()
                    {
                    var settings = {
                       url: "upload2.php?id=<?php echo $projet;?>",
                        method: "POST",
                        allowedTypes:"jpg,png,gif,doc,pdf,zip",
                        fileName: "myfile",
                        multiple: true,
                        onSuccess:function(files,data,xhr)
                        {
                            $("#status").html("<font color='green'> You have Uploaded  successfully </font>");
                            
                        },
                        onError: function(files,status,errMsg)
                        {		
                            $("#status").html("<font color='red'>Upload is Failed</font>");
                        }
                    }
                    $("#mulitplefileuploader").uploadFile(settings);
                    
                    });
                    </script>
                   <input type="hidden" id="project" name="project" value="<?php echo $projet;?>"> 
                   <input type="hidden" name="do" value="design_data">
	
              	<textarea rows="4" class="form-control" name="description" placeholder="Any Other Details (Optional)" style="margin-top:10px;margin-bottom:10px;width:29%;"><?php echo $dvar['description'];?></textarea>
     	        
			
			
            <input type="email" class="form-control" name="email"  value="<?php echo $dvar['email'];?>" id="email" placeholder="Email Address" style="width:25%;display:inline;" required>
 
			  <input type="tel" class="form-control" name="phone"  value="<?php echo $dvar['phone'];?>"   style="width:25%;display:inline;" id="phone" placeholder="Phone Number" required>
		<br><br>
	<a href="Index.php"> <button type="submit" class="btn  btn-lg" style="background-color:#ff6961;color:white;" name="submitbut" onClick="assign()"> Submit </button></a> 
             
                </form>
			</div>
	
		<!... modal on submit ...... >  

				<!-- Trigger the modal with a button -->


<!-- Modal -->

                    

          

      
     
</div>
		</div>
	</div>
</div>




		

<?php include "include/footer.php"?>


</body>
</html>