<?php
require_once '../config/database.php';
require_once '../models/User.php';

class AuthController
{

    public function register()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            /*if (empty($username) || empty($email) || empty($password)) {
                die("All fields are required.");
            }
            if (strlen($username) < 5) {
                die("Username must be at least 5 characters long.");
            }
            if (strlen($password) < 8) {
                die("Password must be at least 8 characters long.");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                die("Invalid email format.");
            }
            if($this->userModel->findByUsername($username)) {
                die("Username already exists.");
            }
            if($this->userModel->register($username, $email, $password)) {
                echo "Registration successful.";
            } else {
                die("Registration failed.");
            }*/
            if (empty($username) || empty($email) || empty($password)) {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['error'] = "empty_fields";
                header("Location: ../views/auth/register.php");
                exit();
            }
            if (strlen($username) < 5) {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['error'] = "username_too_short";
                header("Location: ../views/auth/register.php");
                exit();
            }
            if (strlen($password) < 8) {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['error'] = "password_too_short";
                header("Location: ../views/auth/register.php");
                exit();
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['error'] = "invalid_email";
                header("Location: ../views/auth/register.php");
                exit();
            }




            $con = Database::connect();
            $user = new User($username, $email, $password);
            if ($user->save($con)) {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['success'] = "Registration successful.";
                header("Location: ../views/auth/login.php");
                exit();
            } else {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['error'] = "Registration failed.";
                header("Location: ../views/auth/register.php");
                exit();
            }
        }
    }


    public function login()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            session_start();

            if (empty($username) || empty($password)) {
                $_SESSION['error'] = "empty_fields";
                header("Location: ../views/auth/login.php");
                exit();
            }

            $con = Database::connect();
            $userData = User::login($con, $username, $password);
            if ($userData) {
                $_SESSION['user_id'] = $userData['id'];
                $_SESSION['username'] = $userData['username'];
                $_SESSION['user_role'] = $userData['role'];
                //echo "Login successful.";
                header("Location: \dse\C-W\Advertising-Website\public\index.php");
                exit();
            } else {
                session_start();
                $_SESSION['error'] = "invalid_credentials";
                header("Location: ../views/auth/login.php");
                exit();

            }
        }
    }


    public function showloginForm()
    {
        include '../views/auth/login.php';
    }
    public function showRegisterForm()
    {
        include '../views/auth/register.php';
    }
    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: ../views/auth/login.php");
        exit();
    }




}
$controller = new AuthController();
if (isset($_GET['action']) && $_GET['action'] === 'register') {
    $controller->register();
}
if (isset($_GET['action']) && $_GET['action'] === 'login') {
    $controller->login();
}

?>