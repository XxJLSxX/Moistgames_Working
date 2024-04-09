<?php include 'user_css.php'; ?>
<body style="background-color: #3b3b3b">
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

     <div class="banner-container" style="margin-top: -20px;">
        <img src="../images/sample_game.png" alt="Your Image">
    </div>

        <div class="container" style="padding: 4%; background-color: rgba(0, 0, 0, 0);">
            <div style="margin: -40px 6% 0 6%; display: flex; align-items: center;">
                <img src="../images/developer_icon.png" style="height: 125px; width: 125px; border-radius: 25px; object-fit: cover;">
                <div style="margin-left: 20px;">
                    <h1 style="font-weight: bold;">Arrowhead Game Studios</h1>
                    <p>Email: arrowhead@gmail.com</p>
                    <p>Location: Hammarby Sjöstad, Stockholm, Sweden</p>
                </div>
            </div> 
        </div>

        <div class="container" style="padding: 0 4% 0 4%;background-color: rgba(0, 0, 0, 0);">
        <div style="margin: -40px 6% 0 6%; display: flex; align-items: center;">
            <a href="#" class="active user-dev">Games</a>
            <a href="user_devabout.php" class="user-dev">About</a>
        </div>
        </div>

        <?php
          // Define the total number of images and images per page
          $totalImages = 12;
          $imagesPerPage = 4;

          // Get the current page number from the URL query parameter
          $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
          $page = max(1, min(ceil($totalImages / $imagesPerPage), $page)); // Ensure page is within valid range

          // Calculate the start index for images to display
          $startIndex = ($page - 1) * $imagesPerPage;
        ?>

        <div class="container" style="padding: 0 4% 0 4%;background-color: rgba(0, 0, 0, 0);">
                <div style="margin: 20px 3.7% 0 3.7%; display: flex; align-items: center; justify-content: center;">
                  <?php
                      for ($i = $startIndex; $i < min($totalImages, $startIndex + $imagesPerPage); $i++) {
                          echo '<a href="#">';
                          echo '<img src="../images/sample_game.png" class="game-panel">';
                          echo '</a>';
                      }
                  ?>
              </div>
          </div>

        <div class="pagination-container">
          <div class="pagination custom-pagination">
              <a href="?page=1" class="arrow prev <?php echo $page <= 1 ? 'disabled' : ''; ?>"><i class="fas fa-angle-double-left"></i></a>
              <a href="?page=<?php echo max(1, $page - 1); ?>" class="arrow prev <?php echo $page <= 1 ? 'disabled' : ''; ?>"><i class="fas fa-angle-left"></i></a>
              
              <?php 
              // Display page numbers
              for ($i = 1; $i <= ceil($totalImages / $imagesPerPage); $i++): ?>
                  <a href="?page=<?php echo $i; ?>" class="page-number <?php echo $i === $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
              <?php endfor; ?>

              <a href="?page=<?php echo min(ceil($totalImages / $imagesPerPage), $page + 1); ?>" class="arrow next <?php echo $page >= ceil($totalImages / $imagesPerPage) ? 'disabled' : ''; ?>"><i class="fas fa-angle-right"></i></a>
              <a href="?page=<?php echo ceil($totalImages / $imagesPerPage); ?>" class="arrow next <?php echo $page >= ceil($totalImages / $imagesPerPage) ? 'disabled' : ''; ?>"><i class="fas fa-angle-double-right"></i></a>
          </div>
      </div>


</body>
</html>

