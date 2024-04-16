<?php
  session_start();
  require '../Database/MoistFunctions.php';
  if (!isset($_SESSION['Admin'])) {
    header("Location: ../Main/index.php");
  }

  $moistFunction = new MoistFunctions($connection);
  $moistFunctions = new MoistFunctions($connection);

  $add_Games = $moistFunctions -> showRecords('developer');
    
  if (isset($_POST['Add'])){
      $data = [];
      $Gname = $_POST['Game_Name'];
      
      //Input Date in Database Table
      $data['Game_Downloads'] = '0';
      $data['Upload_Date'] = date('Y-m-d');
      $data['Game_Rating'] = '0';
      foreach ($_POST as $name => $val) {
          if ($name !== 'Add' && $name !== 'GameImage' && $name !== 'GameBackground' && $name !== 'Screenshot1' && $name !== 'Screenshot2' && $name !== 'Screenshot3') {
              $data[$name] = $val;
          }
      }
      //Create Folder
      $folderPath = "../Games/$Gname";
      if (!is_dir($folderPath)) {
          //Create if existing
          mkdir($folderPath,0777);
      }else {
          echo"Game Already Exists";
          die();
      }
      try {
          $action = $moistFunctions->addQuery($data, 'games');
      } catch (Exception $e) {
          echo "Error: $e";
          die();
      } 
      
      //Save and Rename image for GameImage
      $target_dir = "../Games/$Gname/";
      $moistFunctions -> uploadFile($_FILES["GameImage"], $target_dir, $Gname, "Image." . "png");
      $moistFunctions -> uploadFile($_FILES["GameBackground"], $target_dir, $Gname, "Background." . "png");
      $moistFunctions -> uploadFile($_FILES["Screenshot1"], $target_dir, $Gname, "Screenshot1." . "png");
      $moistFunctions -> uploadFile($_FILES["Screenshot2"], $target_dir, $Gname, "Screenshot2." . "png");
      $moistFunctions -> uploadFile($_FILES["Screenshot3"], $target_dir, $Gname, "Screenshot3." . "png");
  }
?>
<html>
  <head>
    <link rel="stylesheet" href="../css/admin_css.css?+3">
    <link rel="stylesheet" href="../css/admin_addgames_css.css?+1">
    <link rel="stylesheet" href="../css/header_css.css?+2">
    <link rel="stylesheet" href="../css/footer_css.css">
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous">
  </head> 
  <body style="background-color: #1e1e1e;">
  <?php include '../header.php' ?>

  <!------------------------------------------------------------ Add Game Popup ------------------------------------------------------------>
  <div class="modal fade" id="GameAdd-Form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content" style="background-color: #6d6c6c; border-radius: 10px;">
        <div class="modal-body" style="background-color: #6d6c6c;">
          <center>
            <form action="" method="post" enctype="multipart/form-data">
              <a href="index.php">
                <img src="../img/logo.png" style="aspect-ratio: 2 / 1; width: 150px;">
              </a>
              <p style="font-size: 25px; margin-top: 16px; margin-bottom: 29px">Add a New Game</p>
              
              <label for="name">Game Name</label><br>
              <input type="text" name="Game_Name" required><br><br>
              
              <label for="developer">Game Developer</label><br>
              <select name="Developer_ID" class="form-select" onmousedown="this.size=5;" onclick="this.size=1" required>
                  <option value="" disabled selected>Select Game Developer</option>
                  <?php
                      if (count($add_Games) > 0) {
                          foreach ($add_Games as $dev) {
                              echo "<option value ='$dev[0]'>$dev[1]</option>";
                          }
                      }
                  ?>
              </select><br>
              
              <label for="price">Game Price</label><br>
              <input type="float" name="Price" required><br><br>
              
              <label for="genre">Game Genre</label><br>
                  <select name="Category" class="form-select" required>
                      <option value="" disabled selected>Select Game Category</option>
                      <option value="1">Action</option>
                      <option value="2">Adventure</option>
                      <option value="3">RPG</option>
                      <option value="4">Simulation</option>
                      <option value="5">Strategy   </option>
                  </select>
                  <br>    
              <label for="game_image">Game Image</label>
              <input type="file" id="inputFile" class="file-upload" name="GameImage" placeholder="Upload" accept="image/png, image/jpeg" required><br><br>
              
              <label for="game_image">Game Background</label>
              <input type="file" id="inputFile" class="file-upload" name="GameBackground" placeholder="Upload" accept="image/png, image/jpeg" required><br><br>

              <label for="game_image">Game Screenshots</label>
              <input type="file" id="inputFile" class="file-upload" name="Screenshot1" style="margin-bottom: 15px;" placeholder="Upload Screenshot 1" accept="image/png, image/jpeg" required>
              <input type="file" id="inputFile" class="file-upload" name="Screenshot2" style="margin-bottom: 15px;" placeholder="Upload Screenshot 2" accept="image/png, image/jpeg" required>
              <input type="file" id="inputFile" class="file-upload" name="Screenshot3" placeholder="Upload Screenshot 3" accept="image/png, image/jpeg" required>
              <br>

              <label for="game_desc">Game Description</label>
              <textarea name="Game_Desc" rows="4" placeholder="Write description here..." required></textarea><br>
              
              <input type="submit" name='Add' class="submit-button"><br>
              <a href="" style="margin-top: 10px; color: white; text-decoration: none;" data-bs-dismiss="modal">Cancel</a>
            </form>
          </center> 
        </div>    
      </div>
    </div>
  </div>
  <!------------------------------------------------------------ Admin Page Body ------------------------------------------------------------>
      <div class="admin-container">
          <h1 style=" font-size: 4.5vw; " >Hi there, Admin!</h1>
          <p style="font-size: large">What would you like to do?</p>
      </div>
      <div class="admin-container-flex">
        <div class="cards-container">
          <a class="card" href="" data-bs-toggle="modal" data-bs-target="#GameAdd-Form">Add a Game<br><img src='../img/Controller.svg'></a>
          <a class="card" href="#">View Developers<br><img src='../img/Dev.svg'></a>
          <a class="card" href="#">Assign Featured Post<br><img src='../img/Feat.svg'></label></a>
        </div>
      </div>
  </body>
</html>

<script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
    crossorigin="anonymous">
</script>
<script>
// ------------------------------------------------------ Add Games Script ------------------------------------------------------
  document.getElementById("inputFile").addEventListener("change", function() {
  if (this.value) {
      this.setAttribute("data-title", this.value.replace(/^.*[\\\/]/, ''));
  } else {
      this.setAttribute("data-title", "No file chosen");
  }
  });


</script>