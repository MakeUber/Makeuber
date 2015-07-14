<?php 
 require_once("init.php");
 require_once("config_db.php");
 require_once("config.php");
 //redirect_loggedin('group.php', $user_status);

 require_once("include/fb_connect.php");
 //print_r($user);
 $tabl = "user";
 $type=$_GET['type'];
 $do=$_GET['do'];
 $ids=$_GET['id'];
 $path = $_GET['path'];
 $uniq_id = random_generator(10);
//  echo  $do; die;
 //print_r($user_profile);
 if ($user) {
  $dvar['first_name'] = $user_profile['first_name'];
	$dvar['last_name']  = $user_profile['last_name'];
    $dvar['email_id']   = $user_profile['email'];
	$dvar['username']   = $user_profile['id'];
	$dvar['password']   = $user_profile['id'];
	//It is used to check the email Id already exists or not
	$sql1="select count(*) from $tabl where email_id='".$dvar['email_id']."' and type='".$type."'";
	$exec1 = mysql_query($sql1);
	list($num1) = mysql_fetch_row($exec1);
	 $num1;
	if($num1 > 0){
		$sql_user="select * from $tabl where email_id='".$dvar['email_id']."' and type='".$type."'";
	$exec_user = mysql_query($sql_user);
	$userfetch = mysql_fetch_array($exec_user);
	if($userfetch['type'] == '0')
	{
		//echo $userfetch['status'];die;
		$id = $userfetch['uniq_id'];
		user_login($id);
		if($path <> ''){
			//echo $path;die;
			header("Location:".$path);
		}
		
		
		}
		else if ($userfetch['type'] == '1'){
			
			$id = $userfetch['uniq_id'];
			user_login($id);
			if($path <> ''){
			//echo $path;die;
			header("Location:".$path);
		} 
	}
	}
	else{
		if($type==0){
			$add_dvar = array( 'uniq_id' => $uniq_id, 'status' => '1', 'type' => $type, 'time' => time());
	$remove_dvar = array('rpassword');
	list($insert_q[0], $insert_q[1]) = insert_query($dvar, $add_dvar, $remove_dvar, $change_dvar);
$sql =  "INSERT into $tabl(sort, $insert_q[0]) SELECT max(sort)+1, $insert_q[1] from $tabl";
$exec_user=mysql_query($sql);
if($exec_user){ 
$to = $dvar['email_id'];    //  your email
			 $subject  = 'Welcome to Makeuber';
			$header = ' MIME-Version: 1.0' . "\r\n";
		$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$header .= 'From: Makeuber <reachus@makeuber.com>';
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
    <p>Your User Name is '.$dvar['username'].' and Password is '.$dvar['username'].' </p>
	<p>This is your temporary username and password. You can change it after login</p>
    <p>If you do have any further questions, concerns, or suggestions, shout out to our team anytime through the contact form on</p> 
    <p><a href="http://www.makeuber.com/contact_us.php">http://www.makeuber.com/contact_us.php</a></p>
    
    <p>We hope you have an enjoyable experience with us.</p>
    
    <p>Best Wishes,</p>
    
    <p>MakeUber Team</p></font></td>
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
			 $sub  = 'New USER Added';
			$header = ' MIME-Version: 1.0' . "\r\n";
		$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$header .= 'From: Makeuber <reachus@makeuber.com>';
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
                            <td height="35" align="left" valign="middle" style="border-bottom:2px dotted #000000"><font style="font-family: Georgia, Times New Roman, Times, serif; color:#000000; font-size:25px"><strong><em>New Expert Approval</em></strong></font></td>
                          </tr>
                          <tr>
                            <td align="left" valign="top"><font style="font-family: Verdana, Geneva, sans-serif; color:#000000; font-size:13px; line-height:21px">
       <p>&nbsp;</p>
    
    <p>Hi I Register as an User in Your Site Please Approve My Acount </p> 
    <p>My User Name is '.$dvar['username'].' and E-mail Address is '.$dvar['email_id'].' </p>
    
    <p><a href="http://www.makeuber.com/admin">http://www.makeuber.com/admin</a></p>
    
    <p>New Expert</p>
    
    <p>'.$dvar['first_name'].' '.$dvar['last_name'].'</p></font></td>
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

	$reg="select * from $tabl where username='".$dvar['username']."' and type='".$type."'";
$select=mysql_query($reg);
	$userfetch = mysql_fetch_assoc($select);
			//print_r($userfetch);die;
	if($userfetch['status'] == '1' || $userfetch['type'] == $type)
	{
		//echo $userfetch['status'];die;
		$id = $userfetch['uniq_id'];
		user_login($id);
		}
		if($path <> ''){
			//echo $path;die;
			header("Location:".$path);
		}
		
		        }		
			else{
		echo mysql_error();
	}
			}
			
			else if($type==1){$add_dvar = array( 'uniq_id' => $uniq_id, 'status' => '0', 'type' => $type, 'time' => time());
	$remove_dvar = array('rpassword');
	list($insert_q[0], $insert_q[1]) = insert_query($dvar, $add_dvar, $remove_dvar, $change_dvar);
 $sql =  "INSERT into $tabl(sort, $insert_q[0]) SELECT max(sort)+1, $insert_q[1] from $tabl";
$exec_user=mysql_query($sql);

if($exec_user){ 
//////////////////////////Send mail to designer///////////////////////////////////////
$to = $dvar['email_id'];    //  your email
			 $subject  = 'New USER Added';
			$header = ' MIME-Version: 1.0' . "\r\n";
		$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$header .= 'From: Makeuber <reachus@makeuber.com>';
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
    
    <p>Please complete your profile by login into your account and filling in all the necessary details.</p>
	 <p>&nbsp;</p>
     <p>Your User Name is '.$dvar['username'].' and Password is '.$dvar['username'].' </p>
    <p>This is your temporary username and password. You can change it after login</p>
    <p>Once your profile is complete, We will activate your account and you will be live on our. If you have any further questions, concerns, or suggestions, shout out to our team anytime through the contact form on</p> 
    <p><a href="http://www.makeuber.com/contact_us.php">http://www.makeuber.com/contact_us/</a></p>
	 <p>&nbsp;</p>
	<p>Or you could write to us anytime at reachus@makeuber.com</p>
     <p>&nbsp;</p>
    <p>We hope you have an enjoyable experience with us.</p>
    
    <p>Best Wishes,</p>
    
    <p>MakeUber Team</p></font></td>
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
	mail($to, $subject, $body, $headers);
//////////////////////////////////send mail to admin///////////////////////////////////
$to_admin ="reachus@makeuber.com";    //  your email
			 $sub  = 'New USER Added';
			$header = ' MIME-Version: 1.0' . "\r\n";
		$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$header .= 'From: Makeuber <reachus@makeuber.com>';
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
    <p>Hi I Register as a Expert in Your Site Please Approve My Acount </p> 
    <p>My User Name is '.$dvar['username'].' and E-mail Address is '.$dvar['email_id'].' </p>
    
    <p><a href="http://www.makeuber.com/admin">http://www.makeuber.com/admin</a></p>
    
    <p>New Expert</p>
    
    <p>'.$dvar['first_name'].' '.$dvar['last_name'].'</p></font></td>
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
$reg="select * from $tabl where username='".$dvar['username']."' and type='".$type."'";
$select=mysql_query($reg);
	$userfetch = mysql_fetch_assoc($select);
			//print_r($userfetch);die;
	if($userfetch['status'] == '1' || $userfetch['type'] == $type)
	{
		//echo $userfetch['status'];die;
		$id = $userfetch['uniq_id'];
		user_login($id);
		}
		if($path <> ''){
			//echo $path;die;
			header("Location:".$path);
		}
		}		
				
			else{
		echo mysql_error();
	}}
		}
	
  
 }
 else {
   $loginUrl = $facebook->getLoginUrl(array('scope'=>'email,publish_stream,status_update'));
   header("Location: $loginUrl");
      echo "If you don't get redirected automatically, Please Click <a href='$loginUrl' title='Click here to Login using facebook'>Login</a>";
 }
 
?>