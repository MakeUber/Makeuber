<?php
include "init.php";
include "config_db.php";
include "config.php";

$tabl="blog";
$page_parent = 'upload_blog.php';
$item="blog";

if($user_status <> 1){
	header("location:Index.php");	
}

$id = mysql_real_escape_string($_GET['id']);

if($_GET['do'] == 'edit'){
	$sql = "SELECT * from $tabl where id='".$id."'";
	$exec = mysql_query($sql) or die(mysql_error());
	$fetch = mysql_fetch_assoc($exec);
	$dvar['title'] = $fetch['title'];
	$dvar['category'] = $fetch['category'];
	$dvar['description'] = $fetch['description'];
	$image = $fetch['image'];
//print_r($fetch);

}


if(isset($_POST['submitbut'])){
	//print_r($_POST);die;
	$dvar['title'] = $_POST['title'];
	$dvar['category'] = $_POST['category'];
	$dvar['description'] = $_POST['description'];
	
	if($dvar['title'] == ''){$flag[69] = 'r';}
	else if($dvar['category'] == ''){$flag[70] = 'r';}
	else if($dvar['description'] == ''){$flag[71] = 'r';}
		
	$allowed_ext = array("gif","jpg","jpeg","png","GIF","JPG","JPEG","PNG");
	$file_field = 'image';
	
	if($_GET['do'] == 'edit'){
		$validate = validate_file($file_field, $allowed_ext, '0', '0');
	}
	else{
		$validate = validate_file($file_field, $allowed_ext, '0', '0');
	}
	
	if($validate[0] <> '1'){
		$flag['file'] = $validate[0];
	}
	else if($validate[1] <> ''){
		$file = '1';
		$ext = $validate[2];
	}

	if(!empty($flag)){
		$flag_r = 'r';
	}
	else{
		if($file == '1'){
			$rand1 = random_generator(10);
			$image_name = $rand1.'.'.$ext;
			$path = "./img/".$image_name;
			
		}
		
		if($_GET['do'] == 'edit'){
			$sql_s = "select * from $tabl where id='".$id."'";
			$exec_s = mysql_query($sql_s);
			$fetch_s = mysql_fetch_assoc($exec_s);

			if($dvar['image_delete'] == 1 && $file <> '1'){
				unlink('./img/'.$fetch_s[$file_field]);
				
				$image_name = '';
				$sql_file = "$image_name";
				
			}
			if($file == '1'){
				unlink('./img/'.$fetch_s[$file_field]);
				
				$sql_file = "$image_name";
				
			}
			if($dvar['image_delete'] <> 1 && $file <> '1'){ 
				$sql_file = $fetch_s['image'];
				
			}if($file == '1'){
				$add_dvar = array('image' => $sql_file);
				//$dvar['image'] = $sql_file;
			}

			//$add_dvar = array( 'time' => time());
			$remove_dvar = array('image_delete');
			//$change_dvar = array('status' => '0');
			
			$sql = "UPDATE $tabl SET ".update_query($dvar, $add_dvar, $remove_dvar, $change_dvar)." where id='".$id."'";
			$fg = 'ed';
		}
		else{
			$uniq = random_generator(10);
			$add_dvar = array( "name"=> $fetch_user['first_name']." ".$fetch_user['last_name'],'image'=>$image_name,'status' => '1', 'time' => time());
			$remove_dvar = array('image_delete');
			//$change_dvar = array('status' => '1');

			list($insert_q[0], $insert_q[1]) = insert_query($dvar, $add_dvar, $remove_dvar, $change_dvar);
		
			 $sql = "INSERT into $tabl(sort, $insert_q[0]) SELECT max(sort)+1, $insert_q[1] from $tabl";
			$fg = 'ad';
		}
		//echo $sql;die;
		if(mysql_query($sql)){
		//echo $_FILES[$file_field][tmp_name];die;
			if($file == '1'){
				//echo "hi";die;
				 copy($_FILES[$file_field][tmp_name], $path);     //  upload the file to the server
    			  chmod("$path",0777);                 // set permission to the file.                // set permission to the file.
				 $thumb = './img/'.$image_name;
       			 $ext = pathinfo($thumb, PATHINFO_EXTENSION);
				$max_width=270; // Fix the width of the thumb nail images
				$max_height=270; // Fix the height of the thumb nail imaage
				$extn = $ext;	$final = $thumb;	$res = '0';
				include("include/image_resize.php");   // set permission to the file.
			}
			$flag[$fg] = $item;
		}
		else{
			$flag['q'] = 'r';
			echo mysql_error();
		}
	}
}
//////////////////////////////////////Fetch Blogs/////////////////////////////////

