<?php
session_start();
require '../Database/MoistFunctions.php';
if (!isset($_SESSION['Admin'])) {
    header("Location: ../Main/index.php");
}

$moistFunction = new MoistFunctions($connection);
$moistFunctions = new MoistFunctions($connection);

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$paginationData = $moistFunction->paginateItems("games");
$itemsResult = $paginationData['items'];
$total_pages = $paginationData['total_pages'];
$prev_Page = $paginationData['prev_page'];
$next_Page = $paginationData['next_page'];
$date_order = $paginationData['latest'];
$category_filter = $paginationData['sort'];

$devs = $moistFunctions->showRecords('developer');

if (isset($_POST['Add'])) {
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
        mkdir($folderPath, 0777);
    } else {
        echo "Game Already Exists";
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
    $moistFunctions->uploadFile($_FILES["GameImage"], $target_dir, "Image." . "png");
    $moistFunctions->uploadFile($_FILES["GameBackground"], $target_dir, "Background." . "png");
    $moistFunctions->uploadFile($_FILES["Screenshot1"], $target_dir, "Screenshot1." . "png");
    $moistFunctions->uploadFile($_FILES["Screenshot2"], $target_dir, "Screenshot2." . "png");
    $moistFunctions->uploadFile($_FILES["Screenshot3"], $target_dir, "Screenshot3." . "png");
}




if (isset($_POST['Edit'])) {
    $id = $_POST['u_id'];
    $data = $moistFunctions->showRecords('games', null, 'developer', 'games.Developer_ID', 'developer.Developer_ID', "games.Game_ID='$id'");
    $devs = $moistFunctions -> showRecords('developer');
    $Gname = $_POST['Game_Name'];
    $folderPath = "../Games/" . $data[0][1];
    $new_folderPath = "../Games/$Gname";
    if (is_dir($folderPath)) {
        if (strcmp($Gname, $data[0][1]) != 0) {
            rename($folderPath, $new_folderPath);
        }
        
        foreach ($_POST as $name => $val) {
            if ($name !== 'Edit' && $name !== 'GameImage' && $name !== 'GameBackground' && $name !== 'Screenshot1' && $name !== 'Screenshot2' && $name !== 'Screenshot3' && $name !== 'u_id') {
                $datas[$name] = $val;
            }
        }
        try {
            $action = $moistFunctions->updateQuery($datas, 'games', ['Game_ID' => $id]);
            
        } catch (Exception $e) {
            echo "Error: $e";
            die();
        }
        $target_dir = $new_folderPath . "/";
        $moistFunctions->uploadFile($_FILES["GameImage"], $target_dir, "Image." . "png");
        $moistFunctions->uploadFile($_FILES["GameBackground"], $target_dir, "Background." . "png");
        $moistFunctions->uploadFile($_FILES["Screenshot1"], $target_dir, "Screenshot1." . "png");
        $moistFunctions->uploadFile($_FILES["Screenshot2"], $target_dir,  "Screenshot2." . "png");
        $moistFunctions->uploadFile($_FILES["Screenshot3"], $target_dir,  "Screenshot3." . "png");
    }
    header("Refresh:0");
}

?>

<html lang="en">

<head>
    <link rel="stylesheet" href="../css/index_css.css?+1">
    <link rel="stylesheet" href="../css/admin_css.css?+2">
    <link rel="stylesheet" href="../css/admin_addgames_css.css?+2">
    <link rel="stylesheet" href="../css/header_css.css?+2">
    <link rel="stylesheet" href="../css/footer_css-forall.css?+1">
    <link rel="stylesheet" href="../css/user_library_css.css?+2">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Admin Game Library</title>
</head>

