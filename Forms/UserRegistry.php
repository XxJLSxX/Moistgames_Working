<?php
    session_start();
    require '../db/MoistFunctions.php';

    //$connection = new mysqli('localhost', 'root', '', 'moisturegames');
    $moistFunctions = new MoistFunctions($connection);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $selectedPaymentMethodID = $_POST['payment_method'];

        $data = [
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'password' => $password,
        ];

        try {
            $action = $moistFunctions->UserRegistry($data, $selectedPaymentMethodID, 'Users');
            header("Location: ");
        } catch (Exception $e) {
            echo "Error: $e";
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="db/design.css">

    <!-- jS -->
    <script src="bootstrap/js/bootstrap.js"></script>
    
</head>
<body>
    <h1>User Registration</h1>
    <form method="POST" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <label for="payment_method">Payment Method:</label>
        <select id="payment_method" name="payment_method" required>
            <option value="" disabled selected>Select Payment Method</option>
            <option value="1">Card Payment</option>
            <option value="2">E-Wallet Payment</option>
        </select><br><br>
        
        <input type="submit" value="Register">
    </form>
</body>
</html>
