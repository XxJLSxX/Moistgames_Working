<?php include 'admin_css.php'; ?>
<body style="background-color: #1e1e1e;">
  <nav class="navbar">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand custom-color" href="#" style="margin-right: 15px;">
        <img src="../images/logo.png" style="text-align: center; width:30px; height:30px" alt="Logo">
        </a> 
      </div>
      <ul class="nav navbar-nav">
        <li><a href="#">Games</a></li>
        <li><a href="#">Game Developers</a></li>
        <li><a href="#">Transactions</a></li>
        <li><a href="#">Featured Post</a></li>
      </ul>
      <div class="navbar-right">
      <a href="logout.php" class="log-out-button">Log Out</a>
        </div>
      </div>
    </div>
  </nav>
    <div class="container admin-container">
        <h1 style=" font-size: 4.5vw; " >Hi there, Admin!</h1>
        <p style="font-size: large">What would you like to do?</p>
    </div>
    <br>
    <div class="container container-flex">
      <div class="cards-container">
        <a class="card" href="#">Add a Game<br><label class="gamepad"></label></a>
        <a class="card" href="#">View Developers<br><label class="view-dev"></a>
        <a class="card" href="#">Assign Featured Post<br><label class="image-png"></label></a>
      </div>
    </div>

</body>
</html>
