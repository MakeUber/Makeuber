<?php

include "../init.php";// include init
include "../config_db.php";// database connection details stored here
include "include/protecteed.php";// page protect function here

$id = $_GET['id'];
//$uniq_id = $_GET['uniqid'];
$tabl = 'choose_membership';
$item = 'User Order';
$page_parent = 'order.php';

$query_string = array("search" => $_GET['search'], "page" => $_GET['page'], "rel_id" => $_GET['rel_id'], "do" => $_GET['do'], "id" => $_GET['id']);
foreach($query_string as $k=>$v){
	$q_string .= "&$k=$v";
}
 $sql="select user.*,user.image as usimg, $tabl.*, membership_type.* from user left outer join $tabl on $tabl.user_id=user.uniq_id left outer join membership_type on membership_type.id=$tabl.plan where user.status='1' and $tabl.id='".$id."'";
$exec = mysql_query($sql) or die(mysql_error());
$fetch = mysql_fetch_assoc($exec);

$dvar['first_name'] = $fetch['first_name'];
$dvar['last_name'] = $fetch['last_name'];
$dvar['email_id'] = $fetch['email_id'];
$dvar['type'] = $fetch['type'];
$dvar['area'] = $fetch['area'];
$dvar['budget'] = $fetch['budget'];
$dvar['city'] = $fetch['city'];
$image = $fetch['usimg'];
$image1 = $fetch['image'];
$dvar['status'] = $fetch['status'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View <?php echo $item; ?></title>
<?php include("include/head.php"); ?>
<script type="text/javascript">
jQuery(document).ready(function () {
	$('input#start_date').simpleDatepicker({ startdate: 2012, enddate: 2099 });
	$('input#end_date').simpleDatepicker({ startdate: 2012, enddate: 2099 });
});
</script>
</head>
<body>
<div align="center">
  <div class="container">
    <?php
    $pg_active['order'] = 'active';
    require_once('include/header.php'); 
    ?>
    <div class="content">
      <div class="viewform">
        <form method="post" action="view_<?php echo $item; ?>.php">
          <table width="100%" border="0" cellpadding="5">
            <tr>
                <td align="right" class="label_form"></td>
                <td class="label_form"><u><b><?php echo $item ;?></b></u></div></td>
             </tr>
            <tr>
              <td align="right" class="label_form"><div class="view1">First Name :</div></td>
              <td><div class="view2"><?php echo $dvar['first_name']; ?></div></td>
            </tr>
            <tr>
              <td align="right" class="label_form"><div class="view1">Last Name :</div></td>
              <td><div class="view2"><?php echo $dvar['last_name']; ?></div></td>
            </tr>
            <tr>
              <td align="right" class="label_form"><div class="view1">Membership :</div></td>
              <td><div class="view2"><?php echo $dvar['type']; ?></div></td>
            </tr>
            <tr>
              <td align="right" class="label_form"><div class="view1">Membership Budget :</div></td>
              <td><div class="view2"><?php echo $dvar['budget']; ?></div></td>
            </tr>
            <tr>
              <td align="right" class="label_form"><div class="view1">Mambership Image :</div></td>
              <td><div class="view2">  <img src="<?php if($image1 <> ''){echo '../img/'.$image1;}else{echo 'images/1.png';} ?>" alt="images/1" width="98" height="98" /></div></td>
            </tr>
            <tr>
              <td align="right" class="label_form"><div class="view1">Email Id :</div></td>
              <td><div class="view2"><?php echo $dvar['email_id']; ?></div></td>
            </tr>
            
             <tr>
              <td align="right" class="label_form"><div class="view1">Area :</div></td>
              <td><div class="view2"><?php echo $fetch['area']; ?></div></td>
            </tr>
             <tr>
              <td align="right" class="label_form"><div class="view1">City :</div></td>
              <td><div class="view2"><?php echo $fetch['city'];; ?></div></td>
            </tr>
            
               <tr>
              <td align="right" class="label_form"><div class="view1">User Image :</div></td>
              <td><div class="view2">  <img src="<?php if($image <> ''){echo '../img/'.$image;}else{echo 'images/1.png';} ?>" alt="images/1" width="98" height="98" /></div></td>
            </tr>
           
         
            <tr>
              <td align="right" class="label_form"><div class="view1">User Status :</div></td>
              <td><div class="view2">
                  <?php 
				if($dvar['status'] == 1){echo '<span style="color:#009900">Active</span>';} 
				else if($dvar['status'] == 0){ echo '<span style="color:#ff0000">Inactive</span>';} 
				else if($dvar['status'] == 2){ echo '<span style="color:#990000">Banned</span>';}
			 ?>
                </div></td>
            </tr>
             <tr>
              <td align="right" class="label_form"><div class="view1"></div></td>
              <td><div class="slideshowdelend"> <a class="a_button" href="<?php echo $page_parent."?1=1".$q_string; ?>">Close</a> </div></td>
            </tr>
          </table>
        </form>
      </div>
      <?php
	   include "include/footerlogo.php";
	  ?>
    </div>
  </div>
  <div class="clear"></div>
</div>
</div>
</body>
</html>
