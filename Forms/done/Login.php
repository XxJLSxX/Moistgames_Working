<?php
    session_start();
    require '../db/MoistFunctions.php';

    if (isset($_SESSION['id']) && $_SESSION['id'] == '1') {
        header('Location: ../Admin.php');
        exit();
    }
    if (isset($_SESSION['id']) && $_SESSION['id'] > '1'){
        header('../Main.php');
    }
    
    $moistFunctions = new MoistFunctions($connection);

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $data = $moistFunctions -> showRecords('Users', "email = '$email'") ;
        if (count($data) > 0) {
            if ($data[0][0] == '1'){
                if (password_verify($password, $data[0][4])) {
                    $_SESSION['id'] = $data[0][0];
                    header("Location: Admin_Gamelibrary.php");
                }else{
                    echo "Incorrect Username or Password";
                }
            }
            else if (password_verify($password, $data[0][4])) {
                $_SESSION['id'] = $data[0][0];
                header("Location: ../moisturegames/user/index.php");
            }else{
                echo "Incorrect Username or Password";
            }
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index_css.css">
    <link rel="stylesheet" href="../css/header_css.css">
    <link rel="stylesheet" href="../css/footer_css.css?+1">
    <link rel="stylesheet" href="../css/footer_css-forall.css?+1">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <title>Sign In</title>
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
            margin: 125px;
            margin-left: auto; 
            margin-right: auto;
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

        .login-button, .signup-button {
            font-weight: bold;
            border-radius: 25px;
            padding: 7.9px 20px;
            font-size: 16px;
            text-decoration: none;
            color: white;
            margin-left: 16.5px;
            margin-right: 16.5px;
        }

        .login-button {
            width: 160px; /* Adjusted width for Login button */
        }

        .signup-button {
            background-color: #ff9653;
            width: 160px; /* Adjusted width for Sign Up button */
            text-decoration: none;
        }
        .signup-button:hover {
            background-color: #ff7c00; /* Slightly darker shade of button color */
            color: white;
            text-decoration: none; /* Remove underline */
        }
    </style>
</head>

<body style="background-color: #1e1e1e">
<?php include '../header.php';?>
    <div class="container">
        <form action="" method="post">
            <a href="../Main/index.php">
                <img src="../img/logo.png" style="aspect-ratio: 2 / 1; width: 300px;">
            </a>
            <p style="font-size: 25px; margin-top: 16px; margin-bottom: 29px">Sign In</p>
            <label for="email">Email:</label><br>
                <input type="email" name="email" placeholder="Email" required><br><br>
            <label for="password">Password:</label><br>
                <input type="password" name="password" placeholder="Password"><br><br>
            <div class="flex-container">
                <input type="submit" class="login-button button btn btn-success" name="login" value="Log In">
                <a href="UserRegistry.php" class="signup-button">Sign Up</a>
            </div>
        </form>
    </div>
</body>
</html>