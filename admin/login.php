<?php
require_once("../init.php");
require_once("../config_db.php");
require_once("include/check_login.php");
if($flagl=='lgin'){header("Location: dashboard.php");}
$ts = time();
$flaglg = $_GET['login'];
if($_POST['submitbtn'] == ' Login '){
$user_code = mysql_real_escape_string($_POST['user_id']);
$md5pass_cod = md5(mysql_real_escape_string($_POST['pass_word']));


$base_tabl='admin';
$sql="SELECT userid,password,uniq_id FROM $base_tabl WHERE userid ='$user_code' AND password='$md5pass_cod'";
$exec = mysql_query($sql) or die (mysql_error()); 
if (mysql_num_rows($exec) == 1 ) {
$fetch = mysql_fetch_assoc($exec);
$_SESSION[ADMIN_SESSION]= $fetch[uniq_id];
$msg = 'g';
}
else{
$flagp = "red";
}

	
}

mysql_close($link);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $site_name; ?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
       <?php
if($msg <> ''){
?>
<meta http-equiv="refresh" content="0; URL=dashboard.php">
<?php } ?>

</head>

<body>
<div align="center">
  <div class="container">
    <div class="content1" style="border:none">
      <div class="login">
        <div class="bannar"> <img src="images/button2.png" alt="images/logo" height="69" width="81" />
          <div class="bnrtxt">MakeUber Admin Panel</div>
          <div class="clear"></div>
        </div>
<?php
      if($flagp == "red"){ echo '<div style="color:#FF0000; font-size:12px; border-top-color:#0000FF;" align="center">&nbsp; &nbsp;&nbsp; &nbsp;<u>The Username or Password you entered is incorrect.</u></div>';  }
      else if($flagph == "red"){ echo '<div style="color:#FF0000; font-size:12px; border-top-color:#0000FF;" align="center">&nbsp; &nbsp;&nbsp; &nbsp;<u>The Human Verification Code you entered is incorrect.</u></div>';  }
	  else if($flaglg=='req'){ echo '<div style="color:#FF0000; font-size:12px; border-top-color:#0000FF;" align="center"><u>Please Login to access that Page.</u></div>';}
	  if($msg == 'g'){echo '<div style="color:green; font-size:12px; border-top-color:#0000FF;" align="center"><u>Login Successfull, Redirecting you to Dashboard.</u></div>';}

?>



<script language="JavaScript"><!--

var ts = <?php echo $ts; ?>;

--></script>
        <form name="login" action="login.php" method="post" class="upload" >
          <div class="login1"> <img src="images/username_icon.png" alt="images/username_icon" height="14" width="17" />Username: </div>
          <div class="logintxt">
           <input class="field" type="text" name="user_id" maxlength="12" autocomplete="off" />
          </div>
          <div class="login1"> <img src="images/password_icon.png" alt="images/password_icon" height="14" width="13" />Password: </div>
          <div class="logintxt">
            <input class="field" type="password" name="pass_word" maxlength="15" autocomplete="off" />
          </div>
          <div class="login2">
            <div class="clear"></div>
            <input type="submit" name="submitbtn"  value=" Login " />
          </div>
        </form>
        <div class="clear"></div>
        <div class="lastlogin"></div>
      </div>
    </div>
  </div>
</div>
</body>
</html>