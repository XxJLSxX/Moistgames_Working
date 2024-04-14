<?php
    require '../Database/MoistFunctions.php';

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
            header("Location: index.php");
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
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">

    <!-- jS -->
    <script src="bootstrap/js/bootstrap.js"></script>
</head>
<body class = "container mt-5" style=" width: 50%;">
    <h1>User Registration</h1>
    <form method="POST" action="">
    <div class = "mb-3">
        <label class = "form-label">Name:</label>
        <input type="text" name="name"placeholder="Full Name" class="form-control" required>
    </div>    

    <div class = "mb-3">    
        <label class = "form-label">Username:</label>
        <input type="text" name="username" placeholder="User Name" class="form-control" required>
    </div>

    <!--Lagyan din ng format restriction/ and verification-->
    <div class = "mb-3">
        <label class = "form-label">Email:</label>
        <input type="email" name="email" placeholder="Email Address" class="form-control" required>
    </div>

    <!--Lagyan re-type password-->
    <div class = "mb-3">
        <label class = "form-label">Password:</label>
        <input type="password" name="password" placeholder="Password" class="form-control" required>
    </div>

    <div class = "mb-3">
        <label class = "form-label">Payment Method:</label>
        <select name="payment_method" class="form-control" required>
            <option value="" disabled selected>Select Payment Method</option>
            <option value="1">Card Payment</option>
            <option value="2">E-Wallet Payment</option>
        </select>
    </div>  
        <input type="submit" value="SIGN UP">
        <a href="Login.php">SIGN IN</a>
    </form>
</body>
</html>