<body>
    <?php
    include "../header.php";
    ?>
    <!------------------------------------------------------------ Edit Game Popup ------------------------------------------------------------>
    <div class="edit-popups" id="editpop">
        <div class="edit-form-container" id="editpopcon">
            <!-------------------------------------- Wag niyo burahin yung dalawang div mga gago kayo ---------------------------------------->
        </div>
    </div>
    <!------------------------------------------------------------ Add Game Popup ------------------------------------------------------------>
    <div class="modal fade" id="AddGame-Form" tabindex="-1" aria-labelledby="AddPopup" aria-hidden="true">
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
                                if (count($devs) > 0) {
                                    foreach ($devs as $dev) {
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
                                <option value="5">Strategy </option>
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
    <!------------------------------------------------------------ Update Game Popup ------------------------------------------------------------>

    <!------------------------------------ Main Body ------------------------------------>
    <section id="section">
        <div class="game-library-container">
            <div class="library-header">
                <div class="library-title">
                    <p>Administrator Game Library</p>
                </div>
                <div class="game-sort-options">
                    <div class="sort-controls">
                        <p>Sort by:</p>
                        <a href="?all=true#section4" <?php if (isset($_GET['all'])) echo 'style="background-color: #ffffff;color: rgb(0, 0, 0);"'; ?>>All Games</a>
                        <a href="?latest=1<?php echo isset($_GET['sort']) ? '&sort=' . $_GET['sort'] : ''; ?>#section4" <?php if (isset($_GET['latest'])) echo 'style="background-color: #ffffff;color: rgb(0, 0, 0);"'; ?>>Latest</a>
                        <form id="filterForm" action="#section4" method="get">
                            <select name="sort" placeholder="Genre" id="sort">
                                <option value="" disabled <?php echo (!isset($_GET['sort']) ? 'selected' : ''); ?> hidden>Genre</option>
                                <option value="action" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'action' ? 'selected' : ''); ?>>Action</option>
                                <option value="adventure" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'adventure' ? 'selected' : ''); ?>>Adventure</option>
                                <option value="rpg" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'rpg' ? 'selected' : ''); ?>>RPG</option>
                                <option value="simulation" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'simulation' ? 'selected' : ''); ?>>Simulation</option>
                                <option value="strategy" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'strategy' ? 'selected' : ''); ?>>Strategy</option>
                            </select>
                        </form>
                    </div>
                    <a class="library-add-button" href="#" data-bs-target="#AddGame-Form" data-bs-toggle="modal">Add Game</a>
                </div>
            </div>
            <div class="game-records">
                <?php while ($row = $itemsResult->fetch_assoc()) : ?>
                    <div class="game-entry">
                        <div class="game-image-container">
                            <img src="../Games/<?php echo $row['Game_Name']; ?>/Image.png">
                        </div>
                        <div class="game-details-container">
                            <div class="game-title-section">
                                <p class="game-title"><?php echo $row['Game_Name']; ?></p>
                                <?php $rating = $row['Game_Rating']; ?>
                                <div class="rating" data-rating="<?php echo $rating; ?>">
                                    <?php
                                    // Determine how many full stars to display
                                    $fullStars = floor($rating);

                                    // Generate full stars
                                    for ($i = 1; $i <= $fullStars; $i++) {
                                        echo '<span class="star filled">&#9733;</span>';
                                    }

                                    // Generate empty stars to fill up to 5 stars
                                    for ($i = $fullStars + 1; $i <= 5; $i++) {
                                        echo '<span class="star">&#9733;</span>';
                                    }
                                    ?>
                                </div>
                                <button class='edit-button' style='margin-top: 5px;' id="edit-tite" onclick="popupEdit(<?= $row['Game_ID'];?>)" >Edit</button>
                                <script>
                                    let editpop = document.getElementById("editpop");
                                    let editpopcon = document.getElementById("editpopcon");

                                    function popupEdit(value){
                                        var tite = value;
                                        function sendToPHP(value) {
                                        var xhttp = new XMLHttpRequest();
                                        xhttp.onreadystatechange = function() {
                                            if (this.readyState == 4 && this.status == 200) {
                                                console.log("Value sent to PHP successfully");
                                                editpop.classList.add("show-edit");
                                                editpopcon.classList.add("show-edit-container");
                                                editpopcon.scrollTop = 0;
                                                document.body.style.overflow = 'hidden';
                                                document.documentElement.style.overflow = 'hidden';
                                                document.getElementById("editpopcon").innerHTML = this.responseText;
                                            }
                                        };
                                        xhttp.open("GET", "store_variable.php?tite=" + value, true);
                                        xhttp.send();
                                        }                 
                                        sendToPHP(tite);
                                    }
                                    function removepopupEdit(){
                                        editpop.style.visibility = 'visible';
                                        editpopcon.style.visibility = 'visible';
                                        //editpop.classList.remove("show-edit");
                                       //editpopcon.classList.remove("show-edit-container");
                                        document.body.style.overflow = 'auto';
                                        document.documentElement.style.overflow = 'auto';
                                    }

                                </script>
                            </div>
                            <div class="game-info-section">
                                <p class="game-developer"><?php echo $row['Developer_Name']; ?></br></p>
                                <p class="game-genre"><?php echo $row['Category']; ?></p>
                                <button class='delete-button' id='$row[id]'>Delete</button>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="pagination-links">
                <!-- Display pagination links -->
                <a href="?page=1
                    <?php
                    echo isset($_GET['latest']) ? '&latest=1' : '';
                    echo isset($_GET['all']) ? '&all=true' : '';
                    echo isset($_GET['sort']) ? '&sort=' . $_GET['sort'] : '';
                    ?>#section4" class="pagination-links-buttons">&#10094;&#10094;</a>
                <a href="?page=
                    <?php
                    echo $prev_Page;
                    echo isset($_GET['all']) ? '&all=true' : '';
                    echo isset($_GET['latest']) ? '&latest=1' : '';
                    echo isset($_GET['sort']) ? '&sort=' . $_GET['sort'] : '';
                    ?>#section4" class="pagination-links-buttons">&#10094;</a>

                <?php for ($i = max(1, $page - 1); $i <= min($page + 1, $total_pages); $i++) : ?>
                    <a href="?page=
                        <?php
                        echo $i;
                        echo isset($_GET['all']) ? '&all=true' : '';
                        echo isset($_GET['latest']) ? '&latest=1' : '';
                        echo isset($_GET['sort']) ? '&sort=' . $_GET['sort'] : '';
                        ?>#section4" <?php
                                        if ($i == $page)
                                            echo 'class="page-highlight"';
                                        ?> class="pagination-links-buttons"><?php echo $i; ?></a>
                <?php endfor; ?>

                <a href="?page=
                    <?php
                    echo $next_Page;
                    echo isset($_GET['all']) ? '&all=true' : '';
                    echo isset($_GET['latest']) ? '&latest=1' : '';
                    echo isset($_GET['sort']) ? '&sort=' . $_GET['sort'] : '';
                    ?>#section4" class="pagination-links-buttons">&#10095;</a>
                <a href="?page=
                    <?php
                    echo $total_pages;
                    echo isset($_GET['all']) ? '&all=true' : '';
                    echo isset($_GET['latest']) ? '&latest=1' : '';
                    echo isset($_GET['sort']) ? '&sort=' . $_GET['sort'] : '';
                    ?>#section4" class="pagination-links-buttons">&#10095;&#10095;</a>
            </div>
        </div>
    </section>
    <?php
    include "../footer-forall.php";
    ?>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js?+1" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

<script>
    document.getElementById('sort').addEventListener('change', function() {
        document.getElementById('filterForm').submit();
    });
</script>