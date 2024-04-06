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
    
    public function showRecords($tbl, $where=null){
        $sql = "SELECT * FROM $tbl";
        if ($where != null) {
            $sql.= " Where $where";
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
}
?>
