<?php
    require '../Database/MoistFunctions.php';
    $moistFunctions = new MoistFunctions($connection);
    
    $devs = $moistFunctions -> showRecords('developer');
    if (isset($_POST['Add'])){
        $data = [];
        $nodup = 1;
        $dname= $_POST['Developer_Name'];
        foreach ($_POST as $name => $val) {
            if ($name !== 'Add' && $name !== 'DeveloperImage') {
                $data[$name] = $val;
            }
        }
        
        for ($i = 0; $i < count($devs); $i++) {
            $cmp1 = (strtolower($devs[$i][1]));
            $cmp2 = (strtolower($data['Developer_Name']));
            if ($cmp1 == $cmp2) $nodup = 0;
        }
        
        if ($nodup == 1){
            try {
                $action = $moistFunctions->addQuery($data, 'developer');
                    //Create Folder
                $folderPath = "../Developer/$dname";
                if (!is_dir($folderPath)) {
                    //Create if existing
                    mkdir($folderPath,0777);
                }else {
                    echo"Developer Already Exists";
                    die();
                }
                $target_dir = "../Developer/$dname/";
                
                $moistFunctions -> uploadFile($_FILES["DeveloperImage"], $target_dir, $dname . ".png");
            } catch (Exception $e) {
                echo "Error: $e";
                die();
            } 
        } else {
            echo "Developer Already Exists!";
            die();
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
    <title>Add Developer</title>
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
        margin: 40px;
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
    textarea {
    border-radius: 7.5px;
    padding: 8.5px;
    width: 416px; /* Adjust the width as needed */
    height: 150px; /* Adjust the height as needed */
}
.submit-button {
  font-weight: bold;
  background-color: #ababab;
  border: none;
  border-radius: 25px;
  color: black;
  font-size: 16px;
  padding: 10px 20px;
  text-decoration: none;
  width: 170px; /* Adjusted width */
  display: block;
  margin-top: 7.5px;
  margin-left: auto; /* Aligns the button to the right */
  margin-right: auto;
  }
    </style>
</head>
<body style="background-color: #1e1e1e">
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <p style="font-size: 25px; margin-top: 16px; margin-bottom: 29px">Add Developer<br><img src="images/default-icon.png" style="margin-top: 14px; width: 150px; height: 150px;"></p>
            <label for="name">Developer Name</label><br>
            <input type="text" name="Developer_Name" required><br><br>
            <label for="developer_image">Developer Image</label>
            <input type="file" id="inputFile" class="file-upload" name="DeveloperImage" placeholder="Upload" accept="image/png, image/jpeg" required><br>
            <label for="email">Email</label><br>
            <input type="email" name="Developer_Email" required><br><br>
            <label for="address">Address</label><br>
            <input type="text" name="Developer_Address" required><br><br>
            <label for="about_desc">About Description:</label><br>
            <textarea name="Developer_Desc" rows="4" required></textarea><br><br>
            <input type="submit" name="Add" class="submit-button"><br>
            <a href="" style="margin-top: 10px; color: white;">Cancel</a>
        </form>
    </div>
</body>
</html>