<?php
require_once("init.php");
require_once("config_db.php");
require_once("config.php");
$tabl = 'user';
$tab2 = 'project';
$tab3 = 'choose_membership';
$tab5 = 'main_cat';
$item = 'User';
$item2 = 'Project';
$profile="active";
$namep = $_SERVER['PHP_SELF'];
if($user_status <> 1){
		header("location:Index.php");
	}
	//print_r($_SESSION);die;
	//////////////////////////////////////membership session insert into db/////////////////////////////////////////////
if(($_SESSION['order'])<>''){
$dvar['session']= $_SESSION['order'] ['session']; 
$dvar['plan'] = $_SESSION['order'] ['id'];	
$mtype['membership'] = $_SESSION['order'] ['id'];
	$dvar['user_id'] = $user_uniq;
	$sql="select * from $tabl where uniq_id='$user_uniq'";

	$exec = mysql_query($sql);
	if($exec){
//	$remove_dvar = array('rpassword');
//	$change_dvar = array('status' => '1');
 $sql = "UPDATE $tabl SET ".update_query($mtype)." where uniq_id='".$user_uniq."'";

	$add_dvar = array('time' => time(), 'status' => '1');
//	$remove_dvar = array('rpassword');

//			$change_dvar = array('status' => '1');


	list($insert_q[0], $insert_q[1]) = insert_query($dvar, $add_dvar, $remove_dvar, $change_dvar);

	$sql1 = "INSERT into $tab3(sort, $insert_q[0]) SELECT max(sort)+1, $insert_q[1] from $tab3";
 mysql_query($sql1);
 mysql_query($sql);
	$fg = 'ad';
	
	$user = $_SESSION['user'];
	$cart = $_SESSION['cart'];
	session_destroy();
	session_start();
	$_SESSION['user'] = $user;
	$_SESSION['cart']= $cart;
//	unset($_SESSION['order']);
//	session_destroy(); 

		$users="Select * from $tabl where uniq_id='".$user_uniq."'";
$selects=mysql_query($users);	
$row_cats = mysql_fetch_assoc($selects);
$email=$row_cats['email_id'];

			  
			$subject = "Makeuber Order Confirmation is\n";
     		 $message_f ='<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#8d8e90">
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
    <P>Your Account Has Been Upgraded</p>
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
			 $from  = "From: MakeUber  <reachus@makeuber.com>";
			  $from .= ' MIME-Version: 1.0' . "\r\n";
			 $from .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			 if(mail($email, $subject, $message_f, $from)){
				$flag['g'] = '6';
				
			 }
			 else{
			  $flag['e'] = "r";
			 }
	
			}

	
		
	
}
//////////////////////////////////////////////////membership session///////////////////////////////////
 $user="Select * from $tabl where uniq_id='$uniqc'" or die(mysql_error());
 
$select=mysql_query($user);	
$row_cat = mysql_fetch_assoc($select);
$email=$row_cat['email_id'];
$ini=base64_encode($uniqc);

//$group="select $tab2.*, category.category_name from $tab2 left outer join category on $tab2.category=category.id where $tab2.user_id='".$fetch_user['uniq_id']."' group by category and category.status='1'";	
 $group="select * from $tab2 where user_id='".$fetch_user['uniq_id']."' group by category";
$raw_group=mysql_query($group);
$categ="select $tabl.*, $tab5.* from $tabl left outer join $tab5 on $tabl.category = $tab5.id where $tabl.status='1' and $tab5.status='1' group by $tab5.name";
$cat2=mysql_query($categ);
$row_main= mysql_fetch_assoc($cat2);

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

