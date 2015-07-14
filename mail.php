<?php
$body ='<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#E6E6E6">
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
    
	   <p>Thank you for signing up for MakeUber.</p>
    <p>Now you can Browse through our experts <a href="http://www.makeuber.com/expert">http://www.makeuber.com/Expert</a></p>

    <p>Participate in discussions <a href="http://www.makeuber.com/ask">http://www.makeuber.com/Ask</a></p>

    <p>Share your requirement with us <a href="http://www.makeuber.com">http://www.makeuber.com</a></p>

    <p>If you do have any further questions, concerns, or suggestions, shout out to our team anytime through the Feedback form on</p> 
   
    <p><a href="http://www.makeuber.com">http://www.makeuber.com</a></p>
	
	<p>Or you could write to us anytime at reachus@makeuber.com</p>
    
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
echo $body;
?>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script language="javascript">
jQuery(document).ready(function($){
	
	document.body.oncontextmenu = function(e) {
  		e = e || event;
		//$("#txt").bind("contextmenu",function(){
//  		 return false;
//		});
		var el = e.srcElement || e.target;
  		if (!(/textarea/i).test(el.nodeName)) {
			
    		e.preventDefault();
  		}
		/*if($("#txt").event.which=="3")
      {
        document.oncontextmenu = document.body.oncontextmenu = function() {return true;}

      }*/
	 		
		
	}
	$(function(){
		$('#shotxt').addClass('context')
	})

});
	
</script>

<input type="text" name="demo" id="shotxt">
<textarea cols="20" rows="5"></textarea>