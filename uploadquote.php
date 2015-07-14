<?php
require_once("init.php");
require_once("config_db.php");
require_once("config.php");
 ?>  
 <h4 style="position:relative;left:400px;top:10px;color:#EA7844"> Upload your quotation </h4>
			<form action="" method="post" enctype="multipart/form-data" style="position:relative;left:400px;top:10px; ">
	
			<input class="btn btn-danger" type="file" name="fileToUpload" id="fileToUpload">
			<br>
			<input type="submit" value="Send your quote" name="submit">
		</form>
		
<?php    
			
	
			
			
			if ( isset ( $_POST [ 'submit' ] ) )  {
			$subject = "Successfully uploaded your quotation";
			 $message_u ='<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#8d8e90">
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
                           
                            <td width="29%" align="right"><font style="font-family:Myriad Pro, Helvetica, Arial, sans-serif; color:#68696a; font-size:10px"><a href= "http://www.makeuber.com" style="color:#68696a; text-decoration:none; text-transform:uppercase"><strong>GO TO THE SITE</strong></a></font></td>
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
                            <td height="35" align="left" valign="middle" style="border-bottom:2px dotted #000000"><font style="font-family: Georgia, Times New Roman, Times, serif; color:#000000; font-size:25px"><strong><em>Welcome To MakeUber</em></strong></font></td>
                          </tr>
                          <tr>
                            <td align="left" valign="top"><font style="font-family: Verdana, Geneva, sans-serif; color:#000000; font-size:13px; line-height:21px">
       <p>&nbsp;</p>
    <P>Hi,</p>
    <p>	You have successfully created and uploaded your quotation.
			The client shall receive your quote within 72hours.
			In the meanwhile you can view more porjects at <a href=www.makeuber.com> Makuber </a> an quote </p>
    
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
			
			$from  = "From: MakeUber  <reachus@makeuber.com>";
			  $from .= ' MIME-Version: 1.0' . "\r\n";
			 $from .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			if(mail($email, $subject, $message_u, $from)){
				$flag['g'] = '6';
				
			 }
			 else{
			  $flag['e'] = "r";
			 }	
		
			
			
			  
		
			
			$target_dir = "./uploads/".$_GET['project_id'];
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$FileType = pathinfo($target_file,PATHINFO_EXTENSION);

		
			// Check if file already exists
			if (file_exists($target_file)) 
		{
			echo " <h4 style=color:#EA7844> Sorry, file already exists. </h4> ";
			$uploadOk = 0;
		}
		// Check file size	
		if ($_FILES["fileToUpload"]["size"] > 700000) {
			echo "<h4 style=color:#EA7844> Sorry, your file is too large. </h4> ";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($FileType != "xlsx" && $FileType != "docx" && $FileType != "doc"
		&& $FileType != "pdf" ) {
			echo "<h4 style=color:#EA7844> Sorry, only XlSx , DOCx , DOC & PDF files are allowed. </h4> ";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "<h4 style=color:#EA7844> Sorry, your file was not uploaded. </h4> ";
		// if everything is ok, try to upload file
	} else 
	{
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 	
		{	
			echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded." ; 
			echo "<script>setTimeout(\"location.href = './project.php';\",1500);</script>";
		}
		else {
			echo "<h4 style=color:#EA7844> Sorry, there was an error uploading your file.</h4> ";

		}
	}
}
else { } 
?>
