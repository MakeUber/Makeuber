<?php
require_once("../init.php");
require_once("../config_db.php");
require_once("include/protecteed.php");

$tabl = 'tutorial';
$item = 'Tutorial';
$page_parent = 'manage_tutorial.php';
$query_string = array("search" => $_GET['search'],"go" => $_GET['tool'], "page" => $_GET['page'], "category" => $_GET['category'], "do" => $_GET['do'], "id" => $_GET['id']);
foreach($query_string as $k=>$v){
	$q_string .= "&$k=$v";
}

$ts= time();
$id = mysql_real_escape_string($_GET['id']);
$relation = mysql_real_escape_string($_GET['relation']);


if($_GET['do'] == 'edit'){
	$sql = "SELECT * from $tabl where id='".$id."'";
	$exec = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_assoc($exec);
	$dvar['title'] = $fetch['title'];
	$description = $fetch['description'];
	$dvar['status'] = $fetch['status'];
	$uniq = $fetch['uniq'];
}

if($_POST['submitbut'] == 'Save'){
	
	$dvar['title'] = $_POST['title'];
	@$desc = $_POST['description']; 
	@$tool = $_POST['tool'];
	
	$dvar['image_delete'] = $_POST['image_delete'];
	

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
			$add_dvar = array('uniq' => $uniq,'time' => time(),'status' => '1');
			$remove_dvar = array('image_delete');
//			$change_dvar = array('status' => '1');
			list($insert_q[0], $insert_q[1]) = insert_query($dvar, $add_dvar, $remove_dvar, $change_dvar);
			$sql = "INSERT into $tabl(sort, $insert_q[0]) SELECT max(sort)+1, $insert_q[1] from $tabl";
			$fg = 'ad';
		}
		if(mysql_query($sql)){
			  if($_GET['do'] == 'edit'){
				  //update tool table
				  $sql_s = "delete from tools where relation='".$uniq."' ";
				  $exec_s = mysql_query($sql_s);
				  if($tool[0] <> ''){
				  foreach(@$tool as $k1 => $v1){ 
					  $tool_db = mysql_real_escape_string($v1);
					  $sql_data = "INSERT into tools (relation,tool,time) VALUES('".$uniq."','".$tool_db."','".time()."')";
					  $exec_data = mysql_query($sql_data) or die (mysql_error());
			  		}
				  }
			  }
			  else{
				   if($tool[0] <> ''){
				  //insert tool
				   foreach(@$tool as $k1 => $v1){ 
					   $tool_db = mysql_real_escape_string($v1);
					   $sql_data = "INSERT into tools (relation,tool,time) VALUES('".$uniq."','".$tool_db."','".time()."')";
					   $exec_data = mysql_query($sql_data) or die (mysql_error());
				   }
				 }
			  }
			 
			if($_GET['do'] == 'edit'){ 
			
			    	$sql = "select * from files where relation='".$uniq."'";
					$exec = mysql_query($sql);
					$j = 1;
					while($fetch = mysql_fetch_assoc($exec)){
					$allowed_ext = array("gif","jpg","jpeg","png","GIF","JPG","JPEG","PNG");
					$file_field = 'file_'.$fetch['id'];
				
					$validate = validate_file($file_field,$allowed_ext, '0', '0');
					
					$validate1 = validate_file($file_field1,$allowed_ext, '0', '0');
					if($validate[0] <> '1'){
						$flag['file'] = $validate[0];
					}
					else if($validate[1] <> ''){
						$file = '1';
						$ext = $validate[2];
					}
					if($file == '1'){
						unlink('../'.$fetch['thumb']);   ///unink thumb
						unlink('../'.$fetch['thumb_big']); ////unlink big thumb
						unlink('../'.$fetch['location']);  ///unlink actual file
						$rand_old = random_generator(10);
					    $image_name = $rand_old; 
						$data = "-".date("F_j_Y-g_i_s_a"); //add date time
						$image_name = $image_name.$data.'.'.$ext; //add extention
						
						$path_old_file = "../file/".$image_name; /////actual file
						$path_old_thumb = "../thumb/".$image_name; ////thimb
						$path_old_big = "../thumb_big/".$image_name;///bog thumb
						
						 $path = $path_old_file ;  
						 $path1 = $path_old_thumb;
						 $path2 = $path_old_big;
						 //$thumb = '../'.$path1; 
				   }
					if(!empty($flag)){
					$flag_r = 'r';
					}
					else{
						if($file == '1'){
						 $thumb =  $path1;
						 $sql_up = "update files set thumb='".'thumb/'.$image_name."',thumb_big='".'thumb_big/'.$image_name."',location='".'file/'.$image_name."', file_name='".'file/'.$image_name."',description='".$description."' where id='".$fetch['id']."'"; 
						 if(mysql_query($sql_up)){
							if($file == '1'){
								@copy($_FILES[$file_field][tmp_name], $path);     //  upload the file to the server
								@chmod("$path",0777);  
								$max_width=65; // Fix the width of the thumb nail images
								$max_height=72; // Fix the height of the thumb nail imaage
								
								//$max_width1=78; // Fix the width of the thumb nail images
								//$max_height1=78; // Fix the height of the thumb nail imaage
								// $extn $path $final required
								$extn = $ext;	$final = $thumb;	$res = '0';
								//$extn = $ext;	$final = $thumb;	$res = '0';
								include("include/image_resize.php");
								//	include("include/image_resize1.php");             
							}
						}

					}
						if($file <> '1'){//if no changes the fetch data and update as it is
						 $sql_up1 = "update files set thumb='".$fetch['thumb']."',thumb_big='".$fetch['thumb_big']."',location='".$fetch['location']."', file_name='".$fetch['file_name']."',description='".$desc."' where id='".$fetch['id']."'"; 
						$exec_up1 = mysql_query($sql_up1);
						 }
					}
				}
			}
				if($_FILES[pic][name] != ''){
					//insert description to files table
					foreach($desc as $key => $description){
					$uniq_id = multiple_files('pic', ROOT_DIR.'/file/', 'file/', $uniq, $description, $_SERVER['REMOTE_ADDR'], 'doc_name');
					}
				}
				$flag[$fg] = $item;
			}
			else{
				echo mysql_error();//$flag['q'] = 'r';//
			}
		}
}

