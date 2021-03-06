<?php 
require_once("init.php");
require_once("config_db.php");
require_once("config.php"); 

$tabl = 'project';
$tab2 = 'pro_img';
$item = 'Project';
$page_parent = 'project.php';
$query_string = array("search" => $_GET['search'], "page" => $_GET['page'], "rel_id" => $_GET['rel_id'], "do" => $_GET['do'], "id" => $_GET['id']);
foreach($query_string as $k=>$v){
	$q_string .= "&$k=$v";
}

$id = mysql_real_escape_string($_GET['user_id']);
$pro =  mysql_real_escape_string($_GET['project_id']);


$count = 0;

$sqlquery ="SELECT project.project_id , project.price , project.description, project.apartment , project.city , category.category_name, main_cat.name as mcname, sub_categories.name, material.material from user_selection left outer join category on category.id = user_selection.category left outer join sub_categories on sub_categories.id = user_selection.design left outer join main_cat on main_cat.id = user_selection.name left outer join project on project.project_id = user_selection.project_id left outer join material on material.id = user_selection.material where project.project_id='".$pro."'"  ; 
$result = mysql_query($sqlquery) or die(mysql_error());  
$count = mysql_num_fields($result);

for ($i = 0; $i < $count; $i++)	{
    $header .= mysql_field_name($result, $i)."\t";
}

while($row = mysql_fetch_row($result))	{
  $line = '';
  foreach($row as $value)	{
    if(!isset($value) || $value == "")	{
      $value = "\t";
    }	else  {
# important to escape any quotes to preserve them in the data.
      $value = str_replace('"', '""', $value);
# needed to encapsulate data in quotes because some data might be multi line.
# the good news is that numbers remain numbers in Excel even though quoted.
      $value = '"' . $value . '"' . "\t";
    }
    $line .= $value;
  }
  $data .= trim($line)."\n";
}
# this line is needed because returns embedded in the data have "\r"
# and this looks like a "box character" in Excel
  $data = str_replace("\r", "", $data);


# Nice to let someone know that the search came up empty.
# Otherwise only the column name headers will be output to Excel.
if ($data == "") {
  $data = "\nno matching records found\n";
}

$count = mysql_num_fields($result);



# This line will stream the file to the user rather than spray it across the screen
 header("Content-type: application/octet-stream");
//header("Content-type: text/plain");

# replace excelfile.xls with whatever you want the filename to default to
header("Content-Disposition: attachment; filename=Project.xls");

header("Pragma: no-cache");
header("Expires: 0");

//echo $header."\n".$data;
echo $header."\n".$data."\n";
?>