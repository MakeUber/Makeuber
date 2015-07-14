<?php
include('init.php');
include('config_db.php');
include('config.php');
$page='experts';
$tabl = 'user';
$tab4 = 'review';
$tab5 = 'main_cat';
$pages = $_GET['page'];	
$perpage = '7';						// Show per page
$stcom = stcom($pages, $perpage);



$dvar['category']= $_GET['category'];

//select price from Product Entered
$raw_user="select * from $tab4 where status='1'" or die(mysql_error());
$user_raw=mysql_query($raw_user);
$dvar['review']= $_GET['review'];

//select city  from user
 $raw_city="select * from city where status='1'";
$user_city=mysql_query($raw_city);
$dvar['city']= $_GET['city'];

//select area from user
 
 $raw_area="select * from area where status='1'";
 if($_GET['city'] <> ''){
	 $sql_city="select * from city where city='".$_GET['city']."'";
	 $exec_city = mysql_query($sql_city);
	 $fetch_city = mysql_fetch_assoc($exec_city);
	 $raw_area .=" and city='".$fetch_city['id']."'" ;
 }
$user_area=mysql_query($raw_area);
$dvar['area']= $_GET['area'];
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>
<?php echo $site_name;?>
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset = "UTF-8">
<meta name="title" content=" We Help You Make Your Dream Home | MakeUber">
<meta name="description" content=" MakeUber helps you find and select the best interior designers, architects, custom furniture sellers and other experts for all your home interior and design needs. Browse photos, chat withus and get professional advice.">

<link rel ="stylesheet" href="css/bootstrap.min.css">
<link rel ="stylesheet" href="css/style.css">
<link rel ="stylesheet" href="css/font-awesome.min.css">
<script src = "js/jquery.js" type="text/javascript"></script>
<script src = "js/jquery-ui.min.js" type="text/javascript"></script>
<script src ="js/bootstrap.min.js" type="text/javascript"></script>
<script src = "js/jquery.lazy.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/expert.js"></script>
<script type="text/javascript" src="js/jsfunction.js"></script>
<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>
<style type="text/css">
	.profile_pic{
		height: 120px;
		width: 120px;
		border: 4px solid #fff;
		border-radius: 2px;
		background: none repeat scroll 0% 0% rgba(0, 0, 0, 0.3);
		box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.07);
	}
	.list-group-item{
		padding:5px 10px;
		font-size: 15px;
	}
	.ui-autocomplete{
		list-style: none;
		background:#eee;
		width:260px;
		padding:5px;
		border-radius:4px;
	}
	.ui-menu .ui-menu-item:hover{
		background: #428bca;
		padding: 3px;
	}
	.ui-menu .ui-menu-item:focus{
		background: #428bca;
	}
	#main{
		opacity: 1;
	}
	#wrapper{
		background: url('Background/bckg_7.jpg');
		background-size: cover;
	}
	.stats{
		margin-left: -25px;
		list-style-type: square;
	}
	.stats li:first-child{
		border-left:0px none;
		box-shadow: none;
	}
	.stats li{
		float:left;
		display: inline;
		border-left: 1px solid #ccc;
		box-shadow: 1px 0px 0px rgba(255,255,255,0.8) inset;
		color: #999;
		padding: 4px 7px;
		line-height: 15px;
		text-align: center;
		text-shadow:0px 1px 0px rgba(255,255,255,0.8);
		min-height: 30px;
	}
	.photo{
		box-shadow: 0px 0px 0px 4px rgba(0, 0, 0, 0.04), 0px 1px 5px rgba(0, 0, 0, 0.1);
		transition: all 0.15s ease-out 0.1s;
		height: 100%;
		width: 100%;
		display: block;
	}
	.photo-wrap{
		box-shadow: 0px 0px 1px 1px rgba(0,0,0,0.05);
		padding:5px;
		background:none repeat scroll 0% 0% rgba(255,255,255,1);
		width:200px;
		margin:20px;
		font-size: 14px;
		font-weight: 700;
		color: #777;
		text-align: center;
		float: left;
		cursor: pointer;
		transition: all 0.15s ease-out 0.1s;
	}
	.photo-wrap:hover{
		box-shadow: 0px 0px 2px 2px rgba(0,0,0,0.2);
	}
	.wrap{
		background:rgba(0,0,0,0.1);
		padding:5px;
		border:0.5px solid rgba(0,0,0,0.2);
		height: 200px;
		width: 170px;
		margin:5px;
		margin-right: auto;
		margin-left: auto;
	}
	.photo-modal{
		z-index: 502;
		height: 87%;
		width: 75%;
		position: fixed;
		background: #aaa;
		top:7%;
		left:12%;
		border-radius: 4px;
		box-shadow: 0px 0px 2px 2px rgba(0,0,0,0.2);
	}
	.photo-content{
		height: 100%;
		width: 40%;
		background: #fff;
		float: left;
		border-top-right-radius: 4px;
		border-bottom-right-radius: 4px;
		overflow: auto;
	}
	.comment-box{
		height: 50px;
		width: 90%;
		margin:10px;
	}
	.comment{
		float: left;
		margin-left: 10px;
		background: #ccc;
		height: 80%;
		width: 85%;
	}
	.portfolio_pic{
		border:1px solid #ccc;
		padding:5px;
	}
	.slim{
		width:200px;
	}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		
		$('.photo-modal').data('show','false');
		$('.photo-wrap').click(function(e){
			e.preventDefault();
			var id = $(this).attr("id");
			//alert(id);
			$('body').append('<div class="blur"></div>');
			$('#photo-modal'+id).fadeIn();
			$('#photo-modal'+id).data('show','true');
		});
	
		$('.close').click(function(e){
			e.preventDefault();
			$('.photo-modal').fadeOut();
			$('.blur').remove();
			$('#photo-modal'+id).data('show','false');
		});
		
		
		
	});
	function sel_city1(){
	 var city = $('.city').val();
	//alert(city); 
  $.ajax({
   type: "GET",
   data: "",
   url: "ajax.php?do=sel_city&city="+city,
      success: function(rep)
    {
  //alert(rep);
  var response_array = rep.split('|::|');
  if(response_array[0] == 'Error')
  {
   //alert(response_array[0]);
   //$("span#review_error").html(response_array[1]);
   // $("span#review_error").fadeOut(5000);
  }

  if(response_array[0] == 'Success')
  {
   //alert(response_array[1]);
   //$("span#review_error").html(response_array[1]);
    //$("span#review_error").fadeOut(5000);
    //setTimeout("location.reload(true);",2000);
	$('.area').html('');
	$('.area').append(response_array[1]);
	setTimeout($("#frm").submit(),5000);
	//$("#frm").submit();
  }
 }
  });
  return false;
 }
 
 $(document).on('click','.readmore',function(){
		var id=$(this).data('id');
		$('#expert').val(id);
	});

