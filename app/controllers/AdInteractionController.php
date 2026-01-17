<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../models/Advertisement.php';
require_once __DIR__ . '/../config/database.php';

class AdInteractionController
{
    private $con;

    public function __construct()
    {
        $this->con = Database::connect();
    }

    public function addComment()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['user_id'])) {
                header("Location: /dse/C-W/Advertising-Website/app/views/auth/login.php");
                exit;
            }

            $adId = $_POST['ad_id'];
            $comment = $_POST['comment'];
            $userId = $_SESSION['user_id'];

            if (!empty($comment)) {
                Advertisement::addComment($this->con, $adId, $userId, $comment);
            }
            // Redirect back to ad view
            header("Location: /dse/C-W/Advertising-Website/app/views/ads/view_ad.php?id=" . $adId);
            exit;
        }
    }

    public function reportAd()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['user_id'])) {
                header("Location: /dse/C-W/Advertising-Website/app/views/auth/login.php");
                exit;
            }

            $adId = $_POST['ad_id'];
            $reason = $_POST['reason'];
            $userId = $_SESSION['user_id'];

            if (!empty($reason)) {
                Advertisement::reportAd($this->con, $adId, $userId, $reason);
            }
            header("Location: /dse/C-W/Advertising-Website/app/views/ads/view_ad.php?id=" . $adId . "&reported=1");
            exit;
        }
    }
}

$controller = new AdInteractionController();
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'addComment') {
        $controller->addComment();
    } elseif ($_GET['action'] == 'reportAd') {
        $controller->reportAd();
    }
}
?>