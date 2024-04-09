<?php include 'user_css.php'; ?>
<body style="background-color: #1e1e1e">
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

<!-- Purchase History -->
<div style="margin-top: -40px;">
    <div class="container">
        <div style="margin: 0 5% 5% 5%;">
            <h2 class="heading">Purchase History</h2>
            <div class="row">
                <!-- Left grid for vertical pills -->
                <div class="col-md-3 left-grid">
                    <ul class="nav nav-pills nav-stacked" style="text-align: center;">
                        <li class="active"><a href="">Today</a></li>
                        <li><a href="">This Week</a></li>
                        <li><a href="">Before</a></li>
                    </ul>
                </div>
                <!-- Vertical tab -->
                <div class="col-md-1 vl" style="margin-left:-2.4%;"></div>
                <!-- Right grid for vertical pills -->
                <div class="col-md-9 right-grid" style="margin-left:-8.1%;">
                    <div class="table-container">
                        <table>
                            <?php for ($i = 0; $i < 10; $i++): ?>
                                <tr>
                                    <td>
                                        <div>
                                            <h3>Purchased Monster Hunter Rise: Sunbreak</h3>
                                            <p>Date: 3/26/2024 12:48 pm</p>
                                        </div>
                                        <div style="text-align: center;">
                                            <h3>$69.99</h3>
                                            <a class="view-receipt">View Receipt</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php if ($i < 9): ?> <!-- Add gap after all but the last row -->
                                    <tr class="gap-row"></tr>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
