<?php
class Db {
    private $servername = "localhost";
    private $username = "root";
    private $password = "C@mp.90HFGD";
    private $dbname = "projekti";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli(
            $this->servername,
            $this->username,
            $this->password,
            $this->dbname
        );

        if ($this->conn->connect_error) {
            die("Lidhja me DB dështoi: " . $this->conn->connect_error);
        }

        $this->conn->set_charset("utf8mb4");
    }
}
?>
