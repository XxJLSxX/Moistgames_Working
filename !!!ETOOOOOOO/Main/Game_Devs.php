<?php
    session_start();
    require '../Database/MoistFunctions.php';

    $moistFunction = new MoistFunctions($connection);
    $moistFunctions = new MoistFunctions($connection);

    $id = $_GET["id"] ?? NULL;

    $pageDev = isset($_GET['page']) ? $_GET['page'] : 1;
    $paginationData = $moistFunction->paginateDevs("developer");
    $resultDev = $paginationData['itemsDev'];
    $total_pagesDev = $paginationData['total_pagesDev'];
    $prev_PageDev = $paginationData['prev_pageDev'];
    $next_PageDev = $paginationData['next_pageDev'];
    $name_order = $paginationData['Name_Sort'];

    $devs = $moistFunctions -> showRecords('developer');
    $data = $moistFunctions -> showRecords('developer', "Developer_ID = '$id'");

    if (isset($_POST['Add'])){
        $data = [];
        $nodup = 1;
        $dname= $_POST['Developer_Name'];
        foreach ($_POST as $name => $val) {
            if ($name !== 'Add' && $name !== 'Developer_Image') {
                $data[$name] = $val;
            }
        }
        
        for ($i = 0; $i < count($devs); $i++) {
            $cmp1 = (strtolower($devs[$i][1]));
            $cmp2 = (strtolower($data['Developer_Name']));
            if ($cmp1 == $cmp2) $nodup = 0;
        }
        
        if ($nodup == 1){
            try {
                $action = $moistFunctions->addQuery($data, 'developer');
                    //Create Folder
                $folderPath = "../Developer/$dname";
                if (!is_dir($folderPath)) {
                    //Create if existing
                    mkdir($folderPath,0777);
                }else {
                    echo"Developer Already Exists";
                    die();
                }
                $target_dir = "../Developer/$dname/";
                $moistFunctions->uploadFile($_FILES["Developer_Image"], $target_dir, $dname . "Image" . ".png");
                $moistFunctions->uploadFile($_FILES["Developer_Background"], $target_dir, $dname . "Background" . ".png");
            } catch (Exception $e) {
                echo "Error: $e";
                die();
            } 
        } else {
            echo "Developer Already Exists!";
            die();
        }      
    }

    if (isset($_POST['Edit'])){
      $info = [];
      $nodup = 1;
      $dname= $_POST['Developer_Name'];
      foreach ($_POST as $name => $val) {
          if ($name !== 'Edit' && $name !== 'Developer_Image') {
              $info[$name] = $val;
          }
      }
      
      for ($i = 0; $i < count($devs); $i++) {
          $cmp1 = (strtolower($devs[$i][1]));
          $cmp2 = (strtolower($data['Developer_Name']));
          if ($cmp1 == $cmp2) $nodup = 0;
      }
      
      if ($nodup == 1){
          try {
              $action = $moistFunctions->updateQuery($info, 'developer', ['Developer_ID' => $id]);
                  //Create Folder
              $new_folderPath = "../Developer/$dname";
              $folderPath = "../Developer/".$data[0][1];
              if (is_dir($folderPath)) {
                  if (strcmp($dname,$data[0][1]) != 0){
                      rename($folderPath, $new_folderPath);
                  }
              }else {
                  echo"Developer Already Exists";
                  die();
              }
              $target_dir = "../Developer/$dname/";
              
              $moistFunctions -> uploadFile($_FILES["Developer_Image"], $target_dir, $dname . ".png");
          } catch (Exception $e) {
              echo "Error: $e";
              die();
          } 
      } else {
          echo "Developer Already Exists!";
          die();
      }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Game Devs</title>
    <link rel="stylesheet" href="../css/admin_css.css?+3">
    <link rel="stylesheet" href="../css/header_css.css?+2">
    <link rel="stylesheet" href="../css/footer_css.css">
    <link rel="stylesheet" href="../css/add_dev_css.css">
    <link rel="stylesheet" href="../css/Game_Devs_css.css?+5">
    <link rel="stylesheet" href="../css/user_library_css.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap">
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous">
    <title>Game Developers</title>
</head>
<body style="background-color: #1E1E1E;">
<?php include '../header.php' ?>
<!------------------------------------------------------ Add Dev ------------------------------------------------------>
<div class="modal fade" id="AddDev-Form" tabindex="-1" aria-labelledby="AddDev" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" style="width: 600px;">
        <div class="modal-content" style="background-color: #5d5d5d; border-radius: 10px;">
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <p style="font-size: 25px; margin-top: 16px; margin-bottom: 29px">Add Developer<br><img src="../img/default-icon.png" style="margin-top: 14px; width: 150px; height: 150px;"></p>
                    
                    <label for="developer_image">Developer Image</label>
                    <input type="file" id="inputFile" class="file-upload" name="Developer_Image" placeholder="Upload" accept="image/png, image/jpeg" required><br>
                    
                    <label for="developer_image">Developer Background</label>
                    <input type="file" id="inputFile" class="file-upload" name="Developer_Background" placeholder="Upload" accept="image/png, image/jpeg" required><br>
                    
                    <label for="name">Developer Name</label><br>
                    <input type="text" name="Developer_Name" placeholder="Developer Name" required><br>

                    <label for="email">Email</label><br>
                    <input type="email" name="Developer_Email" placeholder="Email Address" required><br>
                    
                    <label for="address">Address</label><br>
                    <input type="text" name="Developer_Address" placeholder="Developer Address" required><br>
                    
                    <label for="about_desc">About Description:</label><br>
                    <textarea name="Developer_Desc" rows="4" placeholder="Developer Description" required></textarea><br>
                    
                    <input type="submit" name="Add" class="submit-button">
                    <button class="submit-button" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!------------------------------------------------------ Edit Dev ------------------------------------------------------>
<div class="modal fade" id="EditDev-Form" tabindex="-1" aria-labelledby="AddDev" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" style="width: 600px;">
        <div class="modal-content" style="background-color: #5d5d5d; border-radius: 10px;">
            <div class="modal-body">
              <form action="" method="post" enctype="multipart/form-data">
                <p style="font-size: 25px; margin-top: 16px; margin-bottom: 29px">Edit Developer<br>
                <img src="../img/default-icon.png" style="margin-top: 14px; width: 150px; height: 150px;"></p>

                <label for="developer_image">Developer Image</label>
                <input type="file" id="inputFile" class="file-upload" name="DeveloperImage" placeholder="Upload" accept="image/png, image/jpeg" required><br>

                <label for="name">Developer Name</label><br>
                <input type="text" value="<?=$data[0][1]?>" name="Developer_Name" required><br>

                <label for="email">Email</label><br>
                <input type="email" value="<?=$data[0][2]?>" name="Developer_Email" required><br>

                <label for="address">Address</label><br>
                <input type="text" value="<?=$data[0][3]?>" name="Developer_Address" required><br>

                <label for="about_desc">About Description:</label><br>
                <textarea name="Developer_Desc" value="" rows="4" required><?=$data[0][4]?></textarea><br>

                <input type="submit" name="Edit" class="submit-button">
                <button class="submit-button" data-bs-dismiss="modal">Cancel</button>          
              </form>
            </div>
        </div>
    </div>
</div>

<!------------------------------------------------------------------------ Main Body ------------------------------------------------------------------------>
  <h1 class="devhead">Game Developers</h1>
  <center>
    <div class="developer_container">    
      <?php while ($row = $resultDev->fetch_assoc()) : ?>
        <div class="developer_card">
            <div class="developer_card-body">
              <div class="developer_profile-img">
              <img src="../Developer/<?php echo $row['Developer_Name']; ?>/<?php echo $row['Developer_Name'] . "Image" ?>.png" alt="<?php echo $row['Developer_Name'] ?>">
              </div>
              <h5 class="developer_card-title"><?php echo $row['Developer_Name'] ?></h5>
              <p class="developer_card-text"><?php echo $row['Developer_Desc'] ?></p>
            </div>
            <a href="../Main/Dev_Page.php?id=<?=$row['Developer_ID']?>" class="developer_btn">View Profile</a>
            
            <?php 
              if (isset($_SESSION['Admin'])) : ?>
                <a href='' class='developer_btn' data-bs-toggle='modal' data-bs-target='#EditDev-Form' data-id="<?php $row['Developer_ID'] ?>">Edit Developer</a>
            <?php endif ?>

        </div>
      <?php endwhile; ?>
    </div>

    <div class="pagination-links">
        <!-- Display pagination links -->
        <a href="?page=1" class="pagination-button">&#10094;&#10094;</a>
                    
        <a href="?page=<?php echo $prev_PageDev; ?>" class="pagination-button">&#10094;</a>

        <?php for ($i = max(1, $pageDev - 1); $i <= min($pageDev + 1, $total_pagesDev); $i++) : ?>
            <a href="?page=<?php echo $i; ?>"
            <?php
                if ($i == $pageDev)
                    echo 'class="page-highlight"';
                ?> class="pagination-button"><?php echo $i; ?></a>
        <?php endfor; ?>

        <a href="?page=<?php echo $next_PageDev; ?>" class="pagination-button">&#10095;</a>

        <a href="?page=<?php echo $total_pagesDev; ?>" class="pagination-button">&#10095;&#10095;</a>
      </div>

  <div class="Dev-AddButton">
    <button class="devAdd-button" data-bs-toggle="modal" data-bs-target="#AddDev-Form">Add Developer</button>
  </div> 
</center>

</body>
</html>

<script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
    crossorigin="anonymous">
</script>