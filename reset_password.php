<?php
include "init.php";
include "config_db.php";
include "config.php";
$tabl = 'user';
$id=$_GET['reset'];
$uid=base64_decode($id);
if(isset($_POST['submit'])){
	$dvar['o_password'] 	= $_POST['o_password'];
	$dvar['password'] 	= $_POST['password'];
	$dvar['r_password']  = $_POST['r_password'];
	
	//It is used to check the user password already exists or not
	$sql1="select * from user where uniq_id='".$uid."'";
	$exec1 = mysql_query($sql1);
	$num1 = mysql_fetch_assoc($exec1);
	
	
     if($dvar['o_password'] == '')
	{$flag[26] = 'r';}
	if($dvar['password'] == '')
	{$flag[27] = 'r';}
	else if($dvar['r_password'] == '')
	{$flag[28] = 'r';}
	 if($dvar['o_password'] <> $num1['password'])
	{$flag[32] = 'r';}
	else if($dvar['password'] <> $dvar['r_password'])
	{$flag[33] = 'r';}
	
	if(!empty($flag)){
		$flag_r = 'r';
		
	}
	else{
	
	$remove_dvar = array('r_password','o_password');
	list($insert_q[0], $insert_q[1]) = insert_query($dvar, $add_dvar, $remove_dvar, $change_dvar);
$sql ="UPDATE $tabl SET ".update_query($dvar, $add_dvar, $remove_dvar, $change_dvar)." where uniq_id='".$uid."'";
$exec_user=mysql_query($sql);
if($exec_user){ 
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
//////////////////////////Send mail to designer///////////////////////////////////////
$to = $num1['email_id'];    //  your email
			 $mail->AddAddress($to);
			 $mail->Subject =  'New Password';
			 $mail->IsHTML(true);
			 $mail->Body ='<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#8d8e90">
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
    
    <p>Hi '.$num1['username'].' Your Password has been updated. Your new password is = '.$dvar['password'].'  </p> 
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
  echo $e->errorMessage(); //error messages from PHPMailer
} 
/*catch (Exception $e) {
  echo $e->getMessage();
}*/
	
	}
	}
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
  <link rel="stylesheet" type="text/css" href="./css/menu.css">
			<link rel="stylesheet" type="text/css" href="./css/Style.css">
			<link rel="stylesheet" type="text/css" href="./css/style1.css" />
		
			<link rel="stylesheet" type="text/css" href="./css/jquery.jscrollpane.css" media="all" />
	
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	<script type="text/javascript" src="./js/jquery.js"></script>
			<script src = "./js/jsfunction.js" type="text/javascript"></script>
	
  <?php
if($flag['g'] <> ''){
?>
<meta http-equiv="refresh" content="3; URL=http://www.makeuber.com/Index.php">
<?php } ?>
  </head>

  <body>
<!--==============================header=================================-->

<?php include "include/header.php"; ?>
<div id="content">
<div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12 block-1 reson_dec_cont">
        <h3 class="reson_dec"><span>Reset Password</span></h3>
        
      </div>
    </div> 
  </div>
<div class="container">
    <div class="row block-3 botoom_border">
    <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 maxheight smalbox" style="height: 474px;"><div class="box_inner">
          	<div class="block-2">
                
              
            </div>           
          </div></div>
      
      <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 regs_uls">
        <?php echo print_messages($flag, $error_message, $success_message);?>        
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?reset=<?php echo $id;?>">
            <ul class="resiter_div">
            <li>
                <label class="reg_lable">Old Password</label>
                
                <input class="reg_box" type="password" name="o_password"  placeholder="Enter your Old Password" value="<?php echo $dvar['o_password'];?>">
              </li>
          
            <li>
                <label class="reg_lable">New Password</label>
                
                <input class="reg_box" type="password" name="password"  placeholder="Enter your New Password" value="<?php echo $dvar['password'];?>">
              </li>
            <li>
                <label class="reg_lable">Re-Enter Password</label>
                
                <input class="reg_box" type="password" name="r_password"  placeholder="Re-Enter your New Password"value="<?php echo $dvar['r_password'];?>">
              </li>
            <li>
            
                <input class="reg_box reg_submit" type="submit" value="Submit" name="submit">
              </li>
          </ul>
          </form>
      
        
      </div>
    </div>
  </div>
    
  </div>
<?php include "include/footer.php"; ?>
</body>
</html>