<?php
    require '../Database/MoistFunctions.php';
    $moistFunctions = new MoistFunctions($connection);
    $id =$_GET["id"] ?? NULL;
    
    if($id==NULL)
        header("Location: ../Admin/");

    $devs = $moistFunctions -> showRecords('developer');
    $data = $moistFunctions -> showRecords('developer', "Developer_ID = $id");
    if (isset($_POST['Edit'])){
        $datas = [];
        $nodup = 1;
        $dname= $_POST['Developer_Name'];
        foreach ($_POST as $name => $val) {
            if ($name !== 'Edit' && $name !== 'DeveloperImage') {
                $datas[$name] = $val;
            }
        }
        
        for ($i = 0; $i < count($devs); $i++) {
            $cmp1 = (strtolower($devs[$i][1]));
            $cmp2 = (strtolower($data['Developer_Name']));
            if ($cmp1 == $cmp2) $nodup = 0;
        }
        
        if ($nodup == 1){
            try {
                $action = $moistFunctions->updateQuery($datas, 'developer', ['Developer_ID' => $id]);
                    //Create Folder
                $new_folderPath = "../Developer/$dname";
                $folderPath = "../Developer/".$data[0][1];
                if (is_dir($folderPath)) {
                    if (strcmp($dname,$data[0][1]) != 0){
                        rename($folderPath, $new_folderPath);
                    }
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
            <p style="font-size: 25px; margin-top: 16px; margin-bottom: 29px">Edit Developer<br><img src="images/default-icon.png" style="margin-top: 14px; width: 150px; height: 150px;"></p>
            <label for="name">Developer Name</label><br>
            <input type="text" value="<?=$data[0][1]?>" name="Developer_Name" required><br><br>
            <label for="developer_image">Developer Image</label>
            <input type="file" id="inputFile" class="file-upload" name="DeveloperImage" placeholder="Upload" accept="image/png, image/jpeg" required><br>
            <label for="email">Email</label><br>
            <input type="email" value="<?=$data[0][2]?>" name="Developer_Email" required><br><br>
            <label for="address">Address</label><br>
            <input type="text" value="<?=$data[0][3]?>" name="Developer_Address" required><br><br>
            <label for="about_desc">About Description:</label><br>
            <textarea name="Developer_Desc" value="" rows="4" required><?=$data[0][4]?></textarea><br><br>
            <input type="submit" name="Edit" class="submit-button"><br>
            <a href="" style="margin-top: 10px; color: white;">Cancel</a>
        </form>
    </div>
</body>
</html>