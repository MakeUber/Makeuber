<?php

$sql_print="select * from print where session='$print_sess'";

$exec_print = mysql_query($sql_print);

$num=mysql_num_rows($exec_print);

?>

<div class="header">

  <div class="uper_line"> </div>

  <div class="sub_container">

    <div class="sub_header">

      <!--<div class="left_header"> <a href="index.php"> <img src="images/logo.png" height="74" width="482" alt="pic" /></a> </div>-->

      <div class="ryt_header">

        <div class="blue_bg">

          <?php if($user_status == 1){?>

          <div class="small_divs">

            <div class="smal_div1" style="width:100%;">

              <div class="title_head">Welcome :

                <?php if($fetch_a['type'] == '1'){?>

                <strong><?php echo $fetch_a['fname']. " ". $fetch_a['lname'];?></strong> (<a style="color:white" href="profile_affiliate.php">Profile</a>)

                <?php }else if($fetch_d['type']== '2'){?>

                <strong><?php echo $fetch_d['fname']. " ". $fetch_d['lname'];?></strong> (<a style="color:white" href="profile_distributor.php">Profile</a>)

                <?php } else{?>

                <strong><?php echo $fetch_u['fname']. " ". $fetch_u['lname'];?></strong> (<a style="color:white" href="profile.php">Profile</a>)

                <?php }?>

                <a style="color:white; float:right" href="logout.php">Logout</a> </div>

              <div class="clear"></div>

            </div>

          </div>

          <div class="bg_small"></div>

          <div class="clear"></div>

          <?php } else{?>

          <form method="post" action="login.php">

            <div class="small_divs">

              <div class="smal_div1">

                <div class="title_head">Email ID: </div>

                <div class="clear"></div>

                <input class="txtbx" name="email" type="text"  />

                <div class="clear"></div>

                <label class="lbl">

                  <input type="checkbox"  />

                  Remember me </label>

                <div class="clear"></div>

              </div>

              <div class="smal_div1">

                <div class="title_head">Password: </div>

                <div class="clear"></div>

                <input class="txtbx" name="password" type="password"  />

                <div class="clear"></div>

                <a href="forgot_passwrd.php" class="forgt_pswrd">Forgot Password?</a>

                <div class="clear"></div>

              </div>

              <div class="smal_div11">

                <div class="title_head">&nbsp;</div>

                <div class="clear"></div>

                <input class="sbm_btn" type="submit" name="login" value="Login"  />

                <div class="clear"></div>

                <a href="registeration.php" class="forgt_pswrd" style="margin-top:12px; float:none; clear:both; display:block">Sign Up</a>

                <div class="clear"></div>

              </div>

              <div class="clear"></div>

            </div>

            <div class="bg_small"></div>

            <div class="clear"></div>

          </form>

          <?php } ?>

        </div>

        <div class="clear"></div>

      </div>

      <div class="clear"></div>

    </div>

    <div class="clear"></div>

    <div class="menu_header">

      <div class="left_menu"> </div>

      <ul class="menu">

        <li> <a href="index.php" id="h1" >Home </a> </li>

        <li class="divi"> <img src="images/dvdr.jpg" height="49" width="2" alt="pic" /></li>

        <li> <a href="<?php if($fetch_a['type'] == '1'){ echo 'profile_affiliate.php';} else if($fetch_d['type'] =='2'){ echo 'profile_distributor.php';} else{ echo 'profile.php';}?>" id="h2" class="<?php echo $profile;?>">My Profile</a> </li>

        <li class="divi"> <img src="images/dvdr.jpg" height="49" width="2" alt="pic" /></li>

      

      

      </ul>

      <div class="ryt_menu"> </div>

      <div class="clear"></div>

    </div>

    <div class="clear"></div>

  </div>

  <div class="clear"></div>

</div>



