<?php
//ini_set('session.save_path','tmp');
session_name();
session_start();

define('ROOT_DIR', dirname(__FILE__));
//echo ROOT_DIR;


define('ROOT_URL', 'http://www.makeuber.com/');
//define('ROOT_URL', 'http://52.74.203.142/');
//define('ROOT_URL', 'http://localhost/Muber/');


//echo ROOT_URL;
$site_name = 'Hire Interior Designers, Architects for Design, Decorating &amp; Remodeling Ideas | MakeUber';
$email_def = 'nirajbohra@gmail.com';
//$email_def = 'sharma255319@yahoo.com';

//$email_merchant = 'samnetbiz@yahoo.com';
$email_merchant = 'samnetbiz@yahoo.com';

$sandbox_env = '1'; // Sandbox environment
date_default_timezone_set("Asia/Kolkata");
ini_set('memory_limit', '512M');

?>

