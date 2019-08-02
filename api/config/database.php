<?php 
class Database{

    private $host = "localhost";
    private $dbname = "pmon01_skp_dp_sde_dk";
    private $username = "pmon01.skp-dp";
    private $password = "yppyqyy2";
    public $conn;

    public function getCon(){
        //$this->conn = null;
        $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->dbname);

        //echo json_encode(array("message" => $this->conn));

        if($this->conn->connect_errno){
            die('Connect Error (' . $this->conn->connect_errno . ') ' . $this->conn->connect_error);
        }

        return $this->conn;
    }
}
?>