<?php
require_once("init.php");
require_once("config_db.php");
require_once("config.php");

if($_POST['do'] == 'login'){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$type 	  = $_POST['type'];
	if($username == ''){
		$message[0] = 'Error';	$message[1] = '<span style="color:red">Error: Please Enter Username.</span>';
	}else if($password == ''){
		$message[0] = 'Error';	$message[1] = '<span style="color:red">Error: Please Enter Password.</span>';
	}
	if(empty($message)){
		$sql_user="select * from user where username='".$username."' and password='".$password."' and type='".$type."'";
		$exec_user = mysql_query($sql_user);
		if(mysql_num_rows($exec_user)>0){
			$userfetch = mysql_fetch_array($exec_user);
			$id = $userfetch['uniq_id'];
			user_login($id);
			$message[0] = 'Success'; $message[1] = '<span style="color:green">Success: Login Successfull</span>';
			$message[2] = $type;

		}else{
		$message[0] = 'Error';	$message[1] = '<span style="color:red">Error: Wrong Username/ Password</span>';
		}
	}
	ksort($message);
//	ksort($message);
	$message_arr = implode('|::|', $message);
	echo $message_arr;
}

if($_GET['do'] == 'send_email'){
	$phone = $_GET['phone'];
	if($phone == ''){
		$message[0] = 'Error';	$message[1] = '<span style="color:red">Error: Please Enter Phone Number.</span>';
	}
	if(empty($message)){
		$dvar['project_id'] = random_generator(10);
		$dvar['user_id']  = $user_uniq;
		$dvar['email'] = $_SESSION['your_project']['email'];
		$dvar['phone'] = $_SESSION['your_project']['phone'];
		$dvar['price'] = $_SESSION['your_project']['budget'];
		$dvar['expert'] = $_SESSION['your_project']['expert'];
		$dvar['expert_name'] = $_SESSION['your_project']['expert_name'];
		$dvar['apartment'] = $_SESSION['your_project']['apartment'];
		$dvar['city'] = $_SESSION['your_project']['city'];
		$dvar['area'] = $_SESSION['your_project']['area'];
			$uniq = random_generator(10);
			$add_dvar = array('status' => '1', 'time' => time());
			
			$remove_dvar = array('image_delete','image_delete2');
//			$change_dvar = array('status' => '1');

			list($insert_q[0], $insert_q[1]) = insert_query($dvar, $add_dvar, $remove_dvar, $change_dvar);
			
			$sql_gal = "INSERT into project(sort, $insert_q[0]) SELECT max(sort)+1, $insert_q[1] from project";
			$fg = 'ad';
			mysql_query($sql_gal);
		$sql_user="select * from user where uniq_id='".$user_uniq."'";
		$exec_user = mysql_query($sql_user);
		if(mysql_num_rows($exec_user)>0){
			$userfetch = mysql_fetch_array($exec_user);
			$to = $userfetch['email_id'];    //  your email
			 $subject  = ' Thank you for contacting us!!';
			$header = ' MIME-Version: 1.0' . "\r\n";
		$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$header .= 'From: MakeUber <reachus@makeuber.com>';
			 $body .='<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#E6E6E6">
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="61" align="center"><a href= "http://www.makeuber.com" target="_blank"><img src="http://www.makeuber.com/img/logo.png"/></a></td>
               
              
        </tr>
		<TR><TD>&nbsp;</TD</TR>
        
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="7%">&nbsp;</td>
                <td width="58%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="95%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="35" align="left" valign="middle" style="border-bottom:2px dotted #000000"><font style="font-family: Georgia, Times New Roman, Times, serif; color:#000000; font-size:25px"><strong><em>Welcome To MakeUber</em></strong></font></td>
                          </tr>
                          <tr>
                            <td align="left" valign="top"><font style="font-family: Verdana, Geneva, sans-serif; color:#000000; font-size:13px; line-height:21px">
       <p>&nbsp;</p>
	    <p>Thank you for submitting your requirements with MakeUber.</p><br>
	   <p>Our team will be contacting you within 24 hours. If you have any further questions, concerns, or suggestions, shout out to our team anytime through the contact form on</p>
	   <a href="http://www.makeuber.com/contact_us">http://www.makeuber.com/contact_us</a><br/>
	   
	  <p> Or you could write to us anytime at reachus@makeuber.com</p>
	  
	  <p>We hope you have an enjoyable experience with us.<p>
	  
	  <p>Best Wishes,</p>
	  
	  MakeUber Team
    
    </font></td>
                          </tr>
                          <tr>
                            <td></td>
                          </tr>
                          <tr>
                            <td></td>
                          </tr>
                          <tr>
                            <td></td>
                          </tr>
                          <tr>

                            <td></td>
                          </tr>
                        </table></td>
                        
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
                <td width="5%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="82%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="10"> </td>
                      </tr>
                      <tr>
                        <td></td>
                      </tr>
                    </table></td>
                    <td width="8%">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
       
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>';
			
	mail($to, $subject, $body, $header);
	//////////////////////////////////send mail to admin///////////////////////////////////
			 $to_admin ="reachus@makeuber.com";    //  your email
			 $sub  = 'New Customer Requirement';
			 $header = ' MIME-Version: 1.0' . "\r\n";
			 $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			 $header .= 'From: MakeUber <reachus@makeuber.com>';
			 $container .='<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#E6E6E6">
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="61" align="center"><a href= "http://www.makeuber.com" target="_blank"><img src="http://www.makeuber.com/img/logo.png"/></a></td>
               
              
        </tr>
		<TR><TD>&nbsp;</TD</TR>
        
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="7%">&nbsp;</td>
                <td width="58%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="95%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="35" align="left" valign="middle" style="border-bottom:2px dotted #000000"><font style="font-family: Georgia, Times New Roman, Times, serif; color:#000000; font-size:25px"><strong><em>Welcome To MakeUber</em></strong></font></td>
                          </tr>
                          <tr>
                            <td align="left" valign="top"><font style="font-family: Verdana, Geneva, sans-serif; color:#000000; font-size:13px; line-height:21px">
       <p>&nbsp;</p>
	  
	   <p>User Has Submitted His Project Requirements. </p> 
    <p>User Information is As bellow</p>
    
        
    <p> Name: '.$userfetch['first_name'].' '.$dvar['last_name'].'</p>
	<p> Email: '.$userfetch['email_id'].'</p>
	<p> Phone number: '.$userfetch['phone'].'</p>
    
   </font></td>
                          </tr>
                          <tr>
                            <td></td>
                          </tr>
                          <tr>
                            <td></td>
                          </tr>
                          <tr>
                            <td></td>
                          </tr>
                          <tr>

                            <td></td>
                          </tr>
                        </table></td>
                        
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
                <td width="5%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="82%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="10"> </td>
                      </tr>

                      <tr>
                        <td></td>
                      </tr>
                    </table></td>
                    <td width="8%">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
       
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>';
			
	mail($to_admin , $sub, $container, $header);	
			$message[0] = 'Success'; $message[1] = '<span style="color:green">Thank you for submitting your requirements with MakeUber.Our team will be contacting you within 24 hours.<br/></span>';
			$message[2] = '<a href="Index.php"><button type="button" class="btn btn-success">OK</button></a>';
			

		}else{
			
			$userfetch = $_SESSION['your_project'];
			$to = $userfetch['email'];    //  your email
			 $subject  = ' Thank you for contacting us!!';
			$header = ' MIME-Version: 1.0' . "\r\n";
		$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$header .= 'From: MakeUber <reachus@makeuber.com>';
			 $body .='<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#E6E6E6">
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="61" align="center"><a href= "http://www.makeuber.com" target="_blank"><img src="http://www.makeuber.com/img/logo.png"/></a></td>
               
              
        </tr>
		<TR><TD>&nbsp;</TD</TR>
        
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="7%">&nbsp;</td>
                <td width="58%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="95%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="35" align="left" valign="middle" style="border-bottom:2px dotted #000000"><font style="font-family: Georgia, Times New Roman, Times, serif; color:#000000; font-size:25px"><strong><em>Welcome To MakeUber</em></strong></font></td>
                          </tr>
                          <tr>
                            <td align="left" valign="top"><font style="font-family: Verdana, Geneva, sans-serif; color:#000000; font-size:13px; line-height:21px">
       <p>&nbsp;</p>
	    <p>Thank you for submitting your requirements with MakeUber.</p><br>
	   <p>Our team will be contacting you within 24 hours. If you have any further questions, concerns, or suggestions, shout out to our team anytime through the contact form on</p>
	   <a href="http://www.makeuber.com/contact_us">http://www.makeuber.com/contact_us</a><br/>
	   
	  <p> Or you could write to us anytime at reachus@makeuber.com</p>
	  
	  <p>We hope you have an enjoyable experience with us.<p>
	  
	  <p>Best Wishes,</p>
	  
	  MakeUber Team
    
    </font></td>
                          </tr>
                          <tr>
                            <td></td>
                          </tr>
                          <tr>
                            <td></td>
                          </tr>
                          <tr>
                            <td></td>
                          </tr>
                          <tr>

                            <td></td>
                          </tr>
                        </table></td>
                        
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
                <td width="5%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="82%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="10"> </td>
                      </tr>
                      <tr>
                        <td></td>
                      </tr>
                    </table></td>
                    <td width="8%">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
       
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>';
			
	mail($to, $subject, $body, $header);
	//////////////////////////////////send mail to admin///////////////////////////////////
			$to_admin ="reachus@makeuber.com";    //  your email
			 $sub = ' New Customer Requirements!!';
			$header = ' MIME-Version: 1.0' . "\r\n";
		$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$header .= 'From: MakeUber <reachus@makeuber.com>';
			 $container .='<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#E6E6E6">
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="61" align="center"><a href= "http://www.makeuber.com" target="_blank"><img src="http://www.makeuber.com/img/logo.png"/></a></td>
               
              
        </tr>
		<TR><TD>&nbsp;</TD</TR>
        
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="7%">&nbsp;</td>
                <td width="58%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="95%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="35" align="left" valign="middle" style="border-bottom:2px dotted #000000"><font style="font-family: Georgia, Times New Roman, Times, serif; color:#000000; font-size:25px"><strong><em>Welcome To MakeUber</em></strong></font></td>
                          </tr>
                          <tr>
                            <td align="left" valign="top"><font style="font-family: Verdana, Geneva, sans-serif; color:#000000; font-size:13px; line-height:21px">
       <p>&nbsp;</p>
	  
	  
	   <p>User Has Submitted His Project Requirements. </p> 
    <p>User Information is As bellow</p>
    
        
	<p> Email: '.$userfetch['email'].'</p>
	<p> Phone number: '.$userfetch['phone'].'</p>
    
   </font></td>
                          </tr>
                          <tr>
                            <td></td>
                          </tr>
                          <tr>
                            <td></td>
                          </tr>
                          <tr>
                            <td></td>
                          </tr>
                          <tr>

                            <td></td>
                          </tr>
                        </table></td>
                        
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
                <td width="5%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="82%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="10"> </td>
                      </tr>

                      <tr>
                        <td></td>
                      </tr>
                    </table></td>
                    <td width="8%">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
       
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>';
			
	mail($to_admin , $sub, $container, $header);	
			$message[0] = 'Success'; $message[1] = '<span style="color:green">Thank you for submitting your requirements with MakeUber.Our team will be contacting you within 24 hours.<br/></span>';
			$message[2] = '<a href="Index.php"><button type="button" class="btn btn-success">OK</button></a>';
			

		
		//$message[0] = 'Error';	$message[1] = '<span style="color:red">Error: Error Sending Email</span>';
		}
	}
	//$message[1] = $user_uniq;
	ksort($message);
//	ksort($message);
	$message_arr = implode('|::|', $message);
	echo $message_arr;
}

