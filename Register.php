<?php
require("include/PHPMailer_5.2.4/class.pop3.php");
require("include/PHPMailer_5.2.4/class.phpmailer.php");
include "init.php";
include "config_db.php";
include "config.php";
$tabl = 'user';
   ini_set('display_errors', '1');

  //  $name = $_POST["name"];
  //  $email = $_POST["email"];
  //  $subject = $_POST["subject"];
  //  $message = $_POST["message"];

if(isset($_POST['submit'])){
	//print_r($_POST);die;
	$dvar['first_name'] = $_POST['first_name'];
	$dvar['last_name']  = $_POST['last_name'];
    $dvar['email_id']   = $_POST['email_id'];
	$dvar['category']   = $_POST['category'];
	$dvar['category1']   = $_POST['category1'];
	$dvar['category2']   = $_POST['category2'];
	$dvar['phone'] 		= $_POST['phone'];
	//$dvar['username'] 	= $_POST['username'];
	$dvar['username'] 	= $_POST['email_id'];
	$dvar['password'] 	= $_POST['password'];
	$dvar['rpassword']  = $_POST['rpassword'];
	$dvar['type']       = $_POST['type'];

	
	//It is used to check the email Id already exists or not
	$sql1="select count(*) from user where email_id='".$dvar['email_id']."'and type='".$dvar['type']."'";
	$exec1 = mysql_query($sql1);
	list($num1) = mysql_fetch_row($exec1);
	
	//It is used to check the Username already exists or not
	$sql="select count(*) from user where username='".$dvar['username']."' and type='".$dvar['type']."'";
	$exec = mysql_query($sql);
	list($num) = mysql_fetch_row($exec);
	//echo $num;
	 $uniq_id = random_generator(10);
	
	/* if($dvar['first_name'] == ''){
		$flag[1] = 'r';
		}else if($dvar['last_name'] == ''){
			$flag[2] = 'r';
		}else if($dvar['category'] == '' or $dvar['category'] == '0'){
			 $flag[82] = 'r';
		 }
		else*/
	if($dvar['email_id'] == ''){
			$flag[3] = 'r';
		}/*
		else if($dvar['phone'] == ''){
		$flag[85] = 'r';}
		else if($dvar['username'] == '')
		{$flag[17] = 'r';}*/
		else if($dvar['password'] == '')
		{$flag[5] = 'r';}
		else if($dvar['rpassword'] == '')
		{$flag[81] = 'r';}
		else if($dvar['rpassword'] <> $dvar['password'])
		{$flag[65] = 'r';}
	
	else if($num1 > 0){
		$flag[21] = 'r';
	}
	else if($num > 0){
		$flag[86] = 'r';
	}
	
	if(!empty($flag)){
		$flag_r = 'r';
		
	}
	else{
		if($dvar['type'] == '0'){
			$dvar['status'] = 1;	
		}
	$add_dvar = array( 'uniq_id' => $uniq_id, 'time' => time());
	$remove_dvar = array('rpassword');
	list($insert_q[0], $insert_q[1]) = insert_query($dvar, $add_dvar, $remove_dvar, $change_dvar);
$sql =  "INSERT into $tabl(sort, $insert_q[0]) SELECT max(sort)+1, $insert_q[1] from $tabl";
$exec_user=mysql_query($sql);
if($exec_user){ 
/* Configurations made by suresh are down i wonder if he saw the init file as i guess the file init is included in each file and would be using email sending firm there */
 error_reporting(E_ALL);
// echo 'hih';exit;
    //require 'PHPMailer_5.2.4/PHPMailer.php';
//	require("PHPMailer_5.2.4/class.smtp.php");

   //echo 'hih';exit;
 
    
/* PLease help me configure the same code in one place where i understand how thsi works like */

  
  
  

   
	ini_set('display_errors', '1');
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
	
	


			$to = $dvar['email_id'];    //  your email
			 $mail->AddAddress($to);
			  $mail->Subject  = 'Welcome to Makeuber';
			    $mail->IsHTML(true);
			  if($dvar['type'] ==0){
			 $mail->Body =  '<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#E6E6E6">
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="61" align="center"><a href= "http://www.makeuber.com" target="_blank"><img src="http://www.makeuber.com/img/logo.png"/></a></td>
               
              
        </tr>
		<TR><TD>&nbsp;</TD</TR>
        
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
    
	   <p>Thank you for signing up for MakeUber.</p>
	   
	      <p>Your Login Details are as bellow.</p>
	   
	   <p>Username : '.$dvar['username'].'</p>

	   <p>Password : '.$dvar['password'].'</p>


    <p>Now you can Browse through our experts <a href="http://www.makeuber.com/expert">http://www.makeuber.com/Expert</a></p>

    <p>Participate in discussions <a href="http://www.makeuber.com/ask">http://www.makeuber.com/Ask</a></p>

    <p>Share your requirement with us <a href="http://www.makeuber.com">http://www.makeuber.com</a></p>

    <p>If you do have any further questions, concerns, or suggestions, shout out to our team anytime through the Feedback form on</p> 
   
    <p><a href="http://www.makeuber.com">http://www.makeuber.com</a></p>
	
	<p>Or you could write to us anytime at reachus@makeuber.com</p>
    
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
  }
  
			  else{
					
					// $mail->AddAddress($to);
						ini_set('display_errors', '1');
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
    $mail->Password = "niraj124"; // Your Password'
	
	
			  $mail->Subject  = 'Welcome to Makeuber';
					  $mail->IsHTML(true);
					 $mail->Body = '<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#E6E6E6">
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="61" align="center"><a href= "http://www.makeuber.com" target="_blank"><img src="http://www.makeuber.com/img/logo.png"/></a></td>
               
              
        </tr>
		<TR><TD>&nbsp;</TD</TR>
        
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
	   <p>Thank you for signing up for MakeUber.</p>

	   <p>Your Login Details are as bellow.</p>
	   
	   <p>Username : '.$dvar['username'].'</p>

	   <p>Password : '.$dvar['password'].'</p>

	   <p>Thank you for signing up for MakeUber.</p>
	   
    <p>Please complete your profile by login into your account and filling in all the necessary details.</p>
	
	<p>Once your profile is complete, We will activate your account and you will be live on our site. </p>
	
    <p>If you do have any further questions, concerns, or suggestions, shout out to our team anytime through the Feedback form on</p> 
   
    <p><a href="http://www.makeuber.com">http://www.makeuber.com</a></p>
	
	<p>Or you could write to us anytime at reachus@makeuber.com</p>
    
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

		try{
    if(!$mail->Send())
    {
      // echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
    else
   {
			ini_set('display_errors', '1');
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
    $mail->Password = "niraj124"; // Your Password'
		 if($dvar['type'] ==0){
    			$mail -> Subject ='<p>Hi I Register as a User in Your Site Please Approve My Account </p> ';   
				 }
				 else
				 {
    		$mail -> Subject =  '<p>Hi I Register as a Expert in Your Site Please Approve My Account </p> ';
				 }
				 if($dvar['type'] ==0){
    			$mail -> Subject = '<p>New User </p> ';   
				 }else{
    			$mail -> Subject = '<p>New Expert </p> ';
				 }
				 
			  $mail->AddAddress('nirajbohra@gmail');    //  your email
			 if($dvar['type'] ==0){
			 	$mail -> Subject  = 'New USER Added';
			 }else{
			 	$mail -> Subject  = 'New EXPERT Added';
			 }
	
			 $mail -> Body ='<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#E6E6E6">
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="61" align="center"><a href= "http://www.makeuber.com" target="_blank"><img src="http://www.makeuber.com/img/logo.png"/></a></td>
               
              
        </tr>
		<TR><TD>&nbsp;</TD</TR>
        
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
                            <td height="35" align="left" valign="middle" style="border-bottom:2px dotted #000000"><font style="font-family: Georgia, Times New Roman, Times, serif; color:#000000; font-size:25px"><strong><em>New Expert Approval</em></strong></font></td>
                          </tr>
                          <tr>
                            <td align="left" valign="top"><font style="font-family: Verdana, Geneva, sans-serif; color:#000000; font-size:13px; line-height:21px">
       <p>&nbsp;</p>'.$info.'<p>My User Name is '.$dvar['username'].' and E-mail Address is '.$dvar['email_id'].' </p>
    
    <p><a href="http://www.makeuber.com/">http://www.makeuber.com/</a></p>'.$info1.'   
    <p>'.$dvar['first_name'].' '.$dvar['last_name'].'</p></font></td>
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
        //echo 'success';
   }
	//$mail->Send();
	} 
	catch (phpmailerException $e) { 
  echo $e->errorMessage(); //error messages from PHPMailer
}  
	}
			
	
	//////////////////////////////////send mail to admin///////////////////////////////////
	
			
		
	$reg="select * from $tabl where username='".$dvar['username']."' and type='".$dvar['type']."'";
	$select=mysql_query($reg);
	$userfetch = mysql_fetch_assoc($select);
			//print_r($userfetch);die;
	if($userfetch['type'] <> '' )
	{
		//echo $userfetch['status'];die;
		$id = $userfetch['uniq_id'];
		user_login($id);
		if($userfetch['type'] == '0'){
		 header("Location:user_profile.php");
		}else{
		 header("Location:designer_profile.php");
		}
	}else{
		echo mysql_error();
	}
	
	
}	

	}
	
		
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
<meta name="title" content=" We Help You Make Your Dream Home | MakeUber">
<meta name="description" content=" MakeUber helps you find and select the best interior designers, architects, custom furniture sellers and other experts for all your home interior and design needs. Browse photos, chat withus and get professional advice.">

<link rel ="stylesheet" href="css/bootstrap.min.css">
<link rel ="stylesheet" href="css/style.css">
<link rel ="stylesheet" href="css/font-awesome.min.css">
<script src = "js/jquery.js" type="text/javascript"></script>
<script src ="js/bootstrap.min.js" type="text/javascript"></script>
<script src = "js/jquery.lazy.min.js" type="text/javascript"></script>
<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>


<script type="text/javascript">
	function show_cat(id){
	if(id ==1){
		$('#cat').show();
		$('#Re_Pwd').show();
		$('#nameField').show();
	}
	if(id ==0){
		$('#cat').hide();
		$('#Re_Pwd').show();
		$('#nameField').hide();
	}
	}


</script>

<style type="text/css">
	#wrapper{
		background-image:url(img/register_back.jpg);
	}

	.dropdown-menu{
		position: relative;
	}
</style>

</head>
<body style="font-family:'Ubuntu',sans-serif;font-size:15px;" onload="show_cat('<?php echo $dvar['type'] ;?>')">
<div id="wrapper"></div>

<!-- ---------------------MAIN ------------------------------- -->
<div id="main" class="row" style="overflow-x:hidden;height:auto;text-align:center;opacity:1;">
	<div style="background:#fff;width:60vw;margin-right:auto;margin-left:auto;margin-top:20px;margin-bottom:20px;border-radius:5px;box-shadow:0 0 3px 3px rgba(0,0,0,0.3);padding-bottom:20px;">
		<div style="padding:30px;padding-bottom:10px;margin-bottom:30px;background:rgba(0,0,0,0.1);">
		<span style="font-size:30px;/* cursor:pointer; *//* float: right; */position: absolute;margin-left: 40%;margin-top: -2%;"><a href="tmpMain.php" style="color:#868AA2;"><i class="fa fa-times"></i></a></span>
		<span style="font-size:25px;margin-left: 0%;">Welcome to &nbsp;</span> <img src="./img/logo.png" height="50px" style="margin-top:-33px;"><br><!--<span><a href="index.php" type="submit">back</a>--><h4>Your Space Your Way!</h4>
		</div>
		<form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" role="form" style="width:43vw;margin-left:auto;margin-right:auto;padding-left:100px;">
        <div class="col-sm-6">
 			<?php echo print_messages($flag, $error_message, $success_message);?> 	
 		</div>
		<div class="clearfix"></div><br/>		
		<div class="form-group">
			<label class="col-sm-3 control-label" style="text-align: right;" for="type">Select Type</label>
			<div class="col-sm-4">
				<select class="reg_box form-control" name="type" onChange="show_cat(this.value)" style="height: 30px;border-radius: 3px;">
					<option value="">Select Type</option>
					<option value="1" <?php if($dvar['type'] == 1){ echo "selected='selected'";}?>>Expert</option>
					<option value="0" <?php if($dvar['type'] == 0){ echo "selected='selected'";}?>>User</option>
				</select>
			</div>
		</div>
		<!--<div class="form-group">
			<div class="col-sm-10">
				<input type="text" class="form-control" name="last_name" value="<?php echo $dvar['last_name'] ;?>" placeholder="Last Name">
			</div>
		</div>-->
		<div class="form-group">
			<div class="col-sm-8">
				<span style="color:red;position: absolute;margin-left: -50%;">*</span>
				<input type="email" name="email_id" value="<?php echo $dvar['email_id'];?>" class="form-control" placeholder="Email">
			</div>
		</div>
	<!--	<div class="form-group">
			<div class="col-sm-10">
				<input type="text" name="username" value="<?php echo $dvar['username'];?>" class="form-control" placeholder="Username">
			</div>
		</div>-->
		<div class="form-group">
			<div class="col-sm-8">
				<span style="color:red;position: absolute;margin-left: -50%;">*</span>
				<input type="password" name="password" value="<?php echo $dvar['password'];?>" class="form-control" placeholder="Password">
			</div>
		</div>
		<div class="form-group" id="Re_Pwd">
			<div class="col-sm-8">
				<span style="color:red;position: absolute;margin-left: -50%;">*</span>
				<input type="password" name="rpassword" class="form-control" placeholder="Retype Password">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-8">
				<input type="text" name="phone" value="<?php echo $dvar['phone'];?>" class="form-control" placeholder="Phone">
			</div>
		</div>
		<div class="form-group" id="nameField">
			<div class="col-sm-4">
				<input type="text" class="form-control" name="first_name" value="<?php echo $dvar['first_name'];?>" placeholder="First Name">
			</div>
			<div class="col-sm-4">
				<input type="text" class="form-control" name="last_name" value="<?php echo $dvar['last_name'] ;?>" placeholder="Last Name"> 
			</div>
		</div>
        
        <div class="form-group" style="display:none;" id="cat">
			<label class="col-sm-3 control-label" style="text-align: left;" for="email">Category&nbsp;1</label>
			<div class="col-sm-5">
			<select class="reg_box form-control"  value="category" name="category" style="height: 30px;border-radius: 3px;">
              <option value="0" label="Choose Your Category"></option>
              <?php
			  $select="select * from main_cat where status='1'";
			  $main=mysql_query($select);
			   while ($row_main = mysql_fetch_assoc($main)) { ?>
                    <option value="<?php echo $row_main['id'];?>" <?php if($row_main['id'] == $dvar['category']){ echo "selected='seleccted'";} ?>><?php echo $row_main['name'];?></option>
                    
                     <?php }?>
              </select>
			</div>
            <div class="clearfix"></div><br/>
            <label class="col-sm-3 control-label" style="text-align: left;padding-top: 0px;margin-top: -5px;" for="email">Category&nbsp;2<br>(optional)</label>
			<div class="col-sm-5">
			<select class="reg_box form-control"  name="category1" style="height: 30px;border-radius: 3px;">
              <option value="0" label="Choose Your Category"></option>
              <?php
			  $select="select * from main_cat where status='1'";
			  $main=mysql_query($select);
			   while ($row_main = mysql_fetch_assoc($main)) { ?>
                    <option value="<?php echo $row_main['id'];?>" <?php if($row_main['id'] == $dvar['category1']){ echo "selected='seleccted'";} ?>><?php echo $row_main['name'];?></option>
                    
                     <?php }?>
              </select>
			</div>  
            <div class="clearfix"></div><br/>
            <label class="col-sm-3 control-label" style="text-align: left;padding-top: 0px;margin-top: -5px;" for="email">Category&nbsp;3<br> (optional)</label>
			<div class="col-sm-5">
			<select class="reg_box form-control" name="category2" style="height: 30px;border-radius: 3px;">
              <option value="0" label="Choose Your Category"></option>
              <?php
			  $select="select * from main_cat where status='1'";
			  $main=mysql_query($select);
			   while ($row_main = mysql_fetch_assoc($main)) { ?>
                    <option value="<?php echo $row_main['id'];?>" <?php if($row_main['id'] == $dvar['category2']){ echo "selected='seleccted'";} ?>><?php echo $row_main['name'];?></option>
                    
                     <?php }?>
              </select>
			</div>
		</div>
<!--		<div class="form-group">
			<label class="col-sm-3 control-label" for="type">Select Type</label>
			<div class="btn-group col-sm-2" id="selectbox">
				<a class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					<span>Select Type</span> &nbsp;&nbsp;&nbsp;<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a class="drop-item" href="#">I am a User</a></li>
					<li><a class="drop-item" href="#">I am an Expert</a></li>
				</ul>
			</div>
		</div> 
		<div class="form-group" style="display:none;" id="catbox">
			<label class="col-sm-5 control-label" for="category">Choose Your Speciality</label>
			<div class="btn-group col-sm-3">
				<a class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					<span>Choose your Speciality</span> &nbsp;&nbsp;&nbsp;<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a class="drop-item" href="#">Choose Your Speciality</a></li>
					<li><a class="drop-item" href="#">Architect</a></li>
					<li><a class="drop-item" href="#">Interior Designers</a></li>
					<li><a class="drop-item" href="#">Contractors</a></li>
					<li><a class="drop-item" href="#">Tiles &amp; Stones</a></li>
					<li><a class="drop-item" href="#">Wallpapers</a></li>
				</ul>
			</div>
		</div>
	<a class="btn btn-success btn-lg" style="margin-left:30%;display:block;width:100px;">Sign Up
		</a>-->	      
				<a class="btn btn-danger btn-lg" href="Index.php" style="margin-left: -22%;" type="submit">Cancel</a>
                <input class="btn btn-success btn-lg" type="submit" name="submit" value="Sign Up">
				<p style="text-align: -webkit-left;margin-top: 10px;"><span style="color:red">*</span>&nbsp;&nbsp;Required field.</p>
		</form>
	</div>
</div>
<!-- ---------------------Footer ------------------------------- -->
<?php include "include/.footer.php";?>

</body>
</html>