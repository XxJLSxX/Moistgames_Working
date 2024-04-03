<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  background-color: #00bf63;
  width: 160px; /* Adjusted width for Login button */
}

.signup-button {
  background-color: #ff9653;
  width: 160px; /* Adjusted width for Sign Up button */
}
    </style>
</head>
<body style="background-color: #1e1e1e">
    <div class="container">
        <form action="" method="post">
        <a href="index.php">
        <img src="images/logo.png" style="width: 50px; height: 50px;">
        </a>
        <p style="font-size: 25px; margin-top: 16px; margin-bottom: 29px">Sign In</p>
       <label for="email">Email:</label><br>
        <input type="email" name="" required><br><br>
        <label for="password">Password:</label><br>
        <input type="password" name="" required><br><br>
   
        <div class="flex-container">
          <input type="submit" class="login-button" value="Log In">
          <a href="sign_up.php" class="signup-button">Sign Up</a>
        </div>
    </form>
    </div>
</body>
</html>