if($_POST['do'] == 'feedback'){
	$name = $_POST['name'];
	$email = $_POST['email'];
	$feedback_type = $_POST['feedback_type'];
	$feedback = $_POST['feedback'];
	if($name == ''){
		$message[0] = 'Error';	$message[1] = '<span style="color:red">Error: Please Enter name.</span>';
	}else if($email == ''){
		$message[0] = 'Error';	$message[1] = '<span style="color:red">Error: Please Enter email.</span>';
	}else if($feedback == ''){
		$message[0] = 'Error';	$message[1] = '<span style="color:red">Error: Please Enter Your Feedback.</span>';
	}
	if(empty($message)){
		$to = "reachus@makeuber.com";
		$subject = "User Feedback";
		$header = ' MIME-Version: 1.0' . "\r\n";
		$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$header .= 'From: MakeUber <reachus@makeuber.com>';
		$messages = "Hello Admin you got a mail \n\n";
		$messages .= "Name: ".$name."<br/>";
		$messages .= "Mobile: ".$mobile."<br/>";
		$messages .= "Email: ".$email."<br/>";
		$messages .= "Feedback Type".$feedback_type."<br/>";
		$messages .= "Message: ".$feedback;
		
		if(mail($to,$subject,$messages,$header)){
			$message[0] = 'Success';	$message[1] = '<span style="color:Green">Success: Feedback Send Successfully</span>';
		}else{
			$message[0] = 'Error';	$message[1] = '<span style="color:red">Error: Error Sending Feedback.</span>';
		}
			
		
	}
	ksort($message);
//	ksort($message);
	$message_arr = implode('|::|', $message);
	echo $message_arr;
}

if($_POST['do'] == 'design_data'){
		$dvar['project_id'] = $_POST['project'];
		$dvar['description'] = $_POST['description'];
		$dvar['user_id']  = $user_uniq;
		$dvar['email'] = $_POST['email'];
		$dvar['phone'] = $_POST['phone'];
		$dvar['price'] = $_POST['budget'];
		$dvar['expert'] = $_SESSION['your_project']['expert'];
		$dvar['expert_name'] = $_SESSION['your_project']['expert_name'];
		$dvar['apartment'] = $_POST['apartment'];
		$dvar['city'] = $_POST['city'];
		$dvar['area'] = $_POST['area'];
	

			
				if(!empty($flag)){
					$flag_r = 'r';
				}
				else{
				
				$uniq = random_generator(10);
			$add_dvar = array('status' => '1', 'time' => time());
			
			$remove_dvar = array('image_delete','image_delete2');
//			$change_dvar = array('status' => '1');

			list($insert_q[0], $insert_q[1]) = insert_query($dvar, $add_dvar, $remove_dvar, $change_dvar);
			
			$sql_gal = "INSERT into project(sort, $insert_q[0]) SELECT max(sort)+1, $insert_q[1] from project";
			$fg = 'ad';
			
			if(mysql_query($sql_gal)){
			//unset($_SESSION['your_project']);
				
		$sql_user="select * from user where uniq_id='".$user_uniq."'";
		$exec_user = mysql_query($sql_user);
		if(mysql_num_rows($exec_user)>0){
			$userfetch = mysql_fetch_array($exec_user);
			$to = $userfetch['email_id'];    //  your email
			 $subject  = ' Thank you for contacting us!!';
			$header = ' MIME-Version: 1.0' . "\r\n";
		$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$header .= 'From: MakeUber <reachus@makeuber.com>';
			 $body .='<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#E6E6E6">
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="61" align="center"><a href= "http://www.makeuber.com" target="_blank"><img src="http://www.makeuber.com/img/logo.png"/></a></td>
               
              
        </tr>
		<TR><TD>&nbsp;</TD</TR>
        
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="7%">&nbsp;</td>
                <td width="58%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="95%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="35" align="left" valign="middle" style="border-bottom:2px dotted #000000"><font style="font-family: Georgia, Times New Roman, Times, serif; color:#000000; font-size:25px"><strong><em>Welcome To MakeUber</em></strong></font></td>
                          </tr>
                          <tr>
                            <td align="left" valign="top"><font style="font-family: Verdana, Geneva, sans-serif; color:#000000; font-size:13px; line-height:21px">
       <p>&nbsp;</p>
	    <p>Thank you for submitting your requirements with MakeUber.</p>
	   <p>Our team will be contacting you within 24 hours. If you have any further questions, concerns, or suggestions, shout out to our team anytime through the contact form on</p>
	   <a href="http://www.makeuber.com/contact_us">http://www.makeuber.com/contact_us</a>
	   
	  <p> Or you could write to us anytime at reachus@makeuber.com</p>
	  
	  <p>We hope you have an enjoyable experience with us.<p>
	  
	  <p>Best Wishes,</p>
	  
	  MakeUber Team
    
    </font></td>
                          </tr>
                          <tr>
                            <td></td>
                          </tr>
                          <tr>
                            <td></td>
                          </tr>
                          <tr>
                            <td></td>
                          </tr>
                          <tr>

                            <td></td>
                          </tr>
                        </table></td>
                        
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
                <td width="5%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="82%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="10"> </td>
                      </tr>
                      <tr>
                        <td></td>
                      </tr>
                    </table></td>
                    <td width="8%">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
       
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>';
			
	mail($to, $subject, $body, $header);
	//////////////////////////////////send mail to admin///////////////////////////////////
$to_admin ="reachus@makeuber.com";    //  your email
			 $sub  = 'New Customer Requirement';
			$header = ' MIME-Version: 1.0' . "\r\n";
		$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$header .= 'From: MakeUber <reachus@makeuber.com>';
			 $container .='<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#8d8e90">
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="61"><a href= "http://www.makeuber.com" target="_blank"><img src="http://www.makeuber.com/img/logo.png"/></a></td>
               
                <td width="393"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="46" align="right" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                           
                            <td width="29%" align="right"><font style="font-family:Myriad Pro, Helvetica, Arial, sans-serif; color:#68696a; font-size:10px"><a href= "http://www.makeuber.com/admin" style="color:#68696a; text-decoration:none; text-transform:uppercase"><strong>GO TO THE ADMIN PANEL</strong></a></font></td>
                            <td width="4%">&nbsp;</td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td height="30">&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
         <tr>
          <td align="center"><font style="font-family:Myriad Pro, Helvetica, Arial, sans-serif; color:#68696a; font-size:36px; text-transform:uppercase"><strong>MakeUber</strong></font></td>
        </tr>
        <tr>
          <td align="center"><a href= "http://www.makeuber.com" target="_blank"><img src="http://www.makeuber.com/img/Y3W9Dg6y5R.png" alt="" width="598" height="260" border="0"/></a></td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="7%">&nbsp;</td>
                <td width="58%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="95%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="35" align="left" valign="middle" style="border-bottom:2px dotted #000000"><font style="font-family: Georgia, Times New Roman, Times, serif; color:#000000; font-size:25px"><strong><em>New User Requirement submission</em></strong></font></td>
                          </tr>
                          <tr>
                            <td align="left" valign="top"><font style="font-family: Verdana, Geneva, sans-serif; color:#000000; font-size:13px; line-height:21px">
       <p>&nbsp;</p>
	  
	  
	   <p>User Has Submitted His Project Requirements. </p> 
    <p>User Information is As bellow</p>
    
        
    <p> Name: '.$userfetch['first_name'].' '.$dvar['last_name'].'</p>
	<p> Email: '.$userfetch['email_id'].'</p>
	<p> Phone number: '.$userfetch['phone'].'</p>
    
   </font></td>
                          </tr>
                          <tr>
                            <td></td>
                          </tr>
                          <tr>
                            <td></td>
                          </tr>
                          <tr>
                            <td></td>
                          </tr>
                          <tr>

                            <td></td>
                          </tr>
                        </table></td>
                        
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
                <td width="5%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="82%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="10"> </td>
                      </tr>

                      <tr>
                        <td></td>
                      </tr>
                    </table></td>
                    <td width="8%">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
       
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>';
			
	mail($to_admin , $sub, $container, $header);	
		// $message[0] = 'Success';	$message[1] = '<span style="color:green">Thank you for sharing your requirements. We will shortly get in touch with you.</span>';
				//	$message[2] = '<a href="Index.php"><input type="button" name="submitbut"  value="Ok" class="btn  btn-success"></a>';
			header ( 'location:Index.php' ) ; 

		}else{
			
			
			$userfetch = $_SESSION['your_project'];
			$to = $userfetch['email'];    //  your email
			 $subject  = ' Thank you for contacting us!!';
			$header = ' MIME-Version: 1.0' . "\r\n";
		$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$header .= 'From: MakeUber <reachus@makeuber.com>';
			 $body .='<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#E6E6E6">
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="61" align="center"><a href= "http://www.makeuber.com" target="_blank"><img src="http://www.makeuber.com/img/logo.png"/></a></td>
               
              
        </tr>
		<TR><TD>&nbsp;</TD</TR>
        
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="7%">&nbsp;</td>
                <td width="58%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="95%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="35" align="left" valign="middle" style="border-bottom:2px dotted #000000"><font style="font-family: Georgia, Times New Roman, Times, serif; color:#000000; font-size:25px"><strong><em>Welcome To MakeUber</em></strong></font></td>
                          </tr>
                          <tr>
                            <td align="left" valign="top"><font style="font-family: Verdana, Geneva, sans-serif; color:#000000; font-size:13px; line-height:21px">
       <p>&nbsp;</p>
	    <p>Thank you for submitting your requirements with MakeUber.</p>
	   <p>Our team will be contacting you within 24 hours. If you have any further questions, concerns, or suggestions, shout out to our team anytime through the contact form on</p>
	   <a href="http://www.makeuber.com/contact_us">http://www.makeuber.com/contact_us</a>
	   
	  <p> Or you could write to us anytime at reachus@makeuber.com</p>
	  
	  <p>We hope you have an enjoyable experience with us.<p>
	  
	  <p>Best Wishes,</p>
	  
	  MakeUber Team
    
    </font></td>
                          </tr>
                          <tr>
                            <td></td>
                          </tr>
                          <tr>
                            <td></td>
                          </tr>
                          <tr>
                            <td></td>
                          </tr>
                          <tr>

                            <td></td>
                          </tr>
                        </table></td>
                        
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
                <td width="5%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="82%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="10"> </td>
                      </tr>
                      <tr>
                        <td></td>
                      </tr>
                    </table></td>
                    <td width="8%">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
       
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>';
			
	mail($to, $subject, $body, $header);
	//////////////////////////////////send mail to admin///////////////////////////////////
$to_admin ="reachus@makeuber.com";    //  your email
			 $sub  = 'New Customer Requirement';
			$header = ' MIME-Version: 1.0' . "\r\n";
		$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$header .= 'From: MakeUber <reachus@makeuber.com>';
			 $container .='<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#E6E6E6">
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="61" align="center"><a href= "http://www.makeuber.com" target="_blank"><img src="http://www.makeuber.com/img/logo.png"/></a></td>
               
              
        </tr>
		<TR><TD>&nbsp;</TD</TR>
        
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="7%">&nbsp;</td>
                <td width="58%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="95%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="35" align="left" valign="middle" style="border-bottom:2px dotted #000000"><font style="font-family: Georgia, Times New Roman, Times, serif; color:#000000; font-size:25px"><strong><em>Welcome To MakeUber</em></strong></font></td>
                          </tr>
                          <tr>
                            <td align="left" valign="top"><font style="font-family: Verdana, Geneva, sans-serif; color:#000000; font-size:13px; line-height:21px">
       <p>&nbsp;</p>
	  
	  
	   <p>User Has Submitted His Project Requirements. </p> 
    <p>User Information is As bellow</p>
    
        
	<p> Email: '.$userfetch['email'].'</p>
	<p> Phone number: '.$userfetch['phone'].'</p>
    
   </font></td>
                          </tr>
                          <tr>
                            <td></td>
                          </tr>
                          <tr>
                            <td></td>
                          </tr>
                          <tr>
                            <td></td>
                          </tr>
                          <tr>

                            <td></td>
                          </tr>
                        </table></td>
                        
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
                <td width="5%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="82%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="10"> </td>
                      </tr>

                      <tr>
                        <td></td>
                      </tr>
                    </table></td>
                    <td width="8%">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
       
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>';

		
	mail($to_admin , $sub, $container, $header);	
		//$message[0] = 'Success';	$message[1] = '<span style="color:green">Thank you for sharing your requirements. We will shortly get in touch with you.</span>';
			//		$message[2] = '<a href="Index.php"><input type="button" name="submitbut"  value="Ok" class="btn  btn-success"></a>';
					
			 header ( 'location:Index.php' ) ;
		
		}
		
			
					
	}else{
		$message[0] = 'Error';	$message[1] = '<span style="color:red">'.mysql_error().'</span>';
	}
				
				}
		
	
		
	ksort($message);
//	ksort($message);
	$message_arr = implode('|::|', $message);
	echo $message_arr;
}

