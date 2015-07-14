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

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-54272760-1', 'auto');
  ga('send', 'pageview');

</script>