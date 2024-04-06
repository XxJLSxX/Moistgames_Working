<?php
session_start();

// Check if the user is already logged in as admin or user
if (isset($_SESSION['Admin']) && $_SESSION['Admin'] === true) {
    header("Location: admin/"); 
    exit();
}

if (isset($_SESSION['User']) && $_SESSION['User'] === true) {
    header("Location: user/"); 
    exit();
} 

require 'db/MoistFunctions.php';

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
        $moistFunctions = new MoistFunctions($connection);
        $action = $moistFunctions->UserRegistry($data, $selectedPaymentMethodID, 'Users');
        header("Location: sign_in.php");
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <title>Sign Up</title>
    <style>
        body{
            font-family: 'Montserrat', sans-serif;
            justify-content: center;
        }
        p{
            font-weight: bold;
            color: white;
            font-size: 16px;
        }
        .container{
            text-align: center; 
            background-color: #5d5d5d;
            border-radius: 25px;
            padding: 2%;
            width: 500px;
            margin: 30px auto;
        }

        label{
            margin-left: 16.5px;
            color: white;
            font-size: 15px;
            font-weight: lighter;
            float: left; /* Align text to the left */
        }
        input{
            border-radius: 16.5px;
            width: 420px;
            padding: 7.5px;
        }

        /* Added CSS for flex container and buttons */
        .flex-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        input[type="submit"]:hover{
            color: rgba(255, 0, 174, 1);
            background-color: rgba(255, 255, 255, 1);
        }

        .signup-button {
            font-weight: bold;
            border-radius: 25px;
            padding: 7.9px 20px;
            font-size: 16px;
            text-decoration: none;
            color: white;
            margin-left: 16.5px;
            margin-right: 16.5px;
            background-color: rgba(255, 0, 174, 1);
            width: 200px; /* Adjusted width for Sign Up button */
        }
    </style>
</head>
<body style="background-color: #1e1e1e">
    <div class="container">
        <form action="" method="post">
            <a href="index.php">
                <img src="images/logo.png" style="aspect-ratio: 1/1; width: 100px; ">
            </a>
            <p style="font-size: 25px; margin-top: 16px; margin-bottom: 29px">Sign Up</p>
            
            <label for="name">Name:</label><br>
            <input type="text" name="name" placeholder="Full Name" class="form-control" required><br>

            <label for="username">Username:</label><br>
            <input type="text" name="username" placeholder="Username" class="form-control" required><br>

            <label for="email">Email:</label><br>
            <input type="email" name="email" placeholder="Email Address" class="form-control" required><br>

            <label for="password">Password:</label><br>
            <input type="password" name="password" placeholder="Create Password" class="form-control" required><br>

            <label for="confirm_password">Confirm Password:</label><br>
            <input type="password" name="confirm_password" placeholder="Retype Password" class="form-control" required><br>

            <label for="payment_method">Payment Method:</label>
            <select name="payment_method" class="form-control" required>
                <option value="" disabled selected>Select Payment Method</option>
                <option value="1">Card Payment</option>
                <option value="2">E-Wallet Payment</option>
            </select><br>

            <input type="submit" class="signup-button" value="Sign up"><br>
            <p style="font-weight: lighter; margin-top: 15px;">Already have an account? <a href="sign_in.php">Sign In</a></p>
        </form>
    </div>
</body>
</html>
