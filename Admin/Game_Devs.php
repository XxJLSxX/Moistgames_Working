<?php
    session_start();
    require '../Database/MoistFunctions.php';
    if (!isset($_SESSION['Admin'])) {
        header("Location: ../Main/index.php");
    }

    $moistFunction = new MoistFunctions($connection);
    $moistFunctions = new MoistFunctions($connection);

    $pageDev = isset($_GET['page']) ? $_GET['page'] : 1;
    $paginationData = $moistFunction->paginateDevs("games");
    $resultDev = $paginationData['itemsDev'];
    $total_pagesDev = $paginationData['total_pagesDev'];
    $prev_PageDev = $paginationData['prev_pageDev'];
    $next_PageDev = $paginationData['next_pageDev'];
    $name_order = $paginationData['Name_Sort'];
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="../css/Game_Devs_css.css?+2">
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous">
</head>
<body style="background-color: #1E1E1E;">
<?php include '../header.php' ?>
  <h1 class="devhead">Game Developers</h1>
    <div class="developer_container">    
      <?php while ($row = $resultDev->fetch_assoc()) : ?>
        <div class="developer_card">
            <div class="developer_card-body">
              <div class="developer_profile-img">
                  <img src="../Developer/<?php echo $row['Developer_Name'] ?>.png" alt="Dev <?php echo $row['Developer_ID'] ?>">
              </div>
              <h5 class="developer_card-title"><?php echo $row['Developer_Name'] ?></h5>
              <p class="developer_card-text"><?php echo $row['Developer_Desc'] ?></p>
              <a href="../Forms/EditDeveloper.php?id=<?php echo $row['Developer_ID']; ?>" class="developer_btn">Dummy Edit</a>
              <a href="#" class="developer_btn">View Profile</a>
            </div>
        </div>
      <?php endwhile; ?>
    </div>
<!-- 
<div class="pagination">
    <button id="prevPage">Previous</button>
    <div class="pageIndicator">Page <span id="currentPage">1</span> of <span id="totalPages">3</span></div>
    <button id="nextPage">Next</button>
</div> 
-->

</body>
</html>
