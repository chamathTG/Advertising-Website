<?php
class User
{
    private $username;
    private $email;
    private $password;

    public function __construct($username, $email, $password)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }
    public function save($con)
    {
        $stmt = $con->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $this->username, $this->email, $this->password);
        return $stmt->execute();
    }
    public function findByUsername($con, $username)
    {
        $stmt = $con->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    public function verifyPassword($inputPassword)
    {
        return password_verify($inputPassword, $this->password);
    }

    public static function login($con, $username, $inputPassword)
    {

        $stmt = $con->prepare("SELECT id, username, password,role FROM users WHERE username = ? LIMIT 1");
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();
        $userData = $result->fetch_assoc();

        if ($userData && password_verify($inputPassword, $userData['password'])) {
            return $userData;
        }

        return false;
    }


    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public static function getAllUsers($con)
    {
        $stmt = $con->prepare("SELECT id, username, email, role, status FROM users ORDER BY id DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function updateStatus($con, $id, $status)
    {
        $stmt = $con->prepare("UPDATE users SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $id);
        return $stmt->execute();
    }

    public static function countUsers($con)
    {
        $result = $con->query("SELECT COUNT(*) as count FROM users WHERE role = 0");
        $row = $result->fetch_assoc();
        return $row['count'];
    }
}

?>