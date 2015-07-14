<?php
	require_once("init.php");
	require_once("config_db.php");
	require_once("config.php");
	$tabl = 'user';
	$tab2 = 'project';
	$item = 'User';
	$page_parent = 'profile.php';
	$id = mysql_real_escape_string($_GET['id']);
	
	if($user_status <> 1){
		header("location:index.php");
	}
$profile="active";

$selected=mysql_query($category);	
	$sql = "SELECT * from $tabl where uniq_id='$uniqc'";
	$exec = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_assoc($exec);
	
	//print_r($fetch);
	$dvar['first_name'] = $fetch['first_name'];
	$dvar['last_name']  = $fetch['last_name'];
	$dvar['category']   = $fetch['category'];
	$dvar['category1']   = $fetch['category1'];
	$dvar['category2']   = $fetch['category2'];
    $dvar['address']    = $fetch['address'];
	$dvar['firm']       = $fetch['firm'];
	$dvar['city']       = $fetch['city'];
	$dvar['area']       = $fetch['area'];
	$dvar['experience'] = $fetch['experience'];
	$dvar['website']    = $fetch['website'];
	$dvar['email_id']   = $fetch['email_id'];
	$dvar['username']   = $fetch['username'];
	$dvar['phone']      = $fetch['phone'];
	$dvar['image']      = $fetch['image'];
	$dvar['about_me']      = $fetch['about_me'];
	

    if(isset($_POST['edit'])){
	$dvar['first_name'] = $_POST['first_name'];
	$dvar['last_name']  = $_POST['last_name'];
	$dvar['category']   = $_POST['category'];
	$dvar['category1']   = $_POST['category1'];
	$dvar['category2']   = $_POST['category2'];
	$dvar['address']    = $_POST['address'];
	$dvar['firm']       = $_POST['firm'];
	$dvar['city']       = $_POST['city'];
	$dvar['area']       = $_POST['area'];
	$dvar['experience'] = $_POST['experience'];
	$dvar['website']    = $_POST['website'];
	$dvar['phone']      = $_POST['phone'];
	$dvar['email_id']   = $_POST['email_id'];
	//$dvar['username']   = $_POST['username'];
	$dvar['about_me']   = $_POST['about_me'];
	
	//$dvar['image'] = $fetch['image'];
	//print_r($dvar);die;
	
    if($dvar['first_name'] == ''){
		$flag[1] = 'r';
		}
		else if($dvar['category'] == ''){
		$flag[82] = 'r';
		}
    else if($dvar['address'] == ''){
		$flag[24] = 'r';
		}
	else if($dvar['firm'] == ''){
		$flag[88] = 'r';
		}
	else if($dvar['city'] == ''){
		$flag[89] = 'r';
		}
	else if($dvar['area'] == ''){
		$flag[90] = 'r';
		}
	else if($dvar['experience'] == ''){
		$flag[91] = 'r';
		}				
    else if($dvar['phone'] == ''){
		$flag[85] = 'r';
		}
	else if($dvar['email_id'] == ''){
		$flag[3] = 'r';
		}
		
		else if($dvar['about_me'] == ''){
		$flag[7] = 'r';
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
	
	//echo $file;die;
	if(!empty($flag)){
		$flag_r = 'r';
	}
	else{
		if($file == '1'){
			$rand1 = random_generator(10);
			$image_name = $rand1.'.'.$ext;
			$path = "img/".$image_name;
		}
		
		 $sql_s = "select * from $tabl where uniq_id='$uniqc'";
			$exec_s = mysql_query($sql_s);
			$fetch_s = mysql_fetch_assoc($exec_s);

			if($dvar['image_delete'] == 1 && $file <> '1'){
				unlink('img/'.$fetch_s[$file_field]);
				$image_name = '';
				$sql_file = "$image_name";
			}
			if($file == '1'){
				unlink('img/'.$fetch_s[$file_field]);
				$sql_file = "$image_name";
			}
			if($file == '1'){
				//$add_dvar = array('image' => $sql_file);
				$dvar['image'] = $sql_file;
			}
			else{
				$add_dvar = array('time' => time());
			}
			//print_r($dvar);die;  		
		$sql = "UPDATE $tabl SET ".update_query($dvar, $add_dvar, $remove_dvar, $change_dvar)." where uniq_id='".$uniqc."'" or die(mysql_error());
		//echo $sql;die;
			mysql_query($sql);
			//echo $file;die;
		
			if($file == 1){
				copy($_FILES[$file_field][tmp_name], $path);     //  upload the file to the server
    			chmod("$path",0777);                 // set permission to the file.                // set permission to the file.
				$thumb = 'img/'.$image_name;
       			$ext = pathinfo($thumb, PATHINFO_EXTENSION);
				$max_width=270; // Fix the width of the thumb nail images
				$max_height=270; // Fix the height of the thumb nail imaage
				$extn = $ext;	$final = $thumb;	$res = '0';
				include("include/image_resize.php");   // set permission to the file.
			}
			
			$fg = 'ed';
			header("location:designer_profile.php");
		
	}
}
$group="select * from $tab2 where user_id='".$fetch_user['uniq_id']."' group by category" or die(mysql_error());
$raw_group=mysql_query($group);


if($_GET['do']=='delete'){
	$id=$_GET['id'];
	$sql="select * from project_images where images_id='$id'";
	$exe=mysql_query($sql);
	$sql2="select * from project where id='$id'";
	$exe2=mysql_query($sql2);
	while($fetch_img=mysql_fetch_assoc($exe)){
		unlink('img/'.$fetch_img['image']);
				}
				
	while($fetch_ppro=mysql_fetch_assoc($exe2)){
		unlink('img/'.$fetch_ppro['project_image']);
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
	

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>
	<?php echo $site_name;?>
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset = "UTF-8">
<link rel ="stylesheet" href="css/bootstrap.min.css">
<link rel ="stylesheet" href="./css/Style.css">
<link rel ="stylesheet" href="cssp/font-awesome.min.css">
<script src = "js/jquery.js" type="text/javascript"></script>
<script src = "js/jquery-ui.min.js" type="text/javascript"></script>
<script src ="js/bootstrap.min.js" type="text/javascript"></script>
<script src = "js/jquery.lazy.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.uploadfile.min.js"></script>
<script type="text/javascript" src="js/jsfunction.js"></script>
<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/uploadfile.css">
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>

<style>
.footer-menu li a:hover{color:white; text-decoration:none; } 
</style>
</head>

<style type="text/css">
	.form-control{
		margin: 10px;
	}
	.dropdown-menu{
		position: relative;
	}
</style>

<script type="text/javascript">
	$(document).ready(function(){
		$('[data-toggle=tooltip]').tooltip();
	});
</script>

<body style="font-family:'Ubuntu',sans-serif;font-size:15px;" onLoad="sel_city()">
<div class="container-fluid" id="wrapper">
</div>

<!-- ---------------------Header ------------------------------- -->
<?php include "./include/header.php" ?>

<!-- ---------------------Main ------------------------------- -->
<div id="main" style="background:#fff;margin:20px;height:auto;width:95vw;opacity:1;padding:20px;text-align:center;">
	<h2 style="color:#C16700;">Edit Your Profile</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" class="form-horizontal" role="form" enctype="multipart/form-data">

	<div style="float:left;margin:10px;margin-left:30px;width:20%;">
		<div style="padding: 7px;border:1px solid rgba(255,255,255,0.5);box-shadow: 0 0 2px 2px rgba(0,0,0,0.2);height:200px;width:180px;margin-left:37px;"><img src="img/<?php if(empty($fetch_user['image'])){ echo 'no_img.jpg'; }else{ echo $fetch_user['image'];}?>" height="100%" width="100%"></div><br>
<!--		<button class="btn btn-warning">Change Profile Picture</button>
-->        <input class="btn btn-warning" style="width:200px; margin-left:37px" type="file" name="image">
	</div>
	<div style="float:left;width:50%;margin-left:20px;">
            <div class="col-sm-8">
                    <?php echo print_messages($flag, $error_message, $success_message);?> 	
                </div>
        		<input type="text" class="form-control" name="first_name" value="<?php echo $dvar['first_name'];?>" placeholder="First Name">
				<input type="text" class="form-control" name="last_name" value="<?php echo $dvar['last_name'] ;?>" placeholder="Last Name">
				<textarea class="form-control" name="address" placeholder="Address" rows="3"><?php echo $dvar['address'];?></textarea>
				<input type="text" name="firm" value="<?php echo $dvar['firm'];?>" class="form-control" placeholder="Enter your firm name">
				<input type="text" class="form-control" name="experience" value="<?php echo $dvar['experience'];?>" placeholder="Enter your experience">
				<input type="text" class="form-control" name="website" value="<?php echo $dvar['website'] ;?>" placeholder="Enter your website">
				<input type="text" name="phone" value="<?php echo $dvar['phone'];?>" class="form-control" placeholder="Phone Number">
				<input type="email" name="email_id" value="<?php echo $dvar['email_id'];?>" class="form-control" placeholder="Email Address">
		<textarea class="form-control" name="about_me" placeholder="Description" rows="4"><?php echo $dvar['about_me'];?></textarea>
		<div>
			<span style="float:left;display:block;margin-top:5px;margin-left:10px;margin-right:10px;width:160px;text-align:left;">Choose Your City</span>
			<select class="form-control city" style="width:400px;" name="city" onChange="sel_city()">
              <option value="0" label="Select Your City"></option>
				<?php
			  $select="select * from city where status='1'";
			  $main=mysql_query($select);
			   while ($row_main = mysql_fetch_assoc($main)) { ?>
                    <option value="<?php echo $row_main['city'];?>" <?php if($row_main['city'] == $dvar['city']){ echo "selected='seleccted'";} ?>><?php echo $row_main['city'];?></option>
                    
                     <?php }?>
			</select>
		</div>
		<div>
			<span style="float:left;display:block;margin-top:5px;margin-left:10px;margin-right:10px;width:160px;text-align:left;">Choose Your Area</span>
			<select class="form-control area" name="area" style="width:400px;">
              <option value="0" label="Select Your Area"></option>
			</select>
		</div>
		<div>
			<span style="float:left;display:block;margin-top:5px;margin-left:10px;margin-right:10px;width:160px;text-align:left;">Choose Your Category</span>
			<select class="form-control" name="category" style="width:400px;">
				 <?php 
				 
				 $cat ="select * from main_cat where status='1'";
                 $query_cat=mysql_query($cat);
			  while ($row_cat = mysql_fetch_assoc($query_cat)) { ?>
                    <option value="<?php echo $row_cat['id'];?>" <?php if($row_cat['id'] == $dvar['category']){ echo "selected='selected'";} ?>><?php echo $row_cat['name'];?></option>
                    
                     <?php }?>
			</select>
		</div>
        <div>
			<span style="float:left;display:block;margin-top:5px;margin-left:10px;margin-right:10px;width:160px;text-align:left;"> Category2</span>
			<select class="form-control" name="category1" style="width:400px;">
				 <?php $cat ="select * from main_cat where status='1'";
                 $query_cat=mysql_query($cat);
			  while ($row_cat = mysql_fetch_assoc($query_cat)) { ?>
                    <option value="<?php echo $row_cat['id'];?>" <?php if($row_cat['id'] == $dvar['category1']){ echo "selected='selected'";} ?>><?php echo $row_cat['name'];?></option>
                    
                     <?php }?>
			</select>
		</div>
        <div>
			<span style="float:left;display:block;margin-top:5px;margin-left:10px;margin-right:10px;width:160px;text-align:left;"> Category3</span>
			<select class="form-control" name="category2" style="width:400px;">
				 <?php $cat ="select * from main_cat where status='1'";
                 $query_cat=mysql_query($cat);
			  while ($row_cat = mysql_fetch_assoc($query_cat)) { ?>
                    <option value="<?php echo $row_cat['id'];?>" <?php if($row_cat['id'] == $dvar['category2']){ echo "selected='selected'";} ?>><?php echo $row_cat['name'];?></option>
                    
                     <?php }?>
			</select>
		</div>
	</div>
	<div style="clear:both;"></div>
	<div style="margin-top:20px;"></div>
	<button type="submit" name="edit" class="btn btn-success">Save Changes</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="designer_profile.php" class="btn btn-danger">Go Back</a>
    </form>
</div>

<!-- ---------------------Footer ------------------------------- -->
<?php include "include/footer.php";?>
		
</body>
</html>