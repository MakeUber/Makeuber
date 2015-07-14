<?php
require_once("../init.php");
require_once("../config_db.php");
require_once("include/protecteed.php");

$tabl = 'content';
$item = 'About Us';
$page_parent = 'edit_about_us.php';
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
	$dvar['title'] = $fetch['title'];
	$dvar['description'] = $fetch['description'];
	$image = $fetch['image'];
}
if($_POST['submitbut'] == 'Save'){
 	$dvar['title'] = $_POST['title'];
	$dvar['description'] = $_POST['description'];
	$dvar['image_delete'] = $_POST['image_delete'];
		
	if($dvar['title'] == ''){$flag[2] = 'r';}
	else if($dvar['description'] == ''){$flag[3] = 'r';}
	
	/*$allowed_ext = array("gif","jpg","jpeg","png","GIF","JPG","JPEG","PNG");
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
	}*/
	if(!empty($flag)){
		$flag_r = 'r';
	}
	else{
		
			if($file == '1'){
			$rand1 = random_generator(10);
			$image_name = $rand1.'.'.$ext;
			$path = "../pics/".$image_name;
		}

		if($_GET['do'] == 'edit'){
			$sql_s = "select * from $tabl where id='".$id."'";
			$exec_s = mysql_query($sql_s);
			$fetch_s = mysql_fetch_assoc($exec_s);

			if($dvar['image_delete'] == 1 && $file <> '1'){
				unlink('../pics/'.$fetch_s[$file_field]);
				$image_name = '';
				$sql_file = "$image_name";
			}
			if($file == '1'){
				unlink('../pics/'.$fetch_s[$file_field]);
				$sql_file = "$image_name";
			}
			if($dvar['image_delete'] <> 1 && $file <> '1'){ 
				$sql_file = $fetch_s['image'];
			}
			
			$add_dvar = array('image' => $sql_file, 'time' => time());
			$remove_dvar = array('image_delete');
//			$change_dvar = array('status' => '0');
			
			$sql = "UPDATE $tabl SET ".update_query($dvar, $add_dvar, $remove_dvar, $change_dvar)." where id='".$id."'";

			$fg = 'ed';
		}
		else{
			$uniq = random_generator(10);
			$add_dvar = array('uniq' => $uniq, 'image' => $image_name, 'time' => time(),'status' => '1');
			$remove_dvar = array('image_delete');
//			$change_dvar = array('status' => '1');

			list($insert_q[0], $insert_q[1]) = insert_query($dvar, $add_dvar, $remove_dvar, $change_dvar);
			
			$sql = "INSERT into $tabl(sort, $insert_q[0]) SELECT max(sort)+1, $insert_q[1] from $tabl";
			$fg = 'ad';
		}
		if(mysql_query($sql)){
			/*if($file == '1'){
				copy($_FILES[$file_field][tmp_name], $path);     //  upload the file to the server
				chmod("$path",0777);                 // set permission to the file.
			}*/
			$flag[$fg] = $item;
		}
		else{
			echo mysql_error();
		}
	}
}
if($_GET['do'] == 'edit' && ($flag['g'] <> '')){
	$sql = "SELECT * from $tabl where id='$id'";
	$exec = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_assoc($exec);
	$dvar['title'] = $fetch['title'];
	$dvar['description'] = $fetch['description'];
	//$image = $fetch['image'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add/Edit<?php echo $item; ?></title>
<?php include("include/head.php"); ?>
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
    $pg_active['con'] = 'active';
    require_once('include/header.php'); 
    ?>
    <div class="content">
      <div style="margin-top:10px">
        <?php
        echo print_messages($flag, $error_message, $success_message);
		?>
      </div>
      <div class="form5">
        <form id="add" name="add" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?1=1<?php echo $q_string; ?>" enctype="multipart/form-data">
          <table width="950" border="0" cellpadding="5">
            <tr>
              <td align="right" class="label_form"></td>
              <td><u><?php echo $item; ?></u><br class="clear" /></td>
            </tr>
            <tr>
              <td align="right" class="label_form">Title: </td>
              <td><input name="title" type="text" class="input_text" value="<?php echo $dvar['title'];?>"/>
                <br class="clear" /></td>
            </tr>
            <tr>
              <td align="right" class="label_form" valign="top">Description: </td>
              <td><textarea name="description" class="ckeditor"><?php echo $dvar['description'];?></textarea></td>
            </tr>
            
            <!-- <tr>                
                    <td align="right" class="label_form">Image: </td>
                    <td><div class="pic">
                         <img src="<?php if($image <> ''){echo '../pics/'.$image;}else{echo 'images/1.png';} ?>" alt="images/1" width="98" height="98" /><br />
                     <?php if($_GET['do'] == 'edit'){ ?>
                           <input name="image_delete" value="1" type="checkbox" /> <span class="edit">Delete Image</span>
                        <?php } ?>
                        </div>
                        <div class="edit1"><input name="image" type="file" /><div class="clear"></div>
                          <span class="edit">
                            (Resolution: 306px X 365px)<br />
                            (Format Supported: GIF, PNG, JPG)
                          </span>
                        </div>
                    </td>
              </tr>
              -->
              <tr>
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