if($_POST['do'] == 'question_submit'){
	$title = $_POST['title'];
	$userid = $_POST['user_id'];
	$image_id = $_POST['image_id'];
	$design = $_POST['design'];
	$description = $_POST['about_img'];
	if($title == ''){
		$message[0] = 'Error';	$message[1] = '<span style="color:red">Error: Please Enter Title.</span>';
	}else if($description == ''){
		$message[0] = 'Error';	$message[1] = '<span style="color:red">Error: Please Enter Details.</span>';
	}
	if(empty($message)){
		$time = time();
		 $sql = "INSERT into discussion(sort, image_id, user_id, design, tittle, about_img, time, status) select max(sort)+1, '$image_id','$userid', '$design' ,'$title', '$description' ,'$time', '1' from discussion";
		if(mysql_query($sql)){
			$message[0] = 'Success';	$message[1] = '<span style="color:Green">Success: Question Added Successfully</span>';
		}else{
			$message[0] = 'Error';	$message[1] = '<span style="color:red">Error:'.mysql_error().'</span>';
		}
			
		
	}
	ksort($message);
//	ksort($message);
	$message_arr = implode('|::|', $message);
	echo $message_arr;
}

if($_GET['do'] == 'add_requirement'){
	$id = $_GET['id'];
	$dvar['project_id'] = $_GET['project'];
	$dvar['user_id'] = $_GET['user_uniq'];
	$dvar['design'] = $_GET['design'];
	$dvar['category'] = $_GET['category'];
	$dvar['material'] = $_GET['material'];
	if($dvar['design'] == 'undefined'){
		$dvar['design'] = 0;	
	}
	if($dvar['material'] == 'undefined'){
		$dvar['material'] = 0;	
	}
	
		
		$sql_check = "select * from user_selection where project_id='".$dvar['project_id']."' and category = '".$dvar['category']."' and user_id = '".$dvar['user_id']."' order by id DESC limit 1";
		$exec_check= mysql_query($sql_check);
		$num_check = mysql_num_rows($exec_check);
		if($num_check > 0){
			$fetch_info = mysql_fetch_assoc($exec_check);
/*			if($fetch_info['material'] <> 0 && $fetch_info['design'] <> 0){
				
			$time = time();
		 
			$add_dvar = array('status' => '1', 'time' => time());
			
			//$remove_dvar = array('image_delete','image_delete2');
			//$change_dvar = array('status' => '1');
				
			list($insert_q[0], $insert_q[1]) = insert_query($dvar, $add_dvar, $remove_dvar, $change_dvar);
			
			$sql_gal = "INSERT into user_selection(sort, $insert_q[0]) SELECT max(sort)+1, $insert_q[1] from user_selection"; 
				
			if(mysql_query($sql_gal)){
				$message[0] = 'Success';	$message[1] = '<span style="color:Green">Success: Record Added Successfully</span>';
				$message[3] = mysql_insert_id();

			}else{
				$message[0] = 'Error';	$message[1] = '<span style="color:red">Error:'.mysql_error().'</span>';
			}
			}else{
*/				if($dvar['material'] == 0 && $fetch_info['material'] <> 0){
					$dvar['material'] = $fetch_info['material'];	
				}
				if($dvar['design'] == 0 && $fetch_info['design'] <> 0){
					$dvar['design'] = $fetch_info['design'];	
				}
					//$add_dvar = array('project_image' => $sql_file, 'floor_plan' => $sql_file1, 'time' => time());
					//$remove_dvar = array('image_delete',);
		//			$change_dvar = array('status' => '0');
					
					$sql_gal = "UPDATE user_selection SET ".update_query($dvar, $add_dvar, $remove_dvar, $change_dvar)." where id='".$id."'";
					if(mysql_query($sql_gal)){
					$message[0] = 'Success';	$message[1] = '<span style="color:Green">Success: Record Added Successfully</span>';
					$message[3] = $fetch_info['id'];
					}else{
					$message[0] = 'Error';	$message[1] = '<span style="color:red">Error:'.mysql_error().'</span>';
					}
					
				
			//}
		}else{
			
			$time = time();
		 
			$add_dvar = array('status' => '1', 'time' => time());
		
		//$remove_dvar = array('image_delete','image_delete2');
		//$change_dvar = array('status' => '1');
		
			list($insert_q[0], $insert_q[1]) = insert_query($dvar, $add_dvar, $remove_dvar, $change_dvar);
			
			$sql_gal = "INSERT into user_selection(sort, $insert_q[0]) SELECT max(sort)+1, $insert_q[1] from user_selection"; 
				
			if(mysql_query($sql_gal)){
				$message[0] = 'Success';	$message[1] = '<span style="color:Green">Success: Record Added Successfully</span>';
				$message[3] = mysql_insert_id();
			}else{
				$message[0] = 'Error';	$message[1] = '<span style="color:red">Error:'.mysql_error().'</span>';
			}
		}
		$message[2] = $sql_gal;
			
	ksort($message);
//	ksort($message);
	$message_arr = implode('|::|', $message);
	echo $message_arr;
}

