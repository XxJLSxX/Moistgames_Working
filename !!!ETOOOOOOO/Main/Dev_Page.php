<?php
    session_start();
    require '../Database/MoistFunctions.php';

    $id = $_GET["id"] ?? NULL;

    $moistFunction = new MoistFunctions($connection);
    $moistFunctions = new MoistFunctions($connection);

    $devData = $moistFunctions -> showRecords('developer', "Developer_ID = '$id'");
    $gameData = $moistFunctions -> showRecords('games', "Developer_ID = '$id'");
    $DL_result = $moistFunction->queryRandomByLimitOrderBy("games", 3, "Game_Name");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/header_css.css">
    <link rel="stylesheet" href="../css/admin_css.css?+1">
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous">
    <title><?php echo ""; ?></title>

    <style>

.dev-pagecontainer {
    display: flex;
    flex-direction: column;
    background-color: #1e1e1e; 
    color: white; 
    width: 100%;
    padding: 20px;
    box-sizing: border-box;
}
.dev-gamecontainer {
    margin-top: 20px;
    padding: 10px;
    display: flex;
    max-height: 300px;
    text-align: center;
}

.dev-pagecontainer-games {
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    display: grid;
    flex-direction: column;
    grid-template-columns: 4 1fr;
    aspect-ratio: 16 / 9;
    margin-left: auto;
    margin-right: auto;
}

.devbanner-container {
    position: relative;
    display: inline-block;
    margin-top: 55px;
    height: 200px;
    width: 100%;
    margin-bottom: 20px;
}

.devbanner-container::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to left, 
        rgba(150, 150, 150, 0), 
        rgba(59, 59, 59, 0), 
        rgba(23, 23, 23, 0.1), 
        #101010, 
        #101010, 
        #101010) left,
    linear-gradient(to right, 
        rgba(150, 150, 150, 0), 
        rgba(59, 59, 59, 0), 
        rgba(23, 23, 23, 0.1), 
        #101010, 
        #101010, 
        #101010) right;
    background-size: 50% 100%; /* Adjust as needed */
    background-repeat: no-repeat;
}
.devbanner-container img {
    display: block;
    width: 100%;
    height: 200px;
    object-fit: cover;
}
.user-dev{
    text-decoration: none;
    border-radius: 25px;
    padding: 10px 29px;
    color: white;
    font-size: 19px;
    background-color: #5d5d5d; 
    margin: 0;  
}
.user-dev.active,
.user-dev:hover {
    text-decoration: none;
    color: white;
    background-color: #ababab; 
}
.edit-dev-btn{
    background-color: #f1bc36;
    border-radius: 25px;
    padding: 7px 16px;
    float: right;
    color: black;
    font-size: 16px;
}

.devGames {
    all: unset;
}

.dev_pageDisplayIMG{
    aspect-ratio: 16 / 9;
    width: 400px;
}
.devGames_container {
    text-align: center;
    flex-grow: 1;
    display: flex;
    flex-direction: row;
    max-height: 300px;
    margin-left: 10px;
    margin-right: 10px;
}
.devPage_gameTitle {
    color: white;
    text-align: center;
}
.devPage_Description {
    color: white;
    text-align: justify;
}
    </style>

</head>

<body style="background-color: #1e1e1e; 
    font-family: 'Montserrat', sans-serif;">
<?php include '../header.php'; ?> 


     <div class="devbanner-container">
        <img src="../Developer/<?php echo $devData[0][1]; ?>/<?php echo $devData[0][1]; ?>Background.png" alt="Banner Image">
    </div>

    <div class="dev-pagecontainer">
        <div style="margin: 10px 15% 0 15%; display: flex; align-items: center;">
            <img src="../Developer/<?php echo $devData[0][1]; ?>/<?php echo $devData[0][1]; ?>Image.png" style="aspect-ratio: 1 / 1; width: 125px; border-radius: 25px; object-fit: cover;">
            <div style="margin-left: 20px;">
                <h1 style="font-weight: bold;"><?php echo $devData[0][1] ; ?></h1>
                <p class="margin: 10px;"><strong>Email:</strong> <?php echo $devData[0][2]; ?></p>
                <p class="margin: 10px;"><strong>Location:</strong> <?php echo $devData[0][3] ?></p>
            </div>
            <form style="margin-left: auto;">
                <button type="button" class="edit-dev-btn">Edit Developer</button>
            </form>
        </div> 
    </div>

    <div class="dev-pagecontainer" id="selection">
        <div style="margin: -25px 15% 0 15%; display: flex; align-items: center;">
            <button class="user-dev active" onclick="Dev_Call('Games')">Games</button>
            <button class="user-dev" onclick="Dev_Call('About')">About</button>
        </div>
    </div>

    <center>
    <div class="dev-gamecontainer tab" id="About" style="display: none; max-width: 70%;">
        <h4 class="devPage_Description">&nbsp;<?php echo $devData[0][4]; ?></h4>
    </div>
    </center>

    

    <div class="dev-gamecontainer tab" id="Games">
        <div class="dev-pagecontainer-games">
            <?php $gamesPage = 0; if(count($gameData) > 0) : ?>
                    <?php for ($i = 0; $i < 3; $i++) {
                        $row = $DL_result->fetch_assoc();
                        if (isset($row['Game_Name'])) {
                            $_name = $row['Game_Name'];
                        } else $_name = "No Data Found";
                    ?>
                        <div class="devGames_container">
                            <a class="devGames" href="../Main/Game_Profile.php?id=<?php echo $row['Game_ID']; ?>" class="game-option">
                                <div class="op-img-con">
                                    <img class="dev_pageDisplayIMG" src="../Games/<?php echo $row['Game_Name']; ?>/Image.png" alt="No Image Found">
                                </div>
                                <h4 class="devPage_gameTitle"><?php echo $_name ?></h4>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            <?php endif; ?>
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
    function Dev_Call(tabName) {
    var i;
    var x = document.getElementsByClassName("tab");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";  
    }
    document.getElementById(tabName).style.display = "flex";  
    }

    var header = document.getElementById("selection");
    var btns = header.getElementsByClassName("user-dev");
    for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", function() {
        var current = document.getElementsByClassName("active");
        current[0].className = current[0].className.replace(" active", "");
        this.className += " active";
    });
    }
</script>

