<?php
    session_start();
    if (isset($_SESSION['Admin']) && $_SESSION['Admin'] === true) {
        header("Location: admin/"); 
        exit();
    }

    if (isset($_SESSION['User']) && $_SESSION['User'] === true) {
        header("Location: user/"); 
        exit();
    } 

    require 'db/MoistFunctions.php';

    class LoginHandler {
        private $connection;
        
        public function __construct($connection) {
            $this->connection = $connection;
        }
        
        public function handleLogin() {
            if(isset($_POST['login'])) { // Changed to 'login' to match the form input name
                $email = $_POST['email'];
                $password = $_POST['password'];
                
                $moistFunctions = new MoistFunctions($this->connection);
                
                $data = $moistFunctions->showRecords('users', "email='$email'");
                if($email == "admin@moist.com" && password_verify($password,$data[0][4])) {
                    $_SESSION['Admin'] = true;
                    header("Location: admin/");
                    exit();
                } else if(count($data) > 0) {
                    if(password_verify($password,$data[0][4])){
                        $_SESSION['User'] = true;
                        $_SESSION['name'] = strtoupper($data[0][2]);
                        header("Location: user/");
                        exit();
                    } else {
                        $this->redirectWithError('Incorrect Username or Password');
                    }
                } else {
                    $this->redirectWithError('Incorrect Username or Password');
                }
            }
        }
        
        private function redirectWithError($errorMessage) {
            echo "<script type='text/javascript'>alert('$errorMessage'); window.location.href='';</script>";
            exit();
        }
    }

    $loginHandler = new LoginHandler($connection);
    $loginHandler->handleLogin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <title>Sign In</title>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #1e1e1e;
        }
        .container {
            text-align: center;
            background-color: #5d5d5d;
            border-radius: 25px;
            padding: 2%;
            width: 500px;
            margin: 125px auto;
        }
        label {
            color: white;
            font-size: 15px;
            font-weight: lighter;
            float: left;
        }
        input {
            border-radius: 16.5px;
            width: 420px;
            padding: 7.5px;
        }
        .flex-container {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }
        .flex-container a {
            text-decoration: none;
        }
        input[type="submit"]:hover, .flex-container a:hover {
            color: rgba(255, 0, 174, 1);
            background-color: rgba(255, 255, 255, 1);
        }
        .login-button, .signup-button {
            font-weight: bold;
            border-radius: 25px;
            padding: 10px 20px;
            font-size: 16px;
            text-decoration: none;
            color: white;
        }
        .login-button,
        .signup-button {
            background-color: rgba(255, 0, 174, 1);
            width: 200px;
        }
        .signup-button {
            margin-left: 16.5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <a href="index.php">
                <img src="images/logo.png" style="aspect-ratio: 1/1; width: 150px;">
            </a>
            <p style="font-size: 25px; margin-top: 16px; margin-bottom: 29px;">Sign In</p>
            
            <label for="email">Email:</label><br>
            <input type="email" name="email" placeholder="Email Address" class="form-control" required><br>
            
            <label for="password">Password:</label><br>
            <input type="password" name="password" placeholder="Password" class="form-control" required><br>
       
            <div class="flex-container">
                <input type="submit" class="login-button" name="login" value="Login">
                <a href="sign_up.php" class="signup-button">Sign Up</a>
            </div>
        </form>
    </div>
</body>
</html>