if($_GET['do'] == 'delete_requirement'){
	$id = $_GET['id'];
	$dvar['project_id'] = $_GET['project'];
	$dvar['user_id'] = $_GET['user_uniq'];
	$dvar['design'] = $_GET['design'];
	$dvar['category'] = $_GET['category'];
	$dvar['material'] = $_GET['material'];
	if($dvar['design'] == 'undefined'){
		$dvar['design'] = 0;	
	}
	if($dvar['material'] == 'undefined'){
		$dvar['material'] = 0;	
	}
	
		
		$sql_check = "select * from user_selection where id='$id'";
		$exec_check= mysql_query($sql_check);
		$num_check = mysql_num_rows($exec_check);
		if($num_check > 0){
			$fetch_info = mysql_fetch_assoc($exec_check);
			if($fetch_info['material'] <> 0 && $fetch_info['design'] <> 0){
				
			if($dvar['material'] == 0 && $fetch_info['material'] <> 0){
					$dvar['material'] = $fetch_info['material'];	
				}
				if($dvar['design'] == 0 && $fetch_info['design'] <> 0){
					$dvar['design'] = $fetch_info['design'];	
				}
					//$add_dvar = array('project_image' => $sql_file, 'floor_plan' => $sql_file1, 'time' => time());
					//$remove_dvar = array('image_delete',);
		//			$change_dvar = array('status' => '0');
					
					$sql_gal = "UPDATE user_selection SET ".update_query($dvar, $add_dvar, $remove_dvar, $change_dvar)." where id='".$fetch_info['id']."'";
					if(mysql_query($sql_gal)){
					$message[0] = 'Success';	$message[1] = '<span style="color:Green">Success: Record Added Successfully</span>';
					}else{
					$message[0] = 'Error';	$message[1] = '<span style="color:red">Error:'.mysql_error().'</span>';
					}
					
			}else{
				
					//$add_dvar = array('project_image' => $sql_file, 'floor_plan' => $sql_file1, 'time' => time());
					//$remove_dvar = array('image_delete',);
		//			$change_dvar = array('status' => '0');
					
					$sql_gal = "delete from user_selection  where id='".$id."'";
					if(mysql_query($sql_gal)){
					$message[0] = 'Success';	$message[1] = '<span style="color:Green">Success: Record Added Successfully</span>';
					}else{
					$message[0] = 'Error';	$message[1] = '<span style="color:red">Error:'.mysql_error().'</span>';
					}
					
				
			}
		}
		$message[2] = $sql_gal;
			
	ksort($message);
//	ksort($message);
	$message_arr = implode('|::|', $message);
	echo $message_arr;
}

//add Likes into database according to the User
if($_GET['do'] == 'add_likes'){
	$image_id =  mysql_real_escape_string($_GET['image_id']);
	$userid =  mysql_real_escape_string($_GET['userid']);
	
	$sql = "select * from likes where user_id='".$userid."' and image_id='".$image_id."' and uc='0'"; 
	$exec = mysql_query($sql);
	$num = mysql_num_rows($exec);
	
	if($num != 0){$message[0] = 'Error';	$message[1] = 'You have already Liked This Image'; }	
	if(empty($message)){
		$time = time();
		 $sql = "INSERT into likes(image_id, user_id, uc, time, status) values('$image_id', '$userid', '0', '$time','1')";
		if(mysql_query($sql)){
			$sql_likes = "select * from likes where image_id='".$image_id."'"; 
			$exec_likes = mysql_query($sql_likes);
			$num_likes = mysql_num_rows($exec_likes);
			$message[0] = 'Success'; $message[1] = '<a style="cursor:pointer" onClick="unlike('.$image_id.','."'".''.$userid.''."'".')">Unlike</a>';
			if($num_likes == ''){
				$message[3] = '0';
			}else{
				$message[3] = $num_likes;
			}
		}
		else{
			$message[0] = 'Error';	$message[1] = 'Error:';
		}
	}
	$message[2]=$image_id;
	ksort($message);
//	ksort($message);
	$message_arr = implode('|::|', $message);
	echo $message_arr;
}

if($_GET['do'] == 'add_likes1'){
	$image_id =  mysql_real_escape_string($_GET['image_id']);
	$userid =  mysql_real_escape_string($_GET['userid']);
	
	$sql = "select * from likes where user_id='".$userid."' and image_id='".$image_id."' and uc='0'"; 
	$exec = mysql_query($sql);
	$num = mysql_num_rows($exec);
	
	if($num != 0){$message[0] = 'Error';	$message[1] = 'You have already Liked This Image'; }	
	if(empty($message)){
		$time = time();
		 $sql = "INSERT into likes(image_id, user_id, uc, time, status) values('$image_id', '$userid', '0', '$time','1')";
		if(mysql_query($sql)){
			$sql_likes = "select * from likes where image_id='".$image_id."'"; 
			$exec_likes = mysql_query($sql_likes);
			$num_likes = mysql_num_rows($exec_likes);
			$message[0] = 'Success'; $message[1] = '<a style="cursor:pointer" onClick="unlike1(\''.$userid.'\')">Unlike</a>';
			if($num_likes == ''){
				$message[3] = '0';
			}else{
				$message[3] = $num_likes;
			}
		}
		else{
			$message[0] = 'Error';	$message[1] = 'Error:';
		}
	}
	$message[2]=$image_id;
	ksort($message);
//	ksort($message);
	$message_arr = implode('|::|', $message);
	echo $message_arr;
}


//add Likes into database according to the User
if($_GET['do'] == 'add_likes_reviews'){
	$image_id =  mysql_real_escape_string($_GET['image_id']);
	$userid =  mysql_real_escape_string($_GET['userid']);
	
	$sql = "select * from likes_reviews where user_id='".$userid."' and review_id='".$image_id."' and uc='0'"; 
	$exec = mysql_query($sql);
	$num = mysql_num_rows($exec);
	
	if($num != 0){$message[0] = 'Error';	$message[1] = 'You have already Liked This Review'; }	
	if(empty($message)){
		$time = time();
		 $sql = "INSERT into likes_reviews(review_id, user_id, uc, time, status) values('$image_id', '$userid', '0', '$time','1')";
		if(mysql_query($sql)){
			$sql_likes = "select * from likes_reviews where image_id='".$image_id."'"; 
			$exec_likes = mysql_query($sql_likes);
			$num_likes = mysql_num_rows($exec_likes);
			$message[0] = 'Success'; $message[1] = $num_likes;
			if($num_likes == ''){
				$message[3] = '0';
			}else{
				$message[3] = $num_likes;
			}
		}
		else{
			$message[0] = 'Error';	$message[1] = 'Error:';
		}
	}
	$message[2]=$image_id;
	ksort($message);
//	ksort($message);
	$message_arr = implode('|::|', $message);
	echo $message_arr;
}

//Unlike an image

if($_GET['do'] == 'unlikes'){
	$image_id =  mysql_real_escape_string($_GET['image_id']);
	$userid =  mysql_real_escape_string($_GET['userid']);
		 $sql = "delete from likes where image_id='$image_id' and user_id='$userid' and uc='0'";
		if(mysql_query($sql)){
			$sql_likes = "select * from likes where image_id=".$image_id." and uc='0'";
			$exec_likes = mysql_query($sql_likes);
			$num_likes = mysql_num_rows($exec_likes);
		
			$message[0] = 'Success'; $message[1] = '<a style="cursor:pointer" onClick="like('.$image_id.','."'".''.$userid.''."'".')">Like</a>';
			$message[3] = $num_likes;

		}
		else{
			$message[0] = 'Error';	$message[1] = 'Error:';
		}
	
	$message[2]=$image_id;
	ksort($message);
//	ksort($message);
	$message_arr = implode('|::|', $message);
	echo $message_arr;
}

if($_GET['do'] == 'unlikes1'){
	$image_id =  mysql_real_escape_string($_GET['image_id']);
	$userid =  mysql_real_escape_string($_GET['userid']);
		 $sql = "delete from likes where image_id='$image_id' and user_id='$userid' and uc='0'";
		if(mysql_query($sql)){
			$sql_likes = "select * from likes where image_id=".$image_id." and uc='0'";
			$exec_likes = mysql_query($sql_likes);
			$num_likes = mysql_num_rows($exec_likes);
		
			$message[0] = 'Success'; $message[1] = '<a style="cursor:pointer" onClick="like1(\''.$userid.'\')">Like</a>';
			$message[3] = $num_likes;

		}
		else{
			$message[0] = 'Error';	$message[1] = 'Error:';
		}
	
	$message[2]=$image_id;
	ksort($message);
//	ksort($message);
	$message_arr = implode('|::|', $message);
	echo $message_arr;
}


// add a message

