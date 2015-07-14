<?php
require("include/PHPMailer_5.2.4/class.pop3.php");
require("include/PHPMailer_5.2.4/class.phpmailer.php");
require_once("init.php");
require_once("config_db.php");
require_once("config.php");

/* This file has send mail index you added email settings. Do we add here why did you uoload it in update profile ? we made changes right that was user profi;e not update Wrong file uploaded which oneu ok il test ?  uploaded right file? i am verifying here yes yes user profule has reset amil link rightly uploaded o*/
  
$tabl = 'user';
$tab2 = 'project';
$item = 'User';
$item2 = 'Project';
$profile="active";
$namep = $_SERVER['PHP_SELF'];

if($user_status <> 1){
		header("location:Index.php");
	}
 $user="Select * from $tabl where uniq_id='$uniqc'" or die(mysql_error());
$select=mysql_query($user);	
$row_cat = mysql_fetch_assoc($select);
$email=$row_cat['email_id'];
$ini=base64_encode($uniqc);
//$group="select $tab2.*, category.category_name from $tab2 left outer join category on $tab2.category=category.id where $tab2.user_id='".$fetch_user['uniq_id']."' group by category and category.status='1'";	
 $group="select * from $tab2 where user_id='".$fetch_user['uniq_id']."' group by category";
$raw_group=mysql_query($group);


if($_GET['do']=='delete'){
	$id=$_GET['id'];
	$sql="select * from project_images where images_id='$id'";
	$exe=mysql_query($sql);
	$sql2="select * from project where id='$id'";
	$exe2=mysql_query($sql2);
	while($fetch_img=mysql_fetch_assoc($exe)){
		unlink('./img/'.$fetch_img['image']);
				}
				
	while($fetch_ppro=mysql_fetch_assoc($exe2)){
		unlink('./img/'.$fetch_ppro['project_image']);
				}			
		//delete from database
		 $sql_img_del="delete from project_images where images_id='".$id."'";
		 $sql_pro_del="delete from project where id='".$id."'";
		
		if(mysql_query($sql_pro_del) & mysql_query($sql_img_del)){
		$flag['d'] = $item2;
	}
	else{
		$flag['q'] = 'r';
	}
	}
	
	////////////////////////////////////////////Reset Password//////////////////////////////////////
	if(isset($_POST['Reset'])){
	/* Configurations made by suresh are down i wonder if he saw the init file as i guess the file init is included in each file and would be using email sending firm there */
 //error_reporting(E_ALL);
// echo 'hih';exit;
    //require 'PHPMailer_5.2.4/PHPMailer.php';
//	require("PHPMailer_5.2.4/class.smtp.php");


   //echo 'hih';exit;
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
    
/* PLease help me configure the same code in one place where i understand how thsi works like */

  
    
	//$mail->AddCC("nirajbohra@gmail.com");
  

    
		$users="Select * from $tabl where uniq_id='$uniqc'" or die(mysql_error());
$selects=mysql_query($users);	
$row_cats = mysql_fetch_assoc($selects);
$email=$row_cats['email_id'];

		    $mail->AddAddress($email); 
			$mail->IsHTML(true);
			$mail->Subject =  "Reset Forgot Password is\n";
     		$mail->Body  = '<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#8d8e90">
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="61"><a href= "http://www.makeuber.com" target="_blank"><img src="http://www.makeuber.com/img/logo.png"/></a></td>
               
                <td width="393"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="46" align="right" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                           
                            <td width="29%" align="right"><font style="font-family:Myriad Pro, Helvetica, Arial, sans-serif; color:#68696a; font-size:10px"><a href= "http://www.makeuber.com" style="color:#68696a; text-decoration:none; text-transform:uppercase"><strong>GO TO THE SITE</strong></a></font></td>
                            <td width="4%">&nbsp;</td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td height="30">&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
         <tr>
          <td align="center"><font style="font-family:Myriad Pro, Helvetica, Arial, sans-serif; color:#68696a; font-size:36px; text-transform:uppercase"><strong>MakeUber</strong></font></td>
        </tr>
        <tr>
          <td align="center"><a href= "http://www.makeuber.com" target="_blank"><img src="http://www.makeuber.com/img/Y3W9Dg6y5R.png" alt="" width="598" height="260" border="0"/></a></td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="7%">&nbsp;</td>
                <td width="58%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="95%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="35" align="left" valign="middle" style="border-bottom:2px dotted #000000"><font style="font-family: Georgia, Times New Roman, Times, serif; color:#000000; font-size:25px"><strong><em>Welcome To MakeUber</em></strong></font></td>
                          </tr>
                          <tr>
                            <td align="left" valign="top"><font style="font-family: Verdana, Geneva, sans-serif; color:#000000; font-size:13px; line-height:21px">
       <p>&nbsp;</p>
    <P>Your Reset Password request is confirm</p>
    <p>Click on this link to change the password :<a href=http://www.makeuber.com/reset_password.php?reset='.$ini.'>Reset Password</a></p> 
    <p><a href="http://www.makeuber.com/contact_us.php">http://www.makeuber.com/contact_us.php</a></p>
    
    <p>We hope you have an enjoyable experience with us.</p>
    
    <p>Best Wishes,</p>
    
    <p>MakeUber Team</p></font></td>
                          </tr>
                          <tr>
                            <td></td>
                          </tr>
                          <tr>
                            <td></td>
                          </tr>
                          <tr>
                            <td></td>
                          </tr>
                          <tr>

                            <td></td>
                          </tr>
                        </table></td>
                        
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
                <td width="5%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="82%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="10"> </td>
                      </tr>
                      <tr>
                        <td></td>
                      </tr>
                    </table></td>
                    <td width="8%">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
       
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>'; 
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
  //echo $e->errorMessage(); //error messages from PHPMailer
} 
/*catch (Exception $e) {
  echo $e->getMessage();
}*/
			/* $from  = "From: MakeUber  <nirajbohra@gmail.com>"; // Can this creatte mess This is a peace of code on every mailer  ? 
			  $from .= ' MIME-Version: 1.0' . "\r\n";
			 $from .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			 if(mail($email, $subject, $body, $from)){
				$flag['g'] = '6';
				
			 }
			 else{
			  $flag['e'] = "r";
			 }	*/
		}
		
		
		
		
	


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $site_name; ?></title>
    <meta charset="utf-8">   
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./css/custom.css">

