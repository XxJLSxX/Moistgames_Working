<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin_css.css">
    <link rel="stylesheet" href="../css/header_css.css">
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous">
    <title>About Us</title>
</head>
<body style="background-color: #1e1e1e;">  
  </nav>
    <?php include '../header.php'?>

        <div class="container" style="padding: 4%; background-color: rgba(0, 0, 0, 0);">
            <div style="margin: -40px 6% 0 6%; display: flex; align-items: center;">
                <img src="../images/developer_icon.png" style="height: 125px; width: 125px; border-radius: 25px; object-fit: cover;">
                <div style="margin-left: 20px;">
                    <h1 style="font-weight: bold;">Arrowhead Game Studios</h1>
                    <p>Email: arrowhead@gmail.com</p>
                    <p>Location: Hammarby Sjöstad, Stockholm, Sweden</p>
                </div>
            </div> 
        </div>

        <div class="container" style="padding: 0 4% 0 4%;background-color: rgba(0, 0, 0, 0);">
        <div style="margin: -40px 6% 0 6%; display: flex; align-items: center;">
            <a href="user_devgames.php" class="user-dev">Games</a>
            <a href="#" class="active user-dev">About</a>
        </div>
        <div style="margin: 2.5% 6% 0 6%; display: flex; align-items: center;">
        <p style="font-size: 18px; text-align: justify;"><span class="tab"></span>
            Arrowhead Game Studios, headquartered in Stockholm, Sweden, is a celebrated independent game development company renowned for its inventive and immersive gaming ventures. 
            Since its establishment in 2009, the studio has consistently delivered captivating titles across multiple platforms, including PC, consoles, and mobile devices. Notably recognized for its distinctive blend of humor, 
            cooperative gameplay dynamics, and vibrant artistry, Arrowhead's creations foster engaging player experiences. Their repertoire includes standout successes like "Helldivers," a satirical top-down shooter emphasizing 
            teamwork and comedic military tropes, and "Magicka," an action-adventure game renowned for its spellcasting chaos and humor. Driven by a commitment to innovation and excellence, Arrowhead Game Studios continues to captivate 
            audiences worldwide with its unparalleled creativity and dedication to crafting exceptional gaming adventures.
            </p>
        </div>
        </div>
</body>
</html>
