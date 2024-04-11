<?php 
    include '../css/Admin_css.php'; 
    require '../db/MoistFunctions.php';
    $moistFunctions = new MoistFunctions($connection);

?>
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
                <span style="float: right;"><a class="add-button" href="#" >Add Game</a></span>
            </p> 
  </div>
  </div>
  
  <div class="container game-lib" style="margin-top: -75px;">
  <div style="margin: 0 5% 5% 5%;">
    <table class="game-table">
        <?php
            $datas = $moistFunctions -> showRecords('games', NULL, 'developer', 'games.Developer_ID', 'developer.Developer_ID');
            if (count($datas) > 0) {
                foreach ($datas as $data) {
                    echo "<tr>";
                        echo "<td style='padding: 0;'>
                            <img class='image-class' src='../Games/$data[1]/Image.png' alt='Game Image'>
                            </td>";
                        echo "<td>
                                <h3>$data[1]&ensp;&ensp;<span class='rating'>
                                    <span class='star'>&#9733;</span>
                                    <span class='star'>&#9733;</span>
                                    <span class='star'>&#9733;</span>
                                    <span class='star'>&#9733;</span>
                                    <span class='star'>&#9734;</span> <!-- Example rating: 4 out of 5 stars -->
                                    </span></h3>
                                <p style='float: left;'>$data[10]&ensp;<a href='#'>$data[5]</a></p>
                            </td>";
                        echo "<td style='padding-right: 0;'>
                                <div class='button-group'>
                                    <button class='delete-button' id='$data[0]'>Delete</button>
                                    <br>
                                    <button class='edit-button' style='margin-top: 5px;' onclick=\"window.location.href='EditGames.php?id=$data[0]';\">Edit</button>
                                </div>
                            </td>";
                    echo "</tr>";
                }
            }
        ?>
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