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
    $sql = "UPDATE products SET name=?, description=?, price=?, stock=? WHERE id=?";
    $stmt = $this->conn->prepare($sql);

    if (!$stmt) {
        error_log("Error preparing statement: " . $this->conn->error);
        return false;
    }

    if (!$stmt->bind_param("ssdii", $name, $description, $price, $stock, $id)) {
        error_log("Error binding parameters: " . $stmt->error);
        return false;
    }

    if (!$stmt->execute()) {
        error_log("Error executing statement: " . $stmt->error);
        return false;
    }

    return true;
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
public function getAllProducts($filter = '', $search = '') {
    $sql = "SELECT * FROM products";
    $conditions = [];

    if (!empty($search)) {
        $search = "%" . $this->conn->real_escape_string($search) . "%";
        $conditions[] = "(name LIKE '$search' OR description LIKE '$search')";
    }

    if (!empty($conditions)) {
        $sql .= " WHERE " . implode(" AND ", $conditions);
    }

    switch ($filter) {
        case 'price_asc':
            $sql .= " ORDER BY price ASC";
            break;
        case 'price_desc':
            $sql .= " ORDER BY price DESC";
            break;
        case 'name_asc':
            $sql .= " ORDER BY name ASC";
            break;
        case 'name_desc':
            $sql .= " ORDER BY name DESC";
            break;
    }

    $result = $this->conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}


}
?>
