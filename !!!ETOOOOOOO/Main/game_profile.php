<?php
session_start();

//$_SESSION['User'] = true;
unset($_SESSION['User']);

//$_SESSION['Admin'] = true;
//unset($_SESSION['Admin']);

// Database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "items";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM games WHERE id = $id";
    $game_info = mysqli_query($conn, $sql);
    $game_info = mysqli_fetch_assoc($game_info);

    $genre = $game_info['genre'];
    $MLT = "SELECT * from games WHERE genre = '$genre' AND id != '$id' ORDER BY RAND() LIMIT 3";
    $MLT_result = mysqli_query($conn, $MLT);

    $RG = "SELECT * FROM (SELECT * FROM games ORDER BY RAND()) AS random_games ORDER BY ratings DESC LIMIT 3";
    $RG_result = mysqli_query($conn, $RG);

    $date_order = '';
    $rate_order = '';
    $sortingQueryParam = '';
    if (isset($_GET['latest'])) {
        $date_order = "ORDER BY date_uploaded DESC";
        $sortingQueryParam = '&latest=1';
    }
    if (isset($_GET['rating'])) {
        $rate_order = "ORDER BY rating DESC";
        $sortingQueryParam = '&rating=1';
    }

    $order_clause = $date_order ?: $rate_order;

    //lagyan niya na lang din ng limit na di makikita review ni user na logged in at makikita na kasi sa top un if ever my review na
    // lagyan niyo ng AND id != '$id' parang ganon is user ang logged pero sa admin kita lahat
    //lagayan niyo na lang ng halimbawa game_id = $game_id;
    $rev = "SELECT * FROM reviews $order_clause";
    $rev_result = mysqli_query($conn, $rev);
    $total_review = mysqli_num_rows($rev_result);
}
$game_bought = false;
$full_rev = false;
if (isset($_GET['more'])) {
    if ((int)$_GET['more'] < $total_review)
        $max_rev_count = (int)$_GET['more'];
    else {
        $max_rev_count = $total_review;
        $full_rev = true;
    }
} else {
    $max_rev_count = 5;
}

//mali ung algo ko hindi dapat sa loob ng %_POST ung $game_reviewed = true; pero for the sake lang na mapalabas ko results ito
//gawin niyo na lang na mag query kayo tapos mysqli_num_rows tapos if count > 0
//ibig sabihin non present siya. Tsaka nito lagyan ng flag na  $game_reviewed = true;
//kumbaga after $_post, tsaka niyo scan kung may review si user depende sa id ah
//ung $_POST kasi dito simulate lang siya ng insert sa table pero gawin niyong makatotohanan HAHAHA
$username = "Sample User";
$date = "2013-23-1";
$time = "12:12:12";

$logged_user = array(
    "Username" => "",
    "Date" => "",
    "Time" => "",
    "Rating" => 0,
    "Review" => ""
);
$game_reviewed = False;
if (isset($_POST['submit_review'])) {

    $review = $_POST['review'];
    $rating = $_POST['rating'];

    $logged_user['Username'] = $username;
    $logged_user['Date'] = $date;
    $logged_user['Time'] = $time;
    $logged_user['Review'] = $review;
    $logged_user['Rating'] = $rating;
    $game_reviewed = true;
}

