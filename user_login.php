<?php
   include "init.php";
   include "config_db.php";
   include "config.php";
   $tabl = "login";
   $user ='pure-menu-selected';
if($user_status == 1){
		header("location:index.php");
	}
echo $_SESSION['project_name'];
    if(isset($_POST['login'])){
	$dvar['username'] = $_POST['username'];
	$dvar['password'] = $_POST['password'];
	if($dvar['username'] == ''){
		$flag[17] = 'r';
		}
	else if($dvar['password'] == ''){
		$flag['5'] = 'r';
		}
	if(!empty($flag)){
		$flag_r = 'r';
		}
		else{
  echo $sql_user="select * from user where username='".$dvar['username']."' and password='".$dvar['password']."' and status='1' and type='0'";
	$exec_user = mysql_query($sql_user);
	if(mysql_num_rows($exec_user)>0){
	$userfetch = mysql_fetch_array($exec_user);
				//print_r($userfetch);die;
	if($userfetch['status'] == '1' || $userfetch['type'] == '0')
	{
		//echo $userfetch['status'];die;
		$id = $userfetch['uniq_id'];
	
		user_login($id);
		if($_POST['do'] == 'project'){
			header("Location:view_project.php?id=".$_POST['id']."");
		}
		else if($_POST['do'] == 'login'){
			header("Location:you.php");
		}
		else if($_POST['do'] == 'you'){
			header("Location:you.php");
		}
		else if($_POST['do'] == 'your_project'){
			header("Location:your_project.php");
		}
		
		else if($_POST['do'] == 'review'){
			header("Location:view_review.php?id=".$_POST['id']."");
		}
		else if($_POST['do'] == 'discussion'){
		
			header("Location:discussion.php?id=".$_POST['id']."");
		}
		else if($_POST['do'] == 'viewpro'){
		
			header("Location:view_project.php?id=".$_POST['id']."");
		}
		else{
			header("Location:user_profile.php");
		}
		
		        }		
			}
	else{
		$flag['42'] = 'r';
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
  <?php include("include/head.php"); ?>
  </head>

  <body>
<!--==============================header=================================-->

<?php include "include/header.php"; ?>
<div id="content">
<div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12 block-1 reson_dec_cont">
        <h3 class="reson_dec"><span>User Login</span></h3>
        
      </div>
    </div> 
  </div>
<div class="container">
    <div class="row block-3 botoom_border">
      <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 xxs-img"><div class="box_inner">
          	<div class="block-2 resiter_login">
                <h5>In just one step, sign up and finalize your purchase: all this with ease, speed and safety. <span>Register now.</span></h5>
              <a class="reg_box reg_submit" href="user_register.php">Register</a>
              
              <a class="reg_box pull-left" style="background-color:#ff6961; color:#FFF" href="fb_login.php?type=0&do=<?php echo $_GET['do'];?>&id=<?php echo $_GET['id'];?>"><b>Login with Facebook</b></a>
                 <a class="reg_box pull-left" style="background-color:#ff6961; color:#FFF" href="google_login.php?type=0&do=<?php echo $_GET['do'];?>&id=<?php echo $_GET['id'];?>"><b>Login with Google+</b></a>
                 <a class="reg_box pull-left" style="background-color:#ff6961; color:#FFF" href="twitter_login.php?type=0&do=<?php echo $_GET['do'];?>&id=<?php echo $_GET['id'];?>"><b>Login with Twitter</b></a>
                 
                 
            </div>           
          </div></div>
      <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 regs_uls">
        <?php echo print_messages($flag, $error_message, $success_message);?>
        
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo $_GET['id'];?>">
            
            <ul class="resiter_div">
            <li>
                <label class="reg_lable">Username</label>
               
                <input class="reg_box" type="text" name="username"  placeholder="Enter your username" value="<?php echo $dvar['username'];?>">
              </li>
            <li>
                <label class="reg_lable">Password</label>
                
                <input class="reg_box" type="password" name="password"  placeholder="Enter your Password" value="<?php echo $dvar['password'];?>">
              </li>
              <li>
              
            <a  class="forgt_link" href="forgot_password.php?type=0">Forgot your Password?</a>
              </li>
                <li>
              
            <a  class="forgt_link" href="user_register.php">New User Create your account</a>
              </li>
            <li>
             <input type="hidden" name="do" value="<?php echo $_GET['do'];?>">
             <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
               <input class="reg_box reg_submit" type="submit" name="login" value="Login">
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