</script>
</head>
<body style="font-family:'Ubuntu',sans-serif;font-size:15px;">

<div class="container-fluid" id="wrapper">
</div>

<!-- ---------------------Header ------------------------------- -->
<script type="text/javascript">
	$(document).ready(function(){
		$(function(){
			$('#header').data('size','big');
		});
		$(window).scroll(function(e){
			var headerHeight = $('#header').height();

			if($(this).scrollTop() > headerHeight){
				if($('#header').data('size') == 'big'){
					$('#header').hide();
					$('#fake-header').slideDown('2000');
					$('#header').data('size','small');
				}
			}
			else{
				if($('#header').data('size') == 'small'){
					$('#fake-header').hide();
					$('#header').slideDown('2000');
					$('#header').data('size','big');
				}
			}
		});
	});
</script>
<script language="javascript">
function login1(){
	//alert("hi");
	
	//alert($('#loginform').serialize());
	$.ajax({
   type: "POST",
   data: $('#loginform').serialize(),
   url: "ajax.php",
      success: function(rep)
    {
   //alert(rep);
  var response_array = rep.split('|::|');
  if(response_array[0] == 'Error')	
  {
  //alert(response_array[2]);
    $("#errormsg").show();
   $("#errormsg").html(response_array[1]);
   $("#errormsg").fadeOut(2000);
  }
  if(response_array[0] == 'Success')
  {
   $("#errormsg").html(response_array[1]);
   //////////////////////////it is used to check the person has click on share requirements//////////////////////
   //alert($('#sharetxt').val());
   var data = $('#sharetxt').val();
   var expert = $('#expert').val();
  // alert(response_array[2]);
  // break;
  	 if(data=='share'){
		    $(location).attr('href','index.php');
			
	   }
	   else if(expert !=''){
		    $(location).attr('href','expert_portfolio.php?id='+expert);
	   }
	   else{
		     if(response_array[2] == '1'){
	   		//alert($('#budget').val());
	   
			//if($('#budget').val() != '' && $('#budget').val() !== undefined){
			//alert("got");//
			//$("#projectform").submit();
			//}else{
			$(location).attr('href','designer_profile.php');
			//}
		}else{
			$(location).attr('href',window.location.href); 
			//salert($('#budget').val());
			//if($('#budget').val() != '' || $('#budget').val() !== undefined){
				//alert("hi");
				//$("#projectform").submit();
			//}else{
				//alert("bye");
				//alert(window.location.reload());
				$(location).attr('href',window.location.href); 
			//}
   }
	   }
	/////////////////////////////////////else portion//////////////////////////////////////
  }
 }
  });
  return false;
 	
}
function submit_form(){
	//alert($('#feedbackform').serialize());
	//exit;
	$.ajax({
   type: "POST",
   data: $('#feedbackform').serialize(),
   url: "ajax.php",
      success: function(rep)
    {
 //alert(rep);
  var response_array = rep.split('|::|');
  if(response_array[0] == 'Error')
  {
  //alert(response_array[2]);
    $("#errormsg1").show();
   $("#errormsg1").html(response_array[1]);
   $("#errormsg1").fadeOut(2000);

  }
  if(response_array[0] == 'Success')
  {
    $("#errormsg1").show();
   $("#errormsg1").html(response_array[1]);
   $("#errormsg1").fadeOut(4000);
   setInterval('hidefeddback()',3000);

  }
 }
  });
  return false;
}
function hidefeddback(){
	$('.feedback').animate({right:'-32.7%'},1000);
	$('.feedback').data('hidden','false');
	$('.blur').remove();
}
function usertype(types){
		//alert(types);
		document.getElementById('usertype').value = types;
		if(types == 1){
			$('#expertsocial').show();
			$('#usersocial').hide();
		}else{
			$('#usersocial').show();	
			$('#expertsocial').hide();
		}
			
		//$('#usertype').val = types;
}
function feedback_type(feedback_type){
			document.getElementById('feedback_type').value = feedback_type;

}
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

