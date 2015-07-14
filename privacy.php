<?php
require_once("init.php");
require_once("config_db.php");
require_once("config.php");
$tabl='content';
$sql_gallary = "select * from  $tabl where id='2'";
$exec_gallery = mysql_query($sql_gallary);
$fetch_gal = mysql_fetch_assoc($exec_gallery);
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
<link rel ="stylesheet" href="./css/Style.css">
<link rel ="stylesheet" href="cssp/font-awesome.min.css">
<script src = "js/jquery.js" type="text/javascript"></script>
<script src ="js/bootstrap.min.js" type="text/javascript"></script>
<script src = "js/jquery.lazy.min.js" type="text/javascript"></script>
<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>
<style type="text/css">
	#wrapper{
		background: url('Background/bckg_7.jpg');
		background-size: cover;
		-webkit-filter:blur(3px);
		-moz-filter:blur(3px);
		-o-filter:blur(3px);
		-ms-filter:blur(3px);
		filter: url(blur.svg#blur);
	}
	.usr-img{
		padding-left: 50px;
		padding-top:5px;
	}
	.user-comments .comment-data{
		min-height: 80px;
		background:#fff;
		padding:10px;
		box-shadow: 0 0 1px 1px #8d9cde;
	}	
	.user-comments{
		margin-top: 10px;
	}
	#blog-ref a{
		color:#356e6f;
	}

</style>

<script type="text/javascript">
	$(document).ready(function(){

		$(function(){
			$('#header').data('size','big');
		});
		$('.feedback').data('hidden','false');
		$('#icon a').on('click',function(e){
			e.preventDefault();
			if($('.feedback').data('hidden')=='false'){
				$('.feedback').animate({right:'0%'},1000);
				$('.feedback').data('hidden','true');
				$('body').append($('<div class="blur"></div>'));
			}
			else{
				$('.feedback').animate({right:'-32.7%'},1000);
				$('.feedback').data('hidden','false');
				$('.blur').remove();
			}
		});
		$('#feed-close').on('click',function(e){
			e.preventDefault();
			if($('.feedback').data('hidden')=='true'){
				$('.feedback').animate({right:'-32.7%'},1000);
				$('.feedback').data('hidden','false');
				$('.blur').remove();
			}
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

</head>
<body style="font-family:'Ubuntu',sans-serif;font-size:15px;">

<div class="container-fluid" id="wrapper">
</div>

<!-- ---------------------Header ------------------------------- -->
<?php include "include/header.php";?>
<!-- ---------------------MAIN ------------------------------- -->
<div id="main" class="row container" style="padding:10px;height:auto; overflow:hidden">
	<div class="col-sm-2 col-sm-push-1" id="blog-ref" style="color:#fff;height:auto;padding:10px;">
		
		
		
	</div>
	<div class="col-sm-10 col-sm-pull-1" style="background:#fff;height:auto;">
		<h2 style="color:#de5842;"><?php echo $fetch_gal['title'];?></h2>

		<?php echo $fetch_gal['description'];?>
	</div>
    
</div>


<!-- -----------------COMMENT----------------------- -->



<!---------------------------FEEDBACK ----------------- -->
<?php include "include/feedback.php";?>

<!----------------------------FOOTER------------------- -->
<?php include "include/footer.php";?>

</body>
</html>