$sel_blogs = "select * from blog where status='1' and name like '%".$fetch_user['first_name']."%'";
$exec_blog = mysql_query($sel_blogs);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Makeuber</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset = "UTF-8">
	<link rel ="stylesheet" href="./css/bootstrap.min.css">
	<link rel ="stylesheet" href="./css/Style.css">
	<link rel ="stylesheet" href="./cssp/font-awesome.min.css">
	<script src = "./js/jquery.js" type="text/javascript"></script>
	<script src ="./js/bootstrap.min.js" type="text/javascript"></script>
	<script src = "./js/jquery.lazy.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="./js/jquery.uploadfile.min.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="./css/uploadfile1.css">
	<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>
	<style type="text/css">
		.edit,.delete{
			margin-top: 10px;
			padding:6px 12px;
			border-radius: 4px;
			border: 1px solid #ccc;
			color: #428bca;
			text-align: center;
			text-shadow:0px 1px 0px rgba(255,255,255,0.8);
			min-height: 30px;
			background:linear-gradient(#fff,#eee);
			box-shadow:0px 1px 1px rgba(0,0,0,0.08),0px 1px 0px rgba(255,255,255,0.8) inset;
			float: left;
		}
		.edit:hover,.delete:hover{
			text-decoration: none;
		}
		.blog_title{
			margin-top: 10px;
			width:270px;
			display: block;
			float: left;
			min-height: 30px;
			vertical-align: center;
			padding: 7px;
			margin-right:10px;
			border:1px solid #ccc;
			margin-left:-50px;
			border-radius: 4px;
		}
	</style>
    <script language="javascript">
	BASEURL='<?php echo ROOT_URL;?>';
	</script>
    <script type="text/javascript" src="./js/addproject.js"></script>
<?php
if($flag[$fg] <> ''){
?>
<meta http-equiv="refresh" content="0; URL=<?php echo $page_parent."?1=1".$q_string; ?>">
<?php } ?>
</head>
<body style="font-family:'Ubuntu',sans-serif;font-size:15px;">

<div id="wrapper"></div>

<?php include "include/header.php";?>

<!-- ---------------------MAIN ------------------------------- -->
<div id="main" style="margin:0px;padding:10px;height:auto;background:#fff;opacity:1;text-align:center;">
	<h3>Manage Your Blogs</h3>
	
	<div class="col-sm-6">
		<span style="margin:20px;display:block;">Write A New Blog</span>
         <div style="margin-top:10px">
      <?php
        echo print_messages($flag, $error_message, $success_message);

		?>
      </div>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?do=<?php echo $_GET['do'];?>&id=<?php echo $_GET['id'];?>" enctype="multipart/form-data">
<!--			<input type="text" name="title" class="form-control blog-title" placeholder="Enter Blog Title Here" style="margin-bottom:10px; " value="sdfsdf">
-->            
<input type="text" name="title" value="<?php echo $dvar['title'];?>" class="form-control" placeholder="Enter Blog title Here" style="margin-bottom:10px;">
            <select name="category" style="margin-bottom:10px;" class="form-control category"/>
                  <option value="">Select Category</option>
                  <?php $cat="select * from blog_category where status='1'";
				  $query_cat=mysql_query($cat);
				  while($fetch_cat=mysql_fetch_assoc($query_cat)){
				  ?>
                  <option id="<?php echo  $fetch_cat['id'];?>" value="<?php echo  $fetch_cat['id'];?>" <?php if ($fetch_cat['id']==$dvar['category']){echo 'selected=selected';}?>><?php echo  $fetch_cat['category_name'];?></option>
                  <?php } ?>
                  </select>
                  <div style="border:1px solid #ccc; border-radius:3px; min-height:100px;">
                 <div class="pic">
                       <img style="float:left" id="img" src="<?php if($image <> ''){echo './img/'.$image;}else{echo './img/no_img.jpg';} ?>" alt="images/1" width="98" height="98" /><br />
                      
                      </div>
                 <div class="edit1" style="margin-bottom:10px"><input name="image" type="file" />
                        
                      </div>
                      </div>
                      <div class="clearfix"></div>
            <br/>
			<textarea name="description" class="ckeditor"><?php echo $dvar['description'];?></textarea>
			<script src = "./ckeditor/ckeditor.js" type="text/javascript"></script>
			
			<br>
			<span style="text-align:left;display:block;font-size:12px;">Use <kbd>Shift+Enter</kbd> to insert <kbd>&lt;br&gt;</kbd><br>You can insert code to put font-awesome icons</span>
			<br>
<!--			<button type="submit" class="btn btn-default" style="margin-bottom:30px;" id="blog-submit">Upload</button>
-->		
			<button type="submit" class="btn btn-default" name="submitbut" style="margin-bottom:30px;">Upload</button>
				<script type="text/javascript">
				$(document).ready(function(){
					$('.blog-title').val('');
					function changeCase(str){
						return str.charAt(0).toUpperCase() + str.slice(1);
					}
					$('[data-toggle=tooltip]').tooltip();
					$.ajax({
						url:'blog_db.php',
						type:'POST',
						data:{getBlog:'getty'}
					}).done(function(data){
						//alert(data);
						response = $.parseJSON(data);
						
						var toappend= '';
						for(var i=0;i<response.length;i++){
							toappend += '<li><a class="blog_title" href="#" title="Click here to view this blog">'+changeCase(response[i])+'</a><a class="edit" href="#">Edit</a><a class="delete" href="#">Delete</a></li>';
						}
						//$('.blog-list').append(toappend);
					});
					$('#blog-submit').click(function(e){
						e.preventDefault();
						var title = $('.blog-title').val();
						var data = CKEDITOR.instances.uploadBlog.getData();
						var cat = $('.category').val();
						var image= $('#image').val();
						//alert(image);
						console.log(data);
						var form = $('<form action="blog_display.php" method="post" style="display:none;"><input type="text" name="title" value="'+title+'"><input type="text" name="content" value="'+data+'" /><input type="text" name="category" value="'+cat+'" /><input type="text" name="image" value="'+image+'" /></form>');
						$('body').append(form);
						form.submit();
					});
				});
			</script>
		</form>
	</div>
	<div class="col-sm-4 col-sm-offset-1">
		<span style="margin-top:20px;margin-bottom:10px;font-size:16px;display:block;">List of uploaded blogs</span>
		<ul style="list-style:none;" class="blog-list">
        <?php while($fetch_blog = mysql_fetch_assoc($exec_blog)){?>
        <li><a class="blog_title" style="color:blue;" href="blog.php?id=<?php echo $fetch_blog['id'];?>" title="<?php echo $fetch_blog['title'];?>"><?php echo $fetch_blog['title'];?></a><a  style="margin-right:10px;margin-top: 10px;padding: 6px 12px;border-radius: 4px;border: 1px solid #ccc;color: #428bca;text-align: center;text-shadow: 0px 1px 0px rgba(255,255,255,0.8);min-height: 30px;background: linear-gradient(#fff,#eee);box-shadow: 0px 1px 1px rgba(0,0,0,0.08),0px 1px 0px rgba(255,255,255,0.8) inset;float: left;" href="<?php echo $_SERVER['PHP_SELF'];?>?do=edit&id=<?php echo $fetch_blog['id'];?>">Edit</a> <a class="delete" href="<?php echo $_SERVER['PHP_SELF'];?>do=delete&id=<?php echo $fetch_blog['id'];?>">Delete</a></li>
        <?php }?>
		</ul>
	</div>
	<script type="text/javascript">
		$(document).on('click','.edit',function(e){
			e.preventDefault();
			var ind = $(this).parent().index();
			var title = $(this).prev().text();
			$('.blog-title').val(title);
			$.ajax({
				url:'blog_db.php',
				type:'POST',
				data:{getdata:ind}
			}).done(function(data){
				//alert(data);
				response = $.parseJSON(data);
				console.log(response);
				//alert(response);
				$('.category').val(response['category']);
				if(response['image'] !=''){
					$('#img').attr('src',response['image']);
				}
				
				CKEDITOR.instances.uploadBlog.setData(response['description']);
			});
		});
		$(document).on('click','.delete',function(e){
			e.preventDefault();
			var ind = $(this).parent().index();
			//alert(ind);
			$.ajax({
				url:'blog_db.php',
				type:'POST',
				data:{delete_post:ind}
			}).done(function(data){
				console.log(data);
				window.location.reload();
				//Do something after delete operation
			});
		});
	</script>
</div>

<!----------------------------FOOTER------------------- -->
<?php include "include/footer.php";?>

</body>
</html>