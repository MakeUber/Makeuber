<?php
require_once("../init.php");
require_once("../config_db.php");
require_once("include/protecteed.php");

$tabl = 'gallery';
$item = '';
$page_parent = 'manage_gallery.php';
$query_string = array("search" => $_GET['search'], "page" => $_GET['page'], "category" => $_GET['category'], "do" => $_GET['do'], "id" => $_GET['id'],"uniq" => $_GET['uniq']);
foreach($query_string as $k=>$v){
	$q_string .= "&$k=$v";
}

$id = mysql_real_escape_string($_GET['id']);
$relation = mysql_real_escape_string($_GET['relation']);


if($_GET['do'] == 'edit'){
	$sql = "SELECT * from $tabl where id='".$id."'";
	$exec = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_assoc($exec);
	$dvar['description'] = $fetch['description'];
	//$image = $fetch['image'];
	$dvar['status']=$fetch['status'];
	$uniq = $fetch['uniq'];
}

if($_POST['submitbut'] == 'Save'){
	$dvar['description'] = $_POST['description'];
	$dvar['image_delete'] = $_POST['image_delete'];
	$dvar['status']=$_POST['status'];
	//$image = $fetch['image'];
    
	
	if($dvar['description'] ==''){$flag[3]='r';}
	
	if(!empty($flag)){
		$flag_r = 'r';
	}
	else{
		
			if($_GET['do'] =='edit'){
			$add_dvar = array('time' => time());
			$remove_dvar = array('image_delete');
//			$change_dvar = array('status' => '0');
			$sql = "UPDATE $tabl SET ".update_query($dvar, $add_dvar, $remove_dvar, $change_dvar)." where id='".$id."'";
			$fg = 'ed';
		}
		else{
			$uniq = random_generator(10);
			$add_dvar = array('uniq' => $uniq,'time' => time());
			$remove_dvar = array('image_delete');
//			$change_dvar = array('status' => '1');
			list($insert_q[0], $insert_q[1]) = insert_query($dvar, $add_dvar, $remove_dvar, $change_dvar);
			$sql = "INSERT into $tabl(sort, $insert_q[0]) SELECT max(sort)+1, $insert_q[1] from $tabl";
			$fg = 'ad';
		}
		if(mysql_query($sql)){
			if($_GET['do'] == 'edit'){ 
			    	$sql = "select * from files where relation='".$uniq."'";
					$exec = mysql_query($sql);
					$j = 1;
					while($fetch = mysql_fetch_assoc($exec)){
					$allowed_ext = array("gif","jpg","jpeg","png","GIF","JPG","JPEG","PNG");
					$file_field = 'file_'.$fetch['id'];
					
					// $_FILES[$file_field][name];
					//$file_field= $_FILES[pic][name];
					$validate = validate_file($file_field,$allowed_ext, '0', '0');
					//print_r($validate);
					$validate1 = validate_file($file_field1,$allowed_ext, '0', '1');
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
							$path = "file/".$image_name;
					 	    $sql_up = "update files set location='".$path."', file_name='".'file/'.$image_name."' where id='".$fetch['id']."'";
							if($exec_up = mysql_query($sql_up)){
								if($file == '1'){
									@copy($_FILES[$file_field][tmp_name], '../'.$path);     //  upload the file to the server
									@chmod("$path",0777);                 // set permission to the file.
								}
							}
	
						}
					}
				}
			}
				
				if($_FILES[pic][name] != ''){
					$uniq_id = multiple_files('pic', ROOT_DIR.'/file/', 'file/', $uniq, $_SERVER['REMOTE_ADDR'], 'doc_name');
				}
				$flag[$fg] = $item;
			}
			else{
				$flag['q'] = 'r';//echo mysql_error();
			}
		}
}

// delete images
$item1 = "Product image";
if($_GET['go'] == 'delete' && ctype_digit($_GET['field_id'])){
	 $field_id = $_GET['field_id'];
     $sql = "SELECT * from files where id='".$field_id."'";
	 $exec_f= mysql_query($sql);
	
	while($fetch_image=mysql_fetch_assoc($exec_f)){
	 $id=$fetch_image['id'];
	 $img1=$fetch_image['location'];
	 $file_name2=$fetch_image['file_name'];
	 @unlink('../'.$img1);
	 @unlink('../file/'.$file_name2);
	}
	

   $sql_d = "DELETE from files where id='".$field_id."'";
	if(mysql_query($sql_d)){
		$flag['d'] = $item1;
	}
	else{
		$flag['q'] = 'r';
	}
	
}

if($_GET['do'] == 'edit' && ($flag[$fg] <> '')){
	$sql = "SELECT * from $tabl where id='$id'";
	$exec = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_assoc($exec);
	$dvar['name'] = $fetch['name'];
	$dvar['description'] = $fetch['description'];
	$dvar['status']=$fetch['status'];
	//$image = $fetch['image'];
	$uniq = $fetch['uniq'];
}

//images
$sql_imges = "select count(*) from files where relation='".$uniq."'";
$exec_imges = mysql_query($sql_imges);
$img = mysql_fetch_row($exec_imges);

