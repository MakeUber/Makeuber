<?php
include "../init.php";// include init
include "../config_db.php";// database connection details stored here
include "include/protecteed.php";// page protect function here
$time = time();
$tabl = 'user';
$item = 'User';
$password = '';
$page_parent = 'manage_user.php';

$query_string = array("search" => $_GET['search'], "page" => $_GET['page'], "rel_id" => $_GET['rel_id'], "do" => $_GET['do'], "id" => $_GET['id']);
foreach($query_string as $k=>$v){
	$q_string .= "&$k=$v";
}

$id = mysql_real_escape_string($_GET['id']);
$relation = mysql_real_escape_string($_GET['relation']);

if($_GET['do'] == 'edit'){
	$sql = "SELECT * from $tabl where id='$id'";
	$exec = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_assoc($exec);
	$image = $fetch['image'];
	$dvar['first_name'] = $fetch['first_name'];
	$dvar['last_name'] = $fetch['last_name'];
	$dvar['email_id'] = $fetch['email_id'];
	$dvar['password'] = $fetch['password'];
	$dvar['address'] = $fetch['address'];
	$dvar['phone'] = $fetch['phone'];
	
	$dvar['status'] = $fetch['status'];
	
}

if($_POST['submitbut'] == 'Save'){
	$dvar['first_name'] = $_POST['first_name'];
	$dvar['last_name'] = $_POST['last_name'];
	$dvar['email_id'] = $_POST['email_id'];
	$password = $_POST['password'];
	$dvar['c_password'] = $_POST['c_password'];
	$dvar['address'] = $_POST['address'];
	$dvar['phone'] = $_POST['phone'];
	
	//$dvar['thumb'] = $_POST['thumb'];
	$dvar['status'] = $_POST['status'];
	$dvar['image_delete'] = $_POST['image_delete'];
	
	$fetch_user = "select email from $tabl where email_id='".$dvar['email_id']."' AND id <>'".$id."' and 1 = 1";
	$exec_user  = mysql_query($fetch_user);
	
	/*if($dvar['first_name'] == ''){$flag[26] = "r";}
	else if($dvar['last_name'] == ''){$flag[27] = "r";}
	else if($dvar['email'] == ''){$flag[8] = "r";}
	else if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $dvar['email'])){$flag[9] = 'r';}
	else if(mysql_num_rows($exec_user) != 0){$flag[10] = 'r';}
	else if($password == '' && (strlen($password) < 5)){$flag[108] = 'r';}
	else if($password <> $dvar['c_password']){$flag[109] = 'r';}*/
	
	
	if($dvar['first_name'] == ''){$flag[1] = "r";}
	else if($dvar['last_name'] == ''){$flag[2] = "r";}
	else if($dvar['address'] == ''){$flag[24] = "r";}
	else if($dvar['phone'] == ''){$flag[85] = "r";}
	else if($dvar['email_id'] == ''){$flag[3] = "r";}
	else if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $dvar['email_id'])){$flag[3] = 'r';}

