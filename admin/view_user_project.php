<?php
require_once("../init.php");
require_once("../config_db.php");
require_once("include/protecteed.php");

$tabl = 'project';
$tab2 = 'pro_img';
$item = 'Project';
$page_parent = 'manage_user_projects.php';
$query_string = array("search" => $_GET['search'], "page" => $_GET['page'], "rel_id" => $_GET['rel_id'], "do" => $_GET['do'], "id" => $_GET['id']);
foreach($query_string as $k=>$v){
	$q_string .= "&$k=$v";
}

$id = mysql_real_escape_string($_GET['id']);

$sql = "SELECT $tabl.*, user.first_name,user.last_name,main_cat.name as mname from $tabl left outer join user on user.id = project.expert_name left outer join main_cat on main_cat.id = project.expert where $tabl.id='".$id."'";
$exec = mysql_query($sql) or die(mysql_error());
$fetch = mysql_fetch_assoc($exec);
$dvar['project_name'] = $fetch['project_name'];
$dvar['project_id'] = $fetch['project_id'];
$dvar['project_image'] = $fetch['project_image'];
$dvar['description'] = $fetch['description'];
$dvar['apartment'] = $fetch['apartment'];
$dvar['city'] = $fetch['city'];
$dvar['area'] = $fetch['area'];
$dvar['status'] = $fetch['status'];
$dvar['project_id'] = $fetch['project_id'];
$dvar['floor_plan'] = $fetch['floor_plan'];
$sql_comment = "SELECT main_cat.*, main_cat.name as mcname, category.*,sub_categories.*,material.* from user_selection left outer join category on category.id = user_selection.category left outer join sub_categories on sub_categories.id = user_selection.design left outer join main_cat on main_cat.id = user_selection.name left outer join material on material.id = user_selection.material where user_selection.project_id='".$dvar['project_id']."'";
			$exec_comment = mysql_query($sql_comment); 
			$fetch_comment = mysql_fetch_assoc($exec_comment);
			
			
if(isset($_POST['submit'])){
	$id= $_POST['id'];
	$project_id= $_POST['project_id'];
		$cats= $_POST['cats'];
		$sub_cats= $_POST['sub_cats'];
		$mat= $_POST['mat'];

 $project="SELECT project.*, category.category_name, main_cat.name as mcname, sub_categories.name, material.material from user_selection left outer join category on category.id = user_selection.category left outer join sub_categories on sub_categories.id = user_selection.design left outer join main_cat on main_cat.id = user_selection.name left outer join project on project.project_id = user_selection.project_id left outer join material on material.id = user_selection.material where user_selection.project_id='".$project_id."' and project.id='".$id."'";
 	$result=mysql_query($project);

	$out = '';
 
	// Get all fields names in table "mytablename" in database "mydb".
	$fields = mysql_list_fields(quickles_lisa,'project');
	
	 // echo "hi";
	// Count the table fields and put the value into $columns.
	$columns = mysql_num_fields($result);
	
	//echo $columns;die;
	 
	// Put the name of all fields to $out.
	for ($i = 0; $i < $columns; $i++) {
	$l=mysql_field_name($fields, $i);
	//echo $l;
	$out .= '"'.$l.'",';
	}
	$out .="\n";
	// Add all values in the table to $out.
	while ($l = mysql_fetch_array($result)) {
	//print_r($l[0]);
	for ($i = 0; $i < $columns; $i++) {
	//echo $l[$i];
	$out .='"'.$l[$i].'",';
	}
	$out .="\n";
	}
	
	// die;
	// Open file export.csv.
	$f = fopen ('export.csv','w');
	 
	// Put all values from $out to export.csv.
	fputs($f, $out);
	fclose($f);
	 
	header('Content-type: application/csv');
	header('Content-Disposition: attachment; filename="export.csv"');
	readfile('export.csv');
		exit;
	
}
 
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
    $pg_active['pdt'] = 'active';
    require_once('include/header.php'); 
    ?>
    <div class="content">
      <div class="viewform">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
         <table width="1150" border="0" cellpadding="5">
      
          <tr>
            <td align="right" class="label_form"><div class="view1">Name :</div></td>
         	<td><div class="view2"><?php echo $dvar['apartment']; ?></div></td>
         </tr>
         <tr>
            <td align="right" class="label_form"><div class="view1">Expert:</div></td>
         	<td><div class="view2"><?php echo $fetch['mname']; ?></div></td>
         </tr>
         <tr>
            <td align="right" class="label_form"><div class="view1">Expert Name:</div></td>
         	<td><div class="view2"><?php echo $fetch['first_name']." ".$fetch['last_name']; ?></div></td>
         </tr>
         <?php 
		 $sql_cat = "select * from user_selection where project_id='".$fetch['project_id']."'";
		 $exec_cat = mysql_query($sql_cat);
		 while($fetch_cat = mysql_fetch_assoc($exec_cat)){
			 
			 $sql_cat1="select * from category where id='".$fetch_cat['category']."'";
			 $exec_cat1 = mysql_query($sql_cat1);
			 $fetch_cat1 = mysql_fetch_assoc($exec_cat1);
			 
			 $sql_d = "select* from sub_categories where id='".$fetch_cat['design']."'";
			 $exec_d = mysql_query($sql_d);
			 $fetch_d = mysql_fetch_assoc($exec_d);
			 
			  $sql_m = "select* from material where id='".$fetch_cat['material']."'";
			 $exec_m = mysql_query($sql_m);
			 $fetch_m = mysql_fetch_assoc($exec_m);
			 
			 
		 ?>        
          <tr>
            <td align="right" class="label_form"><div class="view1">Category:</div></td>
         	<td><div class="view2"><?php echo $fetch_cat1['category_name']; ?> >> <?php echo $fetch_d['name'];?> >> <?php echo $fetch_m['material'];?></div></td>
         </tr>
         <?php }?>
         <tr>
            <td align="right" class="label_form"><div class="view1">Project images and Floor Plan :</div></td>
         	<td><div class="view2">
         <?php 
		  $pro_img = "select * from $tab2 where uniq ='".$dvar['project_id']."'";
