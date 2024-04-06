<?php
    session_start();
    if (isset($_SESSION['Admin']) && $_SESSION['Admin'] === true) {
        header("Location: admin/"); 
        exit();
    }
    
    if (isset($_SESSION['User']) && $_SESSION['User'] === true) {
        header("Location: user/"); 
        exit();
    } 
?>
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
        background-image: url('images/static_bg.png');
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

    .sign-in-button {
      background-color: #dddddd;
      border: none;
      color: #101010;
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      font-size: 16px;
      border-radius: 25px; 
      cursor: pointer;
      margin-right: 10px;
    }

    .sign-in-button-container {
      margin-left: 10px;
    }

    .navbar-right {
      display: flex;
      align-items: center;
    }
  </style>
</head>
<body>
  <nav class="navbar">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand custom-color" href="#" style="margin-right: 15px;">
          <img src="images/logo.png" style="text-align: center; width:30px; height:30px" alt="Logo">
        </a> 
      </div>
      <ul class="nav navbar-nav">
        <li><a href="#">Store</a></li>
        <li><a href="about_us.php">About Us</a></li>
      </ul>
      <div class="navbar-right">
        <div class="search-container">
          <input type="text" class="search-input" placeholder="">
          <img src="images/search.png" class="search-icon" alt="Search Icon"> 
        </div>
        <div class="sign-in-button-container">
          <form action="sign_in.php" method="post">
            <button type="submit" class="sign-in-button">Sign In</button>
          </form>
        </div>
      </div>
    </div>
  </nav>
  <div class="background-image"></div>
</body>
</html>
