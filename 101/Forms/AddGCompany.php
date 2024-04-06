<?php
require '../db/MoistFunctions.php';

$connection = new mysqli('localhost', 'root', '', 'moisturegames');
$moistFunctions = new MoistFunctions($connection);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [];
    foreach ($_POST as $name => $val) {
        if ($name !== 'Add') {
            $data[$name] = $val;
        }
    }

    try {
        $action = $moistFunctions->addQuery($data, 'company');
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
    <title>Add Game Company</title>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../../bootstrap/css/bootstrap.css">

    <!-- jS -->
    <script src="bootstrap/js/bootstrap.js"></script>
</head>

<body class = "container mt-5" style=" width: 50%;">
    <h2>Add Game Company</h2>
    <form action = "" method = "post">
        <div class = "mb-3">
            <label class = "form-label">Name</label>
            <input type="text" name="Company_Name" placeholder="Company Name" class="form-control" required>
        </div>
        <div class = "mb-3">
            <label class = "form-label">EMail</label>
            <input type="email" name="Company_Email" placeholder="Company Email" class="form-control" required>
        </div>
        <div class = "mb-3">
            <label class = "form-label">Address</label>
            <input type="text" name="Company_Address" placeholder="Company Address" class="form-control" required>
        </div>
        <!--Lalagyan ng limitation na 2000 letters-->
        <div class = "mb-3">
            <label class = "form-label">Description</label><br>
            <textarea name="Company_Desc" placeholder="Company Description" cols="30" rows="10" class="form-control" required></textarea>

        </div>
            <button type='submit' name='Add'class = "btn btn-primary w-100">Submit</button>
    </form>
</body>
</html>