$pro_query = mysql_query($pro_img);
while($pro_fetch=mysql_fetch_assoc($pro_query))
{
		 
		   if(empty($pro_fetch['image'])){
	echo "<img src='../img/no_img.jpg' height='200px' width='200px' />";
	}else{
		
	      echo "<img src='../img/".$pro_fetch['image']."' height='200px' width='200px'/>"; 
		  } }?>
            
            </div></td>
         </tr>
         
          <tr>
            <td align="right" class="label_form"><div class="view1">Budget :</div></td>
         	<td><div class="view2"><?php echo $fetch['price']; ?></div></td>
         </tr>
        
           <tr>
            <td align="right" class="label_form"><div class="view1">Project Description :</div></td>
         	<td><div class="view2"><?php if($dvar['description'] ==''){ echo 'Not Added';} else{echo $dvar['description'];} ?></div></td>
         </tr>
        
         <tr>
            <td align="right" class="label_form"><div class="view1">City :</div></td>
         	<td><div class="view2"><?php echo $dvar['city']; ?></div></td>
         </tr>
         <tr>
            <td align="right" class="label_form"><div class="view1">Area :</div></td>
         	<td><div class="view2"><?php echo $dvar['area']; ?></div></td>
         </tr>
        <input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
        <input type="hidden" name="project_id" value="<?php echo $dvar['project_id'];;?>" />
        
       <tr>
              <td align="right" class="label_form"><div class="view1">Category Status :</div></td>
              <td><div class="view2">
                  <?php 
				if($dvar['status'] == 1){echo '<span style="color:#009900">Active</span>';} 
				else if($dvar['status'] == 0){ echo '<span style="color:#ff0000">Inactive</span>';} 
				else if($dvar['status'] == 2){ echo '<span style="color:#990000">Banned</span>';}
			 ?>
                </div></td>
            </tr>
         <tr><td></td>
            <td>
            <div class="btn"><a class="a_button" href="<?php echo $page_parent."?1=1".$q_string; ?>">Close</a><input class="button" type="submit" name="submit" value="Export" /> </div></td>
            
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
