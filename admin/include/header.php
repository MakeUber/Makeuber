<div class="top_header">
  <div class="logo"> <a href="dashboard.php"> <img src="images/button2.png" alt="images/button2" width="85" height="69" /> </a> </div>
  <div class="site_name"><?php echo $site_name; ?> Admin Panel </div>
  <div class="top_header_right">
    <div class="clock">
      <div id="Date"></div>
      <ul>
        <li id="hours">LO</li>
        <li id="point">:</li>
        <li id="min">AD</li>
        <li id="point">:</li>
        <li id="sec">IN</li>
        <li id="ap">G...</li>
      </ul>
    </div>
  </div>
  <a class="log" href="logout.php">Logout</a> <a class="log" href="update_profile.php">Update Profile</a> </div>
<div class="header">
  <div class="list">
    <ul id="nav">
       <li class="dashboard"> <a href="#"> <span class="dashboardleft"></span> <span class="dashboardcenter"> <span class="slideshow4<?php echo $pg_active['users']; ?> ">User</span> </span> <span class="dashboardright"></span> </a>
       <ul>
     <li class="listdiv"></li>
      <li><a href="manage_pros.php">Manage Expert</a></li>
     <li> <a href="manage_user.php">Manage User</a> </li>
     <li><a href="manage_city.php">Expert City</a></li>
     <li><a href="manage_area.php">Expert Area</a></li>
     </ul>
       
        </li>
    <li class="dashboard"> <a href="manage_slideshow.php"> <span class="dashboardleft"></span> <span class="dashboardcenter"> <span class="slideshow4<?php echo $pg_active['sld']; ?> ">Slider</span> </span> <span class="dashboardright"></span> </a> </li>
      
      <li class="dashboard"> <a href="#"> <span class="dashboardleft"></span> <span class="dashboardcenter"> <span class="slideshow4<?php echo $pg_active['mctg']; ?> ">Category</span> </span> <span class="dashboardright"></span> </a> 
      <ul>
     <li class="listdiv"></li>
      <li><a href="manage_main_cat.php">Category</a></li>
     <li> <a href="manage_blog_category.php">Blog Category</a> </li>
     </ul>
      </li>
          <li class="dashboard"> <a href="#"> <span class="dashboardleft"></span> <span class="dashboardcenter"> <span class="slideshow4<?php echo $pg_active['ctg']; ?> ">Design</span> </span> <span class="dashboardright"></span> </a> 
           <ul>
     <li class="listdiv"></li>
      <li><a href="manage_categories.php">Design</a></li>
      <li><a href="manage_sub_categories.php">Design Type</a></li>
     <li> <a href="manage_material.php">Material</a> </li>
     </ul>
          </li>
     <li class="dashboard"> <a href="#"> <span class="dashboardleft"></span> <span class="dashboardcenter"> <span class="slideshow4<?php echo $pg_active['tut']; ?> ">Project</span> </span> <span class="dashboardright"></span> </a> 
     <ul>
     <li class="listdiv"></li>
      <li><a href="manage_projects.php">Designer Project</a></li>
     <li> <a href="manage_user_projects.php">User Project</a> </li>
     </ul>
     </li>
     <li class="dashboard"> <a href="manage_membership.php"> <span class="dashboardleft"></span> <span class="dashboardcenter"> <span class="slideshow4<?php echo $pg_active['member']; ?> ">Membership</span> </span> <span class="dashboardright"></span> </a> </li>
     <li class="dashboard"> <a href="order.php"> <span class="dashboardleft"></span> <span class="dashboardcenter"> <span class="slideshow4<?php echo $pg_active['order']; ?> ">Order</span> </span> <span class="dashboardright"></span> </a> </li>
      <li class="dashboard"> <a href="#"> <span class="dashboardleft"></span> <span class="dashboardcenter"> <span class="configuration<?php echo  $pg_active['con']; ?>">Configuration</span> </span> <span class="dashboardright"></span> </a>
        <ul>
          <li class="listdiv"></li>
           <!--<li><a href="edit_contact.php?do=edit&id=27">Contact Us</a></li> -->
           <li><a href="edit_about_us.php?do=edit&id=1">About US </a></li> 
           <!-- <li><a href="edit_pros.php?do=edit&id=3">Pros</a></li> 
           <li><a href="edit_know_your_project.php?do=edit&id=4">Know your Project</a></li> -->
            <li><a href="manage_team.php">Team</a></li>
             <li><a href="manage_press.php">Press</a></li>
            <li><a href="manage_how_it_works.php">How It works Images</a></li>
            <li><a href="edit_home_text.php?do=edit&id=10">Home Text</a></li> 
           <li><a href="edit_privacy_policy.php?do=edit&id=2">Privacy Policy</a></li>
           <li><a href="manage_home_page.php">Home</a></li>
            <li><a href="manage_blog.php">Blog</a></li>
          <li><a href="manage_customer_stories.php">Manage Customer Stories</a></li> 
         <li class="listdivbtm"></li>
        </ul>
      </li>
    </ul>
    <div class="clear"></div>
  </div>
</div>
