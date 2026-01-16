<?php
require_once '../config/database.php';

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

    public static function getOthersAds($con, $currentUserId)
    {
        $stmt = $con->prepare("SELECT a.*, u.username FROM advertisements a JOIN users u ON a.user_id = u.id WHERE a.user_id != ? AND a.status = 0 ORDER BY a.created_at DESC");
        $stmt->bind_param("i", $currentUserId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Getters
    public function getId() { return $this->id; }
    public function getUserId() { return $this->user_id; }
    public function getTitle() { return $this->title; }
    public function getDescription() { return $this->description; }
    public function getPrice() { return $this->price; }
    public function getImagePath() { return $this->image_path; }
    public function getStatus() { return $this->status; }
    public function getCreatedAt() { return $this->created_at; }
}
?>