<link rel ="stylesheet" href="./css/Style.css">
<link rel ="stylesheet" href="./cssp/font-awesome.min.css">

<style>
a:hover{hover:white;
text-decoration:none;}
</style>

<script src = "./js/jquery.js" type="text/javascript"></script>
<script src ="./js/bootstrap.min.js" type="text/javascript"></script>
<script src = "./js/jquery.lazy.min.js" type="text/javascript"></script>

    <?php    if($flag['g'] <> ''){
?>
<meta http-equiv="refresh" content="3; URL=<?php echo $_SERVER['PHP_SELF']?>">
<?php } ?>
<script type="text/javascript">
	$(document).ready(function(){

		$(function(){
			$('#header').data('size','big');
		});
	});
</script>
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="//v2.zopim.com/?35HWLYHjHRZIffiJOElwqt2kf7zJhOHX";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
<style> 
.footer-menu li a:hover { color :white; text-decoration:none; } 
</style>
</head>


<body style="font-family:'Ubuntu',sans-serif;font-size:15px;">

<div class="container-fluid" id="wrapper">
</div>
<?php include "./include/header.php";?>
<!-- ---------------------Main ------------------------------- -->

<!-- -----------------------Blogs ----------------- -->

<div id="blog-contri" class="row content-page" style="padding-left:80px;">
	
	<p class="text-left" style="font-size:28px;font-family:sans-serif;color:#663300; margin-left:4%">My Profile</p>
	<br/><br/><div class="row">
                    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data" >

		<div class="panel panel-primary col-sm-10" style="margin-left:5%; margin-right:10%">
			<div class="panel-body">
            <div class="col-sm-4">
            <a class="text-center" style="font-size:28px;font-family: 'Yanone Kaffeesatz', sans-serif;color:#663300;" href="user_profile_edit.php<?php echo $row_gory['id'];?>"><h1><?php echo $row_gory['project_name'];?> </h1>
            <img class="image_sizes" src="img/<?php if(empty($row_cat['image'])){ echo 'no_img.jpg'; }else{ echo $row_cat['image'];}?>"  width="75%" height="200px"/>
</a></div>
<br>

		<div class="col-sm-6" style="margin-top:10px; margin-left:10%; line-height:30px;">
                  <?php echo print_messages($flag, $error_message, $success_message);?>
               <span class="text-left" style="font-family:sans-serif;"><strong style="font-family:sans-serif;">Name:</strong> <?php echo $row_cat['first_name'];?>&nbsp;<?php echo $row_cat['last_name'];?></span><br/>
               <span class="text-left" style="font-family:sans-serif;"><strong style="font-family:sans-serif;">Address:</strong> <?php echo $row_cat['address'];?></span><br/>
               <span class="text-left" style="font-family:sans-serif;"><strong style="font-family:sans-serif;">Contact No: </strong><?php echo $row_cat['phone'];?></span><br/>
               <span class="text-left" style="font-family:sans-serif;"><strong style="font-family:sans-serif;">E-mail:</strong> <?php echo $row_cat['email_id'];?></span><br/>
               <span class="text-left" style="font-family:sans-serif;"><strong style="font-family:sans-serif;">Username:</strong> <?php echo $row_cat['username'];?></span><br/><br/>
                             <a class="btn btn-success" href="user_profile_edit.php">Edit</a>
              <a class="btn btn-success"  href="project.php" style="font-family:sans-serif;">Know Your Project</a><br/><br/>
<!--				<a class="btn btn-danger" href="your_project.php">Start your Project</a>
-->         
				<a class="btn btn-danger" href="<?php echo startproj.".php";?>">Start your Project</a>
		        <input type="submit" value="Reset Password" class="btn btn-danger" name="Reset">
                <div class="clear"></div>
        
        </div>
				<!--<blockquote>
	  				<p><?php echo substr($row_gory['description'],0,120);?><a href="view_pro_image.php?id=<?php echo $row_gory['id'];?>"> Learn More....</a></p>
	  				
				</blockquote>
				<p><?php echo substr($fetch_blog['description'],0,300);?>
				</p>
                <a class="btn btn-success btn-lg col-sm-offset-2 pull-right" href="view_project.php?id=<?php echo $row_gory['id'];?>">View Images</a>-->
			</div>
		</div>
		</form>
	</div>
	
	<br><br><br><br><br><br>
</div>

<hr>



<!---------------------------FEEDBACK ----------------- -->
<?php include "include/feedback.php";?>

<?php include "./include/footer.php";?>

</body>
</html>