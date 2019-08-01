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

    function create(){
        $query = "INSERT INTO " . $this->table_name . "
                SET
                    name=:name, email=:email, age=:age, shoe_size=:shoe_size";

        if($stmt = $this->conn->prepare($query)){
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->age=htmlspecialchars(strip_tags($this->age));
            $this->shoe_size=htmlspecialchars(strip_tags($this->shoe_size));

            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":age", $this->age);
            $stmt->bindParam(":shoe_size", $this->shoe_size);

            if($stmt->execute()){
                return true;
            }
        }
        return false;
    }
}

?>