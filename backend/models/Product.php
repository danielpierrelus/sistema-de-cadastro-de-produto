<?php
class Product {
    private $conn;
    private $table_name = "products";

    public $id;
    public $name;
    public $description;
    public $image;
    public $price;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (name, description, image, price) VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->name);
        $stmt->bindParam(2, $this->description);
        $stmt->bindParam(3, $this->image);
        $stmt->bindParam(4, $this->price);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
