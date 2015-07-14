<?php
 require_once("init.php");
 require_once("config_db.php");
 require_once("config.php");
 //start session
session_start();

$tabl = "user";
 $type=$_GET['type'];
 $do=$_GET['do'];
 $ids=$_GET['id'];
 $path= $_GET['path'];
 $cookie_name = "path";
$cookie_value = $path;
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

$uniq_id = random_generator(10);
 
 $_SESSION['type']=$type;
 $_SESSION['do']=$do;
 $_SESSION['ids']=$ids;
 $_SESSION['path']=$path;
 $_SESSION['uniq_id']=$uniq_id;
 
// print_r($_SESSION);die;
 //include google api files
require_once 'google/src/Google_Client.php';
require_once 'google/src/contrib/Google_Oauth2Service.php';
 
########## Google Settings.. Client ID, Client Secret from https://cloud.google.com/console #############
$google_client_id 		= '931223953776-a3o8619i839r5kodh9ub5b8o4atac7r8.apps.googleusercontent.com';
$google_client_secret 	= '1VBWtggsWk7-HpKmHeseHRhR';
$google_redirect_url 	= 'http://www.makeuber.com/google_login.php'; //path to your script
$google_developer_key 	= 'AIzaSyBTnuGLriO-Ao2X85iRl6gYY596VQ_tuTo';

########## MySql details (Replace with yours) #############
$db_username = "lisa"; //Database Username
$db_password = "lisa@makeuber.com"; //Database Password
$hostname = "localhost"; //Mysql Hostname
$db_name = 'decor'; //Database Name
###################################################################
$gClient = new Google_Client();
$gClient->setApplicationName('Login to Makeuber');
$gClient->setClientId($google_client_id);
$gClient->setClientSecret($google_client_secret);
$gClient->setDeveloperKey($google_developer_key);
$gClient->setAccessType('online');
$gClient->setScopes(array('https://www.googleapis.com/auth/plus.login?path='.$path, 'https://www.googleapis.com/auth/plus.me', 'https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/userinfo.profile'));
 $gClient->setRedirectUri('http://www.makeuber.com/google_login.php');

 
$google_oauthV2 = new Google_Oauth2Service($gClient);

//If user wish to log out, we just unset Session variable
if (isset($_REQUEST['reset'])) 
{
 unset($_SESSION['token']);
  $gClient->revokeToken();
  header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL)); //redirect user back to page
}

//If code is empty, redirect user to google authentication page for code.
//Code is required to aquire Access Token from google
//Once we have access token, assign token to session variable
//and we can redirect user back to page and login.
if (isset($_GET['code'])) 
{ 
	$gClient->authenticate($_GET['code']);
	$_SESSION['token'] = $gClient->getAccessToken();
	header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL));
}


if (isset($_SESSION['token'])) 
{ 
	$gClient->setAccessToken($_SESSION['token']);
}


if ($gClient->getAccessToken()) 
{

	  //For logged in user, get details from google using access token
	  $user 				= $google_oauthV2->userinfo->get();
	  $user_id 				= $user['id'];
	  $user_name 			= filter_var($user['name'], FILTER_SANITIZE_SPECIAL_CHARS);
	  $email 				= filter_var($user['email'], FILTER_SANITIZE_EMAIL);
	  $profile_url 			= filter_var($user['link'], FILTER_VALIDATE_URL);
	  $profile_image_url 	= filter_var($user['picture'], FILTER_VALIDATE_URL);
	  $personMarkup 		= "$email<div><img src='$profile_image_url?sz=40'></div>";
	  $_SESSION['token'] 	= $gClient->getAccessToken();
}
else 
{
	//For Guest user, get google login url
	$authUrl = $gClient->createAuthUrl();
}

