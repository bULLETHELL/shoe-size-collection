<?php 
class Database{

    private $host = "localhost";
    private $dbname = "pmon01_skp_dp_sde_dk";
    private $username = "pmon01.skp-dp";
    private $password = "yppyqyy2";
    public $conn;

    public function getCon(){
        $this->conn = null;
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

        if($mysqli->connect_errno){
            printf("Connect failed: %s\n", $mysqli->connect_error);
            exit();
        }
    }
}
?>