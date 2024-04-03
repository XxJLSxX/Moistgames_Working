<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
  <title>Moisture Games</title>
  <style>
    body, .navbar-brand {
      font-family: 'Montserrat', sans-serif;
    }
    .background-image {
        background-image: url('../images/static_bg.png');
        background-size: cover; 
        background-position: center; 
        background-repeat: no-repeat; 
        width: 100%; 
        height: 100vh; 
        margin-top: -20px;
    }
    .navbar {
      background-color: #3b3b3b; 
      border-radius: 0; 
    }
    .navbar-nav > li > a {
      padding-top: 18.6px; 
      padding-bottom: 15px; 
      color: white;
      margin-right: 30px;
      font-size: 16px;
    }
    .custom-color {
      color: #3b3b3b; 
    }
    .search-container {
      margin-top: 7.5px; 
      margin-bottom: 7.5px; 
      margin-right: 40px; /* Adjusted margin */
      display: flex;
      align-items: center;
      background-color: #999999;
      border: none;
      border-radius: 25px; 
      overflow: hidden;
      width: 200px; 
      position: relative; 
    }
    .search-input {
      background-color: #999999;
      border: none;
      outline: none;
      width: calc(100% - 40px); 
      padding: 10px;
      padding-left: 40px; 
    }

    .search-icon {
      position: absolute; 
      left: 10px; 
      top: 50%; 
      transform: translateY(-50%); 
      width: 25px; 
      height: 20px; 
    }

    .navbar-right {
      display: flex;
      align-items: center;
    }

    a {
      padding-top: 18.6px; 
      padding-bottom: 15px; 
      color: white;
      margin-right: 30px;
      font-size: 16px;
    }
    .container{
        text-align: left; 
        background-color: #5d5d5d;
        border-radius: 25px;
        padding: 2%;
        width: 90%;
        margin: 25px;
        margin-left: auto; 
        margin-right: auto;
    }
    p{
        color: white;
        font-size: 15px;
    }
  </style>
</head>
<body style="background-color: #1e1e1e">
  <nav class="navbar">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand custom-color" href="#" style="margin-right: 15px;">
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
        <div class="sign-in-button-container" style="margin-right: 10px;"> 
          <div style="margin-left: 10px">
            <img src="../images/default-icon.png" alt="User Icon" style="width: 40px; height: 40px;">
            <a href="profile.php" style="margin-left: 10px; padding-top: 18.6px; color: white; font-size: 16px;">User</a>
         </div>
        </div>
      </div>
    </div>
  </nav>
  <h1 style="text-align: center; color: white; margin-top: 4%">About Us</h1>
  <div class="container">
    <p>&emsp;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Curabitur vitae nunc sed velit dignissim sodales ut eu sem. Nec feugiat in fermentum posuere. Sodales neque sodales ut etiam sit amet. Dignissim sodales ut eu sem integer vitae justo eget magna. Ut diam quam nulla porttitor. Quis varius quam quisque id diam vel. Et odio pellentesque diam volutpat. Morbi non arcu risus quis varius quam quisque id. Morbi tincidunt ornare massa eget egestas purus viverra. Cras ornare arcu dui vivamus arcu felis bibendum ut tristique. Vulputate ut pharetra sit amet. Justo nec ultrices dui sapien eget. Arcu vitae elementum curabitur vitae.

    <br><br>Iaculis nunc sed augue lacus viverra vitae congue. Tempus imperdiet nulla malesuada pellentesque elit eget gravida. Et pharetra pharetra massa massa ultricies. Ornare lectus sit amet est placerat in egestas. In arcu cursus euismod quis. Urna condimentum mattis pellentesque id nibh tortor id. Sit amet porttitor eget dolor morbi non arcu risus. Eget aliquet nibh praesent tristique magna sit amet. Urna nec tincidunt praesent semper feugiat nibh sed pulvinar. Ornare arcu odio ut sem nulla pharetra diam sit amet. Sed turpis tincidunt id aliquet risus. Faucibus nisl tincidunt eget nullam non nisi est. Et odio pellentesque diam volutpat commodo sed egestas egestas. Pharetra vel turpis nunc eget lorem. Neque gravida in fermentum et sollicitudin ac orci phasellus. Ultricies integer quis auctor elit sed vulputate. Ut eu sem integer vitae justo eget magna.
</p>
</div>
</body>
</html>