////////////////////////////////////////////Reset Password//////////////////////////////////////
	if(isset($_POST['Reset'])){
		$users="Select * from $tabl where uniq_id='$uniqc'" or die(mysql_error());
$selects=mysql_query($users);	
$row_cats = mysql_fetch_assoc($selects);
$email=$row_cats['email_id'];

			  
			$subject = "Reset Forgot Password is\n";
     		 $message_f ='<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#8d8e90">
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
			 $from  = "From: MakeUber  <reachus@makeuber.com>";
			  $from .= ' MIME-Version: 1.0' . "\r\n";
			 $from .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			 if(mail($email, $subject, $message_f, $from)){
				$flag['g'] = '6';
				
			 }
			 else{
			  $flag['e'] = "r";
			 }	
		}
		if(isset($_POST['img_upload'])){
			//print_r($_FILES);die;	
			$file_name = $_FILES['image']['name'];
			if(move_uploaded_file($_FILES['image']['tmp_name'],'img/'.$_FILES['image']['name'])){
				$sql = "update user set image='".$file_name."' where uniq_id='$user_uniq'";
				$exe = mysql_query($sql);
				if(!$exe){ echo mysql_error();}
			}else{
			echo "Error Uploading file";die;	
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
<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>

<style type="text/css">
	#profile_pic{
		height:200px;
		width: 180px;
		margin: 20px;
		padding: 7px;
		border:1px solid rgba(255,255,255,0.5);
		box-shadow: 0 0 2px 2px rgba(0,0,0,0.2);
		margin-top: 60px;
	}
	.change_pic{
		position:absolute;
		z-index:20;
		width:183px;
		height:50px;
		background:rgba(0,0,0,0.5);
		opacity:0.7;
		margin-left:-10px;
		top:372px;
		color:#fff;
		cursor: pointer;
		padding-top:10px;
		text-align:center;
		display: none;
		transition:all 0.4s;
	}
	#profile_pic:hover .change_pic{
		display: block;
	}
	#info{
		float: left;
		margin-left: 20px;
	}
	.bio span{
		padding:4px;
		display: block;
		color:#664A1E;
	}
	.project-wrap{
		float: left;
		padding:10px;
		margin:10px;
		text-align: center;
		border:1px solid #ccc;
		font-size:14px;
		color: #A01D00;
	}
	.portfolio{
		margin:5px;
		text-align: center;
		font-family: 'Dosis',sans-serif;
		padding:10px;
		border: 1px solid #aaa;
		box-shadow: 0 0 1px 1px #ccc;
	}
	.portfolio img{
		cursor: pointer;
		border-radius: 4px;
		margin-bottom: 5px;
	}
	.desc{
		background:rgba(0,0,0,0.3);
		opacity:0.7;
		color: #fff;
		position: absolute;
		text-align: center; 
		vertical-align: center;
		padding:10px;
		padding-top: 40px;
		font-family: 'Ubuntu',sans-serif;
		display: none;
		cursor: pointer;
	}
	.portfolio:hover .desc{
		display: block;
	}
	.btn-default{
		background: rgba(130,102,37,0.6);
		color: #422913;
	}
	.pullright { position:relative; left:370px; }
	
	.footer-menu li a:hover{color:white; text-decoration:none;}
</style>

<script type="text/javascript">
	$(document).ready(function(){
		$('[data-toggle=tooltip]').tooltip();
		$('.desc').each(function(){
			$(this).width($(this).parent().width());
			var top=($(this).parent().offset().top+1)+'px';
			$(this).css('top',top);
			$(this).height($(this).parent().height()-29);
			var left=($(this).parent().offset().left)+'px';
			$(this).css('left',left);
		});
		$('#img_upload').click(function(){
			alert($('#img_add').serialize());
		});
	});
</script>
    <script type="text/javascript">
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
<?php    if($flag['g'] <> '' || $flag['d'] <> ''){
?>
<meta http-equiv="refresh" content="3; URL=<?php echo $_SERVER['PHP_SELF']?>">
<?php } ?>
</head>
<body style="font-family:'Ubuntu',sans-serif;font-size:15px;">

<div class="container-fluid" id="wrapper">
</div>

<!-- ---------------------Header ------------------------------- -->
<?php include "./include/header.php" ?> 
<!-- ---------------------MODAL ------------------------------- -->

<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
				</button>
				<div class="modal-title"><h3>Upload a new photo</h3></div>
			</div>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
			<div class="modal-body">
            <input type="file" name="image" class="btn btn-warning"><br/>
				<button type="submit" name="img_upload" class="btn btn-warning">Upload Photo</button>

                <br><br>
				<div> Uploaded image goes here </div>
			</div>
            </form>
		</div>
	</div>
</div>

