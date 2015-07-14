<?php
include "../init.php";// database connection details stored here
include "../config_db.php";// database connection details stored here
include "include/protecteed.php";// page protect function here

$tabl = 'user';

// Config. for pagination //
$page = $_GET['page'];				// get variable for page
$search_txt = $_GET['search'];
$perpage = '10';						// Show per page
$base_tabl = $tabl;				// table name for query
$item = 'User';				// table name for query
$page_child = 'add_edit_user.php';				// table name for query
$namep = $_SERVER['PHP_SELF'];					// Page name
$query_string = array("search" => "$search_txt");
foreach($query_string as $k=>$v){
	$q_string .= "&$k=$v";
}

$q_string_pg = $q_string."&page=$page";	// value inside pages
$stcom = stcom($page, $perpage);

// Select Query part for every query related to this page
$select = "$base_tabl.* ";
 $from = "  $base_tabl where type = '0' "; 

/*if($_GET['sort'] <> ''){
	$categ = $_GET['sort'];
	if($categ == 'name'){
		$sql1 .= " $from where name='".$categ."' ";
	}
	if($categ == 'status'){
		$sql1 .= " $from where status='".$categ."' ";
	}
	if($categ == 'status'){
		$sql1 .= " $from where citizenship='".$categ."' ";
	}
	$categ_addq = 'g';
}
*/
if($_GET['search'] == '' || $_GET['search'] == 'search'){
	// Make query to select records
$sql1 = "SELECT $select from $from"; 		// SQL query to select rows.
}
else{
	$search_txt_db = mysql_real_escape_string($search_txt);
	$sql1 = "SELECT $select from $from AND ($base_tabl.first_name like '%$search_txt_db%' OR $base_tabl.email_id like '%$search_txt_db%')"; 

}

// If multiple rows selected and form submitted
if($_POST['Delete'] == 'Delete Selected'){
	@$chk = $_POST['chk'];
	$i='0';
	if( is_array($chk)){
		while (list ($key, $val) = each ($chk)) {
			if($val <> ''){
				$chk_arr[$i] = $val;
			}
			$i++;
		}
	}
//print_r($chk);die;
	foreach($chk as $usr){
	// select user information while deleting him
	$sql_user = "select * from user where id='$usr'"; 
	$exec_user = mysql_query($sql_user);
	$fetch = mysql_fetch_assoc($exec_user);
	$user_pic = $fetch['image'];
	@unlink('../img/'.$user_pic);
	
	$sql_pro = "select * from project where user_id='".$fetch['uniq_id']."'";
	$exec_pro = mysql_query($sql_pro);
	$fetch_pro = mysql_fetch_assoc($exec_pro);
	$project_image = $fetch_pro['project_image'];
	$floor = $fetch_pro['floor_plan'];
	 @unlink('../img/'.$project_image);
	 @unlink('../img/'.$floor);
	
	$sql_img = "select * from project_images where images_id ='".$fetch_pro['id']."'"; 
	$fetch_query =  mysql_query($sql_img);
	
	$fetch_img = mysql_fetch_assoc($fetch_query);
	$pimg = $fetch_img['image'];
	 @unlink('../img/'.$pimg);
	
	
	$sql_dis = "select * from discussion where user_id='".$fetch['uniq_id']."'";
	$exec_dis = mysql_query($sql_dis);
	$fetch_dis = mysql_fetch_assoc($exec_dis);
	
	 $sql_dimg = "select * from dis_img where uniq ='".$fetch_dis['image_id']."'";
	$fetch_query2 =  mysql_query($sql_dimg);
	$fetch_img2 = mysql_fetch_assoc($fetch_query2);
	$dimg = $fetch_img2['image'];
	 @unlink('../uploads/'.$dimg);
	 
	 	// delete all project
	$sql_m = "DELETE from project where user_id ='".$fetch['uniq_id']."'"; 
	mysql_query($sql_m);
	// delete all Favourites
	 $sql_f = "DELETE from project_images where images_id ='".$fetch_pro['id']."'"; 
	mysql_query($sql_f);
	
	$sql_s = "DELETE from user_selection where user_id = '".$fetch['uniq_id']."'"; 
	mysql_query($sql_s);
	$sql_r = "DELETE from review where user_id ='".$fetch['uniq_id']."'"; 
	mysql_query($sql_r);
	$sql_l = "DELETE from likes where user_id ='".$fetch['uniq_id']."'"; 
	mysql_query($sql_l);
	$sql_c = "DELETE from comment where user_id ='".$fetch['uniq_id']."'"; 
	mysql_query($sql_c);
	$sql_d = "DELETE from discussion where user_id ='".$fetch['uniq_id']."'"; 
	mysql_query($sql_d);
	
	 if($fetch['id'] <> '' || $fetch['uniq_id'] <> ''){
		 $sql="delete from $tabl where id='$usr'";
		 $exec = mysql_query($sql);
	 }
	 else{
		$sql="Update $tabl set 1='1' where id='$usr'";
		$exec = mysql_query($sql);
		
	 }
	
		//delete from tutorials and other stuff
	if($exec){$flag['d'] =$item;}
	else{$flag['z'] = $item;}
	
	
	
	
	}
	
}