<div id="header" class="container row">
  <div class="col-sm-4"><a href="<?php echo ROOT_URL;?>"><img src="Final_Logo.png" data-src="Final_Logo.png"></a></div>
 <!-- <script type="text/javascript">
		$(document).ready(function(){
			$('#logo img').lazy();
		});
	</script>-->
  <div class="col-sm-8">
    <div id="contacts" class="row" style="width:100%;height:40px;margin:5px;display:block;">
      <div class="pull-right" style="padding:5px;text-align:center;background:#ccc;"> <strong>Contact Us @</strong> <span class="icon-pencil"> reachus@makeuber.com</span>&nbsp;&nbsp;
  
      <span class="icon-phone">+(91) 9900071655</span> </div>
    </div>
    <div id="menu-bar">
      <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-menu"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
          </div>
          <div class="collapse navbar-collapse" id="navbar-collapse-menu">
            <ul class="nav navbar-nav">
              <li class="<?php if($page=='index'){ echo 'active';}?>"><a href="<?php echo ROOT_URL;?>">Home</a></li>
              <li class="<?php if($page=='howitworks'){ echo 'active';}?>"><a href="how_it_works">How It Works</a></li>
              <li class="<?php if($page=='experts'){ echo 'active';}?>"><a href="expert">Experts</a></li>
              <li class="<?php if($page=='ask'){ echo 'active';}?>"><a href="ask">Ask</a></li>
              <li class="<?php if($page=='blog'){ echo 'active';}?>"><a href="blog_front">Blog</a></li>
              <?php if($user_status <> 0){?>
              <li class="<?php if($page=='register'){ echo 'active';}?>"> <a href="<?php if($fetch_user['type']=='1'){ echo "designer_profile.php";}else{echo "user_profile.php";
							  }?>">Profile</a></li>
              <li><a style="float:left;" href="logout">Logout</a>
              <span style="font-size: 14px;margin-top: 16px;margin-left: 3px;float: left;">
              <span class="icon-user"></span>
              <?php if($fetch_user['type'] == '0'){?>
                <a href="user_profile.php"><?php echo $fetch_user['first_name'];?></a>
            <?php }else{?>
                <a href="designer_profile"><?php echo $fetch_user['first_name'];?></a>
            <?php }?>
            </span>
              </li>
              
              <?php }else{?>
              <li><a href="#" data-toggle="modal" data-target="#loginModal">Login</a></li>
              <li class="<?php if($page=='register'){ echo 'active';}?>"><a href="register">Register</a></li>
              <?php }?>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </div>
</div>
<!-- --------------------- FAKE HEADER --------------------------- -->
<div id="fake-header" class="container">
	<div class="row">
		<div class="col-sm-4"><img height="50px" src="Final-Logo.png" data-src="Final-Logo.png"></div>
		<script type="text/javascript">
			/*$(document).ready(function(){
				$('#logo img').lazy();
			});*/
		</script>
		<div class="col-sm-8">
			<div id="contacts" class="row" style="width:100%;height:40px;margin:5px;display:block;">
				<div class="pull-right" style="padding:5px;text-align:center;background:#ccc;">
					<strong>Contact Us @</strong>
					<span class="icon-pencil"> reachus@makeuber.com</span>&nbsp;&nbsp;
					<span class="icon-phone">+(91) 9900071655</span>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- ---------------------MODAL ------------------------------- -->

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span> </button>
        <div class="modal-title">
          <h2>Login</h2>
        </div>
      </div>
      <div class="modal-body">
        <ul class="nav nav-tabs" role="tablist">
          <li class="active"><a href="#" onclick="usertype(0)" role="tab" data-toggle="tab">Users</a></li>
          <li><a role="tab" onclick="usertype(1)" data-toggle="tab">Experts</a></li>
        </ul>
        <br>
        <div class="tab-content">
          <form id="loginform" name="login">
          <input type="hidden" id="sharetxt" name="share" value="" />
          <input type="hidden" id="expert" name="expert" value="" />
            <div class="tab-pane fade in active">
              <div align="center" id="errormsg"></div>
              <div class="input-group input-modal"> <span class="input-group-addon icon-user"></span>
                <input type="text" id="username" name="username" class="form-control" required placeholder="Username">
                <input type="hidden" id="usertype" name="type" value="0" />
                <input type="hidden" name="do" value="login" />
              </div>
              <br>
              <div class="input-group input-modal"> <span class="input-group-addon icon-lock"></span>
                <input type="password" name="password" class="form-control" required placeholder="Password">
              </div>
              <br>
              <button type="button" onclick="login1()" class="btn btn-success">Sign In</button>
              &nbsp;&nbsp;&nbsp;
              Or connect with <br>
              <br>
              <div id="usersocial"> <a href="fb_login.php?type=0&path=<?php echo full_url();?>&id=<?php echo $_GET['id'];?>">
                <button type="button" class="btn btn-primary"><i class="fa fa-facebook"></i> Facebook</button>
                </a> <a href="google_login.php?type=0&path=<?php echo full_url();?>&id=<?php echo $_GET['id'];?>">
                <button type="button" class="btn btn-primary"><i class="fa fa-google"></i> Google</button>
                </a> <!--<a href="twitter_login.php?type=0&pth=<?php echo full_url();?>&id=<?php echo $_GET['id'];?>">
                <button type="button" class="btn btn-primary"><i class="fa fa-twitter"></i> Twitter</button>
                </a>--> </div>
              <div id="expertsocial" style="display:none"> <a href="fb_login.php?type=1&path=<?php echo full_url();?>&id=<?php echo $_GET['id'];?>">
                <button type="button" class="btn btn-primary"><i class="fa fa-facebook"></i> Facebook</button>
                </a> <a href="ex_google_login.php?type=1&path=<?php echo full_url();?>&id=<?php echo $_GET['id'];?>">
                <button type="button" class="btn btn-primary"><i class="fa fa-google"></i> Google</button>
                </a> </div>
            </div>
          </form>
          <div class="tab-pane fade"></div>
        </div>
      </div>
      <div class="modal-footer">
				<span class="pull-left">Don't have an account? <a href="register">Sign up</a> now!</span>
			</div>
    </div>
  </div>
