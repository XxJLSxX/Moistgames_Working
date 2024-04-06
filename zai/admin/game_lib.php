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


  <div style="margin-top: -40px;">
    <div class="container game-lib">
      <div style="margin: 0 5% 5% 5%;">
        <h1>Game Library</h1>
            <p style="font-size: 20px; font-weight: bold;">Sort by: &ensp;
                <select id="" class="select-button">
                    <option value="">Latest</option>
                    <option value="">2</option>
                </select>
                &ensp;&ensp;
                <select id="" class="select-button">
                    <option value="">Genre</option>
                    <option value="">Horror</option>
                    <option value="">RPG</option>
                    <option value="">Action</option>
                </select>
                <span style="float: right;"><a class="add-button" href="#" style="">Add Game</a></span>
            </p> 
  </div>
  </div>
  
  <div class="container game-lib" style="margin-top: -75px;">
  <div style="margin: 0 5% 5% 5%;">
    <table class="game-table">
      <tr>
        <td style="padding: 0;">
            <img class="image-class" src="genshin.png" alt="Game Image" style="">
        </td>
        <td>
          <h3>Game Title&ensp;&ensp;<span class="rating">
              <span class="star">&#9733;</span>
              <span class="star">&#9733;</span>
              <span class="star">&#9733;</span>
              <span class="star">&#9733;</span>
              <span class="star">&#9734;</span> <!-- Example rating: 4 out of 5 stars -->
            </span></h3>
          <p style="float: left;">Developer Name&ensp;<a href="#">Action</a></p>
        </td>
        <td style="padding-right: 0;">
          <div class="button-group">
            <button class="delete-button">Delete</button>
            <br>
            <button class="edit-button" style="margin-top: 5px;">Edit</button>
          </div>
        </td>
      </tr>
    </table>
  </div>
</div>

<div class="pagination-container">
  <div class="pagination custom-pagination">
    <span class="arrow"><i class="fas fa-angle-double-left"></i></span>
    <span class="arrow"><i class="fas fa-angle-left"></i></span>
    <span class="page-number">1</span>
    <span class="page-number">2</span>
    <span class="page-number">3</span>
    <span class="arrow"><i class="fas fa-angle-right"></i></span>
    <span class="arrow"><i class="fas fa-angle-double-right"></i></span>
  </div>
</div>

</body>
</html>