if($_POST['do'] == 'msgsave'){
	$tabl = "comment";
	$comment=$_POST['comment'];
	$image_id =  mysql_real_escape_string($_POST['image_id']);
	$userid =  mysql_real_escape_string($_POST['userid']);
	if($comment == ''){
			$message[0] = 'Error';	$message[1] = '<span style="font-size:15px">Error: Please Enter Comment.</span>';
	}
	else{
		$time = time();
		 $sql = "INSERT into comment(image_id, user_id, comments, uc, time, status) values('$image_id', '$userid', '$comment', '1', '$time','1')";
		if(mysql_query($sql)){
			
			$message[0] = 'Success';
			$sql_comment = "select comment.*,user.first_name,user.last_name, user.image as img,user.uniq_id as usid from comment left outer join user on user.uniq_id = comment.user_id where comment.image_id='".$image_id."' and comment.status='1' order by comment.id DESC";
			$exec_comment = mysql_query($sql_comment);
			$num_comment = mysql_num_rows($exec_comment);
			$message[2]  = $num_comment;
			$j=1;
			while($fetch_comment = mysql_fetch_assoc($exec_comment)){
				
				if($fetch_comment['img'] <> ''){ $img="img/".$fetch_comment['img'];}else{$img = "img/no_img.jpg";}
				 if($fetch_user['uniq_id']==$fetch_comment['user_id']){
$data = '<div onClick="del2('.$fetch_comment['id'].','.$fetch_comment['image_id'].','."'".''.$fetch_comment['user_id'].''."'".')"  class="cancel_co">x</div>

<div class="clear"></div>';
				 }

				$message[1] .= '<div class="comments_shows"><img style="float:left; margin-right:1%" src="'.$img.'" height="40px" width="40px">'.$fetch_comment['first_name'].' '.$fetch_comment['last_name'].':'.$fetch_comment['comments'].$data.'</div><div class="clearfix"></div>';
				/*$message[1] .= '<div class="comments_shows"><div style="float:left;"><img src="'.$img.'" height="40px" width="40px"/></div><div class="comment">'.$fetch_comment['first_name'].' '.$fetch_comment['last_name'].':'.$fetch_comment['comments'].'<div  onClick="del2('.$fetch_comment['id'].','.$image_id.','."'".''.$fetch_user['uniq_id'].''."'".')" class="cancel_co">x</div></div></div>
        <div class="clearfix"></div>';*/
		$data='';
		
				}
				
			//$message[1] = 'Success: Comment Posted successfully.';
			
		}	
		else{
			$message[0] = 'Error';	$message[1] = mysql_error();
		}
	}
	$message[3] = $image_id;
	$message[4] = $sql;

	ksort($message);
	$message_arr = implode('|::|', $message);
	echo $message_arr;
}

if($_POST['do'] == 'msgsave1'){
  $tabl = "comment";
  $comment=$_POST['comment'];
  $image_id =  mysql_real_escape_string($_POST['image_id']);
  $userid =  mysql_real_escape_string($_POST['userid']);
  if($comment == ''){
      $message[0] = 'Error';  $message[1] = '<span style="font-size:15px">Error: Please Enter Comment.</span>';
  }
  else{
    $time = time();
     $sql = "INSERT into comment(image_id, user_id, comments, uc, time, status) values('$image_id', '$userid', '$comment', '0', '$time','1')";
    if(mysql_query($sql)){
      
      $message[0] = 'Success';
    $sql_cmt = "select comment.*,user.first_name,user.last_name, user.image as img from comment left outer join user on user.uniq_id = comment.user_id where comment.image_id=$image_id and comment.status='1' and comment.uc='0' order by comment.id DESC";
	$exec_cmt = mysql_query($sql_cmt);
	while($fetch_cmt = mysql_fetch_assoc($exec_cmt)){
		 if($fetch_cmt['img'] <> ''){ $img="img/".$fetch_cmt['img'];}else{$img = "img/no_img.jpg";}
		$message[1] .= '<div class="comment-box"><div style="float:left;"><img src="'.$img.'" height="40px" width="40px"/></div><div class="comment">'.$fetch_cmt['first_name'].' '.$fetch_cmt['last_name'].':'.$fetch_cmt['comments'].'</div><div class="close del-comment" data-id = "'.$fetch_cmt['id'].'" data-imgId="'.$image_id.'" data-userId = "'.$fetch_cmt['user_id'].'">&times;</div></div><div class="clearfix"></div>';
	}
      
      
    } 
    else{
      $message[0] = 'Error';  $message[1] = mysql_error();
    }
  }
  //$message[3] = $image_id;

  ksort($message);
  $message_arr = implode('|::|', $message);
  echo $message_arr;
}



//check Tutorial Availability

if($_GET['do'] == 'tutorial_check'){
	$title = mysql_real_escape_string($_GET['title']);
	$sql="SELECT count(*) FROM tutorial WHERE  title =  '$title'";
	$exec = mysql_query($sql);
	list($num) = mysql_fetch_row($exec);

	if($num == 0){
		$message[1] = 'n';
	}
	else{
		$message[1] = 'y';
	}

	$message[0] = 'Success';
	
	ksort($message);

	$message_arr = implode('|::|', $message);
	echo $message_arr;
}

// send frend message
 if($_GET['do'] == 'send_messages' && $_GET['type'] == "addmessg"){
	$tabl = "messages";
	
		$dev_user_id = mysql_real_escape_string($_GET['dev_user_id']);
		$dev_message = mysql_real_escape_string($_GET['dev_message']);
		$user_uniq=$fetch_u['uniq'];
		if($dev_message == ''){$message[0] = 'Error'; $message[1] = '<span style="color:#f00">Error: Please Enter Message</span>';}	
		else{
			$sql = "SELECT count(*) as count, conversation from $tabl where user_uniq_sender='$user_uniq' && user_uniq_receiver='$dev_user_id' || user_uniq_sender='$dev_user_id' && user_uniq_receiver='$user_uniq'";
		$exec = mysql_query($sql);
		$fetch = mysql_fetch_assoc($exec);
		if($fetch[count] > 0){$conversation = $fetch[conversation];}
		else{$conversation = random_generator(32);}
			
		$time = time();
		$uniq = random_generator(32);
		$status=0;
			
			$sql_ins = "INSERT into $tabl(uniq, conversation, user_uniq_receiver, user_uniq_sender, message, status, timestamp, time) values('".$uniq."','".$conversation."','".$dev_user_id."', '".$fetch_u['uniq']."', '".$dev_message."', '".$status."', '".$time."', NOW())";
			if(mysql_query($sql_ins)){
				$message[0] = 'Success';	$message[1] = '<span style="color:#090">Success: Message Sent Successfully</span>';
			}
			else{
				$message[0] = 'Error'; $message[1] = '<span style="color:#f00">Error: Database error, Please contact Admin </span>';
			}
		}
		/*else{
			$message[0] = 'Success';	$message[1] = 'Request Already Sent';
		}*/
	ksort($message);
	$message_arr = implode('|::|', $message);
	echo $message_arr;
}

//Add  Message by message Detail page
    if($_GET['do'] == 'reply' && $_GET['type'] == 'message'){
	$tabl = "messages";
	 $conversation= mysql_real_escape_string($_GET['conversation']);
	 $reply= mysql_real_escape_string($_GET['reply']);
	 $user_uniq_sender= mysql_real_escape_string($_GET['user_uniq_sender']);
	 $user_uniq_receiver = mysql_real_escape_string($_GET['user_uniq_receiver']);
	
		$time = time();
		$uniq = random_generator(32);
		$reply = htmlentities($reply);
		$status=0;
		
		$sql = "INSERT into $tabl(uniq, conversation, user_uniq_sender, user_uniq_receiver, message, status, timestamp, time) values('$uniq', '$conversation', '$user_uniq_sender', '$user_uniq_receiver', '$reply', $status, '$time', NOW())";
		mysql_query($sql);						
		$message[0] = 'Success';	
	

//	ksort($message);
	$message_arr = implode('|::|', $message);
	echo $message_arr;
}

// Proposal detail handle messages
if($_GET['do'] == 'updates' && $_GET['type'] == 'pmessage'){
	$tabl = "messages";
	$timestamp= $_GET['timestamp'];
	$timestamp_m= $_GET['timestamp_more'];
	$conversation = mysql_real_escape_string($_GET['conversation']);
	
	$message = array();

	$page = $_GET['page'];
	$perpage = 9;
	$offset = $page * $perpage;
	
	if($timestamp == ''){$timestamp = 0;}

	$sql_msg = "(SELECT messages.*, users.image, users.first_name, users.last_name, users.uniq FROM messages left outer join users on users.uniq=messages.user_uniq_sender WHERE conversation='$conversation' AND messages.timestamp > '$timestamp' order by time DESC LIMIT $offset, $perpage) ORDER BY time ASC;";
	$exec_msg = mysql_query($sql_msg);
	$message[1] = $message[2] = '';	$timestamp_1st = '';	$i = 0;
	while($fetch_msg = mysql_fetch_assoc($exec_msg)){
		//get 1st time stamp for pagination purposes
		if($i == 0){$timestamp_1st = $fetch_msg[timestamp];}		
		
		if($fetch_msg['image'] <> ''){ $img = "thumb/".$fetch_msg[image];} else{ $img= 'images/no_img.jpg';}
		$message[1] .=  '<li id="'.$fetch_msg[timestamp].'"> 
                           <div class="left_img">
                            <img src="'.$img.'" height="53" width="54" alt="pic" />
                           </div>
                           <div class="text_centr">
                           <div class="left_center">
                            <div class="name_head">
                            '.$fetch_msg[first_name].'
                            </div>
                            <div class="text_msg">
                             '.nl2br($fetch_msg[message]).'.
                            </div>
                            </div>
                            <div class="ryt_center">
                             '.date("j M", $fetch_msg[timestamp]).'
                            </div>
                               <div class="clear"></div>
                           </div>
                          <div class="clear"></div>
                         </li>';
		
		$i++;
	}

	if($timestamp_m == '' || $timestamp_m == '0'){$timestamp_m = $timestamp_1st;}
	$sql="SELECT count(*) FROM messages WHERE conversation='$conversation' AND timestamp < '$timestamp_m'";
	$exec = mysql_query($sql);
	list($num) = mysql_fetch_row($exec);

	if($num == 0){
		$message[2] = 'r';
	}
	else{
		$message[2] = 'g';
	}

	$message[0] = 'Success';
	
	ksort($message);

	$message_arr = implode('|::|', $message);
	echo $message_arr;
}