</div>


          <p id="requirements" title="Sorry" style="display:none;font-family:Helvetica Neue,Helvetica,Arial,sans-serif !important;">please fill in details about your project</p>


<!----------------- MAIN ------------------------ -->
<div id="main" style="height:auto;">
	<div class="col-sm-3" style="padding:10px;height:auto;">
		<div class="panel panel-default" style="background:#c1d3f2;height:100%;">
			<div class="panel-heading">
				Filter By
				<a href="expert" class="pull-right">Clear Filters</a>
			</div>
			<div class="panel-body">
            <form id="frm">
				<h4>Review</h4>
				<select class="form-control" name="Review" onChange="this.form.submit()">
	<option value="1-10" <?php if($_GET['Review'] == '1-10'){ echo "selected='selected'";} ?>>1-10</option>
    <option value="10-20"  <?php if($_GET['Review'] == '10-20'){ echo "selected='selected'";} ?>>10-20</option>
    <option value="20-50"  <?php if($_GET['Review'] == '20-50'){ echo "selected='selected'";} ?>>20-50</option> 
    <option value="50-100"  <?php if($_GET['Review'] == '50-100'){ echo "selected='selected'";} ?>>50-100</option> 
    <option value="100-200"  <?php if($_GET['Review'] == '100-200'){ echo "selected='selected'";} ?>>100-200</option>  
    <option value="200-500"  <?php if($_GET['Review'] == '200-500'){ echo "selected='selected'";} ?>>200-500</option>
    <option value="500-1000"  <?php if($_GET['Review'] == '500-1000'){ echo "selected='selected'";} ?>>500-1000</option>
    <option value="1000-15000"  <?php if($_GET['Review'] == '1000-15000'){ echo "selected='selected'";} ?>>Above 1000</option>    

				</select>
				<h4>City</h4>
				<select class="form-control city" name="city" onChange="this.form.submit()">
                <option value="">City</option>
					    <?php while ($row_city = mysql_fetch_assoc($user_city)) {
		if($row_city['city'] <> ''){
		 ?>
                    <option value="<?php echo $row_city['city'];?>" <?php if($row_city['city'] == $dvar['city']){ echo "selected='selected'";} ?>><?php echo $row_city['city'];?></option>
                     <?php }}?>
				</select>
				<h4>Area</h4>
				<select class="form-control area" name="area" onChange="this.form.submit()">
                <option value="">Area</option>
                 <?php while ($row_area = mysql_fetch_assoc($user_area))
	{if($row_area['area'] <> '') { ?>
                    <option value="<?php echo $row_area['area'];?>" <?php if($row_area['area'] == $dvar['area']){ echo "selected='selected'";} ?>><?php echo $row_area['area'];?></option>
                     <?php }}?>
				</select>
                <br/>
                <!--<input type="submit" class="pull-right" name="sub" value="submit">-->
                </form>
                <div class="clearfix"></div>
				<div class="list-group">
					<h4>Category</h4>
					<a href="expert" class="list-group-item active">All</a>
                    <?php
					 //select all categories Entered
					$categ="select $tabl.*, $tab5.* from $tabl left outer join $tab5 on $tabl.category = $tab5.id where $tabl.status='1' and $tab5.status='1' group by $tab5.name";
					$cat2=mysql_query($categ);
					while ($cat_row2 = mysql_fetch_assoc($cat2)) { 
					$count_user="select * from user where (category='".$cat_row2['id']."' or category1='".$cat_row2['id']."')  and status='1'";
					$exec_user = mysql_query($count_user);
					$num_user = mysql_num_rows($exec_user);
					?>
					<a href="<?php echo $_SERVER['PHP_SELF'];?>?cat=<?php echo $cat_row2['id'];?>&Review=<?php echo $_GET['Review'];?>&city=<?php echo $_GET['city'];?>&area=<?php echo $_GET['area'];?>" class="list-group-item"><?php echo $cat_row2['name'];?>
						<span class="badge"><?php echo $num_user;?></span>
					</a>
                    <?php }?>
					<!--<a href="#" class="list-group-item">Customized Furniture
						<span class="badge">1</span>
					</a>
					<a href="#" class="list-group-item">Interior Designers
						<span class="badge">15</span>
					</a>
					<a href="#" class="list-group-item">Outdoor &amp; Garden
						<span class="badge">3</span>
					</a>
					<a href="#" class="list-group-item">Wallpapers
					<span class="badge">1</span>
					</a>-->
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-9" style="padding:10px;height:auto;background:#ccc;margin-top:10px;">
		<div class="input-group col-sm-3" style="float:left;">
			<form method="post" action="expert.php?Review=<?php echo $_GET['Review'];?>&city=<?php echo $_GET['city'];?>&area=<?php echo $_GET['area'];?>"><div class="input-group"><input type="text" class="form-control expert-search" name="expSearch" value="<?php echo $name;?>" placeholder = "Search for Expert">
			<span class="input-group-btn"><button type="submit" name="expSubmit" class="btn btn-default"><i class="fa fa-search"></i></button></span></div></form>
		</div>
		<div class="input-group col-sm-3 col-sm-offset-1" style="float:left;">
			<form method="post" action="expert.php" id="picture-form">
            <div class="input-group">
            <input type="text" class="form-control picture-search" name="picSearch" placeholder = "Search for Picture">
			<span class="input-group-btn"><button type="submit" name="picSubmit" class="btn btn-default"><i class="fa fa-search"></i></button></span>
            </div>
           </form>
		</div>
		<div class="col-sm-3 col-sm-offset-1">
			<form id="sort-form" name="sort" method="get" action="expert.php">
			<select id="sort-type" name="sort_by" class="form-control" onChange="this.form.submit()">
				<option value="name" <?php if($_GET['sort_by'] == 'name'){ echo "selected='selected'";}?>>Name</option>
            	<option value="popularity" <?php if($_GET['sort_by'] == 'popularity'){ echo "selected='selected'";}?>>Popularity</option>

			</select>
			</form>
		</div>
		<div class="row col-sm-12 content">

