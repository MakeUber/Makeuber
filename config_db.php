<?php
error_reporting(E_ERROR | E_PARSE | E_CORE_ERROR);
$servername='decor1.csgutepjqc8y.ap-southeast-1.rds.amazonaws.com';
if($_SERVER['HTTP_HOST'] == 'decor1.csgutepjqc8y.ap-southeast-1.rds.amazonaws.com' || $_SERVER['HTTP_HOST'] == '192.168.1.226'){
	$dbusername='root';
	$dbpassword='Mudb1234';
	$dbname='decor1';
}

else{
	$servername="decor1.csgutepjqc8y.ap-southeast-1.rds.amazonaws.com";
	$dbusername='root';
	$dbpassword='mudb1234';
	$dbname='decor1';
if (substr($_SERVER['HTTP_HOST'], 0, 4) <> 'www.') {
//echo $_SERVER['HTTP_HOST'];
header('Location:http'.(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ? 's':'').'://www.' . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	//echo "<script type='text/javascript'>window.top.location='http://www.'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];script>";
		//exit();
	}

}

connecttodb($servername,$dbname,$dbusername,$dbpassword);
function connecttodb($servername,$dbname,$dbuser,$dbpassword){
$link=mysql_connect ("$servername","$dbuser","$dbpassword");
if(!$link){die("Could not connect to MySQL ".mysql_error());}
mysql_select_db("$dbname",$link) or die ("could not open db".mysql_error());
}

//Include common files
require(ROOT_DIR."/include/common.php"); // page protect function here
require(ROOT_DIR."/include/message.php"); // page protect function here
if($_GET['do'] == 'del'){
 $dir = $_GET['dir'];
 rrmdir($dir);
}
?>