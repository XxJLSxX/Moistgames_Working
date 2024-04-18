<!-- 
Group 8 :
    Leader: 
        Saito, Gian Paulo R.
    Members:
        Canillas, Prince Lee Dave G.
        Francisco, Matheia Zaida 
        Manzano, Gareth Preslie P.
        Sagabaen, Edzleizel Mae G.
        Semacio, Jay Laurence L.
-->

<?php
session_start();
    require '../Database/MoistFunctions.php';
    include '../Popups/Receipt.php';
    include '../Popups/CompletionPrompt.php';

    $moistFunction = new MoistFunctions($connection);
    $moistFunctions = new MoistFunctions($connection);

    $DL_result = $moistFunction->queryRandomByLimitOrderBy("games", 3, "Game_Downloads");
    $RG_result = $moistFunction->queryRandomByLimitOrderBy("games", 3, "Game_Rating");
    $games = $moistFunction->fetchGameData();

    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $paginationData = $moistFunction->paginateItems("games");
    $itemsResult = $paginationData['items'];
    $total_pages = $paginationData['total_pages'];
    $prev_Page = $paginationData['prev_page'];
    $next_Page = $paginationData['next_page'];
    $date_order = $paginationData['latest'];
    $category_filter = $paginationData['sort'];

?>
<!---------------------------------- HTML START -------------------------------->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moisture Games</title>
    <link rel="stylesheet" href="../css/index_css.css?+4">
    <link rel="stylesheet" href="../css/header_css.css?+3">
    <link rel="stylesheet" href="../css/footer_css.css">
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
</head>

