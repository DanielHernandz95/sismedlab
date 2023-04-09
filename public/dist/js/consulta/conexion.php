<?php

$conexion1 = mysqli_connect("localhost", "Admin", "T3cnolog14", "db_spiatel", "3306");

class conexion {

    public static function getConexion() {
        $conexion = NULL;
        try {
            $conexion = new PDO("mysql:host=localhost;dbname=db_spiatel", "Admin", "T3cnolog14");
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $ex) {
            echo 'Error= ' . $ex->getMessage();
        }
        return $conexion;
    }

}



class DBController {

    private $host = "localhost";
    private $user = "Admin";
    private $password = "T3cnolog14";
    private $database = "db_spiatel";
    private $conn;

    function __construct() {
        $this->conn = $this->connectDB();
    }

    function connectDB() {
        $conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        return $conn;
    }

    function runQuery($query) {
        $result = mysqli_query($this->conn, $query);
        while ($row = mysqli_fetch_array($result)) {
            $resultset[] = $row;
        }
        if (!empty($resultset))
            return $resultset;
    }

    function insertQuery($query) {
        mysqli_query($this->conn, $query);
        $insert_id = mysqli_insert_id($this->conn);
        return $insert_id;
    }

    function getIds($query) {
        $result = mysqli_query($this->conn, $query);
        while ($row = mysqli_fetch_array($result)) {
            $resultset[] = $row[0];
        }
        if (!empty($resultset))
            return $resultset;
    }

    function numRows($query) {
        $result = mysqli_query($this->conn, $query);
        $rowcount = mysqli_num_rows($result);
        return $rowcount;
    }

}

?>