<!-- ---------------------Main ------------------------------- -->
<div id="main" style="background:#fff;margin:20px;height:auto;width:95vw;opacity:1;padding:20px;padding-left:60px;">
	<div style="float:left;">
		<div id="profile_pic">
			<img src = "img/<?php if(empty($row_cat['image'])){ echo 'no_img.jpg'; }else{ echo $row_cat['image'];}?>" height="100%" width="100%">
			<div class="change_pic" data-toggle="modal" data-target="#profileModal">Change Profile Picture</div>
		</div>
		<a href="designer_profile_edit.php" class="btn btn-default" style="margin-left:40px;">Edit Your Profile</a><br>
                            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data" >

		<button class="btn btn-default" name="Reset" style="margin-left:40px;margin-top:10px;">Change Password</button>
        </form>

	</div>
	<div id="info">
		<div>
                  <p style="text-align:center"> <?php echo print_messages($flag, $error_message, $success_message);?></p>

        <h3 style="float:left;color:#EA7844">Hello <?php echo $row_cat['first_name'];?>! Here's your Profile</h3>

        <a href="upgrade_membership.php" style="float:left;margin-left:100px;margin-top:20px;" class="btn btn-default">Upgrade Membership</a></div><div style="clear:both"></div>
         <?php
         // print_r($row_cat);
          $sql_cat="select * from main_cat where id='".$row_cat['category']."'";
          $exec_cat = mysql_query($sql_cat);
          $fetch_cat = mysql_fetch_assoc($exec_cat);
          //print_r($fetch_cat);
          ?>
		<span class="bio" style="float:left;margin-top:30px;display:block; width:380px;">
			<span>Name : <?php echo $row_cat['first_name'];?>&nbsp;<?php echo $row_cat['last_name'];?></span>
			<span>Address : <?php if($row_cat['address'] == ''){;?>Not Provided <i class="fa fa-exclamation-triangle"></i><?php }else{ echo $row_cat['address'];}?></span> 
			<span>Name of the Firm : <?php if($row_cat['firm'] == ''){;?>Not Provided <i class="fa fa-exclamation-triangle"></i><?php }else{ echo $row_cat['firm'];}?></span>
			<span>City : <?php if($row_cat['city'] == ''){;?>Not Provided <i class="fa fa-exclamation-triangle"></i><?php }else{ echo $row_cat['city'];}?></span>
			<span>Category : <?php echo $fetch_cat['name'];?></span>
			<span>Experience :<?php echo $row_cat['experience'];?> Years</span>
			<span>Website :<?php if($row_cat['website'] == ''){;?>Not Provided <i class="fa fa-exclamation-triangle"></i><?php }else{ echo $row_cat['website'];}?></span>
               <?php if ($row_cat['membership']<>0){?>
                <div class="pullright"> <a class="btn btn-danger btn-md col-sm-offset-2" href="project.php">Search project</a> </div>
                <?php }?>
		</span>
		<span class="bio" style="float:left;margin-left:108px;margin-top:30px;display:block;">
			<span>Membership Type : <?php if ($row_cat['membership']<>0){
				 $sql_member = "select * from membership_type where id='".$row_cat['membership']."'";
				 $exec_member = mysql_query($sql_member);
				 $fetch_member = mysql_fetch_assoc($exec_member);
				 echo $fetch_member['type'];}else{ echo "Free";}?></span>
			<span>Contact No. : <?php echo $row_cat['phone'];?></span>
			<span>Email : <?php echo $row_cat['email_id'];?></span>
			<span style="width:350px;">Description :<?php echo $row_cat['about_me'];?>!</span>
		</span>
	</div>
	<a href="project.php" style="float:left;margin-left:450px;margin-top:40px;background-color:#E16961;" class="btn btn-default"> Search Projects </a> </div></div style="clear:both"> </div>
	<div style="clear:both;"></div><br><br><hr><br><br>
	
	<div>
		<h3 style="float:left;margin-left:60px;color:#EA7844">Your Portfolio</h3><a href="add_project.php" style="float:left;margin-left:100px;margin-top:20px;margin-bottom:20px;" class="btn btn-default add_button" data-toggle="tooltip" data-placement="top" title="Click to add projects">Add Projects</a><div style="clear:both"></div>
             <?php
	 while ($cat_group = mysql_fetch_assoc($raw_group)){ 
	 
	 $sql_cat = "select * from category where id='".$cat_group['category']."'";
	 $exec_cat = mysql_query($sql_cat);
	 $fetch_cat = mysql_fetch_assoc($exec_cat);
	 echo "<h3>".$fetch_cat['category_name']."</h3>"; 
		  ?>
     
    <?php
	$category="Select * from $tab2 where category='".$cat_group['category']."' and user_id='".$fetch_user['uniq_id']."' order by sort ASC";
 	$selected=mysql_query($category);
	
	while ($row_gory = mysql_fetch_assoc($selected)){?>

		<div class="project-wrap">
			<?php echo $row_gory['project_name'];?>
			<div class="portfolio">
				<img src="./img/<?php if(empty($row_gory['project_image'])){ echo 'no_img.jpg'; }else{ echo $row_gory['project_image'];}?>" height="240px" width="220px">
				<div class="desc">Description -- <?php echo substr($row_gory['description'],0,600);?></div>
			</div>
			<a  href="edit_project.php?do=edit&id=<?php echo $row_gory['id'];?>" class="btn btn-primary">Edit</a>
			<a  href="<?php echo $namep.'?do=delete&id='.$row_gory['id'].''; ?>" value="Delete" name="delete" onclick="return archive_fun();" class="btn btn-primary">Delete</a>
		</div>
        
        <?php }}?>
		
	</div>
</div>

<!-- ---------------------Footer ------------------------------- -->
<?php include "./include/footer.php"?>

</body>
</html>