$login_popup = false;
if (isset($_GET['get'])) {
    if (isset($_SESSION['User'])) {
        header("Location:buy_game.php");
    } else {
        $login_popup = true;
    }
}
$edit_able = false;
if (isset($_GET['edit-review'])) {
    $edit_able = true;
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/header_css.css">
    <link rel="stylesheet" href="../css/game_profile_css.css">
    <link rel="stylesheet" href="../css/footer_css-forall.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <title><?php echo $game_info['name']; ?></title>
</head>

<body>
    <?php if (isset($_SESSION['User']) && $game_reviewed && $edit_able) { ?>
        <div class="popup-area" onclick="window.location.href='?id=<?php echo $game_info['id']; ?>';">
            <div class="popup-con" id="edit-pup">
                <div class="top-edit-con">
                    <p>Edit Review</p>
                </div>
                <div class="bottom-edit-con">
                    <form action="" method="post">
                        <textarea name="review" placeholder="Write Review Here" id="text" rows="1">Sample Sample</textarea>
                        <select name="rating" required>
                            <option value="" disabled selected hidden>Give Rate</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <button type="submit" name="submit_review">Submit Review</button>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php if ($login_popup) { ?>
        <div class="popup-area" onclick="window.location.href='?id=<?php echo $game_info['id']; ?>';">
            <div class="popup-con">
                <div class="popup-title">
                    <p>Want to purchase this game?</p>
                    <p class="desc">Register an Account or Sign In now!</p>
                </div>
                <div class="popup-links">
                    <a href="" id="link1">Sign Up</a>
                    <a href="" id="link2">Sign In</a>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php
    include "../header.php";
    ?>

    <!------------------------------Game Details Section---------------------------------->
    <div class="game-details-section">
        <div class="bg-cover-con">
            <img src="../records/game_<?php echo $game_info['id']; ?>/bg_cover.png">
        </div>
        <div class="game-content">
            <div class="top-content">
                <div class="game-cover-con">
                    <img src="../records/game_<?php echo $game_info['id']; ?>/cover.png">
                </div>
                <div class="game-title-con">
                    <div class="game-desc-sec-1">
                        <p class="game-title"><?php echo $game_info['name']; ?></p>
                        <?php $rating = $game_info['ratings']; ?>
                        <div class="rating">
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
                        <?php if (isset($_SESSION['Admin'])) { ?>
                            <a href="" class="edit">Edit Game</a>
                        <?php } else { ?>
                            <?php if ($game_bought) { ?>
                                <a href="" class="vie-lib">View Library</a>
                            <?php } else { ?>
                                <p class="game-price">$<?php echo $game_info['price']; ?></p>
                                <a href="?id=<?php echo $game_info['id']; ?>&get=true" class="get">Get</a>
                        <?php }
                        } ?>
                    </div>
                    <div class="game-desc-sec-2">
                        <p><?php echo $game_info['game_developer']; ?></p>
                    </div>
                    <div class="game-desc-sec-3">
                        <p class="game-genre"><?php echo $game_info['genre']; ?></p>
                        <p class="game-downloads">Downloads: <?php echo $game_info['downloads']; ?></p>
                    </div>
                </div>
            </div>
            <div class="bottom-content">
                <div class="screenshot-con">
                    <!-- Radio Inputs for Navigation -->
                    <input type="radio" name="slide" id="slide1" checked>
                    <input type="radio" name="slide" id="slide2">
                    <input type="radio" name="slide" id="slide3">

                    <!-- Slides -->
                    <div class="slides">
                        <label for="slide3" class="left-arrow" onclick="prevImage()">&#10094;</label>
                        <label for="slide2" class="right-arrow" onclick="nextImage()">&#10095;</label>
                        <div class="slide"><img src="../records/game_<?php echo $game_info["id"]; ?>/ss_1.png" alt="Slide 1"></div>
                    </div>
                    <div class="slides">
                        <label for="slide1" class="left-arrow" onclick="prevImage()">&#10094;</label>
                        <label for="slide3" class="right-arrow" onclick="nextImage()">&#10095;</label>
                        <div class="slide"><img src="../records/game_<?php echo $game_info["id"]; ?>/ss_2.png" alt="Slide 2"></div>
                    </div>
                    <div class="slides">
                        <label for="slide2" class="left-arrow" onclick="prevImage()">&#10094;</label>
                        <label for="slide1" class="right-arrow" onclick="nextImage()">&#10095;</label>
                        <div class="slide"><img src="../records/game_<?php echo $game_info["id"]; ?>/ss_3.png" alt="Slide 3"></div>
                    </div>
                </div>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        // Get all radio inputs
                        var radios = document.querySelectorAll('input[type="radio"][name="slide"]');

                        // Function to change slide
                        function changeSlide() {
                            // Hide all slides
                            document.querySelectorAll('.slides').forEach(function(slide) {
                                slide.style.display = 'none';
                            });

                            // Get the index of the currently checked radio
                            var checkedRadioIndex = Array.from(radios).findIndex(radio => radio.checked);

                            // Show the corresponding slide
                            if (checkedRadioIndex !== -1) {
                                document.querySelectorAll('.slides')[checkedRadioIndex].style.display = 'block';
                            }
                        }

                        // Initial display update
                        changeSlide();

                        // Add change event listener to each radio input
                        radios.forEach(function(radio) {
                            radio.addEventListener('change', changeSlide);
                        });
                    });
                </script>
                <div class="game-info">
                    <div class="game-info-sec-1">
                        <p class="about">About Game</p>
                        <p class="game-date">Publish Date: <?php echo $game_info['date_published']; ?></p>
                    </div>
                    <div class="game-info-sec-2">
                        <p><?php echo $game_info['game_desc']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!------------------------------Game Review Section---------------------------------->
    <div class="game-review-section" id="View-More">
        <div class="review-con">
            <div class="review-head">
                <p>Reviews</p>
                <?php if ($total_review) { ?>
                    <p class="sort">Sort by:</p>
                    <a href="?id=<?php echo $game_info['id']; ?>&latest=1#View-More" class="rev-button" <?php if ($sortingQueryParam == "&latest=1") echo "style='background-color: #bebebe; color: black;'"; ?>>Latest</a>
                    <a href="?id=<?php echo $game_info['id']; ?>&rating=1#View-More" class="rev-button" <?php if ($sortingQueryParam == "&rating=1") echo "style='background-color: #bebebe; color: black;'"; ?>>Rating</a>
                <?php } ?>
            </div>
            <?php if (!$total_review) { ?>
                <div class="rev-wrapper">
                    <p class="no-review">No Reviews Yet.</p>
                </div>
            <?php } ?>

            <!--------------------------- kay user ito ----------------------------------------->
            <!-- tapos dito kasi lalabas lang review ni user if logged in siya at activated ung flag na if may review na si user -->
            <?php if (isset($_SESSION['User']) && $game_reviewed) { ?>
                <div class="rev-wrapper" ?>"
                    <div class="rev-info">
                        <div class="profile-img-container">
                            <img src="../img/default-icon.png" alt="">
                        </div>
                        <div class="user-info">
                            <p class="username"><?php echo $logged_user['Username']; ?></p>
                            <p><?php echo $logged_user['Date']; ?></p>
                            <p><?php echo $logged_user['Time']; ?></p>

                            <?php $rating = $logged_user['Rating']; ?>
                            <div class="rating">
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
                        </div>

                    </div>
                    <div class="review-text">
                        <?php echo $logged_user['Review']; ?>
                    </div>
                </div>
                <div class="edit-review"><a href="?id=<?php echo $game_info['id']; ?>&edit-review= true">Edit Review</a></div>
            <?php } ?>




            <!--------------------------- all reviews ----------------------------------------->
            <?php
            for ($j = 0; $j < $max_rev_count; $j++) {
                $row = $rev_result->fetch_assoc();
            ?>
                <div class="rev-wrapper" id="rev-<?php echo $j; ?>">
                    <div class="rev-info">
                        <div class="profile-img-container">
                            <img src="../img/default-icon.png" alt="">
                        </div>
                        <div class="user-info">
                            <p class="username"><?php echo $row['name'] ?></p>
                            <p><?php echo $row['date_uploaded'] ?></p>
                            <p><?php echo $row['time_uploaded'] ?></p>

                            <?php $rating = $row['rating']; ?>
                            <div class="rating">
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
                            <?php if (isset($_SESSION['Admin'])) { ?>
                                <button class="delete-review">Delete</button>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="review-text">
                        <?php echo $row['review'] ?>
                    </div>
                </div>
            <?php }
            if (!$full_rev) { ?>
                <div class="view-more">
                    <a href="?id=<?php echo $game_info['id']; ?>&more=<?php echo $max_rev_count + 5;
                                                                        echo $sortingQueryParam; ?>#rev-<?php echo $j; ?>">View More</a>
                </div>
            <?php }

            if (!$game_reviewed && isset($_SESSION['User'])) { ?>
                <form action="" method="post">
                    <div class="rev-wrapper" style="overflow: hidden;">
                        <textarea name="review" placeholder="Write Review Here" id="text" rows="1"></textarea>
                    </div>
                    <div class="submit-review">
                        <select name="rating" required>
                            <option value="" disabled selected hidden>Give Rate</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <button type="submit" name="submit_review">Submit Review</button>
                    </div>
                </form>
            <?php } ?>
        </div>
    </div>
    <!------------------------------Game Reco Section---------------------------------->
    <div class="game-recommended-section">
        <div class="section-container">
            <div class="MLT-section">
                <div class="Head-title">More Like This</div>
                <div class="container-content">
                    <?php for ($i = 0; $i < 3; $i++) {
                        $row = $MLT_result->fetch_assoc();
                        if (isset($row['name'])) {
                            $_name = $row['name'];
                        } else $_name = "No Data Found";
                    ?>
                        <a href="game_profile.php?id=<?php echo $row['id']; ?>" class="game-option">
                            <div class="op-img-con">
                                <img src="../records/game_<?php echo $row['id']; ?>/cover.png" alt="No Image Found">
                            </div>
                            <div class="op-title-con"><?php echo $_name; ?></div>
                        </a>
                    <?php } ?>
                </div>
            </div>
            <div class="RG-section">
                <div class="Head-title">Recommended Games</div>
                <div class="container-content">
                    <?php for ($i = 0; $i < 3; $i++) {
                        $row = $RG_result->fetch_assoc();
                    ?>
                        <a href="game_profile.php?id=<?php echo $row['id']; ?>" class="game-option">
                            <div class="op-img-con">
                                <img src="../records/game_<?php echo $row['id']; ?>/cover.png">
                            </div>
                            <div class="op-title-con"><?php echo $row['name']; ?></div>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php

    include "../footer-forall.php";

    ?>
</body>

</html>