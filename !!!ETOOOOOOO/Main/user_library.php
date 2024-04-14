<?php
    session_start();
    require '../Database/MoistFunctions.php';

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
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/user_library_css.css">
    <link rel="stylesheet" href="../css/index_css.css">
    <link rel="stylesheet" href="../css/header_css.css">
    <link rel="stylesheet" href="../css/footer_css-forall.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <title>Document</title>
</head>

<body>
    <?php
    include "../header.php";
    ?>
    <section id="section">
        <div class="game-library-container">
            <div class="library-header">
                <div class="library-title">
                    <p>Game Library</p>
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
                        <script>
                            document.getElementById('sort').addEventListener('change', function() {
                                document.getElementById('filterForm').submit();
                            });
                        </script>
                    </div>
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
                                <p class="game-price-desc">$<?php echo $row['Price']; ?></p>
                            </div>
                            <div class="game-info-section">
                                <p class="game-developer"><?php echo $row['Developer_Name']; ?></br></p>
                                <p class="game-genre"><?php echo $row['Category']; ?></p>
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