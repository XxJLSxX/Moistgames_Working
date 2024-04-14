<?php
require 'connection.php';

class MoistFunctions {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }
    
    public function sqlExecute($sql) {
        $result = mysqli_query($this->connection, $sql);
        $data = array();
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)) {
                $data_row=array();
                foreach($row as $r) {
                    array_push($data_row, $r);
                }
                array_push($data, $data_row);
            }
        }
        return $data;
    }
    
    public function showAll($tbl) {
        $sql = "SELECT * FROM $tbl where email != 'admin@moist.com'";
        return $this->sqlExecute($sql); 
    }
    
    public function showRecords($tbl, $where=null, $join=null, $col1=null, $col2=null, $wherejoin=null) {
        $sql = "SELECT * FROM $tbl";
        if ($where != null) {
            $sql.= " Where $where";
        }
        if ($join != null) {
            $sql.= " Left Join $join ON $col1 = $col2";
            if ($wherejoin != null) {
                $sql.= " Where $wherejoin";
            }
        }
        return $this->sqlExecute($sql);
    }

    public function getPaymentMethods() {
        $sql = "SELECT * FROM Payment_Method";
        return $this->sqlExecute($sql);
    }

    public function UserRegistry($data, $selectedPaymentMethodID, $tbl){
        $name = mysqli_real_escape_string($this->connection, $data['name']);
        $username = mysqli_real_escape_string($this->connection, $data['username']);
        $email = mysqli_real_escape_string($this->connection, $data['email']);
        $password = mysqli_real_escape_string($this->connection, $data['password']);

        $sqlInsertUser = "INSERT INTO $tbl(Name, User_Name, Email, Password, PMethod_ID) VALUES ('$name', '$username', '$email', '$password', '$selectedPaymentMethodID')";
        mysqli_query($this->connection, $sqlInsertUser);

        return true;
    }


    public function addQuery($data, $tbl){
        $tbl_columns = implode(",", array_keys($data));
        $tbl_values = implode("','", $data);
        $sql = "INSERT INTO $tbl($tbl_columns) VALUES ('$tbl_values')";
        return mysqli_query($this->connection, $sql);
    }

    public function updateQuery($data,$tbl,$id){
        $update="";
        foreach($data as $key => $value){
            $update.=" $key='$value' ,";
        }
        $update = substr($update,0,-1);
        $primary_key = array_keys($id)[0];
        $key_value = $id[$primary_key];
        $sql = "UPDATE $tbl SET {$update} WHERE $primary_key=$key_value";
        return mysqli_query($this-> connection, $sql);
    }
    

    public function uploadFile($file, $target_dir, $Gname, $new_file_name) {
        $fileExtension = pathinfo($file["name"], PATHINFO_EXTENSION);
        $uploadOk = 1;
    
        // Check file size
        if ($file["size"] > 20000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
    
        // Allow certain file formats
        if ($fileExtension != "jpg" && $fileExtension != "jpeg" && $fileExtension != "png") {
            echo "Sorry, only JPG, JPEG, and PNG files are allowed.";
            $uploadOk = 0;
        }else {  // New file name
            $target_file = $target_dir . $new_file_name; // Full path to the new file
        }
    
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars(basename($file["name"])). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}
