<?php
require_once 'User.php';

class Admin extends User {
    private $accessLevel;

    public function __construct($conn, $accessLevel = 'full') {
        parent::__construct($conn);
        $this->role = 'admin';
        $this->accessLevel = $accessLevel;
    }

    public function getAccessLevel() {
        return $this->accessLevel;
    }

    public function setAccessLevel($accessLevel) {
        $this->accessLevel = $accessLevel;
    }

    public function login($email, $password) {
        $stmt = $this->conn->prepare("SELECT id, fullname, email, password, role FROM users WHERE email = ? AND role = 'admin'");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $admin = $result->fetch_assoc();
            if (password_verify($password, $admin['password'])) {
                $this->id = $admin['id'];
                $this->fullname = $admin['fullname'];
                $this->email = $admin['email'];
                $this->password = $admin['password'];
                $this->role = $admin['role'];
                return true;
            }
        }
        return false;
    }

    public function canManageProducts() {
        return ($this->accessLevel === 'full' || $this->accessLevel === 'product');
    }

    public function canManageUsers() {
        return ($this->accessLevel === 'full' || $this->accessLevel === 'user');
    }
}
