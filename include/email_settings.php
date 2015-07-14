<?php /* 
date_default_timezone_set('America/New_York');
$mail             = new PHPMailer();
		
$mail->Host       = 'smtp.mail.yahoo.com'; //"mail.yourdomain.com"; // SMTP server
$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
										   // 1 = errors and messages
										   // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
//$mail->Host       = "smtp.gmail.com"; // sets the SMTP server
$mail->Port       = 465;                    // set the SMTP port for the GMAIL server
$mail->Username   = 'sharma255319@yahoo.com';//"waliaworking@gmail.com"; // SMTP account username
$mail->Password   = "255319@123";        // SMTP account password

$mail->SetFrom('sharma255319@yahoo.com', 'sdsdfsd');   // defined in the init file
$mail->AddReplyTo('testing.slinfy02@gmail.com', 'zfgzdfgdz');   // defined in the init file

This is used to send mails Major config*/ 

?>

<?php
/* Configurations made by suresh are down i wonder if he saw the init file as i guess the file init is included in each file and would be using email sending firm there */
 error_reporting(E_ALL);
// echo 'hih';exit;
    //require 'PHPMailer_5.2.4/PHPMailer.php';
//	require("PHPMailer_5.2.4/class.smtp.php");
require("include/PHPMailer_5.2.4/class.pop3.php");
require("include/PHPMailer_5.2.4/class.phpmailer.php");

   //echo 'hih';exit;
    ini_set('display_errors', '1');

  //  $name = $_POST["name"];
  //  $email = $_POST["email"];
  //  $subject = $_POST["subject"];
  //  $message = $_POST["message"];

    $mail = new PHPMailer();
    $mail->IsSMTP();
	$mail->SMTPDebug=2; 
	$mail->From = "nirajbohra@gmail.com";
	$mail->FromName ="nirajbohra@gmail.com";
    $mail->Host = "smtp.gmail.com"; // Your SMTP PArameter
	$mail->SMTPSecure = "tls";//"ssl";"tls"; // Check Your Server's Connections for TLS or SSL
    $mail->Port = 587;//465; // Your Outgoing Port
    $mail->SMTPAuth = true; // This Must Be True
    $mail->Username = "nirajbohra@gmail.com"; // Your Email Address
    $mail->Password = "niraj124"; // Your Password
    
/* PLease help me configure the same code in one place where i understand how thsi works like */

  
    $mail->AddAddress("lisa.mohapatra17@gmail.com");
	$mail->AddCC("nirajbohra@gmail.com");
    $mail->IsHTML(true);

    $mail->Subject = "To check the mailer";

   $mail->Body =  "Test mail: I am Niraj Bohra";
//echo 'hihi';exit;
try{
    if(!$mail->Send())
    {
      // echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
    else
   {
        //echo 'success';
   }
	//$mail->Send();
	} 
	catch (phpmailerException $e) { 
  echo $e->errorMessage(); //error messages from PHPMailer
} 
/*catch (Exception $e) {
  echo $e->getMessage();
}*/
    ?>

