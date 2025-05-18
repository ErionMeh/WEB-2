<?php

class User {
    private $conn;

    private $id;
    private $fullname;
    private $email;
    private $password;
    protected $role = 'user';

 public function __construct($conn) {
        $this->conn = $conn;
    }

 public function getId() {
        return $this->id;
    }

    public function getFullname() {
        return $this->fullname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getRole() {
        return $this->role;
    }

    public function getPassword() {
        return $this->password;
    }
    
    public function setId($id) {
        $this->id = $id;
    }

    public function setFullname($fullname) {
        $this->fullname = $fullname;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function emailExists($email) {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public function register($fullname, $email, $phone, $password) {
        if ($this->emailExists($email)) {
            return "Ky email është marrë tashmë. Zgjidh një tjetër.";
        }

        $stmt = $this->conn->prepare("INSERT INTO users (fullname, email, phone, password, role) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            return "Gabim me databazën: " . $this->conn->error;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $role = $this->role;

        $stmt->bind_param("sssss", $fullname, $email, $phone, $hashedPassword, $role);

        if ($stmt->execute()) {
            return true;
        } else {
            return "Gabim gjatë regjistrimit: " . $stmt->error;
        }
    }

    public function login($email, $password) {
        $stmt = $this->conn->prepare("SELECT id, fullname, email, password, role FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $this->id = $user['id'];
                $this->fullname = $user['fullname'];
                $this->email = $user['email'];
                $this->password = $user['password'];
                $this->role = $user['role'];
                return true;
            }
        }

        return false;
    }
}

?>








?>