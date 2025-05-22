<?php
class Product {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function insert($name, $description, $price, $stock) {
        $sql = "INSERT INTO products (name, description, price, stock) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssdi", $name, $description, $price, $stock);
        return $stmt->execute();
    }

    public function update($id, $name, $description, $price, $stock) {
        $sql = "UPDATE products SET name = ?, description = ?, price = ?, stock = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssdii", $name, $description, $price, $stock, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function getAll() {
        $sql = "SELECT * FROM products";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    public function bulkInsert($products) {
    $stmt = $this->conn->prepare("INSERT INTO products (name, description, price, stock) VALUES (?, '', ?, ?)");

    foreach ($products as $p) {
        $stmt->bind_param("sdi", $p["name"], $p["price"], $p["stock"]);
        $stmt->execute();
    }

    return true;
}

}
?>
