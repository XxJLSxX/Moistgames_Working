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
    <link rel="stylesheet" href="../css/about_contact_css.css?+1">
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <title>About Us - Moisture Games</title>
</head>
<body style="background-color: #1e1e1e">
<!-------------------------------------------------------- Contact Popup -------------------------------------------------------->
    <div class="modal fade" id="Contact-Form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="min-width: 600px;">
            <div class="modal-content" style="background-color: #5d5d5d; border-radius: 10px;">
                <div class="modal-body" style="background-color: #5d5d5d;">
                    <div class="Contact-Container">

                        <form action="../phpmailer/Mail_Contact.php" method="post">
                            <a href="index.php">
                            <img src="../img/logo.png" style="width: 150px; aspect-ratio: 2 / 1;">
                            </a>
                            <p style="font-size: 25px; margin-top: 16px; margin-bottom: 29px">Contact Us</p>
                            
                            <label for="name">Name:</label><br>
                            <input type="text" name="name" placeholder="Name" required><br><br>
                            
                            <label for="email">Email:</label><br>
                            <input type="email" name="email" placeholder="Email" required><br><br>
                            
                            <label for="subject-line">Subject:</label><br>
                            <input type="text" name="subject" placeholder="Title" tabindex="4" required><br><br>
                            
                            <label for="concern">Concern:</label><br>
                            <textarea name="message" placeholder="Type your Message Details Here..." tabindex="5" required></textarea>
                            
                            <input type="submit" name="send" class="submit-button" id="contact-submit"><br>
                            <button type="button" class="submit-button" data-bs-dismiss="modal">Cancel</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

<center>
<div class="limiter">
    <?php include '../header.php' ?>
    <h1 style="text-align: center; color: white; margin-top: 5%; font-weight: bold;">About Us</h1>
    <div class="About_Us-container1">
        <p>&emsp;Welcome to <strong>Moisture Games</strong>, your ultimate destination for thrilling adventures in the virtual realm! Established with a passion for gaming and a commitment to delivering top-notch entertainment, <strong>Moisture Games</strong> brings together a diverse collection of digital delights for players of all ages and preferences.
        At <strong>Moisture Games</strong>, we understand that gaming is more than just a hobby; it's a vibrant community where friendships are forged, skills are honed, and unforgettable experiences are made. With this ethos at our core, we strive to provide an unparalleled gaming experience that captivates, challenges, and inspires. <br><br>
        &emsp;Our meticulously curated selection features an extensive array of titles spanning various genres, from pulse-pounding action and immersive role-playing epics to mind-bending puzzles and heartwarming indie gems. Whether you're a seasoned veteran seeking the next big adventure or a casual gamer looking for some lighthearted fun, <strong>Moisture Games</strong> has something for everyone.
        But we're not just about offering great games; we're also dedicated to fostering a welcoming and inclusive community where gamers can connect, share, and celebrate their love for gaming. Our team is comprised of passionate gamers who eat, sleep, and breathe everything gaming, and we're here to support you every step of the way.<br><br>
        &emsp;So, dive into the world of <strong>Moisture Games</strong> and let your imagination run wild. Join us as we embark on epic quests, unravel thrilling mysteries, and create memories that will last a lifetime. Together, let's unleash the power of play and make every gaming moment truly unforgettable. Welcome to Moisture Games—where the adventure never ends!
        </p>
    </div>

    <div class="About_Us-container2">
        <p>&emsp;Have a question, suggestion, or just want to say hello? We'd love to hear from you! Our "Contact Us" button is your direct line to the Moisture Games team. Whether you need assistance with your gaming experience, want to inquire about our products, or have any other inquiries, we're here to help.
        Simply click the "Contact Us" button and fill out the form with your message. Our dedicated support team will promptly get back to you to provide assistance and ensure that your experience with Moisture Games is nothing short of exceptional.<br>
        Your feedback is invaluable to us, as we constantly strive to improve and tailor our services to meet your needs. So don't hesitate to reach out—your next gaming adventure awaits, and we're here to make it unforgettable.
        </p>
        <center><a href="#"><button type="button" data-bs-toggle="modal" data-bs-target="#Contact-Form">Contact Us</button></a></center>
    </div>
</div>  
</center>  
</body>
</html>
<script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
    crossorigin="anonymous">
</script>