//If Delete button is pressed for one row
if($_GET['do'] == 'delete' && ctype_digit($_GET['id'])){
	$id = $_GET['id'];
	// select user information while deleting him
	$sql_user = "select * from user where id='$id'";
	$exec_user = mysql_query($sql_user);
	$fetch = mysql_fetch_assoc($exec_user);
	$user_pic = $fetch['image'];
	@unlink('../img/'.$user_pic);
	
	 if($fetch['id'] <> '' || $fetch['uniq_id'] <> ''){
		 $sql="delete from $tabl where id='$id'";
		$exec = mysql_query($sql);
	 }
	 else{
		$sql="Update $tabl set 1='1' where id='$id'";
		$exec = mysql_query($sql);
	 }
	
	if($exec){
		
	$sql_pro = "select * from project where user_id='".$fetch['uniq_id']."'";
	$exec_pro = mysql_query($sql_pro);
	$fetch_pro = mysql_fetch_assoc($exec_pro);
	$project_image = $fetch_pro['project_image'];
	$floor = $fetch_pro['floor_plan'];
	 @unlink('../img/'.$project_image);
	 @unlink('../img/'.$floor);
	
	$sql_img = "select * from project_images where images_id ='".$fetch_pro['id']."'"; 
	$fetch_query =  mysql_query($sql_img);
	
	$fetch_img = mysql_fetch_assoc($fetch_query);
	$pimg = $fetch_img['image'];
	 @unlink('../img/'.$pimg);
	
	
	$sql_dis = "select * from discussion where user_id='".$fetch['uniq_id']."'";
	$exec_dis = mysql_query($sql_dis);
	$fetch_dis = mysql_fetch_assoc($exec_dis);
	
	 $sql_dimg = "select * from dis_img where uniq ='".$fetch_dis['image_id']."'";
	$fetch_query2 =  mysql_query($sql_dimg);
	$fetch_img2 = mysql_fetch_assoc($fetch_query2);
	$dimg = $fetch_img2['image'];
	 @unlink('../uploads/'.$dimg);
	 
		// delete all Messages
	 $sql_m = "DELETE from project  where user_id ='".$fetch['uniq_id']."'"; 
	mysql_query($sql_m);
	// delete all Favourites
	 $sql_f = "DELETE from project_images where images_id ='".$fetch_pro['id']."'"; 
	mysql_query($sql_f);
	
	$sql_s = "DELETE from user_selection where user_id = '".$fetch['uniq_id']."'"; 
	mysql_query($sql_s);
	$sql_r = "DELETE from review where user_id ='".$fetch['uniq_id']."'"; 
	mysql_query($sql_r);
	$sql_l = "DELETE from likes where user_id ='".$fetch['uniq_id']."'"; 
	mysql_query($sql_l);
	$sql_c = "DELETE from comment where user_id ='".$fetch['uniq_id']."'"; 
	mysql_query($sql_c);
	$sql_d = "DELETE from discussion where user_id ='".$fetch['uniq_id']."'"; 
	mysql_query($sql_d);
		//delete from tutorials and other stuff
		
	
	//delete all data that is id of tutorial
	
		
	}
	if($exec){$flag['d'] =$item;}
	else{$flag['z'] = $item;}
	}

		
	




if($_GET['do'] == 'enable'){
	$id = $_GET['id'];
	$sql = "UPDATE $tabl SET status='1' where id = '$id'";
	mysql_query($sql) or die(mysql_error());
}

if($_GET['do'] == 'disable'){
	$id = $_GET['id'];
	$sql = "UPDATE $tabl SET status='0' where id = '$id'";
	mysql_query($sql) or die(mysql_error());
}

$sqlq = $sql1;
 $sql2 = $sql1." ORDER BY sort ASC LIMIT $stcom , $perpage";
// pagination file include
include "include/pagination.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Manage <?php echo $item; ?>s</title>
<?php include("include/head.php"); ?>
<script type="text/javascript">
	function del_fun(){
		if(confirm("Are you sure you want to delete this <?php echo $item; ?>?")){return true;}
		else{return false;}
	}

	function dis_fun(){
		if(confirm("Are you sure you want to Disable this <?php echo $item; ?>?")){return true;}
		else{return false;}
	}

	function enb_fun(){
		if(confirm("Are you sure you want to Enable this <?php echo $item; ?>?")){return true;}
		else{return false;}
	}
