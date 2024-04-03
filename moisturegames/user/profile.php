<?php include 'user_css.php'; ?>
<body>
  <nav class="navbar">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand custom-color" href="index.php" style="margin-right: 15px;">
        <img src="../images/logo.png" style="text-align: center; width:30px; height:30px" alt="Logo">
        </a> 
      </div>
      <ul class="nav navbar-nav">
        <li><a href="#">Store</a></li>
        <li><a href="#">Library</a></li>
        <li><a href="#">Purchase History</a></li>
        <li><a href="about_us.php">About Us</a></li>
      </ul>
      <div class="navbar-right">
        <div class="search-container">
          <input type="text" class="search-input" placeholder="">
          <img src="../images/search.png" class="search-icon" alt="Search Icon"> 
        </div>
        <div class="sign-in-button-container" style="margin-right: 10px;"> <!-- Adjusted margin -->
          <form action="" style="margin-left: 10px">
            <img src="../images/default-icon.png" alt="User Icon" style="width: 40px; height: 40px;">
            <a href="#" style="margin-left: 10px">User</a>
          </form>
        </div>
      </div>
    </div>
  </nav>

  <div style="margin-top: -40px;">
    <div class="container">
      <div style="margin: 0 5% 5% 5%;">
        <h2 class="heading">Gamer Profile</h2>
        <div class="grid-container">
          <div class="left-column">
            <img src="../images/default-icon.png" alt="User Icon" style="width: 150px; height: 150px;">
            <p>User<br>(User Gamer)</p>
            <p style="font-size: 16px;">user@gmail.com</p>
            <a href="edit_profile.php" class="edit-profile-button">Edit Profile</a>
            <a href="change_password.php" class="change-password-button">Change Password</a>
            <a href="logout.php" class="log-out-button">Log Out</a>
          </div>
          <div class="right-column">
            <div class="right-section">Purchase History<br><a href="#" class="see-more-button">See More</a></div>
            <div class="right-section">Game Library<br><a href="#" class="see-more-button">See More</a></div>
            <div class="right-section">Contact Us<br><a href="contact_us.php" class="see-more-button">See More</a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