// delete images description from files
$item1 = "Tutorial Image and Description";
if($_GET['go'] == 'delete' && ctype_digit($_GET['field_id'])){
	 $field_id = $_GET['field_id'];
     $sql = "SELECT * from files where id='".$field_id."' ";
	 $exec_f = mysql_query($sql);
	
	//empty the file folder i.e. delete all images
	while($fetch_image = mysql_fetch_assoc($exec_f)){
	 $id = $fetch_image['id'];
	 $img1 = $fetch_image['location'];
	 $file_name2 = $fetch_image['file_name'];
	 $thumb_small = $fetch_image['thumb'];
	 $thumb_big = $fetch_image['thumb_big'];
	 @unlink('../'.$img1);
	 @unlink('../file/'.$file_name2);
	 @unlink('../'.$thumb_small);
	 @unlink('../'.$thumb_big);
	}
	
	//delete the row from file table
   $sql_d = "DELETE from files where id='".$field_id."' ";
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
	$description = $fetch['description'];
	$dvar['title'] = $fetch['title'];
	$dvar['status']=$fetch['status'];
	$uniq = $fetch['uniq'];
}

//images
$sql_imges = "select count(*) from files where relation='".$uniq."'";
$exec_imges = mysql_query($sql_imges);
$img = mysql_fetch_row($exec_imges);

// 


//fetch tools info tools table  
$sql_meta = "select * from tools where relation ='".$uniq."' ";
$exec_meta = mysql_query($sql_meta);
$num = mysql_num_rows($exec_meta);


