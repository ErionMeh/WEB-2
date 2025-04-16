<?php

require_once 'User.php';

class Admin extends User {

    private $accessLevel;

    public function __construct($id = 0, $fullname = '', $email = '', $password = '', $accessLevel = 'full') {
        parent::__construct($id, $fullname, $email, $password);
        
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
        if ($email === $this->getEmail() && $password === $this->getPassword()) {
            return true;
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
?>
