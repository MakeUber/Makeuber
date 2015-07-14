<?php
	require_once("init.php");
	require_once("config_db.php");
	require_once("config.php");
	$tabl = 'user';
	$item = 'User';
	$page_parent = 'profile.php';
	$id = mysql_real_escape_string($_GET['id']);
	$profile="active";
	if($user_status <> 1){
		header("location:index.php");
	}


	$sql = "SELECT * from $tabl where uniq_id='$uniqc'";
	$exec = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_assoc($exec);
	$dvar['first_name'] = $fetch['first_name'];
	$dvar['last_name']  = $fetch['last_name'];
	$dvar['address']    = $fetch['address'];
	$dvar['email_id']   = $fetch['email_id'];
	$dvar['phone']      = $fetch['phone'];
	$dvar['image']      = $fetch['image'];
	$dvar['username']      = $fetch['username'];


    if(isset($_POST['edit'])){
	$dvar['first_name'] = $_POST['first_name'];
	$dvar['last_name']  = $_POST['last_name'];
	$dvar['address']    = $_POST['address'];
	$dvar['phone']      = $_POST['phone'];
	$dvar['email_id']   = $_POST['email_id'];
	$dvar['username']   = $_POST['username'];
	
	//$dvar['image'] = $fetch['image'];
	//print_r($dvar);die;
	
    if($dvar['first_name'] == ''){
		$flag[1] = 'r';
		}
    else if($dvar['last_name'] == ''){
		$flag[2] = 'r';
		}
    else if($dvar['address'] == ''){
		$flag[24] = 'r';
		}
    else if($dvar['phone'] == ''){
		$flag[85] = 'r';
		}
	else if($dvar['email_id'] == ''){
		$flag[3] = 'r';
		}
		else if($dvar['username'] == ''){
		$flag[17] = 'r';
		}
		
	
	
	//print_r ($dvar);
	$allowed_ext = array("gif","jpg","jpeg","png","GIF","JPG","JPEG","PNG");
	$file_field = 'image';
	$validate = validate_file($file_field, $allowed_ext, '0', '0');
	
	//print_r($validate);die;
	
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
			//echo "hi";die;
			$rand1 = random_generator(10);
			$image_name = $rand1.'.'.$ext;
			$path = "./img/".$image_name;
		}
		//echo $path;die;
		
		$sql_s = "select * from $tabl where uniq_id='$uniqc'";
			$exec_s = mysql_query($sql_s);
			$fetch_s = mysql_fetch_assoc($exec_s);

			if($dvar['image_delete'] == 1 && $file <> '1'){
				unlink('./img/'.$fetch_s[$file_field]);
				$image_name = '';
				$sql_file = "$image_name";
			}
			if($file == '1'){
				unlink('./img/'.$fetch_s[$file_field]);
				$sql_file = "$image_name";
			}
			if($file == '1'){
				$add_dvar = array('image' => $sql_file);
			}
			else{
				$add_dvar = array('time' => time());
			}
    		
		$sql = "UPDATE $tabl SET ".update_query($dvar, $add_dvar, $remove_dvar, $change_dvar)." where uniq_id='".$uniqc."'" or die(mysql_error());
		//echo $sql;die;
			mysql_query($sql);
			if(mysql_query($sql)){
			if($file == '1'){
				 copy($_FILES[$file_field][tmp_name], $path);     //  upload the file to the server
    			  chmod("$path",0777);                 // set permission to the file.                // set permission to the file.
				 $thumb = 'img/'.$image_name;
       			 $ext = pathinfo($thumb, PATHINFO_EXTENSION);
				$max_width=270; // Fix the width of the thumb nail images
				$max_height=270; // Fix the height of the thumb nail imaage
				$extn = $ext;	$final = $thumb;	$res = '0';
				include("./include/image_resize.php");   // set permission to the file.
			}
			
			$fg = 'ed';
			header("location:user_profile.php");
			
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

	<link rel="stylesheet" href="./css/Style.css"> 
	<script src = "./js/jquery.js" type="text/javascript"></script>
<script src ="./js/bootstrap.min.js" type="text/javascript"></script>
<script src = "./js/jquery.lazy.min.js" type="text/javascript"></script>
    <?php include("include/head.php"); ?>
	<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="//v2.zopim.com/?35HWLYHjHRZIffiJOElwqt2kf7zJhOHX";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
<style>
.footer-menu li a:hover{color:white; text-decoration:none;}
</style>

</head>

<body style="font-family:'Ubuntu',sans-serif;font-size:15px;">

<div class="container-fluid" id="wrapper">
</div>
<?php include "./include/header.php";?>
<!-- ---------------------Main ------------------------------- -->

<!-- -----------------------Blogs ----------------- -->

<div id="blog-contri" class="row content-page" style="padding-left:80px;">
	
	<p class="text-left" style="font-size:28px;font-family: 'Yanone Kaffeesatz', sans-serif;color:#663300; margin-left:4%">Edit Profile</p>
	<div class="row">

		<div class="panel panel-primary col-sm-10" style="margin-left:5%; margin-right:10%">
			<div class="panel-body">
            <div class="col-sm-4">
            <a class="text-center" style="font-size:28px;font-family: 'Yanone Kaffeesatz', sans-serif;color:#663300;" href="view_project.php?id=<?php echo $row_gory['id'];?>"><h1><?php echo $row_gory['project_name'];?> </h1>
            <img class="image_sizes" src="img/<?php if(empty($fetch_user['image'])){ echo 'no_img.jpg'; }else{ echo $fetch_user['image'];}?>"  width="100%" height="320px"/>
</a></div>

		<div class="col-sm-6" style="margin-top:10px; margin-left:10%">
			 <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" class="form-horizontal" role="form" enctype="multipart/form-data">
 		<div class="form-group">
			<label class="col-sm-4 control-label" for="firstname"></label>
			<div class="col-sm-8">
 			<?php echo print_messages($flag, $error_message, $success_message);?> 	
 		</div>
		</div>
        <div class="clearfix"></div>
		<div class="form-group">
			<label class="col-sm-4 control-label" for="firstname">First Name</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="first_name" value="<?php echo $dvar['first_name'];?>" placeholder="First Name">
			</div>
		</div>
                <div class="clearfix"></div>
<br/>
		<div class="form-group">
			<label class="col-sm-4 control-label" for="lastname">Last Name</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="last_name" value="<?php echo $dvar['last_name'] ;?>" placeholder="Last Name">
			</div>
		</div>
                        <div class="clearfix"></div>
                        <br/>
		<div class="form-group">
			<label class="col-sm-4 control-label" for="firstname">Image</label>
			<div class="col-sm-8">
              <input type="file" class="form-control" name="image" value="<?php echo $dvar['image'];?>" /> 
			</div>
		</div>
                <div class="clearfix"></div>
<br/>
        
                         
		<div class="form-group">
			<label class="col-sm-4 control-label" for="email">Email Address</label>
			<div class="col-sm-6">
				<input type="email" name="email_id" value="<?php echo $dvar['email_id'];?>" class="form-control" placeholder="Email Address">
			</div>
		</div>
        <div class="clearfix"></div>
        <br/>
        
        <div class="form-group">
			<label class="col-sm-4 control-label" for="email">Address</label>
			<div class="col-sm-6">
				<input type="text" name="address" value="<?php echo $dvar['address'];?>" class="form-control" placeholder="Address">
			</div>
		</div>
        <div class="clearfix"></div>
        <br/>

		<div class="form-group">
			<label class="col-sm-4 control-label" for="phone">Phone Number</label>
			<div class="col-sm-6">
				<input type="text" name="phone" value="<?php echo $dvar['phone'];?>" class="form-control" placeholder="Phone Number">
			</div>
		</div>
                                <div class="clearfix"></div>
                                <br/>

		<div class="form-group">
			<label class="col-sm-4 control-label" for="username">Username</label>
			<div class="col-sm-6">
				<input type="text" name="username" value="<?php echo $dvar['username'];?>" class="form-control" placeholder="Username">
			</div>
		</div>
                                <div class="clearfix"></div>
                                <br/>

		<div style="margin-left:30%">		
        <input class="btn btn-success"  type="submit" name="edit" value="Save">
         <a class="btn btn-success" href="user_profile.php">Cancel</a>
         </div>
	</form>
        
        </div>
				
			</div>
		</div>
		</form>
	</div>
	
	<br><br><br><br>
</div>
<hr>



<!---------------------------FEEDBACK ----------------- -->
<?php include "include/feedback.php";?>

<?php include "./include/footer.php";?>

</body>
</html>