$item2 = 'Tool';
if($_GET['go'] == 'deletemeta' && ctype_digit($_GET['mid'])){
	$mid = mysql_real_escape_string($_GET['mid']);
 	$sql_de = "DELETE from  tools where id='".$mid."'";
	$exec_de = mysql_query($sql_de);
    if($exec_de){
		$fg = 'ed'; 
		$flag[$fg] = $item2;
	}
	else{
		$flag['q']='r';
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add/Edit<?php echo $item; ?></title>
<?php include("include/head.php"); ?>
<script type="text/javascript">

function check_validation(){
	//alert('hi');
   var title = $('#title').val();
   var location = $('#location').val();
   var description = $('#description').val();
   var tool = $('#tool').val();
   
    if(title == '') {
  		var error = "Error:Please Enter Tutorial title";
		$('#title').focus();
    } 
	else if(location == '') {
  		var error = "Error:Please Upload an Image";
		$('#location').focus();
    } 
	
	
	else if(description == '') {
  		var error = "Error:Please Enter description";
		$('#description').focus();
    } 
	
    if(error != "" && error != null){
		$('#error').html(error);
		$('#error').show("normal");
		window.scrollTo(0,0);
		return false;
    }
     else{
  		return true;
	 }
}



</script>
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
<style type="text/css">
.edit2 {
	width: 245px;
	float: left;
	height: 60px;
}
</style>
</head>

<body>
<div align="center">
  <div class="container">
    <?php
    $pg_active['tut'] = 'active';
    require_once('include/header.php'); 
    ?>
    <div class="content">
      <div style="margin-top:10px">
        <?php
        echo print_messages($flag, $error_message, $success_message);
		?>
      </div>
      <div class="form5">
        <form id="add" name="add" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?5=5<?php echo $q_string; ?>" enctype="multipart/form-data" onsubmit="return check_validation();">
          <table width="100%" border="0" cellpadding="5">
            <tr>
              <td><div id="error" style="color:#F00"></div></td>
            </tr>
            <tr>
              <td align="right" class="label_form">Title: </td>
              <td><input name="title" id="title" type="text" class="input_text" value="<?php echo $dvar['title'];?>"/>
                <br class="clear" /></td>
            </tr>
            
			<?php
					if($_GET['do'] == 'edit' || $flag[$fg] <> ''){
					//$sql_field = "select * from files where relation='".$uniq."' order by id asc";
					$sql_field = "select * from files where relation='".$uniq."' order by id ASC";
					$exec_field = mysql_query($sql_field);
					$n = @mysql_num_rows($exec_field);
					$i=1;
					while($fetch_field = @mysql_fetch_assoc($exec_field)){ 
				   ?>
            <tr>
              <td align="right" valign="top" class="label_form">Image(<?php echo $i; ?>) : </td>
              <td><div class="pic"> <img src="<?php if($fetch_field['location'] <> ''){echo "../".$fetch_field['location'];}else{echo 'images/1.png';} ?>" alt="images/1" width="98" height="98" /></div>
                <div class="edit1">
                  <input  name="file_<?php echo $fetch_field['id'];  ?>" type="file" value='<?php echo $fetch_field['pic']; ?>' class='edit1'/>
                  <div  style="margin-left:3px; float:left; margin-top:7px; width:3px !important; " >
                    <div class="view" style=" width:3px !important;  "> <a href="<?php echo $_SERVER['PHP_SELF'].'?do=edit&id='.$fetch['id'].'&temp_id='.$fetch_field['rel_id'].'&go=delete&field_id='.$fetch_field[id]; ?>" title="Delete Image(<?php echo $i ;?>) and Description(<?php echo $i ;?>)" onClick="return dele_fun();"> <img src="images/delete.png" /> </a> </div>
                  </div>
                  <div class="clear"></div>
                </div></td>
            </tr>
            
            <tr>
              <td align="right" valign="top" class="label_form">Description(<?php echo $i; ?>):</td>
              <td><div>
                  <textarea  class="edit2" name='description'><?php echo $fetch_field ['description'];?> </textarea>
                </div></td>
            </tr>
            <?php $i++;} } else{?>
            <tr>
              <td align="right" valign="top" class="label_form">Image : </td>
              <td>
                  <div style="float:left;"><input  name="pic[]" type="file" value='<?php echo $fetch_field['pic']; ?>' /></div>
                  <div style="float:left; padding-top:18px;">Description :</div><div style="float:left;"><textarea  class="edit2"><?php echo $fetch_field ['description'];?> </textarea></div>
              </td>
            </tr>
        	 <?php }?>
           
            <tr>
              <td class="label_form" >
              <div id="dynamicInput" style="width:400px; margin-left: -113px; "> 
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
                     newdiv.innerHTML = "<div style='margin-left: 206px;padding-top: 5px;padding-right: 14px;float: left;width: 600px;' >Image" + (counter + 1)+":&nbsp;</div>" + "<div style='width: 203px;margin-left: -623px;float: left;'><input type='file' id='location' name='pic[]' value='<?php echo $dvar['pic']; ?>' class='edit2' style='margin-left: 114px;padding: 10px;'></div> <br class='clear'>";
					 document.getElementById(divName).appendChild(newdiv);
                    counter++;
                  }
                }
            </script> 
                </div></td>
             
             
              <td class="label_form" style="margin-left:190px"><div id="dynamicInput1"> 
                  <script language="javascript">
                <?php if($_GET['do'] == 'edit'){ ?>
                            var counter1 = <?php echo $i; ?>;
                <?php } else{ ?>
                            var counter1 = 0 ;
                <?php }  ?>
				
				var limit1 = 10;
				function addInput1(divName1){
                 if(counter1 >= limit1){
                  alert("Error: Maximium 10 descriptions can upload ");
                 }
                 else{
					 var newdiv1 = document.createElement('div1');
					  newdiv1.innerHTML = "<div style='padding-top: 5px;padding-right: 14px;float: left;width: 600px;>Description" + (counter1 + 1)+":&nbsp;</div>" + "<div style='width: 203px;margin-left: -623px;float: left;'><textarea  name='description[]' id='description' class='edit2' style='margin-left: 114px;'></textarea> </div> <br class='clear'>";
                      document.getElementById(divName1).appendChild(newdiv1);
                    counter1++;
                  }
                }
            </script> 
                </div></td>
            </tr>
            
            <!-- <table id="table-data" >
            newdiv1.innerHTML = "<div style='padding-top: 5px;padding-right: 14px;float: left;width: 600px;>Description" + (counter1 + 1)+":&nbsp;</div>" + "<div style='width: 203px;margin-left: -623px;float: left;'><input type='text' class='input_text' name='description[]' value='<?php echo $dvar['description']; ?>' class='edit1' style='margin-left: 114px;'></div> <br class='clear'>";
                    
            <tr class="tr_clone">
                  <td align="right" class="label_form">Description :</td>
                  <td><input name="data_meta[]" type="text" class="input_text" value=""/><br class="clear" /></td><br class="clear" />
                  <td><img style="float:left; margin-top:1.6em; cursor:pointer" title="Delete Row" src="images/delete.png" alt="cross" onclick = "if(document.getElementById('table-data').rows.length != 1){$(this).parent().parent().remove(); } else{ alert('sorry, you cannot delete this');}" ></td>
             </tr>
		
             </table>
       --> 
            
            <!--<tr>
              <td align="right" class="label_form"><div class="view1">Image:</div></td>
              <td><div class="btn">
                  <input style="margin-left:20px" type="button" name="add" value="Add Step" onClick="addInput('dynamicInput');" class="button" >
                  <script language="javascript">
				//	if(counter == 0){alert("Error: Please upload minimum one image")}
					</script> 
                </div></td>
            </tr>-->
             <table id="table-data"  method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <?php if($_GET['do'] != 'edit' || $num == 0){ ?>
            <tr class="tr_clone">
                  <td align="right" class="label_form">Tool Used :</td>
                  <td><input name="tool[]" type="text" class="input_text" value=""/><br class="clear" /></td><br class="clear" />
                  <td><img style="float:left; margin-top:1.6em; cursor:pointer" title="Delete Row" src="images/delete.png" alt="cross" onclick = "if(document.getElementById('table-data').rows.length != 1){$(this).parent().parent().remove(); } else{ alert('sorry, you cannot delete this');}" > 
             </tr>
                <!--<div><input  type="button" name="add" value="Add Tool" id="tb_clone_click" class="button" > </div>-->   
           
		  <?php } else{ $j=1; while($fetch_meta = mysql_fetch_assoc($exec_meta)){
				// print_r($fetch_meta);die;
				 ?>
            <tr class="tr_clone" style="border:1px solid red;">
                  <td align="right" class="label_form">Tool Used(<?php echo $j;?>):</td>
                  <td><input name="tool[]" type="text" class="input_text" value="<?php echo $fetch_meta['tool'];?>"/><br class="clear" /></td><br class="clear" />
                  <td><a href="<?php echo $_SERVER['PHP_SELF']; ?>?do=edit&go=deletemeta&mid=<?php echo $fetch_meta['id'].'&id='.$id; ?>" ><img style="float:left; margin-top:1.6em; cursor:pointer" title="Delete Tool" src="images/delete.png" alt="cross"></a>  </td>
            </tr><?php $j++; } }?>
            <tr>
                <td></td>
                <td></td>
                <td> <div><input  type="button" name="add" value="Add Tool" id="tb_clone_click" class="button" > </div>   </td>
            </tr>
    
             </table>
          
        
             
             
            <tr>
              <td></td>
              <td><div class="btn">
                  <input style="margin-left:20px" type="button" name="add" value="Add Step" onClick="addInput('dynamicInput'),addInput1('dynamicInput1');" class="button" >
                 <input class='button' name='submitbut' value='Save' type='submit' />
                  <!--  <input style="margin-left:190px;" type="button" name="add" value="Add Row"class="button" id="tb_clone_click" >--> 
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