// MORE messages
if($_GET['do'] == 'updates' && $_GET['type'] == 'pmessage_more'){
	$tabl = "messages";
	$timestamp= $_GET['timestamp'];
	$conversation = mysql_real_escape_string($_GET['conversation']);
	$group = mysql_real_escape_string($_GET['group_id']);
	$message = array();

	$page = $_GET['page'];
	$perpage = 9;
	$offset = $page * $perpage;
	
	if($timestamp == ''){$timestamp = 0;}

	$sql="SELECT count(*) FROM messages WHERE conversation='$conversation' AND timestamp < '$timestamp'";
	$exec = mysql_query($sql);
	list($num) = mysql_fetch_row($exec);
	
	$sql_msg = "(SELECT messages.*, users.image, users.first_name, users.last_name FROM messages left outer join users on users.uniq=messages.user_uniq_sender WHERE conversation='$conversation' AND messages.timestamp < '$timestamp' order by time DESC LIMIT $offset, $perpage) ORDER BY time ASC;";
	$exec_msg = mysql_query($sql_msg);
	$message[1] = $message[2] = '';
	while($fetch_msg = mysql_fetch_assoc($exec_msg)){
		$message[1] .=  '<li id="'.$fetch_msg[timestamp].'"> 
                           <div class="left_img">
                            <img src="thumb/'.$fetch_msg[image].'" height="53" width="54" alt="pic" />
                           </div>
                           <div class="text_centr">
                           <div class="left_center">
                            <div class="name_head">
                            '.$fetch_msg[first_name].'
                            </div>
                            <div class="text_msg">
                             '.nl2br($fetch_msg[message]).'.
                            </div>
                            </div>
                            <div class="ryt_center">
                             '.date("j M", $fetch_msg[timestamp]).'
                            </div>
                               <div class="clear"></div>
                           </div>
                          <div class="clear"></div>
                         </li>';
		$i++;
	}
	if($num <= $perpage){
		$message[2] = 'r';
	}
	else{
		$message[2] = 'g';
	}
	
	$message[0] = 'Success';
	
	ksort($message);

	$message_arr = implode('|::|', $message);
	echo $message_arr;
}
// Follow User Concept
 if($_GET['do'] == 'follow' && $_GET['type'] == "request"){
	$tabl = "follow";
	
		$follower = mysql_real_escape_string($_GET['follower']);
		$following = mysql_real_escape_string($_GET['following']);
		$time = time();
		$uniq = random_generator(32);
		$reply = htmlentities($reply);
		$status=0;
					
			$sql_ins = "INSERT into $tabl(uniq, follower, following, status, timestamp, time) values('".$uniq."','".$follower."','".$following."', '".$status."', '".$time."', NOW())";
			if(mysql_query($sql_ins)){
				$message[0] = 'Success';	$message[1] = '<span style="color:#090">Success: Message Sent Successfully</span>';
			}
			else{
				$message[0] = 'Error'; $message[1] = '<span style="color:#f00">Error: Database error, Please contact Admin </span>';
			}		
		
	ksort($message);
	$message_arr = implode('|::|', $message);
	echo $message_arr;
}

// Follow User Concept
 if($_GET['do'] == 'unfollow' && $_GET['type'] == "request"){
	$tabl = "follow";
	
		$follower = mysql_real_escape_string($_GET['follower']);
		$following = mysql_real_escape_string($_GET['following']);
		$sql="delete from follow where following='$following' and follower='$follower'";
		$exec = mysql_query($sql);
		if($exec){	
		$message[0] = 'Success';	$message[1] = '<span style="color:#090">Success: Unfollowed Successfully</span>';
			}
			else{
				$message[0] = 'Error'; $message[1] = '<span style="color:#f00">Error: Database error, Please contact Admin </span>';
			}		
		$message[2] = $sql;
	ksort($message);
	$message_arr = implode('|::|', $message);
	echo $message_arr;
}

// Add Favourite
 if($_GET['do'] == 'add' && $_GET['type'] == "favourite"){
	$tabl = "favourite";
	
		$user_uniq = mysql_real_escape_string($_GET['user_uniq']);
		$tutorial_id = mysql_real_escape_string($_GET['tutorial']);
		$time = time();
		$uniq = random_generator(32);
		$reply = htmlentities($reply); 
		$status=1;
					
			 $sql_ins = "INSERT into $tabl(uniq, user_uniq, tutorial_id, status, timestamp, time) values('".$uniq."','".$user_uniq."','".$tutorial_id."', '".$status."', '".$time."', NOW())";
			if(mysql_query($sql_ins)){
				$message[0] = 'Success';	$message[1] = '<span style="color:#090">Success: Tutorial Added To Favourite List</span>';
			}
			else{
				$message[0] = 'Error'; $message[1] = '<span style="color:#f00">Error: Database error, Please contact Admin </span>';
			}		
		
	ksort($message);
	$message_arr = implode('|::|', $message);
	echo $message_arr;
}

// Delete Favourite
 if($_GET['do'] == 'delete' && $_GET['type'] == "favourite"){
	$tabl = "favourite";
	
		$user_uniq = mysql_real_escape_string($_GET['user_uniq']);
		$tutorial_id = mysql_real_escape_string($_GET['tutorial']);
		$time = time();
		$uniq = random_generator(32);
		$reply = htmlentities($reply); 
		$status=1;
				if($tutorial_id <> ''){	
			 $sql_ins = "Delete from $tabl where user_uniq='".$user_uniq."' and tutorial_id='".$tutorial_id."'";
			if(mysql_query($sql_ins)){
				$message[0] = 'Success';	$message[1] = '<span style="color:#090">Success: Tutorial Deleted Successfully</span>';
			}
			else{
				$message[0] = 'Error'; $message[1] = '<span style="color:#f00">Error: Database error, Please contact Admin </span>';
			}		
				}
		
	ksort($message);
	$message_arr = implode('|::|', $message);
	echo $message_arr;
}

// Unfollow User
 if($_GET['do'] == 'unfollow' && $_GET['type'] == "user"){
	$tabl = "follow";
	
		$following = mysql_real_escape_string($_GET['following']);
		$follower = mysql_real_escape_string($_GET['follower']);
		$time = time();
		$uniq = random_generator(32);
		$reply = htmlentities($reply); 
		$status=1;
					
			 $sql_ins = "Delete from $tabl where follower='".$follower."' and following='".$following."'";
			if(mysql_query($sql_ins)){
				$message[0] = 'Success';	$message[1] = '<span style="color:#090">Success: Tutorial Deleted Successfully</span>';
			}
			else{
				$message[0] = 'Error'; $message[1] = '<span style="color:#f00">Error: Database error, Please contact Admin </span>';
			}		
		
	ksort($message);
	$message_arr = implode('|::|', $message);
	echo $message_arr;
}
if($_GET['do'] == 'review' && $_GET['type'] == "add_review"){
	$sql_review = mysql_query("select * from  jstar where ip='".$_SERVER['REMOTE_ADDR']."' and rest_uniq='".$_GET['tutorial']."' and user_uniq='".$_GET['user_uniq']."'");
	$count_ip = mysql_num_rows($sql_review);
	 if($_GET['comment'] == '')
	 {
		 $message[0] = 'Error';	$message[1] = 'Error: Please enter comment';
	 }
	 else if($_GET['review'] == '')
	 {
		$message[0] = 'Error';	$message[1] = 'Error: Please Select Review'; 
	 }
	 else if($count_ip != 0)
	 {
		 $message[0] = 'Error';	$message[1] = 'Error: Sorry You have already posted comment';
	 }
	 else
	 {
		 $sql = mysql_query('insert into jstar(user_uniq,rest_uniq,review,ip,url,rateval,time) values("'.$_GET['user_uniq'].'","'.$_GET['tutorial'].'","'.$_GET['comment'].'","'.$_SERVER['REMOTE_ADDR'].'","'.$_GET['url'].'","'.$_GET['review'].'","'.time().'")');
		 if($sql)
		 {
			  $message[0] = 'Success';	$message[1] = 'Success: Comment posted successfully.';
		 }
	 }
	 ksort($message);
	$message_arr = implode('|::|', $message);
	echo $message_arr;
}

//this is for select categories section on add description page
if($_GET['do'] == 'cat'){ 
	$cat_id =  mysql_real_escape_string($_GET['category']);
	 $sql = "select * from sub_categories where cat_id='".$cat_id."'"; 
	 $sql1 = "select * from material where cats_id='".$cat_id."'"; 
	$exec = mysql_query($sql);
	$exec1 = mysql_query($sql1);
	$num = mysql_num_rows($exec);
	$num1 = mysql_num_rows($exec1);
	if($num >0){
	while($name=mysql_fetch_assoc($exec)){
	$message[1] .= "<option value='".$name['id']."'>".$name['name']."</option>";
		}
		}
		elseif($cat_id!=$name['cat_id']){$message[1] .=	"<option value='0'>--Nothing--</option>" ;}
	$message[0] = 'Success';
//material	
	if($num1 >0){
	while($mat=mysql_fetch_assoc($exec1)){
	$message[3] .= "<option value='".$mat['id']."'>".$mat['material']."</option>";
		}
		}
		elseif($cat_id!=$mat['cats_id']){$message[3] .=	"<option value='0'>--Nothing--</option>" ;}
	$message[2] = 'Success';
	//$message[2] = $sql;
	 ksort($message);
	$message_arr = implode('|::|', $message);
	echo $message_arr;

}