/*	else if($dvar['m'] == ''){$flag[47] = 'r';}
	else if($dvar['d'] == ''){$flag[48] = 'r';}
	else if($dvar['y'] == ''){$flag[49] = 'r';}
*/
	
	
	$allowed_ext = array("gif","jpg","jpeg","png","GIF","JPG","JPEG","PNG");
	$file_field = 'image';
	
	if($_GET['do'] == 'edit'){
		$validate = validate_file($file_field, $allowed_ext, '0', '0');
	}
	else{
		$validate = validate_file($file_field, $allowed_ext, '0', '1');
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
			$path = "../img/".$image_name;
			
		}

		if($_GET['do'] == 'edit'){
			$sql_s = "select * from $tabl where id='$id'";
			$exec_s = mysql_query($sql_s);
			$fetch_s = mysql_fetch_assoc($exec_s);

			if($dvar['image_delete'] == 1 && $file <> '1'){
				unlink('../img/'.$fetch_s[$file_field]);
			
				$image_name = '';
				$sql_file = "$image_name";
				
			}
			if($file == '1'){
				unlink('../pics/'.$fetch_s[$file_field]);
				
				$sql_file = $image_name;
				
			}
			if($dvar['image_delete'] <> 1 && $file <> '1'){ 
				$sql_file = $fetch_s['image'];
				
			}
			
			if($password == ''){
				$add_dvar = array('image'=> $sql_file, 'time' => time() ,'password' => $dvar['password']);
			}
			else{
				$add_dvar = array('image'=>$sql_file, 'time' => time() ,'password' => $password );
			}
			$remove_dvar = array('image_delete','c_password');
//			$change_dvar = array('status' => '0');
			$sql = "UPDATE $tabl SET ".update_query($dvar, $add_dvar, $remove_dvar, $change_dvar)." where id='".$id."'";
			$fg = 'ed';
		}
		else{
			$uniq=random_generator(10);
			$add_dvar = array('image'=>$image_name, 'password' => $password ,'time' => time(),'uniq' => $uniq);
			$remove_dvar = array('image_delete','c_password');
//			$change_dvar = array('status' => '1');
			list($insert_q[0], $insert_q[1]) = insert_query($dvar, $add_dvar, $remove_dvar, $change_dvar);
		    $sql = "INSERT into $tabl(sort, $insert_q[0]) SELECT max(sort)+1, $insert_q[1] from $tabl";
			$fg = 'ad';
		}
		if(mysql_query($sql)){
			
			
			if($file == '1'){
				
				copy($_FILES[$file_field][tmp_name], $path);     //  upload the file to the server
				chmod("$path",0777);                 // set permission to the file.
				$max_width=167; // Fix the width of the thumb nail images
				$max_height=163; // Fix the height of the thumb nail imaage
			
				// $extn $path $final required
				$extn = $ext;	$final = $thumb;	$res = '0';
				//include("include/image_resize.php");
			
			}
			$flag[$fg] = $item;
		}
		else{
			echo mysql_error();//$flag['q'] = 'r';
		}
	}
}

