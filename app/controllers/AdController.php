<?php
require_once '../config/database.php';
require_once '../models/Advertisement.php';

class AdController
{
    public function create()
    {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header("Location: ../views/auth/login.php");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);
            $price = trim($_POST['price']);

            if (empty($title) || empty($description) || empty($price)) {
                $_SESSION['error'] = "All fields are required.";
                header("Location: ../views/ads/create_ad.php");
                exit();
            }
          

            if (!is_numeric($price) || $price <= 0) {
                $_SESSION['error'] = "Price must be a positive number.";
                header("Location: ../views/ads/create_ad.php");
                exit();
            }

            if(empty($_FILES['image']['name'])) {
                $_SESSION['error'] = "Please upload an image.";
                header("Location: ../views/ads/create_ad.php");
                exit();
            }

            $imagePath = '';


            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../../public/uploads/';
                //die($uploadDir);
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                $fileName = basename($_FILES['image']['name']);
                $uniqeName = time() . '_' . $fileName;
                $targetFile = $uploadDir . $uniqeName;


                $check = getimagesize($_FILES['image']['tmp_name']);
                if ($check === false) {
                    $_SESSION['error'] = "File is not an image.";
                    header("Location: ../views/ads/create_ad.php");
                    exit();
                }

                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    $imagePath = 'uploads/' . $uniqeName;
                } else {
                    $_SESSION['error'] = "Failed to upload image.";
                    header("Location: ../views/ads/create_ad.php");
                    exit();
                }
            }

            $con = Database::connect();
            $ad = new Advertisement($_SESSION['user_id'], $title, $description, $price, $imagePath);
            if ($ad->save($con)) {
                $_SESSION['success'] = "Ad created successfully.";
                header("Location: ../views/ads/create_ad.php");
                exit();
            } else {
                $_SESSION['error'] = "Failed to create ad.";
                header("Location: ../views/ads/create_ad.php");
                exit();
            }
        }
    }
}

$controller = new AdController();
if (isset($_GET['action']) && $_GET['action'] === 'create') {
    $controller->create();
}
?>