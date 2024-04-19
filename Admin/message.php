<?php
session_start();
require '../Database/MoistFunctions.php';
include '../Popups/Receipt.php';


$id = $_GET['id'];
$moistFunction = new MoistFunctions($connection);
$moistFunctions = new MoistFunctions($connection);

$RG_result = $moistFunction->queryRandomByLimitOrderBy("games", 3, "Game_Rating", "");
$MLT_result = $moistFunction->queryRandomByLimitOrderBy("games", 3, "Category", "WHERE Game_ID != $id");
$game_info = $moistFunction->getGameInfo($id);


$avg_rating_sql = "SELECT AVG(Rate_Score) as 'Rate_Score' FROM rating WHERE Game_ID = $id";
$avg_rating_result = mysqli_query($connection, $avg_rating_sql);
$avg_rating_row = $avg_rating_result->fetch_assoc();


$sortingQueryParam = "";
if (isset($_GET['sort']) == "rating") {
    $sortingQueryParam = "ORDER BY Rate_Score DESC";
}
$game_reviewed = false;
$user_id = "";
if (isset($_SESSION['User'])) {

    $userData = $moistFunction->showRecords('Users', "User_ID = " . $_SESSION['User_ID']);
    $user_id = $userData[0][0];

    $user_rev = "SELECT * FROM rating WHERE Game_ID=$id AND USER_ID = '$user_id'";
    $user_rev_result = mysqli_query($connection, $user_rev);
    $rev_row = $user_rev_result->fetch_assoc();
    if (mysqli_num_rows($user_rev_result) > 0) {
        $game_reviewed = true;
    }
}


$game_bought = false;

$rev = "SELECT * FROM rating WHERE Game_ID = $id AND USER_ID != '$user_id' $sortingQueryParam LIMIT 1";
$rev_result = mysqli_query($connection, $rev);
$total_review = mysqli_num_rows($rev_result);


if (isset($_POST['submit_review'])) {
    $review = $_POST['review'];
    $rating = $_POST['rating'];

    $review_sql = "Insert into Rating(Rate_Score,Review,Review_Date,Review_Time,User_ID,Game_ID)
    values('$rating','$review',CURDATE(),CURTIME(),'$user_id','$id')";
    mysqli_query($connection, $review_sql);

    $game_reviewed = true;
    header("Location: {$_SERVER['PHP_SELF']}?id=$id#rev-section");
    exit();
}

if (isset($_POST['submit_edit_review'])) {
    $review = $_POST['review'];
    $rating = $_POST['rating'];
    $edit_review_sql = "UPDATE Rating SET Rate_Score = '$rating', Review = '$review' WHERE User_ID = '$user_id' AND Game_ID = '$id'";
    mysqli_query($connection, $edit_review_sql);

    $game_reviewed = true;
    header("Location: {$_SERVER['PHP_SELF']}?id=$id#rev-section");
    exit();
}

