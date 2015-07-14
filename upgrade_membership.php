<?php
require_once("init.php");
require_once("config_db.php");
require_once("config.php");
$tabl = 'user';
$tab2 = 'membership_type';
$sql="select * from $tab2 where status='1' order by id";
$query=mysql_query($sql);
if($user_status <> 1){
		header("location:designer_login.php");
	}
	//////////////////////////////////////////////For Payu ////////////////////////////////////////////////////////////////////

// Merchant key here as provided by Payu
$MERCHANT_KEY = "JBZaLc";

// Merchant Salt as provided by Payu
$SALT = "GQs7yium";

// End point - change to https://secure.payu.in for LIVE mode
// https://test.payu.in
$PAYU_BASE_URL = "https://test.payu.in";
if(isset($_POST['payu'])){
	$id= $_POST['id'];
	$pay = $_POST['payu_budget'];
	
	$sql="select * from membership_type where id='".$id."'";
	$exec = mysql_query($sql);
	$fetch = mysql_fetch_assoc($exec); 
	session_start();
	$_SESSION['order'] = array("id"=>$fetch['id'],"session"=>$_SESSION['cart'],"membership_type"=>$fetch['type'],"price"=>$fetch['budget']);
	
/*$action = '';

$posted = array();
if(!empty($_POST)) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
	
  }*/
 // print_r($posted);
//}
header("location:https://www.payumoney.com/paybypayumoney/#/".$pay);

$formError = 0;

if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";

if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
		  || empty($posted['service_provider'])
  ) {
	  echo "hello";
  } else {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
	$hashVarsSeq = explode('|', $hashSequence);
	
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
			
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
	  
    }

    $hash_string .= $SALT;
    $hash = strtolower(hash('sha512', $hash_string));
	
    $action = $PAYU_BASE_URL . '/_payment';
	
	  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  
  $action = $PAYU_BASE_URL . '/_payment';
  
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $site_name; ?></title>
    <meta charset="utf-8">   
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./css/custom.css">
	<link rel="stylesheet" href="./css/Style.css">
    <?php include("./include/head.php"); ?>
    <script type="text/javascript">
    function archive_fun()
{
 if(confirm("Are you sure you want to delete this Project"))
 {
  return true;
 }
 else
 {
  return false; 
 }  
}
    </script>
  <script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
	   
     var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
	
	
	 $(document).ready(function() {
////////////first form/////////////		 

////////////first form/////////////	
////////////second form/////////////		 
$(".hide_show2").attr("name","tester");
$(".hide_show2").mouseover(function(){
 $(".hide_show2").attr("name","payuForm");
 $(".hide_show1").attr("name","tester");
 $(".hide_show3").attr("name","tester");
 $(".hide_show4").attr("name","tester");
 if(hash != '') {
  var payuForm = document.forms.payuForm;
      payuForm.submit();
 }
});

////////////second form/////////////
////////////third form/////////////		 
$(".hide_show3").attr("name","tester");
$(".hide_show3").mouseover(function(){
 $(".hide_show3").attr("name","payuForm");
$(".hide_show1").attr("name","tester");
 $(".hide_show2").attr("name","tester");
 $(".hide_show4").attr("name","tester");
 if(hash != '') {
  var payuForm = document.forms.payuForm;
      payuForm.submit();
 }
});

////////////third form/////////////
////////////fourth form/////////////		 
$(".hide_show4").attr("name","tester");
$(".hide_show4").mouseover(function(){
 $(".hide_show4").attr("name","payuForm");
 $(".hide_show1").attr("name","tester");
 $(".hide_show3").attr("name","tester");
 $(".hide_show2").attr("name","tester");
 if(hash != '') {
  var payuForm = document.forms.payuForm;
      payuForm.submit();
 }
});

////////////fourth form/////////////	
 });
</script>
 <style> 
 .footer-menu li a:hover{color:white; text-decoration:none;}
 </style> 
</head>

<body style="font-family:'Ubuntu',sans-serif;font-size:15px;" onload="submitPayuForm()">

<div class="container-fluid" id="wrapper">
</div>
<?php include "./include/header.php";?>
<!-- ---------------------Main ------------------------------- -->

<!-- -----------------------Blogs ----------------- -->

<div id="blog-contri" class="row content-page" style="padding-left:250px;">
	
	<p class="text-left" style="font-size:28px;font-family: 'Yanone Kaffeesatz', sans-serif;color:#663300;">Upgrade Membership</p>
	<div class="row">
      <?php 
		//print_r($fetch_user);
		while($fetch=mysql_fetch_assoc($query)){
			 ?> 
              <form action="<?php echo $action; ?>" method="post" name="payuForm" class="<?php if($fetch['type']=='Silver'){echo 'hide_show2';}  else if($fetch['type']=='Gold'){echo 'hide_show3';} else if($fetch['type']=='Platinum'){echo 'hide_show4';}?>">
		<div class="panel panel-primary col-sm-3 <?php if($fetch['type']=='Bronze'){echo 'Bronze';} else if($fetch['type']=='Silver'){echo 'Silver';} else if($fetch['type']=='Gold'){echo 'Gold';} else if($fetch['type']=='Platinum'){echo 'Platinum';}?>" style="margin-right:2%">
		  <div class="panel-body">
          <p style="text-align:center"> <?php echo print_messages($flag, $error_message, $success_message);?></p>
 		  <?php
         // print_r($row_cat);
          $sql_cat="select * from main_cat where id='".$row_cat['category']."'";
          $exec_cat = mysql_query($sql_cat);
          $fetch_cat = mysql_fetch_assoc($exec_cat);
          //print_r($fetch_cat);
          ?>
		<div align="center" style="height:400px">
               <?php if(empty($fetch['image'])){
	echo "<img src='./img/no_img.jpg'/>";
	}else{
	      echo "<img src='./img/".$fetch['image']."'/>"; 
		  } ?> 
          <hr/>
          <br/>
     
            <input type="hidden" name="id" value="<?php echo $fetch['id'] ?>"/>
            <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
            <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
            <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
            <input type="hidden" name="amount" value="<?php echo $fetch['budget'];?>"/>
            <input  type="hidden" name="firstname" id="firstname" value="<?php echo $fetch_user['first_name'];?>">
            <input  type="hidden" name="email" id="email" value="<?php echo $fetch_user['email_id'];?>">
            <input type="hidden" name="phone" value="<?php echo $fetch_user['phone'];?>">
            <input type="hidden" name="productinfo" value="<?php echo $fetch['description'];?>">
            <input type="hidden" name="surl" value="http://www.makeuber.com/designer_profile.php";?>
            <input type="hidden" name="furl" value="http://www.makeuber.com">
            <input type="hidden" name="service_provider" value="payu_paisa"> 
			  <div class="pm-button"><a href="https://www.payumoney.com/paybypayumoney/#/5750">
			  <img src="https://www.payumoney.com//media/images/payby_payumoney/buttons/111.png" /></a></div>
            </div>
        
			
			</div>
		</div>
        <?php }?>
		</form>
        
        
	</div>
    
    
    
	
	<br><br><br><br>
</div>
<hr>

<!---------------------------FEEDBACK ----------------- -->

<?php include "include/footer.php";?>

</body>
</html>