if($_GET['do'] == 'edit' && ($flag[$fg] <> '')){
	$sql = "SELECT * from $tabl where id='$id'";
	$exec = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_assoc($exec);
	$dvar['first_name'] = $fetch['first_name'];
	$dvar['last_name'] = $fetch['last_name'];
	$dvar['email_id'] = $fetch['email_id'];
	$dvar['password'] = $fetch['password'];
	$dvar['area'] = $fetch['area'];
	$dvar['city'] = $fetch['city'];
	$dvar['about_me'] = $fetch['about_me'];
	$dvar['experience'] = $fetch['experience'];
	$image = $fetch['image'];
	$dvar['status'] = $fetch['status'];
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <title>Add/Edit<?php echo $item; ?></title>
 <?php include("include/head.php"); ?>

<link rel="stylesheet" type="text/css" href="../css/dhtmlxcalendar.css">
</link>
<link rel="stylesheet" type="text/css" href="../css/dhtmlxcalendar_dhx_skyblue.css">
</link>
<script src="../js/dhtmlxcalendar.js"></script>
<script>
	var myCalendar;
	function doOnLoad() {
		myCalendar = new dhtmlXCalendarObject(["calendar1","calendar2","calendar3"]);
	}

	function show_hide(id){
		$('#1').hide();
		$('#2').hide();
		$('#3').hide();
		$('#'+id).show();
		return false;
	}

	$(document).ready(function(){
		doOnLoad();
	});
</script>
<?php
if($flag[$fg] <> ''){
?>
<meta http-equiv="refresh" content="3; URL=<?php echo $page_parent."?1=1".$q_string; ?>">
<?php } ?>
 </head>

 <body>
 <div align="center">
   <div class="container">
     <?php
    $pg_active['users'] = 'active';
    require_once('include/header.php'); 
    ?>
     <div class="content">
       <div style="margin-top:10px">
         <?php 
              echo print_messages($flag, $error_message, $success_message);
		?>
       </div>
       <div class="form5">
         <form id="add" name="add" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?do=<?php echo $_GET['do'].'&uniq='.$uniq.'&id='.$_GET['id']; ?>" enctype="multipart/form-data">
           <input name="do" value="<?php echo $do; ?>" type="hidden" />
           <input name="type" value="<?php echo $_GET['type']; ?>" type="hidden" />
           <input name="relation" value="<?php echo $_GET['relation']; ?>" type="hidden" />
           <?php
			if($do == 'edit'){
				echo '<input name="id" value="'.$id.'" type="hidden" />';
			}
			?>
           <table width="100%" border="0" cellpadding="5">
            <tr>
                <td align="right" class="label_form"></td>
                <td>&nbsp;</td>
                <td class="label_form"><u><b><?php echo $item ;?> Profile</b></u></td>
             </tr>
             <tr>
               <td scope="col" align="right" class="label_form">First Name<span class="star">*</span> : </td>
               <td>&nbsp;</td>
               <td scope="col"><input name="first_name" class="input_text" type="text" value="<?php echo $dvar['first_name']; ?>" /></td>
             </tr>
             <tr>
               <td scope="col" align="right" class="label_form">Last Name<span class="star">*</span> : </td>
               <td>&nbsp;</td>
               <td scope="col"><input name="last_name" class="input_text" type="text" value="<?php echo $dvar['last_name']; ?>" /></td>
             </tr>
             
             <tr>
               <td scope="col" align="right" class="label_form">Email ID<span class="star">*</span> : </td>
               <td>&nbsp;</td>
               <td scope="col"><input name="email_id" class="input_text" type="text" value="<?php echo $dvar['email_id']; ?>" /></td>
             </tr>
      <tr>
               <td scope="col" align="right" class="label_form">Address <span class="star">*</span> : </td>
               <td>&nbsp;</td>
               <td scope="col"><input  name="address" class="input_text" type="text" value="<?php echo $dvar['address'];?>"/>
            
               </td>
             </tr>
             <tr>
               <td scope="col" align="right" class="label_form">Contact No: <span class="star">*</span> : </td>
               <td>&nbsp;</td>
               <td scope="col"><input name="phone" class="input_text" type="text" value="<?php echo $dvar['phone'];?>"/>
            
               </td>
             </tr>
              <tr>
               <td scope="col" align="right" class="label_form">Reset password: </td>
               <td>&nbsp;</td>
               <td scope="col"><input  name="password" class="input_text" type="password" value="" /></td>
             </tr>
             
              
             
             <tr>
                <td align="right" valign="top" class="label_form">User Image*: </td>
                 <td>&nbsp;</td>
                <td>
                    <div class="pic">
                    	<img src="<?php if($image <> ''){echo '../img/'.$image;}else{echo 'images/1.png';} ?>" alt="images/1" width="98" height="98" /><br />
                        <?php 
							if($_GET['do'] == 'edit'){
						?>
                       	 <input name="image_delete" value="1" type="checkbox" /> <span class="edit">Delete Image</span>
                        <?php
							}
						?>
                    </div>
                    <div class="edit1">
                        <input name="image" type="file" />
                        <div class="clear"></div>
                        <span class="edit">
                        	(Resolution: 491px X 365px)<br />
                        	(Format Supported: GIF, PNG, JPG)
                        </span>
                    </div>
                </td>
              </tr>
             
              <tr>                
                    <td valign="top" align="right" class="label_form">Status: </td>
                    <td>&nbsp;</td>
                    <td  class="txt1input"><span style="color:#090">Active</span><input type="radio" name="status" value="1" <?php if($dvar['status'] == '1'){echo "checked = 'checked'";}?>  checked="checked"/><span style="color:#f00"> Inactive</span> <input type="radio" name="status" value="0" <?php if($dvar['status'] == '0'){echo "checked = 'checked'";}?> />
                    </td>
              </tr>
             
             <tr>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
               <td><div class="btn">
                   <input class="button" name="submitbut" value="Save" type="submit" />
                   <a class="a_button" href="<?php echo $page_parent."?1=1".$q_string; ?>">Cancel</a> </div></td>
             </tr>
           </table>
         </form>
       </div>
       <?php
	  	 include "include/footerlogo.php";
	  ?>
     </div>
     <div class="clear"></div>
   </div>
 </div>
</body>
</html>
