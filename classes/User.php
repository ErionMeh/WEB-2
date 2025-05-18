<?php


class User{
    private $conn; 

        //Atributet
        private $id;
        private $fullname;
        private $email;
        private $password;
        protected $role = 'user'; 
        
        
        // Konstruktori
        public function __construct($id = 0, $fullname = '', $email = '', $password = '') {
            $this->id = $id;
            $this->fullname = $fullname;
            $this->email = $email;
            $this->password = $password;
        }
        
        // Destruktori
        public function __destruct() {
            
        }
        
        // Metodat GET
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

        
        // Metodat SET
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

            // Metoda për regjistrim
        public function register($fullname, $email, $password) {
        $this->fullname = $fullname;
        $this->email = $email;
        $this->password = $password;
        return true;
                        }

         //Metoda per login
         public function login($email, $password) {
            if ($email === $this->email && $password === $this->password) {
                return true;
            }
            return false;
        }


}











?>