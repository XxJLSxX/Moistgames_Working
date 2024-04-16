<?php
    $DB_Server = "localhost";
    $DB_UserName = "root";
    $DB_Password = "";
    $DB_Name = "moisturegames";

    $connection = new mysqli($DB_Server, $DB_UserName, $DB_Password, $DB_Name);

    if ($connection->connect_error) {
        die("Connection Failed: ". $connection->connect_error);
    } else {
        echo "Connected Successfully";
    }
?>