if($_GET['code'] <> ''){

 header("location:google_login.php?type=".$_SESSION['type']."&do=".$_SESSION['do']."&path=".$_SESSION['path']."&ids=".$_SESSION['ids']."");	
}
//list all user details
// 
	echo '<pre>'; 
	 if ($user) {
		 //unset($_SESSION['token']);;
		//$paths=$_COOKIE[$cookie_name];
  $dvar['first_name'] = $user['given_name'];
	$dvar['last_name']  = $user['family_name'];
    $dvar['email_id']   = $user['email'];
	$dvar['username']   = $user['id'];
	$dvar['password']   = $user['password'];
	
	//It is used to check the email Id already exists or not
	$sql1="select count(*) from $tabl where email_id='".$dvar['email_id']."'";
	$exec1 = mysql_query($sql1);
	list($num1) = mysql_fetch_row($exec1);
	 $num1;
	//echo $num1;die;
	$paths= $_GET['path'];
	if($num1 > 0){
		$sql_user="select * from $tabl where email_id='".$dvar['email_id']."'"; 
	$exec_user = mysql_query($sql_user);
	$userfetch = mysql_fetch_array($exec_user);
	if($userfetch['type'] == '0')
	{
		$id = $userfetch['uniq_id'];
		user_login($id);
		
		echo "<script>window.location = 'user_profile.php' </script>";
	  }else{
		  $id = $userfetch['uniq_id'];
		user_login($id);
		print_r($_SESSION);die;
	echo "<script>window.location =  'designer_profile.php' </script>";
	  }
	}
	else{
		//print_r($_SESSION);die;
			$add_dvar = array( 'uniq_id' => $uniq_id, 'status' => '1', 'type' => '0', 'time' => time());
	$remove_dvar = array('rpassword');
	list($insert_q[0], $insert_q[1]) = insert_query($dvar, $add_dvar, $remove_dvar, $change_dvar);
 $sql =  "INSERT into $tabl(sort, $insert_q[0]) SELECT max(sort)+1, $insert_q[1] from $tabl";
$exec_user=mysql_query($sql);

if($exec_user){ 
$to = $dvar['email_id'];    //  your email
			 $subject  = 'Welcome To Makeuber';
			$header = ' MIME-Version: 1.0' . "\r\n";
		$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$header .= 'From: Makeuber <reachus@makeuber.com>';
			 $body .='<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#E6E6E6">
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
    <p>Your User Name is '.$dvar['username'].' and Password is '.$dvar['username'].' </p>
	<p>This is your temporary username and password. You can change it after login</p>
    <p>If you do have any further questions, concerns, or suggestions, shout out to our team anytime through the contact form on</p> 
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
			
	mail($to, $subject, $body, $headers);
	
	//////////////////////////////////send mail to admin///////////////////////////////////
$to_admin ="reachus@makeuber.com";    //  your email
			 $sub  = 'New USER Added';
			$header = ' MIME-Version: 1.0' . "\r\n";
		$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$header .= 'From: Makeuber <reachus@makeuber.com>';
			 $container .='<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#E6E6E6">
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
    
    <p>Hi I Register as an User in Your Site Please Approve My Acount </p> 
    <p>My User Name is '.$dvar['username'].' and E-mail Address is '.$dvar['email_id'].' </p>
    
    <p>New User</p>
    
    <p>'.$dvar['username'].'</p></font></td>
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
			
	mail($to_admin , $sub, $container, $header);	

	$reg="select * from $tabl where username='".$dvar['username']."' and type='0'";
$select=mysql_query($reg);
	$userfetch = mysql_fetch_assoc($select);
			//print_r($userfetch);die;
	if($userfetch['status'] == '1' || $userfetch['type'] == '0')
	{
		//echo $userfetch['status'];die;
		$id = $userfetch['uniq_id'];
		user_login($id);
	}
	
		
		echo "<script>window.location =  'designer_profile.php' </script>";
		
		        }		
			else{
		echo mysql_error();
	}
			}}
	echo '</pre>';

if(isset($authUrl)) //user is not logged in, show login button
{
	
	echo "<script>window.location = '".$authUrl."' </script>";
} 
else // user logged in 
{
	echo "<script>window.location = 'user_profile.php' </script>";
}
 ?>
 
