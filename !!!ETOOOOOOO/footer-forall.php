<?php 
echo"
<div class='footer'>
<div class='links'>
    <div class='web-link'>
        <h3>Website Links</h3>
        <a href=''>Store</a>
        <a href=''>About Us</a>
        <a href=''>Game Developers</a>
    </div>
";
if (isset($_SESSION['User'])) {
    echo "
    <div class='user-link'>
    <h3>User Links</h3>
    <a href=''>Library</a>
    <a href=''>Purchase History</a>
    <a href=''>Profile</a>
</div>
    ";
}
echo "
</div>
    <div class='rights'>© 2024 Moisture Games. All rights reserved.</div>
</div>
";
?>

    