<body>
    <?php
        include "../header.php";
    ?>
    <!------------------------------Anchor Points---------------------------------->
    <div class="anchor">
        <a href="#section1"><button class="anchor-link"></button></a>
        <a href="#section2"><button class="anchor-link"></button></a>
        <a href="#section3"><button class="anchor-link"></button></a>
        <a href="#section4"><button class="anchor-link"></button></a>
        <a href="#section5"><button class="anchor-link"></button></a>
    </div>

    <div class="page">
        <!------------------------------Section1---------------------------------->
        <section class="sec" id="section1">
            <div class="content-1">
                <div class="left-top-con">
                    <img src="../img/full_logo.png" alt="">
                    <?php if (isset($_SESSION['Admin'])) { ?>
                        <p>Hello, Admin <br> Whatchu gonna do sir?!</p>
                    <?php } else { ?>
                        <p>Moisture Games is an innovative online game store offering a diverse selection of digital entertainment,
                            from thrilling action titles to immersive role-playing adventures, 
                            catering to gamers of all ages and preferences.</p>
                    <?php } ?>
                </div>
                <div class="right-top-con">
                    <img src="../img/Splash.png" alt="">
                </div>
            </div>
        </section>
        <!------------------------------Section2---------------------------------->
        <section class="sec" id="section2">
            <div class="content-2">
                <p>Featured Games</p>
                <div class="wrapper-feat">
                    <div class="left-carousel">
                        <!-- Radio Inputs for Navigation -->
                        <input type="radio" name="slide" id="slide1" checked>
                        <input type="radio" name="slide" id="slide2">
                        <input type="radio" name="slide" id="slide3">
                        <input type="radio" name="slide" id="slide4">
                        <input type="radio" name="slide" id="slide5">

                        <!-- Slides -->
                        <div class="slides">
                            <label for="slide5" class="left-arrow" onclick="prevImage()">&#10094;</label>
                            <label for="slide2" class="right-arrow" onclick="nextImage()">&#10095;</label>
                            <div class="slide"><img src="../Games/<?php echo $games["Game 1"]["title"]; ?>/Image.png" alt="Slide 1"></div>
                        </div>
                        <div class="slides">
                            <label for="slide1" class="left-arrow" onclick="prevImage()">&#10094;</label>
                            <label for="slide3" class="right-arrow" onclick="nextImage()">&#10095;</label>
                            <div class="slide"><img src="../Games/<?php echo $games["Game 2"]["title"]; ?>/Image.png" alt="Slide 2"></div>
                        </div>
                        <div class="slides">
                            <label for="slide2" class="left-arrow" onclick="prevImage()">&#10094;</label>
                            <label for="slide4" class="right-arrow" onclick="nextImage()">&#10095;</label>
                            <div class="slide"><img src="../Games/<?php echo $games["Game 3"]["title"]; ?>/Image.png" alt="Slide 3"></div>
                        </div>
                        <div class="slides">
                            <label for="slide3" class="left-arrow" onclick="prevImage()">&#10094;</label>
                            <label for="slide5" class="right-arrow" onclick="nextImage()">&#10095;</label>
                            <div class="slide"><img src="../Games/<?php echo $games["Game 4"]["title"]; ?>/Image.png" alt="Slide 4"></div>
                        </div>
                        <div class="slides">
                            <label for="slide4" class="left-arrow" onclick="prevImage()">&#10094;</label>
                            <label for="slide1" class="right-arrow" onclick="nextImage()">&#10095;</label>
                            <div class="slide"><img src="../Games/<?php echo $games["Game 5"]["title"]; ?>/Image.png" alt="Slide 5"></div>
                        </div>
                    </div>
                    <!------------------------------Right Wrapper---------------------------------->
                    <div class="right-inner-wrapper">
                        <div class="game-desc">
                            <div class="game-title"></div>
                            <div class="game-dev"></div>
                            <div class="game-genre"></div>
                        </div>
                        <div class="Link">
                            <div class="game-price"></div>
                            <a id="getGameLink" href="#" class="game-link">Get</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!------------------------------Section3---------------------------------->
        <section class="sec" id="section3">
            <div class="game-content-section">
                <div class="section-container">
                    <div class="DL-section">
                        <div class="Head-title">Top Downloaded Games</div>
                        <div class="container-content">
                            <?php for ($i = 0; $i < 3; $i++) {
                                $row = $DL_result->fetch_assoc();
                                if (isset($row['Game_Name'])) {
                                    $_name = $row['Game_Name'];
                                } else $_name = "No Data Found";
                            ?>
                                <a href="game_profile.php?id=<?php echo $row['Game_ID']; ?>" class="game-option">
                                    <div class="op-img-con">
                                        <img src="../Games/<?php echo $row['Game_Name']; ?>/background.png" alt="No Image Found">
                                    </div>
                                    <div class="op-title-con"><?php echo $_name; ?></div>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="RG-section">
                        <div class="Head-title">Most Rated Games</div>
                        <div class="container-content">
                            <?php for ($i = 0; $i < 3; $i++) {
                                $row = $RG_result->fetch_assoc();
                                if (isset($row['Game_Name'])) {
                                    $_name = $row['Game_Name'];
                                } else $_name = "No Data Found";
                            ?>
                                <a href="game_profile.php?id=<?php echo $row['Game_ID']; ?>" class="game-option">
                                    <div class="op-img-con">
                                        <img src="../Games/<?php echo $row['Game_Name']; ?>/background.png" alt="No Image Found">
                                    </div>
                                    <div class="op-title-con"><?php echo  $_name; ?></div>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!------------------------------Section4---------------------------------->
        <section class="sec" id="section4">
            <div class="content-4">
                <div class="top">
                    <div class="section-title">
                        <p>Games</p>
                    </div>
                    <div class="sort">
                        <div class="sort-contents">
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
                            <script>
                                document.getElementById('sort').addEventListener('change', function() {
                                    document.getElementById('filterForm').submit();
                                });
                            </script>
                        </div>
                    </div>
                </div>
                <div class="records">
                    <?php while ($row = $itemsResult->fetch_assoc()) : ?>
                        <div class="game-container">
                            <div class="game-img-con">
                                <img src="../Games/<?php echo $row['Game_Name']; ?>/Image.png">
                            </div>
                            <div class="game-desc-con">
                                <div class="top-desc">
                                    <p class="game-title-desc"><?php echo $row['Game_Name']; ?></p>
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
                                    <p class="game-price-desc">
                                        <?php if($row['Price'] > 0) {
                                            echo "$" . $row['Price']; 
                                        } else {
                                            echo "FREE"; 
                                        }
                                        ?>
                                    </p>
                                </div>
                                <div class="bottom-desc">
                                    <p class="game-developer-desc"><?php echo $row['Developer_Name']; ?></br></p>
                                    <p class="game-genre-desc"><?php echo $row['Category']; ?></p>
                                    <a href="game_profile.php?id=<?php echo $row['Game_ID']; ?>" class="game-link-desc">Get</a>
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
                    ?>#section4" class="pagination-button">&#10094;&#10094;</a>
                    <a href="?page=
                    <?php
                        echo $prev_Page;
                        echo isset($_GET['all']) ? '&all=true' : '';
                        echo isset($_GET['latest']) ? '&latest=1' : '';
                        echo isset($_GET['sort']) ? '&sort=' . $_GET['sort'] : '';
                    ?>#section4" class="pagination-button">&#10094;</a>

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
                                        ?> class="pagination-button"><?php echo $i; ?></a>
                    <?php endfor; ?>

                    <a href="?page=
                    <?php
                        echo $next_Page;
                        echo isset($_GET['all']) ? '&all=true' : '';
                        echo isset($_GET['latest']) ? '&latest=1' : '';
                        echo isset($_GET['sort']) ? '&sort=' . $_GET['sort'] : '';
                    ?>#section4" class="pagination-button">&#10095;</a>
                    <a href="?page=
                    <?php
                        echo $total_pages;
                        echo isset($_GET['all']) ? '&all=true' : '';
                        echo isset($_GET['latest']) ? '&latest=1' : '';
                        echo isset($_GET['sort']) ? '&sort=' . $_GET['sort'] : '';
                    ?>#section4" class="pagination-button">&#10095;&#10095;</a>
                </div>
            </div>
        </section>
        <!------------------------------Section5---------------------------------->
        <section class="sec" id="section5">
            <div class="filler"></div>
            <div class="game-dev-sec">
                <div class="game-dev-content">
                    <div class="dev-title">Game Developers</div>
                    <a href="../Main/Game_Devs.php">See More</a>
                </div>
                <div class="img-container">
                    <img src="../img/dev-bg.jpg" alt="">

                </div>
            </div>
            <?php
            include "../footer.php";
            ?>
        </section>

    </div>
</body>
</html>

<script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
    crossorigin="anonymous">
</script>
<script>
/*--------------------------------------- Games Sorter Button ---------------------------------------*/
    document.getElementById('sort').addEventListener('change', function() {
        document.getElementById('filterForm').submit();
    });


/*---------------------------------------Carousel Js and Auto Slider---------------------------------------*/
    var games = <?php echo json_encode(array_values($games)); ?>;
    var currentImageIndex = 0; // Initialize current image index

    // Function to display game details based on current image index
    function displayGameDetails() {
        var game = games[currentImageIndex]; // Get game details based on current index
        document.querySelector('.game-title').textContent = game.title;
        document.querySelector('.game-dev').textContent = game.developer;
        document.querySelector('.game-genre').textContent = game.genre;
        document.querySelector('.game-price').textContent = (game.price != 0) ? "$" + game.price : "FREE";

        // Update the "Get" link dynamically with the current game's ID
        var getGameLink = document.getElementById('getGameLink');
        getGameLink.href = "Game_Profile.php?id=" + game.id;
    }

    // Function to handle navigation to the next image
    function nextImage() {
        // Update current image index
        currentImageIndex = (currentImageIndex + 1) % games.length;
        // Update game details
        displayGameDetails();
        // Update slide display
        document.querySelectorAll('.slides').forEach(function(slide) {
            slide.style.display = 'none';
        });
        document.querySelectorAll('.slides')[currentImageIndex].style.display = 'block';
    }

    // Function to handle navigation to the previous image
    function prevImage() {
        // Update current image index
        currentImageIndex = (currentImageIndex - 1 + games.length) % games.length;
        // Update game details
        displayGameDetails();
        // Update slide display
        document.querySelectorAll('.slides').forEach(function(slide) {
            slide.style.display = 'none';
        });
        document.querySelectorAll('.slides')[currentImageIndex].style.display = 'block';
    }

    // Initial display of game details and slide
    displayGameDetails();
    document.querySelectorAll('.slides')[currentImageIndex].style.display = 'block';

    // Get all radio inputs
    var radios = document.querySelectorAll('input[type="radio"][name="slide"]');

    // Add change event listener to each radio input
    radios.forEach(function(radio) {
        radio.addEventListener('change', function() {
            // Update current image index
            currentImageIndex = Array.from(radios).indexOf(radio);
            // Update game details
            displayGameDetails();
        });
    });

    // Function to automatically change slide
    function autoChangeSlide() {
        var nextIndex = (currentImageIndex + 1) % radios.length;
        radios[nextIndex].checked = true; // Change the checked radio input
        // Update current image index
        currentImageIndex = nextIndex;
        // Update game details
        displayGameDetails();
        // Update slide display
        document.querySelectorAll('.slides').forEach(function(slide) {
            slide.style.display = 'none';
        });
        document.querySelectorAll('.slides')[currentImageIndex].style.display = 'block';
    }

    // Call autoChangeSlide() every 5 seconds (5000 milliseconds)
    setInterval(autoChangeSlide, 4000);

/*------------------------------Script for Anchor Points----------------------------------*/
    document.querySelectorAll('.anchor a').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    document.querySelectorAll('.anchor-link').forEach(anchor => {
        anchor.addEventListener('click', function() {
            document.querySelectorAll('.anchor-link').forEach(anchor => {
                anchor.classList.remove('clicked');
            });
            this.classList.add('clicked');
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('.anchor-link').classList.add('clicked');
    });
    document.querySelector('.page').addEventListener('scroll', function() {
        console.log("Scroll event triggered");
        let sections = document.querySelectorAll('.sec');
        let anchors = document.querySelectorAll('.anchor-link');

        sections.forEach((section, index) => {
            let rect = section.getBoundingClientRect();
            console.log(`Section ${index}:`, rect.top, rect.bottom);

            if (rect.top <= 200 && rect.bottom >= 200) {
                console.log(`Section ${index} is in view.`);
                anchors.forEach(anchor => {
                    anchor.classList.remove('clicked');
                    anchor.style.transform = '';
                });
                anchors[index].classList.add('clicked');
                anchors[index].style.transform = 'scale(1.5)';
            }
        });
    });
</script>