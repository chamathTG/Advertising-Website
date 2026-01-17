<?php
require_once __DIR__ . '/../config/database.php';

class Advertisement
{
    private $id;
    private $user_id;
    private $title;
    private $description;
    private $image_path;
    private $status;
    private $created_at;
    private $price;

    public function __construct($user_id, $title, $description, $price, $image_path, $status = 0)
    {
        $this->user_id = $user_id;
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->image_path = $image_path;
        $this->status = $status;
        $this->created_at = date('Y-m-d');
    }

    public function save($con)
    {
        $stmt = $con->prepare("INSERT INTO advertisements (user_id, title, description, price, image_path, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssis", $this->user_id, $this->title, $this->description, $this->price, $this->image_path, $this->status, $this->created_at);
        return $stmt->execute();
    }

    /*public static function getOthersAds($con, $currentUserId)
    {
        $stmt = $con->prepare("SELECT a.*, u.username FROM advertisements a JOIN users u ON a.user_id = u.id WHERE a.user_id != ? AND a.status = 0 ORDER BY a.created_at DESC");
        $stmt->bind_param("i", $currentUserId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }*/
    public static function getOthersAds($con, $currentUserId, $userRole)
    {

        $sql = "SELECT a.*, u.username 
            FROM advertisements a 
            JOIN users u ON a.user_id = u.id";

        if ($userRole == 1) {
            $sql .= " WHERE a.status IN (0, 1)";
            $sql .= " ORDER BY a.created_at DESC";
            $stmt = $con->prepare($sql);

        } else {
            $sql .= " WHERE a.user_id != ? AND a.status = 1";
            $sql .= " ORDER BY a.created_at DESC";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("i", $currentUserId);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }
    public function getUserId()
    {
        return $this->user_id;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function getImagePath()
    {
        return $this->image_path;
    }
    public function getStatus()
    {
        return $this->status;
    }
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    public static function countActiveAds($con)
    {
        $result = $con->query("SELECT COUNT(*) as count FROM advertisements WHERE status = 1");
        $row = $result->fetch_assoc();
        return $row['count'];
    }

    public static function countAllAds($con)
    {
        $result = $con->query("SELECT COUNT(*) as count FROM advertisements");
        $row = $result->fetch_assoc();
        return $row['count'];
    }

    public static function countPendingAds($con)
    {
        $result = $con->query("SELECT COUNT(*) as count FROM advertisements WHERE status = 0");
        $row = $result->fetch_assoc();
        return $row['count'];
    }

    public static function getAllAdsForAdmin($con)
    {
        $sql = "SELECT a.*, u.username FROM advertisements a JOIN users u ON a.user_id = u.id ORDER BY a.created_at DESC";
        $result = $con->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function updateStatus($con, $id, $status)
    {
        $stmt = $con->prepare("UPDATE advertisements SET status = ? WHERE id = ?");
        $stmt->bind_param("ii", $status, $id);
        return $stmt->execute();
    }

    public static function getAdById($con, $id)
    {
        $stmt = $con->prepare("SELECT a.*, u.username FROM advertisements a JOIN users u ON a.user_id = u.id WHERE a.id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public static function addComment($con, $adId, $userId, $comment)
    {
        $stmt = $con->prepare("INSERT INTO comments (ad_id, user_id, comment) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $adId, $userId, $comment);
        return $stmt->execute();
    }

    public static function getComments($con, $adId)
    {
        $stmt = $con->prepare("SELECT c.*, u.username FROM comments c JOIN users u ON c.user_id = u.id WHERE c.ad_id = ? ORDER BY c.created_at DESC");
        $stmt->bind_param("i", $adId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function reportAd($con, $adId, $userId, $reason)
    {
        $stmt = $con->prepare("INSERT INTO reports (ad_id, user_id, reason) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $adId, $userId, $reason);
        return $stmt->execute();
    }
}