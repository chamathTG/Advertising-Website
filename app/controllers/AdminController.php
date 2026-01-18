<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Advertisement.php';

require_once __DIR__ . '/../config/database.php';

class AdminController
{
    private $con;

    public function __construct()
    {
        $this->con = Database::connect();
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 1) {
            header("Location: /dse/C-W/Advertising-Website/public/index.php");
            exit;
        }
    }

    public function dashboard()
    {
        $userCount = User::countUsers($this->con);
        $adCount = Advertisement::countActiveAds($this->con);
        $totalAds = Advertisement::countAllAds($this->con);
        $pendingAds = Advertisement::countPendingAds($this->con);


        $reportResult = $this->con->query("SELECT COUNT(*) as count FROM reports WHERE status = 'pending'");
        $reportCount = $reportResult ? $reportResult->fetch_assoc()['count'] : 0;

        require_once __DIR__ . '/../views/admin/dashboard_view.php';
    }

    public function users()
    {
        $users = User::getAllUsers($this->con);
        require_once __DIR__ . '/../views/admin/users_view.php';
    }

    public function banUser($userId)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            User::updateStatus($this->con, $userId, 'banned');
            header("Location: /dse/C-W/Advertising-Website/app/views/admin/users.php");
        }
    }

    public function unbanUser($userId)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            User::updateStatus($this->con, $userId, 'active');
            header("Location: /dse/C-W/Advertising-Website/app/views/admin/users.php");
        }
    }

    public function reports()
    {

        $sql = "SELECT r.*, a.title as ad_title, u.username 
             FROM reports r 
             JOIN advertisements a ON r.ad_id = a.id 
             JOIN users u ON r.user_id = u.id 
             WHERE r.status = 'pending' 
             ORDER BY r.created_at DESC";
        $result = $this->con->query($sql);
        $reports = $result->fetch_all(MYSQLI_ASSOC);
        require_once __DIR__ . '/../views/admin/reports_view.php';
    }

    public function dismissReport($reportId)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $stmt = $this->con->prepare("UPDATE reports SET status = 'dismissed' WHERE id = ?");
            $stmt->bind_param("i", $reportId);
            $stmt->execute();
            header("Location: /dse/C-W/Advertising-Website/app/views/admin/reports.php");
        }
    }

    public function deleteAd($adId)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $stmt = $this->con->prepare("DELETE FROM advertisements WHERE id = ?");
            $stmt->bind_param("i", $adId);
            $stmt->execute();

            header("Location: /dse/C-W/Advertising-Website/app/views/admin/reports.php");
        }
    }

    public function manageAds()
    {
        $ads = Advertisement::getAllAdsForAdmin($this->con);
        require_once __DIR__ . '/../views/admin/manage_ads_view.php';
    }

    public function toggleAdStatus($adId, $status)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Advertisement::updateStatus($this->con, $adId, $status);
            header("Location: /dse/C-W/Advertising-Website/app/views/admin/manage_ads.php");
        }
    }
}

if (isset($_GET['action'])) {
    $controller = new AdminController();
    $action = $_GET['action'];
    if ($action == 'dashboard') {
        $controller->dashboard();
    } elseif ($action == 'users') {
        $controller->users();
    } elseif ($action == 'banUser' && isset($_GET['id'])) {
        $controller->banUser($_GET['id']);
    } elseif ($action == 'unbanUser' && isset($_GET['id'])) {
        $controller->unbanUser($_GET['id']);
    } elseif ($action == 'reports') {
        $controller->reports();
    } elseif ($action == 'dismissReport' && isset($_GET['id'])) {
        $controller->dismissReport($_GET['id']);
    } elseif ($action == 'deleteAd' && isset($_GET['id'])) {
        $controller->deleteAd($_GET['id']);
    } elseif ($action == 'manageAds') {
        $controller->manageAds();
    } elseif ($action == 'toggleAdStatus' && isset($_GET['id']) && isset($_GET['status'])) {
        $controller->toggleAdStatus($_GET['id'], $_GET['status']);
    }
}
?>