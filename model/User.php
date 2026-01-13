<?php
class User {
    private $username;
    private $email;
    private $password;

    public function __construct($username, $email, $password) {
        $this->username = $username;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }
    public function save($con) {
        $stmt = $con->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $this->username, $this->email, $this->password);
        return $stmt->execute();
    }
    

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }
}

?>