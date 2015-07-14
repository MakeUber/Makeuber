<?php
	include('init.php');
	include ("config_db.php");
	include ("config.php");
	
	if($_GET['type'] == 'expert'){
		$query = "select first_name, last_name from user where first_name like '".$_GET['name']."%' and status='1'";
		$result = mysql_query($query);
		$response = array();
		while($row = mysql_fetch_array($result)){
			array_push($response, $row[0]." ".$row[1]);
		}
		$response = json_encode($response);
		echo $response;
	}
	if($_GET['type'] == 'picture'){
		$query = "select `category_name` from `category` where `category_name` like '".$_GET['name']."%' order by category_name ASC";
		$result = mysql_query($query);
		$response = array();
		while ($row = mysql_fetch_array($result)) {
			array_push($response,$row[0]);
		}
		$response = json_encode($response);
		echo $response;
		//echo $query;
	}
	/*else if(isset($_POST['page'])){
		$page = $_POST['page']*7;
		if($page!=0)
			$page++;
		$query = "select * from experts order by rating desc limit $page,7";
		$result = mysqli_query($con,$query);
		while($row = mysqli_fetch_array($result)){
			$expert = str_replace(' ','_',$row[1]);
			$picquery = "select * from `picture` where expert = '$expert' limit 0,7 ";
			$res = mysqli_query($con,$picquery);
			echo '<div class="col-sm-12" style="padding:20px;margin-top:10px;background:#fff;border:1px solid #428bca;box-shadow:0px 0px 1px 1px #b2e1ff;">
				<div class="cover">';
			$i = 1;
			while ($rows = mysqli_fetch_array($res)) {
				if($i == 3){
					echo '<div class="col-sm-4 wide" style="padding:0px;">
					<img src="Pictures/'.$rows[3].'/'.$rows[4].'/'.$rows[1].'.jpg" height="340px" width="100%" class="portfolio_pic">
					</div>';
					$i+=2;
					continue;
				}

				if($i%2 == 1){
					echo '<div class="col-sm-2 slim" style="padding:0px;">
					<img src ="Pictures/'.$rows[3].'/'.$rows[4].'/'.$rows[1].'.jpg" height="170px" width="100%" class="portfolio_pic"><br>';
				}

				else if($i % 2 == 0){
					echo '<img src="Pictures/'.$rows[3].'/'.$rows[4].'/'.$rows[1].'.jpg" height="170px" width="100%" class="portfolio_pic">
						</div>';
				}

				$i++;
			}
?>
			
					
			</div>
			<div class="col-sm-12 profile_desc">
				<?php 
					echo '<img src="Experts/expert'.$row[0].'.jpg" class="profile_pic" style="float:left;display:block;margin-top:-20px;margin-left:0px;">';
				?>
				<div style="float:left;padding:10px;font-size:13px;">
					<span style="font-size:20px;"><?php echo $row[1]; ?></span><br> <span>Works At <?php echo $row[2]; ?></span> <br><span>Rating: 
					<?php 
						$rating = $row[6];
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
						<li><span style="color:#428bca;font-size:18px;"><?php echo $row[5]; ?></span><br>reviews</li>
						<li><a href="#" data-toggle="modal" data-target="#loginModal">Read<br> More</a></li>
					</ul>
				</div>
			</div>
		</div>

<!-------------------- PHP BLOCK ------------------------------ -->
		<?php
		}
	}
*/
?>