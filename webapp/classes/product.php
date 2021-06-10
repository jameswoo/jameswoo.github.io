<?php 
class Product {
    public string $name;
    public string $description;
    public float $price;

    public function __construct($name, $description = "", $price = 0.0) {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }

    public function insertNewProduct(): bool {
        include 'config/database.php';
        // insert query
        $query = "INSERT INTO products SET name=:name, description=:description, price=:price, created=:created";

        // prepare query for execution
        $stmt = $con->prepare($query);

        // bind the parameters
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':price', $this->price);
        
        $created = date('Y-m-d H:i:s'); // get current date and time
        $stmt->bindParam(':created', $created);

        // Execute the query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>