// 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add/Edit<?php echo $item; ?></title>
<?php include("include/head.php"); ?>
<script type="text/javascript">
	var i;
	$(document).ready(function(){
		$('#tb_clone_click').click(function(){
			$("#table-data tr:first").clone().find("input").each(function() {
				$(this).val('').attr('id', function(_, id) { return id + i });
			}).end().appendTo("#table-data");
		});
	});
	
</script>
</script>
<?php
if($flag[$fg] <> ''){
?>
<meta http-equiv="refresh" content="3; URL=<?php echo $page_parent."?5=5".$q_string; ?>">
<?php } ?>
</head>

<body>
<div align="center">
  <div class="container">
    <?php
    $pg_active['company'] = 'active';
    require_once('include/header.php'); 
    ?>
    <div class="content">
      <div style="margin-top:10px">
        <?php
        echo print_messages($flag, $error_message, $success_message);
		?>
      </div>
      <div class="form5">
        <form id="add" name="add" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?5=5<?php echo $q_string; ?>" enctype="multipart/form-data" onSubmit="return checkvalidation();">
          <table width="1150" border="0" cellpadding="5">
            <tr>
              <td align="right" class="label_form">Name: </td>
              <td><input name="name" id="name" type="text" class="input_text" value="<?php echo $dvar['name'];?>"/>
                <br class="clear" /></td>
            </tr>
            <tr>
              <td valign="top" align="right" class="label_form">Description: </td>
              <td style="width:860px;"  class="txt1input"  ><textarea id="description" name="description" style="height:150px; width:500px; margin-top:0px;"><?php echo $dvar['description'];?></textarea>
                <br class="clear" /></td>
            </tr>
            <?php
					if($_GET['do'] == 'edit' || $flag[$fg] <> ''){
						
					//$sql_field = "select * from files where relation='".$uniq."' order by id asc";
					$sql_field = "select * from files where relation='".$uniq."'";
					$exec_field = mysql_query($sql_field);
					$n = @mysql_num_rows($exec_field);
					$i=1;
					while($fetch_field = @mysql_fetch_assoc($exec_field)){ 
				   ?>
            <tr>
              <td align="right" valign="top" class="label_form">Image<?php echo $i; ?> : </td>
              <td><div class="pic"> <img src="<?php if($fetch_field['location'] <> ''){echo "../".$fetch_field['location'];}else{echo 'images/1.png';} ?>" alt="images/1" width="98" height="98" <?php echo $fetch_field['location']; ?> /><br />
                </div>
                <div class="edit1">
                  <input  name="file_<?php echo $fetch_field['id'];  ?>" type="file" value='<?php echo $fetch_field['pic']; ?>' class='edit1'/>
                  <div  style="margin-left:3px; float:left; margin-top:7px; width:3px !important; " >
                    <div class="view" style=" width:3px !important;  "> <a href="<?php echo $_SERVER['PHP_SELF'].'?do=edit&id='.$fetch['id'].'&temp_id='.$fetch_field['rel_id'].'&go=delete&field_id='.$fetch_field[id]; ?>" title="Delete" onClick="return dele_fun();"> <img src="images/delete.png" /> </a> </div>
                  </div>
                  <div class="clear"></div>
                </div></td>
              <?php
				  $i++;
				   }
				}
				?>
            </tr>
            <tr>
              <td class="label_form" style="margin-left:190px"><div id="dynamicInput" style="width:400px; margin-left: -113px; "> 
                  <script language="javascript">
                <?php if($_GET['do'] == 'edit'){ ?>
                            var counter = <?php echo $i; ?>;
                <?php } else{ ?>
                            var counter = 0 ;
                <?php }  ?>
                            var limit = 10;
                            function addInput(divName){
                 if(counter >= limit){
                  alert("Error: Maximium 10 images upload ");
                 }
                 else{
                    var newdiv = document.createElement('div');
                    newdiv.innerHTML = "<div style='margin-left: 206px;padding-top: 5px;padding-right: 14px;float: left;width: 600px;' >Image" + (counter + 1)+":&nbsp;</div>" + "<div style='width: 203px;margin-left: -623px;float: left;'><input type='file' name='pic[]' value='<?php echo $dvar['pic']; ?>' class='edit1' style='margin-left: 114px;'></div> <br class='clear'>";
                    document.getElementById(divName).appendChild(newdiv);
                    counter++;
                  }
                }
            </script> 
                </div></td>
            </tr>
            <tr>
              <td align="right" class="label_form"><div class="view1">Image:</div></td>
              <td><div class="btn">
                  
                  <script language="javascript">
				//	if(counter == 0){alert("Error: Please upload minimum one image")}
					</script> 
                </div></td>
            </tr>
                       <tr>
              <td></td>
              <td><div class="btn">
              <input style="margin-left:20px" type="button" name="add" value="Add Image" onClick="addInput('dynamicInput');" class="button" >
              <input style="margin-left:190px;" type="button" name="add" value="Add Row" id="tb_clone_click" class="button" >
                  <input class='button' name='submitbut' value='Save' type='submit' />
                  <a class="a_button" href="<?php echo $page_parent."?5=5".$q_string; ?>">Cancel</a> </div></td>
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