if($_GET['do'] == 'add_likes2'){
	$image_id =  mysql_real_escape_string($_GET['image_id']);
	$userid =  mysql_real_escape_string($_GET['userid']);
	
	$sql = "select * from likes where user_id='".$userid."' and image_id='".$image_id."' and uc='1'"; 
	$exec = mysql_query($sql);
	$num = mysql_num_rows($exec);
	
	if($num != 0){$message[0] = 'Error';	$message[1] = 'You have already Liked This Image'; }	
	if(empty($message)){
		$time = time();
		 $sql = "INSERT into likes(image_id, user_id, uc, time, status) values('$image_id', '$userid', '1', '$time','1')";
		if(mysql_query($sql)){
			$sql_likes = "select * from likes where image_id='".$image_id."'"; 
			$exec_likes = mysql_query($sql_likes);
			$num_likes = mysql_num_rows($exec_likes);
			$message[0] = 'Success'; $message[1] = '<a style="cursor:pointer" onClick="unlike('.$image_id.','."'".''.$userid.''."'".')">Unlike</a>';
			if($num_likes == ''){
				$message[3] = '0';
			}else{
				$message[3] = $num_likes;
			}
		}
		else{
			$message[0] = 'Error';	$message[1] = 'Error:';
		}
	}
	$message[2]=$image_id;
	ksort($message);
//	ksort($message);
	$message_arr = implode('|::|', $message);
	echo $message_arr;
}

//Unlike an image

if($_GET['do'] == 'unlikes2'){
	$image_id =  mysql_real_escape_string($_GET['image_id']);
	$userid =  mysql_real_escape_string($_GET['userid']);
		 $sql = "delete from likes where image_id='$image_id' and user_id='$userid' and uc='1'";
		if(mysql_query($sql)){
			$sql_likes = "select * from likes where image_id=".$image_id." and uc='1' ";
			$exec_likes = mysql_query($sql_likes);
			$num_likes = mysql_num_rows($exec_likes);
		
			$message[0] = 'Success'; $message[1] = '<a style="cursor:pointer" onClick="like('.$image_id.','."'".''.$userid.''."'".')">Like</a>';
			$message[3] = $num_likes;

		}
		else{
			$message[0] = 'Error';	$message[1] = 'Error:';
		}
	
	$message[2]=$image_id;
	ksort($message);
//	ksort($message);
	$message_arr = implode('|::|', $message);
	echo $message_arr;
}
// add a message
if($_POST['do'] == 'savemsg'){
	$tabl = "comment";
	$comment=$_POST['comment'];
	$image_id =  mysql_real_escape_string($_POST['image_id']);
	$userid =  mysql_real_escape_string($_POST['userid']);
	if($comment == ''){
			$message[0] = 'Error';	$message[1] = 'Error: Please Enter Comment.';
	}
	else{
		$time = time();
		 $sql = "INSERT into comment(image_id, user_id, comments, uc, time, status) values('$image_id', '$userid', '$comment', '1', '$time','1')";
		 
		if(mysql_query($sql)){
			
			$message[0] = 'Success';
			$sql_comment = "select comment.*, comment.user_id as usid, user.first_name,user.last_name, user.image as img from comment left outer join user on user.uniq_id = comment.user_id where comment.image_id='".$image_id."' and comment.status='1' and comment.uc='1'";
			$exec_comment = mysql_query($sql_comment);
			$num_comment = mysql_num_rows($exec_comment);
			$message[2]  = $num_comment;
			
			while($fetch_comment = mysql_fetch_assoc($exec_comment)){
			
				if($fetch_comment['img'] <> ''){ $img="img/".$fetch_comment['img'];}else{$img = "img/no_img.jpg";}
				$message[1] .= '<div class="comments_shows"><img src="'.$img.'" height="40px" width="40px">'.$fetch_comment['first_name'].' '.$fetch_comment['last_name'].':'.$fetch_comment['comments'].'<div  onClick="del('.$fetch_comment['id'].','.$image_id.','."'".''.$fetch_user['uniq_id'].''."'".')" class="cancel_co">x</div><div class="clear"></div></div><div class="clear"></div>';
				}	
				
			//$message[1] = 'Success: Comment Posted successfully.';
			
		}	
		else{
			$message[0] = 'Error';	$message[1] = mysql_error();
		}
	}
	$message[3] = $image_id;

	ksort($message);
	$message_arr = implode('|::|', $message);
	echo $message_arr;
}

// add a message
if($_POST['do'] == 'savemsg1'){
	$tabl = "comment";
	$comment=$_POST['comment'];
	$image_id =  mysql_real_escape_string($_POST['image_id']);
	$userid =  mysql_real_escape_string($_POST['userid']);
	if($comment == ''){
			$message[0] = 'Error';	$message[1] = 'Error: Please Enter Comment.';
	}
	else{
		$time = time();
		 $sql_img = "INSERT into comment(image_id, user_id, comments, uc, time, status) values('$image_id', '$userid', '$comment', '1', '$time','1')";
		 
		if(mysql_query($sql_img)){
			
			$message[0] = 'Success';
			$sql_comment = "select comment.*, comment.user_id as usid, user.first_name,user.last_name, user.image as img from comment left outer join user on user.uniq_id = comment.user_id where comment.image_id='".$image_id."' and comment.status='1'";
			$exec_comment = mysql_query($sql_comment);
			$num_comment = mysql_num_rows($exec_comment);
			$message[2]  = $num_comment;
			$j=1;
			
			while($fetch_comment = mysql_fetch_assoc($exec_comment)){
				if($fetch_comment['img'] <> ''){ $img="img/".$fetch_comment['img'];}else{$img = "img/no_img.jpg";}
				$message[1] .= '<div class="comments_shows"><img src="'.$img.'" height="40px" width="40px">'.$fetch_comment['first_name'].' '.$fetch_comment['last_name'].':'.$fetch_comment['comments'].'<div  onClick="del('.$fetch_comment['id'].','.$image_id.','."'".''.$fetch_comment['usid'].''."'".')" class="cancel_co">x</div><div class="clear"></div></div><div class="clear"></div>';
				$j++;}	
				
			//$message[1] = 'Success: Comment Posted successfully.';
			
		}	
		else{
			$message[0] = 'Error';	$message[1] = mysql_error();
		}
	}
	$message[3] = $image_id;
	$message[4] = $sql_comment;

	ksort($message);
	$message_arr = implode('|::|', $message);
	echo $message_arr;
}

if($_GET['do'] == 'del_expert'){
  $id =  mysql_real_escape_string($_GET['id']);
  $image_id =  mysql_real_escape_string($_GET['image_id']);
  $uniq_id =  mysql_real_escape_string($_GET['uniq_id']);
    if($id <> ''){
      $sql_likes = "delete from comment where id='$id' and image_id='$image_id' and user_id='$uniq_id'";
      $exec_likes = mysql_query($sql_likes);
	  $message[0] = 'Success';
    $sql_cmt = "select comment.*,user.first_name,user.last_name, user.image as img from comment left outer join user on user.uniq_id = comment.user_id where comment.image_id=$image_id and comment.status='1' and comment.uc='0' order by comment.id DESC";
	$exec_cmt = mysql_query($sql_cmt);
	while($fetch_cmt = mysql_fetch_assoc($exec_cmt)){
		 if($fetch_cmt['img'] <> ''){ $img="img/".$fetch_cmt['img'];}else{$img = "img/no_img.jpg";}
		$message[1] .= '<div class="comment-box"><div style="float:left;"><img src="'.$img.'" height="40px" width="40px"/></div><div class="comment">'.$fetch_cmt['first_name'].' '.$fetch_cmt['last_name'].':'.$fetch_cmt['comments'].'</div><div class="close del-comment" data-id = "'.$fetch_cmt['id'].'" data-imgId="'.$image_id.'" data-userId = "'.$fetch_cmt['user_id'].'">&times;</div></div><div class="clearfix"></div>';
	}
    }
    else{
      $message[0] = 'Error';  $message[1] = 'Error:';
    }
  
  $message[3]=$image_id;
  $message[4]=$image_id;
  ksort($message);
//  ksort($message);
  $message_arr = implode('|::|', $message);
  echo $message_arr;
}

// For del comments of Ask 
if($_GET['do'] == 'delete'){
	$message[0] = 'Success';
	$id =  mysql_real_escape_string($_GET['id']);
	$image_id =  mysql_real_escape_string($_GET['image_id']);
	$uniq_id =  mysql_real_escape_string($_GET['uniq_id']);
	
		if($id <> ''){
			$sql_likes = "delete from comment where id='$id' and image_id='$image_id' and user_id='$uniq_id'";
			$exec_likes = mysql_query($sql_likes);
			$message[0] = 'Success';
			
			$sql_comment = "select comment.*,user.first_name,user.last_name, user.image as img from comment left outer join user on user.uniq_id = comment.user_id where comment.image_id='".$image_id."' and comment.status='1' and comment.uc='1'";
			$exec_comment = mysql_query($sql_comment);
			$num_comment = mysql_num_rows($exec_comment);
			$message[2]  = $num_comment;
			$j=1;
			while($fetch_comment = mysql_fetch_assoc($exec_comment)){
				
				if($fetch_comment['img'] <> ''){ $img="img/".$fetch_comment['img'];}else{$img = "img/no_img.jpg";}
				$message[1] .= '<div class="comments_shows"><img src="'.$img.'" height="40px" width="40px">'.$fetch_comment['first_name'].' '.$fetch_comment['last_name'].':'.$fetch_comment['comments'].'<div class="cancel_co" onClick="del('.$fetch_comment['id'].','.$image_id.','."'".''.$uniq_id.''."'".')">x</div><div class="clear"></div></div><div class="clear"></div>';
				$j++;}	
			
			

		}
		else{
			$message[0] = 'Error';	$message[1] = 'Error:';
		}
	
	$message[3]=$image_id;
	$message[4]=$uniq_id;
	$message[5]=$id;
	ksort($message);
//	ksort($message);
	$message_arr = implode('|::|', $message);
	echo $message_arr;
}

