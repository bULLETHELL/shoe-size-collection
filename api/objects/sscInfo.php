<?php
class sscInfo{
    private $conn;
    private $table_name = "sscInfo";

    public $id;
    public $name;
    public $email;
    public $age;
    public $shoe_size;

    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
        $query = "SELECT * FROM " . $this->table_name;

        $stmt = $this->conn->query($query);

        return $stmt;
    }

    function create(){
        $query = "INSERT INTO " . $this->table_name . " (name, email, age, shoe_size) VALUES (?, ?, ?, ?)";
        //echo json_encode(array("message" => $query));

        //echo json_encode(array("message" => $this->conn));

        if($stmt = $this->conn->prepare($query)){
            //echo json_encode(array("message" => "In prepare query if statement."));
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->age=htmlspecialchars(strip_tags($this->age));
            $this->shoe_size=htmlspecialchars(strip_tags($this->shoe_size));

            $stmt->bind_param('ssii', $this->name, $this->email, $this->age, $this->shoe_size);

            if($stmt->execute()){
                return true;
            }
        }
        return false;
    }
}

?>