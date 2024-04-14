<?php
require 'Database/MoistFunctions.php';
if (isset($_POST['name'])) {
    $name = $_POST['name'];

    $sql = "SELECT * FROM games WHERE (name LIKE '%$name%' OR game_developer LIKE '%$name%') ORDER BY name ASC, game_developer DESC LIMIT 5";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = $query->fetch_assoc()) {
            
            echo '<a href="game_profile.php?id='.$row['id'].'">';
            echo '<div class="search-container">';
            echo '<div class="search-img-con">';
            echo '<img src="../records/game_' . $row['id'] . '/cover.png" alt="">';
            echo '</div>';
            echo '<div class="search-desc">';
            echo '<h5>' . $row['name'] . '</h5>';
            echo '<p>' . $row['game_developer'] . '</p>';
            echo '</div>';
            echo '</div>';
            echo '</a>';
        }
    }
}
?>