</script>
</head>
<body>
<div align="center">
  <div class="container">
    <?php
		$pg_active['users'] = 'active';
		require_once('include/header.php'); 
	?>
    <div class="content">
      <div style="margin-top: 20px;"> <?php echo print_messages($flag, $error_message, $success_message); ?> </div>
      <div class="down_category" style="margin-top:30px">
        <div class="head"> <span class="head_text"><?php echo $item; ?>s</span>
          <div class="add" style="margin-left:20px; margin-top:0px;">
           <div class="add"> <!--<a href="<?php echo $page_child; ?>"> <span class="add1"> <span class="head_text1"> <?php echo $item; ?></span> </span> </a>--> </div>
          </div>
          <div class="resetallpage"><a href="<?php echo $namep; ?>">Reset</a></div>
          <div class="search">
            <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
              <?php foreach($query_string as $k=> $v){?>
              <input name="<?php echo $k; ?>" value="<?php echo $v; ?>" type="hidden" />
              <?php }	?>
              <input type="text" name="search" value="<?php if($search_txt ==''){$search_txt = 'search';}  echo $search_txt; ?>" onfocus="if(this.value=='search'){this.value=''}" onblur="if(this.value==''){this.value='search'}"/>
              <input type="submit" value="Search" name="Submitbut" class="side_search"  />
            </form>
          </div>
        </div>
        <div class="clear"></div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>?5=5<?php echo $q_string_pg; ?>" method="post" name="<?php echo $item; ?>">
          <input name="done" type="hidden" value="send" />
          <table width="100%" cellspacing="0" border="0" cellpadding="0"  class="maintbl" >
            <tr class="fstrow"  >
              <td width="5%"><input class="check" type="checkbox" id="mainchbx" name="chk" /></td>
              <td align="left" width="15%" style="padding-left:10px">Name </td>
             <!-- <td align="left" width="5%" style="padding-left:10px">Sort </td>-->
              <td align="left" width="15%"> Email </td>
              <td align="center" width="10%"> Status </td>
              <td align="center" width="20%"> Actions </td>
            </tr>
            <?php
                $exec = mysql_query($sql2) or die(mysql_error());
				if(mysql_num_rows($exec) == 0){
					echo '<tr><td colspan="7" align="center"><div style="margin-top:10px;">No result Found</div></td></tr>';
				}
                $z = 0;
                while($fetch = mysql_fetch_assoc($exec)){
					
            ?>
            <tr class="scndrow <?php echo $z%2 ? '' : 'alternate';?>">
              <td><input type='checkbox' name='chk[]' value='<?php echo $fetch['id'] ?>' id='checkme<?php echo $z; ?>' /></td >
              <td align="left"><?php echo $fetch['first_name']; ?></td>
              <!-- <td align="center">
                <div class="n_2">
                <a href="sort_gen.php?type=first_name&tab=<?php echo $tabl; ?>&height=500&width=600&rel=<?php echo $fetch[id]; ?>" class="thickbox"><img src="images/sort-neither.png" title="Sort" width="13" height="16" /></a>
                </div>
                </td>-->
              <td align="left"><?php echo $fetch['email_id']; ?></td>
                <td align="center"><?php if($fetch['status'] == '1'){?>
                <span style="color:#009900">Active</span>
                <?php }else if($fetch[status] == '0'){?>
                <span style="color:#ff0000">Inactive</span>
                <?php }else if($fetch[status] == '2'){?>
                <span style="color:#990000">Banned</span>
                <?php }?></td>
              <td align="center"><a style="margin:0px 10px;" href="view_user.php?id=<?php echo $fetch['id'].$q_string_pg; ?>" title="View"> <img src="images/view.png" /> </a> <a style="margin:0px 10px;" href="<?php echo $page_child; ?>?do=edit&id=<?php echo $fetch['id'].$q_string_pg; ?>" title="Edit"> <img src="images/edit.png" /> </a> <a style="margin:0px 10px;" href="<?php echo $namep.'?do=delete&id='.$fetch['id'].$q_string_pg; ?>" title="Delete" onclick="return del_fun();"> <img src="images/delete.png" /> </a></td>
            </tr>
            <?php $z++; } ?>
          </table>
          <div class="slideshowdelend">
            <div class="clear"></div>
            <input onclick="return del_fun();" type="submit" name="Delete" value="Delete Selected" class="formbutton" />
          </div>
        </form>
      </div>
      <?php
	  	 require("include/pagination_show.php"); 
	  	 include "include/footerlogo.php";
	  ?>
    </div>
    <div class="clear"></div>
  </div>
</div>
</body>
</html>