<!-------------------- PHP BLOCK ------------------------------ -->	



<?php
	if(isset($_POST['picSubmit'])){
		$category = $_POST['picSearch'];
		echo '<h4 style="padding:10px;border-radius:4px;background:#ff670f;color:#fff;">Showing Results for "'.$category.'"</h4><a href="expert.php" class="btn btn-default">Clear All</a>';
		 $query = "select project_images.*,user.first_name, user.last_name, user.image as uimage from project_images left outer join project on project.id = project_images.images_id left outer join user on user.uniq_id = project.user_id  where project_images.`image_name` like '%$category%'";
		$result = mysql_query($query);
		if(mysql_num_rows($result) > 0){
			echo '<div class="col-sm-12" style="background:#eaeaea;margin-top:30px;padding:20px;">';
		$keys=1;
			while($row = mysql_fetch_assoc($result)){
				//print_r($row);
				$sql_likes = "select * from likes where image_id='".$row['id']."' and status='1'  and uc='0' and user_id='".$user_uniq."'";
		$exec_likes = mysql_query($sql_likes);
		$num_like = mysql_num_rows($exec_likes);
		
		$sql_comment = "select comment.*,user.first_name,user.last_name, user.image as img, user.uniq_id as usid from comment left outer join user on user.uniq_id = comment.user_id where comment.image_id='".$row['id']."' and comment.status='1' and comment.uc='0' order by comment.id DESC";
		$exec_comment = mysql_query($sql_comment);
		$num_comment = mysql_num_rows($exec_comment);

?>

			<div class="photo-wrap" id="<?php echo $keys;?>"><span><?php echo $row['image_name']; ?></span><div class="wrap"> <?php echo '<img src="img/'.$row['image'].'" class="photo">'; ?></div>
			<span><i class="fa fa-thumbs-o-up"></i>&nbsp;<?php echo $num_like; ?>&nbsp;&nbsp;&nbsp;<i class="fa fa-comment-o">&nbsp;</i><?php echo $num_comment; ?><br><span style="font-weight:500;">Posted By &nbsp;<?php echo $row['first_name']." ".$row['last_name']; ?></span></span>
			</div>
            
            <!-------------------- PHOTO MODAL ----------------------------- -->
		<div class="photo-modal" id="photo-modal<?php echo $keys;?>" style="display:none;">
			<div style="float:left;height:100%;width:60%;padding:20px;">
				<div style="padding:5px;background:rgba(255,255,255,0.4);border:2px solid rgba(0,0,0,0.1);box-shadow:0px 0px 2px 2px rgba(0,0,0,0.2);height:100%;width:100%;">
				<img src="img/<?php echo $row['image'];?>" height="100%" width="100%"></div>
				<div style="position:fixed;font-size:40px;font-weight:100;top:43%;left:8%;color:rgba(255,255,255,0.7);"><i class="fa fa-chevron-left"></i></div>
				<div style="position:fixed;font-size:40px;font-weight:100;top:43%;right:8%;color:rgba(255,255,255,0.7);"><i class="fa fa-chevron-right"></i></div>
			</div>
			<div class="photo-content" style="padding:20px;">
				<a href="#" class="close"><i class="fa fa-close"></i></a>
				<div><img src="img/<?php echo $row['uimage'];?>" height="50px" width="50px" style="float:left;margin-right:20px;"><span style="margin-left:20px;display:block;"><?php echo $row['first_name']." ".$row['last_name']; ?></span><span style="font-size:10px;"><?php echo date("jS F Y",$row['time']);?></span></div>
				<span style="margin-top:20px;display:block;"><?php echo $row['description'];?></span>
				<span style="margin-top:5px;display:block;"><?php if($num_like > 0 and $user_status== '1'){?><span class="like<?php echo $row['id'];?>"><a style="cursor:pointer" onClick="unlike(<?php echo $row['id'];?>,<?php echo "'".$user_uniq."'"?>)">Unlike</a></span><?php }else{?> 
<span class="like<?php echo $row['id'];?>"><?php if($user_status <> 0 ){?><a  style="cursor:pointer" onClick="like(<?php echo $row['id'];?>,<?php echo  "'".$user_uniq."'"?>)">Like</a><?php }else{?><a  data-toggle="modal" data-target="#loginModal" onClick="like(<?php echo $row['id'];?>,<?php echo  "'".$user_uniq."'"?>)">Like</a> <?php }?></span> <?php }?>&nbsp;&nbsp;&nbsp;<a href="#">Comment</a></span>
		<span style="display:block;margin-top:2px;">&nbsp;&nbsp;<i class="fa fa-thumbs-o-up"></i>&nbsp;<span class="likes<?php echo $row['id'];?>"><?php echo $num_like;?></span>&nbsp;&nbsp;&nbsp;<i class="fa fa-comment-o"></i>&nbsp;<span id="cmt<?php echo $row['id'];?>"><?php echo $num_comment;?></span>
        
        </span>
         <div id="comments<?php echo $row['id'];?>">
			<?php while($num_comments = mysql_fetch_assoc($exec_comment)){?>
		<div class="comment-box">
			<div style="float:left;"><img src="<?php if($num_comments['img'] <> ''){echo 'img/'.$num_comments['img'];}else{ echo 'img/no_img.jpg';}?>" width="10%"></div><div class="comment"><?php echo $num_comments['first_name'];?> <?php echo $num_comments['last_name'];?>: <?php echo $num_comments['comments'];?><div onClick="del2(<?php echo $num_comments['id'];?>,<?php echo $num_comments['image_id'];?>,'<?php echo $num_comments['usid'];?>')" class="cancel_co">x</div></div>
		</div>
        <div class="clearfix"></div>
        <?php }?>
		</div>
		
				<div style="height:50px;">
				</div>
				<div style="background:#ccc;padding:5px;position:absolute;left:60%;bottom:0px;width:40%">
					<div style="float:left;"><img src=""></div><div style="float:left;margin-left:10px;width:90%;">
                    
                     <div id="errormsg<?php echo $row['id'];?>" style="color:red"></div>
			<div id="sucmsg<?php echo $row['id'];?>" style="color:green"></div>

            <form method="post" id="form<?php echo $row['id'];?>" onSubmit="<?php if($user_status <> 0 ){ ?>return save_comment(<?php echo $row['id'];?>) <?php } else{?><?php echo $_SERVER['PHP_SELF'];}?>">
            <input type="hidden" name="image_id" value="<?php echo $row['id'];?>">
            <input type="hidden" name="userid" value="<?php echo $user_uniq;?>">
            <input type="hidden" name="do" value="msgsave">
<?php if($user_status <> 0 ){?>
            <input type="text" class="form-control" name="comment" autocomplete="off" id="savecomment<?php echo $row['id'];?>"  placeholder="Leave a Comment">
            <?php }?>
            </form>
                    
                    
                    </div>
				</div>
			</div>
</div>
			<?php $keys++;} ?>
	</div>




<?php
		}
	}

	else if(isset($_POST['expSubmit'])){
		$name = $_POST['expSearch'];
		$name_arr = explode(" ",$name);
		echo '<h4 style="padding:10px;border-radius:4px;background:#ff670f;color:#fff;">Showing Results for "'.$name.'"</h4><a href="expert.php" class="btn btn-default">Clear All</a>';
		$name = '%'.$name.'%';
    $query = "Select user.* from user left outer join review on review.designer_id=user.uniq_id where user.type='1' and user.status='1' and user.first_name like '$name_arr[0]%' group by user.id";
		$result = mysql_query($query);
		if(mysql_num_rows($result) > 0){
			$count = 0;
			while($row = mysql_fetch_assoc($result)){
				//print_r($row);
				if($count == 8 )
					break;
				//$expert = str_replace(' ','_',$row[1]);
				$picquery = "select project_images.image from `project_images` left outer join project on project.id = project_images.images_id where project.user_id = '".$row['uniq_id']."' and project_image <> ''";
				$res = mysql_query($picquery);
				echo '<div class="col-sm-12" style="padding:20px;margin-top:10px;background:#fff;border:1px solid #428bca;box-shadow:0px 0px 1px 1px #b2e1ff;">
					<div class="cover">';
				$i = 1;
				while ($rows = mysql_fetch_assoc($res)) {
					//print_r($rows);
					if($i<=8){
					if($i == 3){
						echo '<div class="col-sm-4 wide" style="padding:0px;">
						<img src="img/'.$rows['image'].'" height="340px" width="100%" class="portfolio_pic">
						</div>';
						$i+=2;
						continue;
					}

					if($i%2 == 1){
						echo '<div class="col-sm-2 slim" style="padding:0px;">
						<img src ="img/'.$rows['image'].'" height="170px" width="100%" class="portfolio_pic"><br>';
					}

					else if($i % 2 == 0){
						echo '<img src ="img/'.$rows['image'].'" height="170px" width="100%" class="portfolio_pic">
						</div>';
					}

					$i++;
					}
				}
				if($i==2 || $i == 6 || $i==8){
				 echo '</div>';	
				}
				
?>
				</div>
				<div class="col-sm-12 profile_desc" id="<?php echo $row['uniq_id'];?>">
			        <img src="img/<?php if($row['image'] <> ''){ echo $row['image'];}else{ echo 'no_img.jpg';}?>?>" class="profile_pic" style="float:left;display:block;margin-top:-20px;margin-left:0px;">
					<div style="float:left;padding:10px;font-size:13px;">
						<span style="font-size:20px;"> <?php echo $row['firm']; ?></span> <br><span>Rating: 
						<?php 
						$sql_rate = "select * from review where designer_id='".$row['uniq_id']."'";
						$exec_rate = mysql_query($sql_rate);
						$num_rate = mysql_num_rows($exec_rate);
						$rate=0;
						while($fetch_rate = mysql_fetch_assoc($exec_rate)){
							$rate = $rate + $fetch_rate['review'];
						}
						$rating = $rate/$num_rate;
						//echo $rating;
						$rating = ceil($rating);
						
						for($i=0;$i<$rating;$i++)
						echo '<i class="fa fa-star"></i>';
						$rating = 5 - $rating;
						for($i=0;$i<$rating;$i++)
						echo '<i class="fa fa-star-o"></i>';
						?>
						</span>
					</div>
					<div class="pull-right" style="background:linear-gradient(#fff,#eee);margin-top:40px;margin-right:50px;padding:4px;border:1px solid #ccc;border-radius:4px;box-shadow:0px 1px 1px rgba(0,0,0,0.08),0px 1px 0px rgba(255,255,255,0.8) inset">
						<ul class="stats">
							<li><span style="color:#428bca;font-size:18px;"><?php echo $num_rate; ?></span><br>reviews</li>
                            <?php if($user_status == 1 /*&& $fetch_user['type']==0*/){?>
							<li><a href="expert_portfolio.php?id=<?php echo $row['uniq_id'];?>">Read<br> More</a></li>
                            <?php }else{?>
                            <!--<li><a href="#" data-toggle="modal" class="readmore" data-target="#loginModal" data-id = "<?php echo $row['uniq_id'];?>">Read<br> More</a></li>-->
							<li><a href="expert_portfolio.php?id=<?php echo $row['uniq_id'];?>">Read<br> More</a></li>
                            <?php }?>
						</ul>
					</div>
				</div>
			</div>
           

<!-------------------- PHP BLOCK ------------------------------ -->
<?php
				$count++;
			}
?>
			</div>
			<nav style="margin-left:39%;">
				<ul class="pagination">
					<li><a href="<?php echo $_SERVER['PHP_SELF'];?>?page=<?php if($pages==1){ echo $pages;}else{ echo $pages-1;}?>&cat=<?php echo $_GET['cat'];?>&Review=<?php echo $_GET['Review'];?>&city=<?php echo $_GET['city'];?>&area=<?php echo $_GET['area'];?>"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>
				<?php
					$pages = ceil($num/7);
					//echo $pages;
					for($x=0;$x<$pages;$x++){
						if($x==0 && $_GET['page']==''){?>
                        	<li class="active"><a href="<?php echo $_SERVER['PHP_SELF'];?>?page=1&cat=<?php echo $_GET['cat'];?>&Review=<?php echo $_GET['Review'];?>&city=<?php echo $_GET['city'];?>&area=<?php echo $_GET['area'];?>"></a></li>
                        <?php 
							//echo '<li class="active"><a href="'.$_SERVER['PHP_SELF'].'?page='.($x+1).'">'.($x+1).'</a></li>';
						}else{
							$p = $x+1;
							//echo $p.$_GET['page'];
							?>
                        <li class="<?php if($p==$_GET['page']){ echo 'active';}?>"><a href="<?php echo $_SERVER['PHP_SELF'];?>?page=<?php echo ($x+1);?>&cat=<?php echo $_GET['cat'];?>&Review=<?php echo $_GET['Review'];?>&city=<?php echo $_GET['city'];?>&area=<?php echo $_GET['area'];?>"><?php echo ($x+1);?></a></li>
                        <?php
							//echo '<li><a href="'.$_SERVER['PHP_SELF'].'?page='.($x+1).'">'.($x+1).'</a></li>';
						}
					} 
				?>
    				<li><a href="<?php echo $_SERVER['PHP_SELF'];?>?page=<?php echo $pages;?>&cat=<?php echo $_GET['cat'];?>&Review=<?php echo $_GET['Review'];?>&city=<?php echo $_GET['city'];?>&area=<?php echo $_GET['area'];?>"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>
				</ul>
			</nav>




<?php
		}else{?>
        <div class="col-sm-12 profile_desc" id="<?php echo $row['uniq_id'];?>" style="min-height:300px">
       <br/><br/><br/> <h1 align="center">No result Found</h1>
        </div>
        <?php
			
		}		
	}
	else{
			$query = "Select user.* from user left outer join review on review.designer_id=user.uniq_id where user.type='1' and user.status='1'";
		 if($_GET['cat'] <> ''){
			$query .= " and (category=".$_GET['cat']." OR category1=".$_GET['cat']." Or category2=".$_GET['cat'].")"; 
		 }
		if($_GET['area'] <> ''){
			$query .=" and user.area = '".$_GET['area']."'";
		}
		if($_GET['city'] <> ''){
			$query .=" and user.city = '".$_GET['city']."'";
		}
		$query .= " group by user.id";
		if($_GET['sort_by'] == '' or  $_GET['sort_by'] == 'name'){
			$query1 .=" order by user.first_name ASC LIMIT $stcom , $perpage";	
		}
		//echo $query;
		$query1 = $query.$query1;
		$result1 = mysql_query($query);
		$result = mysql_query($query1);
		$num = mysql_num_rows($result1);
		if(mysql_num_rows($result) > 0){
			$count = 0;
			while($row = mysql_fetch_assoc($result)){
				//print_r($row);
				
				if($count == 7)
					break;
				//$expert = str_replace(' ','_',$row[1]);
				 $picquery = "select project_images.image from `project_images` left outer join project on project.id = project_images.images_id where project.user_id = '".$row['uniq_id']."'";
				$res = mysql_query($picquery);
				echo '<div class="col-sm-12" style="padding:20px;margin-top:10px;background:#fff;border:1px solid #428bca;box-shadow:0px 0px 1px 1px #b2e1ff;">
					<div class="cover">';
				$i = 1;
				while ($rows = mysql_fetch_assoc($res)) {
					//print_r($rows);
					if($i <=8){
					if($i == 3){
						echo '<div class="col-sm-4 wide" style="padding:0px;">
						<img src="img/'.$rows['image'].'" height="340px" width="100%" class="portfolio_pic">
						</div>';
						$i+=2;
						continue;
					}

					if($i%2 == 1){
						echo '<div class="col-sm-2 slim" style="padding:0px;">
						<img src ="img/'.$rows['image'].'" height="170px" width="100%" class="portfolio_pic"><br>';
					}

					else if($i % 2 == 0){
						echo '<img src ="img/'.$rows['image'].'" height="170px" width="100%" class="portfolio_pic">
						</div>';
					}

					$i++;
					}
				}
				if($i==2 || $i == 6 || $i==8){
				 echo '</div>';	
				}
				//echo $i;
				
				
?><div id="<?php echo $row['uniq_id'];?>"></div>
				</div>
				<div class="col-sm-12 profile_desc">
			        <img src="img/<?php if($row['image'] <> ''){ echo $row['image'];}else{ echo 'no_img.jpg';}?>?>" class="profile_pic" style="float:left;display:block;margin-top:-20px;margin-left:0px;">
					<div style="float:left;padding:10px;font-size:13px;">
						<span style="font-size:20px;"><?php echo $row['first_name']." ".$row['last_name']; ?></span><br> <span>Works At <?php echo $row['firm']; ?></span> <br><span>Rating: 
						<?php 
						$sql_rate = "select * from review where designer_id='".$row['uniq_id']."'";
						$exec_rate = mysql_query($sql_rate);
						$num_rate = mysql_num_rows($exec_rate);
						$rate=0;
						while($fetch_rate = mysql_fetch_assoc($exec_rate)){
							$rate = $rate + $fetch_rate['review'];
						}
						$rating = $rate/$num_rate;
						//echo $rating;
						$rating = ceil($rating);
						
						for($i=0;$i<$rating;$i++)
						echo '<i class="fa fa-star"></i>';
						$rating = 5 - $rating;
						for($i=0;$i<$rating;$i++)
						echo '<i class="fa fa-star-o"></i>';
						?>
						</span>
					</div>
					<div class="pull-right" style="background:linear-gradient(#fff,#eee);margin-top:40px;margin-right:50px;padding:4px;border:1px solid #ccc;border-radius:4px;box-shadow:0px 1px 1px rgba(0,0,0,0.08),0px 1px 0px rgba(255,255,255,0.8) inset">
						<ul class="stats">
							<li><span style="color:#428bca;font-size:18px;"><?php echo $num_rate; ?></span><br>reviews</li>
 							<?php if($user_status == 1 /*&& $fetch_user['type']==0*/){?>
							<li><a href="expert_portfolio.php?id=<?php echo $row['uniq_id'];?>">Read<br> More</a></li>
                            <?php }else{?>
<!--                            <li><a href="#" data-toggle="modal" class="readmore" data-target="#loginModal" data-id = "<?php echo $row['uniq_id'];?>">Read<br> More</a></li>-->
                            <?php }?>		
							<li><a href="expert_portfolio.php?id=<?php echo $row['uniq_id'];?>">Read<br> More</a></li>
           				</ul>
					</div>
				</div>
			</div>
           

<!-------------------- PHP BLOCK ------------------------------ -->
<?php
				$count++;
			}
?>
			</div>
			<nav style="margin-left:39%;">
				<ul class="pagination">
					<li><a href="expert.php?page=1&cat=<?php echo $_GET['cat'];?>&Review=<?php echo $_GET['Review'];?>&city=<?php echo $_GET['city'];?>&area=<?php echo $_GET['area'];?>"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>
				<?php
					$pages = ceil($num/7);
					//echo $pages;
					for($x=0;$x<$pages;$x++){
						if($x==0 && $_GET['page']==''){?>
                        	<li class="active">
                            <a href="expert.php?page=<?php echo ($x+1);?>&cat=<?php echo $_GET['cat'];?>&Review=<?php echo $_GET['Review'];?>&city=<?php echo $_GET['city'];?>&area=<?php echo $_GET['area'];?>"><?php echo ($x+1);?></a></li>
                        <?php 
							//echo '<li class="active"><a href="'.$_SERVER['PHP_SELF'].'?page='.($x+1).'">'.($x+1).'</a></li>';
						}else{
							$p = $x+1;
							//echo $p.$_GET['page'];
							?>
                        <li class="<?php if($p==$_GET['page']){ echo 'active';}?>">
                        <a href="expert.php?page=<?php echo ($x+1);?>&cat=<?php echo $_GET['cat'];?>&Review=<?php echo $_GET['Review'];?>&city=<?php echo $_GET['city'];?>&area=<?php echo $_GET['area'];?>"><?php echo ($x+1);?></a></li>
                        <?php
							//echo '<li><a href="'.$_SERVER['PHP_SELF'].'?page='.($x+1).'">'.($x+1).'</a></li>';
						}
					} 
				?>
    				<li><a href="expert.php?page=<?php echo $pages;?>&cat=<?php echo $_GET['cat'];?>&Review=<?php echo $_GET['Review'];?>&city=<?php echo $_GET['city'];?>&area=<?php echo $_GET['area'];?>"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>
				</ul>
			</nav>
<?php
		}
	}
?>
	</div>
</div>

<div class="clearfix"></div>

<!---------------------------FEEDBACK ----------------- -->
<?php include "include/feedback.php";?>

<!-- ---------------------Footer ------------------------------- -->
<?php include "include/footer.php";?>

</body>
</html>