if (isset($_POST['continue-delete'])) {
    $delete_review_sql = "DELETE FROM Rating WHERE User_ID = '$user_id' AND Game_ID = '$id'";
    mysqli_query($connection, $delete_review_sql);

    $game_reviewed = false;
    header("Location: {$_SERVER['PHP_SELF']}?id=$id#rev-section");
    exit();
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/header_css.css?+2">
    <link rel="stylesheet" href="../css/game_profile_css.css">
    <link rel="stylesheet" href="../css/footer_css-forall.css">
    <link rel="stylesheet" href="../css/reset.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

    <title><?php echo $game_info['Game_Name']; ?></title>
</head>

<body>
    <div class="popup-area" id="edit-popUp">
        <div class="popup-con" id="edit-pup">
            <div class="top-edit-con">
                <p>Edit Review</p>
                <p class="remove-edit" onclick="removeEditPop()">&#10005;</p>
            </div>
            <div class="bottom-edit-con">
                <form action="" method="post">
                    <textarea name="review" placeholder="Write Review Here" id="text" rows="1"></textarea>
                    <select name="rating" id="rate" required>
                        <option value="" disabled selected hidden></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <button type="submit" name="submit_edit_review">Submit Review</button>
                </form>
            </div>
        </div>
    </div>
    <div class="popup-area" id="delete-popUp">
        <div class="popup-con" id="delete-pup">
            <div class="popup-title">
                <p>Are sure to delete your Review?</p>
            </div>
            <div class="popup-links">
                <button class="cancel-delete" onclick="removeDeletePop()">Cancel</button>
                <form action="" method="post" style="margin: 0%;">
                    <button name="continue-delete" type="submit" class="continue-delete">Continue</button>
                </form>
            </div>
        </div>
    </div>
    <?php
    include "../header.php";
    ?>

    <!------------------------------Game Details Section---------------------------------->
    <div class="game-details-section">
        <div class="bg-cover-con">
            <img src="../Games/<?php echo $game_info['Game_Name']; ?>/Background.png">
        </div>
        <div class="game-content">
            <div class="top-content">
                <div class="game-cover-con">
                    <img src="../Games/<?php echo $game_info['Game_Name']; ?>/Image.png">
                </div>
                <div class="game-title-con">
                    <div class="game-desc-sec-1">
                        <p class="game-title"><?php echo $game_info['Game_Name']; ?></p>
                        <?php $rating = $avg_rating_row['Rate_Score']; ?>
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
                                <p class="game-price">$<?php echo $game_info['Price']; ?></p>
                                <a href="" class="get">
                                    <button data-game-id="<?php $game_info['Game_ID']; ?>" data-bs-toggle="modal" data-bs-target="#Buy-Form">Get</button>
                                </a>
                        <?php }
                        } ?>
                    </div>
                    <div class="game-desc-sec-2">
                        <p><?php echo $game_info['Developer_Name']; ?></p>
                    </div>
                    <div class="game-desc-sec-3">
                        <p class="game-genre"><?php echo $game_info['Category']; ?></p>
                        <p class="game-downloads">Downloads: <?php echo $game_info['Game_Downloads']; ?></p>
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
                        <div class="slide"><img src="../Games/<?php echo $game_info["Game_Name"]; ?>/Screenshot1.png" alt="Slide 1"></div>
                    </div>/
                    <div class="slides">
                        <label for="slide1" class="left-arrow" onclick="prevImage()">&#10094;</label>
                        <label for="slide3" class="right-arrow" onclick="nextImage()">&#10095;</label>
                        <div class="slide"><img src="../Games/<?php echo $game_info["Game_Name"]; ?>/Screenshot2.png" alt="Slide 2"></div>
                    </div>
                    <div class="slides">
                        <label for="slide2" class="left-arrow" onclick="prevImage()">&#10094;</label>
                        <label for="slide1" class="right-arrow" onclick="nextImage()">&#10095;</label>
                        <div class="slide"><img src="../Games/<?php echo $game_info["Game_Name"]; ?>/Screenshot3.png" alt="Slide 3"></div>
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
                        <p class="game-date">Publish Date: <?php echo $game_info['Upload_Date']; ?></p>
                    </div>
                    <div class="game-info-sec-2">
                        <p><?php echo $game_info['Game_Desc']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!------------------------------Game Review Section---------------------------------->
    <div class="game-review-section" id="rev-section">
        <div class="review-con" id="Reviews">
            <div class="review-head">
                <p>Reviews</p>
                <?php if ($total_review) { ?>
                    <p class="sort">Sort by:</p>
                    <a href="?id=<?php echo $id; ?>&sort=rating#rev-section" class="rev-button" id="rate-sort">Rating</a>
                <?php } ?>
            </div>
            <?php if (!$game_reviewed && isset($_SESSION['User'])) { ?>
                <form class="review-form" action="" method="post">
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
            <?php if (!$total_review && !$game_reviewed) { ?>
                <div class="rev-wrapper">
                    <p class="no-review">No Reviews Yet.</p>
                </div>
            <?php } ?>

            <!--------------------------- kay user ito ----------------------------------------->
            <!-- tapos dito kasi lalabas lang review ni user if logged in siya at activated ung flag na if may review na si user -->
            <?php if (isset($_SESSION['User']) && $game_reviewed) { ?>
                <div class="rev-wrapper">
                    <div class="rev-info">
                        <div class="profile-img-container">
                            <img src="../img/default-icon.png" alt="">
                        </div>
                        <div class="user-info">
                            <p class="username"><?php echo $rev_row['User_ID'] ?></p>
                            <p><?php echo $rev_row['Review_Date']; ?></p>
                            <p><?php echo $rev_row['Review_Time']; ?></p>

                            <?php $rating = $rev_row['Rate_Score']; ?>
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
                        <?php echo $rev_row['Review']; ?>
                    </div>
                </div>

                <div class="config-wrapper">
                    <button class="delete-review" onclick="openDeletePop()">
                        <span style="font-family: sans-serif">🗑 Delete</span>
                    </button>
                    <button id="edit-btn" class="edit-review" onclick="openEditPop()">
                        <span style="font-family: sans-serif">✐ Edit</span>
                    </button>
                </div>

            <?php } ?>




            <!--------------------------- all reviews ----------------------------------------->
            <?php
            while ($row = $rev_result->fetch_assoc()) {
            ?>
                <div class="rev-wrapper">
                    <div class="rev-info">
                        <div class="profile-img-container">
                            <img src="../img/default-icon.png" alt="">
                        </div>
                        <div class="user-info">
                            <p class="username"><?php echo $row['User_ID'] ?></p>
                            <p><?php echo $row['Review_Date'] ?></p>
                            <p><?php echo $row['Review_Time'] ?></p>

                            <?php $rating = $row['Rate_Score']; ?>
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
                                <button class="delete-review" onclick="openDeletePop()">
                                    <span style="font-family: sans-serif">🗑 Delete</span>
                                </button>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="review-text">
                        <?php echo $row['Review'] ?>
                    </div>
                </div>

            <?php } ?>
            <script>
                $(document).ready(function() {
                    var offset = 1; // Initial offset for fetching more records
                    var sortByRating = 0;
                    var id = <?php echo json_encode($id); ?>;
                    var user_id = <?php echo json_encode($user_id); ?>;

                    function checkSortParameter() {
                        // Get the URL query string
                        var queryString = window.location.search.substring(1);

                        // Split the query string into individual parameters
                        var parameters = queryString.split('&');

                        // Loop through each parameter
                        for (var i = 0; i < parameters.length; i++) {
                            // Split the parameter into its name and value
                            var parameter = parameters[i].split('=');

                            // Check if the parameter name is 'sort' and the value is 'rating'
                            if (parameter[0] === 'sort' && parameter[1] === 'rating') {
                                return true; // Parameter 'sort' is set to 'rating'
                            }
                        }
                        return false; // Parameter 'sort' is not set to 'rating' or not found
                    }

                    if (checkSortParameter()) {
                        sortByRating = 1;
                    }
                    // Event listener for the "See More" button
                    $('#View-More').click(function() {
                        // AJAX request to fetch more records
                        $.ajax({
                            url: 'fetch_game_reviews.php',
                            type: 'GET',
                            data: {
                                offset: offset,
                                sortByRating: sortByRating,
                                id: id,
                                user_id: user_id
                            },
                            success: function(response) {
                                // Append the received records to the parent container
                                $('#Reviews').append(response);
                                offset += 1; // Increase the offset for the next request

                                // Check if there are no more records
                                if (response.trim() === '<?php echo '<div class="rev-wrapper"><p class="no-review">No More Reviews.</p></div>'; ?>') {
                                    $('#View-More').hide(); // Hide the button
                                    $('#view-more-con').hide(); // Hide the button
                                }

                            },
                            error: function(xhr, status, error) {
                                console.error('AJAX Error:', error);
                            }
                        });
                    });
                });
            </script>



        </div>
        <?php if ($total_review != 0) { ?>
            <div class="view-more" id="view-more-con">
                <button id="View-More">View More</button>
            </div>
        <?php } ?>

    </div>
    <script>
        let editPopUp = document.getElementById('edit-popUp');
        let editpup = document.getElementById('edit-pup');
        let deletePopUp = document.getElementById('delete-popUp');
        let deletepup = document.getElementById('delete-pup');

        function openDeletePop() {
            deletePopUp.style.visibility = 'visible';
            deletepup.classList.add('popup-con-open');
            document.body.style.overflow = 'hidden';
            document.documentElement.style.overflow = 'hidden';
        }

        function openEditPop() {
            editPopUp.style.visibility = 'visible';
            editpup.classList.add('popup-con-open');
            document.body.style.overflow = 'hidden';
            document.documentElement.style.overflow = 'hidden';
            var textarea = document.getElementById('text');
            var select = document.getElementById('rate');
            textarea.value = '<?php echo $rev_row['Review']; ?>';
            select.value = '<?php echo $rev_row['Rate_Score']; ?>';
        }

        function removeEditPop() {
            editPopUp.style.visibility = 'hidden';
            editpup.classList.remove('popup-con-open');
            document.body.style.overflow = 'auto';
            document.documentElement.style.overflow = 'auto';
        }

        function removeDeletePop() {
            deletePopUp.style.visibility = 'hidden';
            deletepup.classList.remove('popup-con-open');
            document.body.style.overflow = 'auto';
            document.documentElement.style.overflow = 'auto';
        }
    </script>
    <!------------------------------Game Reco Section---------------------------------->
    <div class="game-recommended-section">
        <div class="section-container">
            <div class="MLT-section">
                <div class="Head-title">More Like This</div>
                <div class="container-content">
                    <?php for ($i = 0; $i < 3; $i++) {
                        $row = $MLT_result->fetch_assoc();
                        if (isset($row['Game_Name'])) {
                            $_name = $row['Game_Name'];
                        } else $_name = "No Data Found";
                    ?>
                        <a href="game_profile.php?id=<?php echo $row['Game_ID']; ?>" class="game-option">
                            <div class="op-img-con">
                                <img src="../Games/<?php echo $row['Game_Name']; ?>/Image.png" alt="No Image Found">
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
                        <a href="game_profile.php?id=<?php echo $row['Game_ID']; ?>" class="game-option">
                            <div class="op-img-con">
                                <img src="../Games/<?php echo $row['Game_Name']; ?>/Image.png">
                            </div>
                            <div class="op-title-con"><?php echo $row['Game_Name']; ?></div>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

<script>
    // JavaScript to handle button click
    document.getElementById('Buy-Form').addEventListener('show.bs.modal', function(event) {
        // Button that triggered the modal
        var button = event.relatedTarget;
        // Extract ID value from data attribute
        var gameId = button.getAttribute('data-game-id');
        // Set the ID value in the modal
        document.getElementById('buy-game-button').setAttribute('data-game-id', gameId);
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Get the modal element
        var modal = document.getElementById('Buy-Form');

        // Add event listener for the modal shown event
        modal.addEventListener('show.bs.modal', function(event) {
            // Get the button that triggered the modal
            var button = event.relatedTarget;

            // Retrieve the ID value from the button's data attribute
            var gameId = button.getAttribute('data-game-id');
        });
    });
</script>