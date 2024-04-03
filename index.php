<?php
session_start();
require 'db/MoistFunctions.php';

$moistureFunctions = new MoistFunctions($connection);
$records = $moistureFunctions->showAll('users');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moisture Games</title>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="db/design.css">

    <!-- jS -->
    <script src="bootstrap/js/bootstrap.js"></script>
    
</head>
<body>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Payment Method</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $records_count = 0;
            if (count($records) > 0) :
                foreach ($records as $record) :
        ?>
            <tr>
                <td><?= ++$records_count ?></td>
                <td><?= $record[1] ?></td>
                <td><?= $record[2] ?></td>
                <td><?= $record[3] ?></td>
                <td><?= $record[5] ?></td>
                <td>
                    <a class="btn btn-info" href="forms/students_update.php?id=<?= $record[0] ?>">Update</a>
                    <a class="btn btn-warning" href="forms/students_delete.php?id=<?= $record[0] ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach;
            else :
        ?>
            <tr>
                <td colspan="6">No Record Found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
    <tfoot>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Payment Method</th>
        </tr>
    </tfoot>
</table>

</html>
