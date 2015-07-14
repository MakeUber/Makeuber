<?php
	include('init.php');
	include ('config_db.php');
	include ('config.php');
	
	if(isset($_POST['getdata'])){
		$ind = $_POST['getdata'];
		$query = "SELECT * FROM (SELECT `title` AS titles,`name` as name,`image` as images,`description` AS blog_content, `category` as cat, `name` AS blog_writer FROM `blog` AS blog_table WHERE `name` like '%".$fetch_user['first_name']."%') AS result LIMIT  $ind, 1";
		$result = mysql_query($query);
		while($row = mysql_fetch_array($result)){
			$data = array("title"=>$row['titles'],"image"=>$row['images'],"description"=>$row['blog_content'],"name"=>$row['name'],"category"=>$row['cat']);
		}
		$arr = json_encode($data);
		echo $arr;
	}
	else if(isset($_POST['setdata'])){
		
		$content = $_POST['setdata'];
		$title = $_POST['title'];
		$category = $_POST['category'];
		$image = $_POST['image'];
		$content = mysql_real_escape_string($content);
		$time = time();
		if($image==''){
			$query = "INSERT INTO `blog` (sort,`title`,`description`,`name`,category, status,time) select max(sort)+1,'$title','$content','".$fetch_user['first_name'].' '.$fetch_user['last_name']."','$category','1','$time' from blog";
		}else{
			$query = "INSERT INTO `blog` (sort,`title`,`description`,`name`,category,image, status,time) select max(sort)+1,'$title','$content','".$fetch_user['first_name'].' '.$fetch_user['last_name']."','$category','$image','1','$time' from blog";
		}
		$result = mysql_query($query);
		if($result){
			echo 'inserted';
		}else{
			echo mysql_error();	
		}
		//echo $query;
	}
	else if(isset($_POST['delete_post'])){
		$ind = $_POST['delete_post'];
		$query = "DELETE FROM `blog` WHERE id = ( SELECT * FROM (SELECT id AS blog_id FROM `blog` AS blog_table WHERE name like '%".$fetch_user['first_name']."%' LIMIT $ind,1) AS result )";
		$result = mysql_query($query);
		if($result)
			echo 'deleted';
	}
	else if(isset($_POST['getBlog'])){
		$query = "SELECT * FROM `blog` where name like '%".$fetch_user['first_name']."%'";
		$result = mysql_query($query);
		$arr = array();
		while($row = mysql_fetch_assoc($result)){
			array_push($arr,$row['title']);
		}
		$arr = json_encode($arr);
		echo $arr;
	}
?>