if($_GET['do'] == 'del2'){
  $id =  mysql_real_escape_string($_GET['id']);
  $image_id =  mysql_real_escape_string($_GET['image_id']);
  $uniq_id =  mysql_real_escape_string($_GET['uniq_id']);
    if($id <> ''){
      $sql_likes = "delete from comment where id='$id' and image_id='$image_id' and user_id='$uniq_id'";
      $exec_likes = mysql_query($sql_likes);
      
    
      $message[0] = 'Success';
	  $message[0] = 'Success';
			$sql_comment = "select comment.*,user.first_name,user.last_name, user.image as img,user.uniq_id as usid from comment left outer join user on user.uniq_id = comment.user_id where comment.image_id='".$image_id."' and comment.status='1' and comment.uc='1' order by comment.id DESC";
			$exec_comment = mysql_query($sql_comment);
			$num_comment = mysql_num_rows($exec_comment);
			$message[2]  = $num_comment;
			$j=1;
			while($fetch_comment = mysql_fetch_assoc($exec_comment)){
				
				if($fetch_comment['img'] <> ''){ $img="img/".$fetch_comment['img'];}else{$img = "img/no_img.jpg";}
				 if($fetch_user['uniq_id']==$fetch_comment['user_id']){
$data = '<div onClick="del2('.$fetch_comment['id'].','.$image_id.','."'".''.$fetch_user['uniq_id'].''."'".')"  class="cancel_co">x</div>

<div class="clear"></div>';
				 }

				$message[1] .= '<div class="comments_shows"><img style="float:left; margin-right:1%" src="'.$img.'" height="40px" width="40px">'.$fetch_comment['first_name'].' '.$fetch_comment['last_name'].':'.$fetch_comment['comments'].$data.'</div><div class="clearfix"></div>';
				/*$message[1] .= '<div class="comments_shows"><div style="float:left;"><img src="'.$img.'" height="40px" width="40px"/></div><div class="comment">'.$fetch_comment['first_name'].' '.$fetch_comment['last_name'].':'.$fetch_comment['comments'].'<div  onClick="del2('.$fetch_comment['id'].','.$image_id.','."'".''.$fetch_user['uniq_id'].''."'".')" class="cancel_co">x</div></div></div>
        <div class="clearfix"></div>';*/
		$data='';
		
				}
    }
    else{
      $message[0] = 'Error';  $message[1] = 'Error:';
    }
  
  $message[3]=$image_id;
  ksort($message);
//  ksort($message);
  $message_arr = implode('|::|', $message);
  echo $message_arr;
}

//this is for select Experts according to their Catgory ///////////////////
if($_GET['do'] == 'experts'){ 
	$id =  mysql_real_escape_string($_GET['id']);
	 $sql = "select * from user where category='".$id."' and type='1' and status='1'"; 
	$exec = mysql_query($sql);
	$num = mysql_num_rows($exec);
	if($num >0){
		$message[1] = '<option value="">--Nothing--</option>';
	while($name=mysql_fetch_assoc($exec)){
			$message[0] = 'Success'; $message[1] .= "<option value='".$name['id']."'>".$name['first_name']." ".$name['last_name']."</option>";
		}
		}
		else{$message[0] = 'Error'; $message[1] .=	"<option value='0'>--Nothing--</option>" ;}
	
	//$message[2] = $sql;
	 ksort($message);
	$message_arr = implode('|::|', $message);
	echo $message_arr;

}
///view image

if($_GET['do'] == 'del3'){
	$id =  mysql_real_escape_string($_GET['id']);
	$image_id =  mysql_real_escape_string($_GET['image_id']);
	$uniq_id =  mysql_real_escape_string($_GET['uniq_id']);
		if($id <> ''){
			$sql_likes = "delete from comment where id='$id' and image_id='$image_id' and user_id='$uniq_id'";
			$exec_likes = mysql_query($sql_likes);
			$message[0] = 'Success';
			$sql_comment = "select comment.*,user.first_name,user.last_name, user.image as img from comment left outer join user on user.uniq_id = comment.user_id where comment.image_id='".$image_id."' and comment.status='1' and comment.uc='0' order by comment.id DESC";
			$exec_comment = mysql_query($sql_comment);
			$num_comment = mysql_num_rows($exec_comment);
			$message[2]  = $num_comment;
			$j=1;
			while($fetch_comment = mysql_fetch_assoc($exec_comment)){
				
				if($fetch_comment['img'] <> ''){ $img="img/".$fetch_comment['img'];}else{$img = "img/no_img.jpg";}
				$message[1] .= '<div class="comments_shows"><img src="'.$img.'" height="40px" width="40px">'.$fetch_comment['first_name'].' '.$fetch_comment['last_name'].':'.$fetch_comment['comments'].'<div class="cancel_co" onClick="del3('.$fetch_comment['id'].','.$image_id.','."'".''.$uniq_id.''."'".')">x</div><div class="clear"></div></div><div class="clear"></div>';
				$j++;}
		}
		else{
			$message[0] = 'Error';	$message[1] = 'Error:';
		}
	
	$message[3]=$image_id;
	ksort($message);
//	ksort($message);
	$message_arr = implode('|::|', $message);
	echo $message_arr;
}

//for select category
if($_GET['do'] == 'catsubmit'){
	$message[0] = 'Success';
	$main_cat =  mysql_real_escape_string($_GET['main_cat']);
	$material =  mysql_real_escape_string($_GET['material']);
	$design =  mysql_real_escape_string($_GET['design']);
	$category =  mysql_real_escape_string($_GET['category']);
	$user_id =  mysql_real_escape_string($_GET['user_id']);
	$project_id = mysql_real_escape_string($_GET['project_id']);
	if($main_cat == '0'){
			$message[0] = 'Error';	$message[1] = 'Error: Please select category.';
	}
	elseif($category == '0'){
			$message[0] = 'Error';	$message[1] = 'Error: Please select design.';
	}
	else{
		$time = time();
		 $sql = "INSERT into user_selection(user_id, name, category, design, material,project_id,  time, status) values('$user_id', '$main_cat', '$category', '$design', '$material','$project_id', '$time','1')";
		 
		if(mysql_query($sql)){
			
			$message[0] = 'Success';
			$sql_comment = "SELECT main_cat.*, main_cat.name as mcname, category.*,sub_categories.*,material.* from user_selection left outer join category on category.id = user_selection.category left outer join sub_categories on sub_categories.id = user_selection.design left outer join main_cat on main_cat.id = user_selection.name left outer join material on material.id = user_selection.material where user_selection.project_id='$project_id'";
			$exec_comment = mysql_query($sql_comment);
			$num_comment = mysql_num_rows($exec_comment);
			$message[2]  = $num_comment;
			$j=1;
			while($fetch_comment = mysql_fetch_assoc($exec_comment)){
				$message[1] .= '<div class="resultsof_add">'.$fetch_comment['mcname'].'&nbsp;->&nbsp;'.$fetch_comment['category_name'].'&nbsp;->&nbsp;'.$fetch_comment['name'].'&nbsp;->&nbsp;'.$fetch_comment['material'].'<div class="clear"></div></div><div class="clear"></div>';
				$j++;}	
				
			//$message[1] = 'Success: Comment Posted successfully.';
			
		}	
		else{ 
			$message[0] = 'Error';	$message[1] = mysql_error();
		}
	}
	$message[3] = $user_id;

	ksort($message);
	$message_arr = implode('|::|', $message);
	echo $message_arr;
}

//this is for select area according to city
if($_GET['do'] == 'sel_city'){ 

	$city =  mysql_real_escape_string($_GET['city']);
	 $sql = "select * from city where city='".$city."'"; 
	$exec = mysql_query($sql);
	$fetch=mysql_fetch_assoc($exec);
	
	$sqlm = "select * from area where city='".$fetch['id']."'";
	$execm = mysql_query($sqlm);
	$num1 = mysql_num_rows($execm);
	
	
	if($num1 >0){
		$message[1] .= "<option value=''>Area</option>";
	while($name=mysql_fetch_assoc($execm)){
	$sql1 = "select * from user where area='".$name['area']."' and uniq_id='".$fetch_user['uniq_id']."'";
	$exec1 = mysql_query($sql1);
	$fetch1=mysql_fetch_assoc($exec1);
	 if($name['area']==$fetch1['area']){$select = "selected='selected'";}
	 else{$select = "";}
	$message[1] .= "<option value='".$name['area']."' ".$select.">".$name['area']."</option>";
		}
		$message[0] = 'Success';
		}
	else{$message[0] = 'error';}
//material	
	
	$message[2] = $city;
	 ksort($message);
	$message_arr = implode('|::|', $message);
	echo $message_arr;

}
if($_POST['do'] == 'share_reviews'){
	$tabl = "review";
	$comment=$_POST['feedback'];
	$review = $_POST['review'];
	$designer_id =  mysql_real_escape_string($_POST['designer_id']);
	$userid =  mysql_real_escape_string($user_uniq);
	$time = time();
	
	if($review == ''){
			$message[0] = 'Error';	$message[1] = '<span style="font-size:15px">Error: Please Give Rating By slecting Stars.</span>';
	}
	else if($comment == ''){
			$message[0] = 'Error';	$message[1] = '<span style="font-size:15px">Error: Please Provide Feedback.</span>';
	}
	else{
		$time = time();
		 $sql = "INSERT into review(designer_id, user_id, review, feedback, time, status) values('$designer_id', '$userid', '$review', '$comment', '$time','1')";
		if(mysql_query($sql)){
			
			$message[0] = 'Success';
			$message[1] = 'Success: Review Posted successfully.';
			
		}	
		else{
			$message[0] = 'Error';	$message[1] = mysql_error();
		}
	}

	ksort($message);
	$message_arr = implode('|::|', $message);
	echo $message_arr;
}
/*if($_POST['do'] == 'share_reviews'){
	
}*/

