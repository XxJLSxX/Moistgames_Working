<?php
require '../Database/MoistFunctions.php';

$tite = $_GET['tite'];
$moistFunctions = new MoistFunctions($connection);

$id = $tite;
$datas = $moistFunctions->showRecords('games', null, 'developer', 'games.Developer_ID', 'developer.Developer_ID', "games.Game_ID='$id'");
$devs = $moistFunctions -> showRecords('developer');


foreach ($datas as $data){
echo "
            <a href='index.php' class='edit-logo'>
                <img src='../img/logo.png'>
            </a>
            <p class='edit-title'>Edit Game</p>
            <form action='' method='post' enctype='multipart/form-data'>
                <label class='edit-form-label' for='name'>Game Name</label><br>
                <input class='edit-form-input' type='text' name='Game_Name' value='$data[1]' >";

            echo "<label class='edit-form-label' for='developer'>Game Developer</label><br>
                <select class='edit-form-select' name='Developer_ID' id='edit-select' onmousedown='this.size=5;' onclick='this.size=1' >";
                    echo "<option value='' disabled selected>$data[9]</option>";
                    if (count($devs) > 0) {
                        foreach ($devs as $dev) {
                            echo "<option value ='$dev[0]'>$dev[1]</option>";
                        }
                    }
            echo"</select>";

            echo"<label class='edit-form-label' for='price'>Game Price</label>
                <input class='edit-form-input' type='float' name='Price' value='$data[4]' >

                <label class='edit-form-label' for='genre'>Game Genre</label><br>
                <select class='edit-form-select' name='Category'  onmousedown='this.size=5;' onclick='this.size=1' >
                    <!-- <option value='' disabled selected> $data[5] </option> -->
                    <option value='1'> Action</option>
                    <option value='2'> Adventure</option>
                    <option value='3'> RPG</option>
                    <option value='4'> Simulation</option>
                    <option value='5'> Strategy </option>
                </select>";

            echo"<label class='edit-form-label' for='game_image'>Game Image</label>
                <label class='edit-form-label-upload' for='inputFile'>Upload Image Here</label>
                <input type='file' id='inputFile' class='file-upload' value='Wala' name='GameImage' placeholder='Upload' accept='image/png, image/jpeg' >

                <label class='edit-form-label' for='game_image'>Game Background</label>
                <label class='edit-form-label-upload' for='inputFile2'>Upload Image Here</label>
                <input type='file' id='inputFile2' class='file-upload' name='GameBackground' placeholder='Upload' accept='image/png, image/jpeg' >

                <label class='edit-form-label' for='game_image'>Game Screenshots</label>
                <label class='edit-form-label-upload' for='inputFile3'>Upload Image Here</label>
                <input type='file' id='inputFile3' class='file-upload' name='Screenshot1' style='margin-bottom: 15px;' placeholder='Upload Screenshot 1' accept='image/png, image/jpeg' >
                
                <label class='edit-form-label-upload' for='inputFile4'>Upload Image Here</label>
                <input type='file' id='inputFile4' class='file-upload' name='Screenshot2' style='margin-bottom: 15px;' placeholder='Upload Screenshot 2' accept='image/png, image/jpeg' >
                
                <label class='edit-form-label-upload' for='inputFile5'>Upload Image Here</label>
                <input type='file' id='inputFile5' class='file-upload' name='Screenshot3' placeholder='Upload Screenshot 3' accept='image/png, image/jpeg' >
                <br>

                <label class='edit-form-label' for='game_desc'>Game Description</label>
                <textarea class='edit-form-textarea' name='Game_Desc' rows='4' placeholder='Write description here...' >$data[2]</textarea><br><br>

                <input type='hidden' value = $data[0] name = 'u_id'>
                <input class='edit-form-submit' type='submit' name='Edit'><br>
            </form>
                <button onclick=' window.location.reload()' class='edit-cancel'>Cancel</button>";
}
// You can perform other operations with $phpVariable here
?>
