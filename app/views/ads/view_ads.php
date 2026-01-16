<!DOCTYPE html>
<html>

<head>
    <title>View Ads</title>
    <link rel="stylesheet" type="text/css" href="\dse\C-W\Advertising-Website\public\assets\css\ads\view_ads.css">
</head>

<body>
    <?php
    session_start();
    require_once __DIR__ . '..\..\app\config\database.php';

    require_once __DIR__ . '..\..\app\models\Advertisement.php';

    $con = Database::connect();
    $currentUserId = $_SESSION['user_id'] ?? null;
    $ads = [];
    if ($currentUserId) {
        $ads = Advertisement::getOthersAds($con, $currentUserId);
    }
    ?>

    <?php include '../layout/header.php'; ?>

    <h2>Other Users' Advertisements</h2>

    <div class="ad-list">
        <?php if (empty($ads)): ?>
            <p>No advertisements available.</p>
        <?php else: ?>
            <?php foreach ($ads as $ad): ?>
                <div class="ad-item">
                    <h3><?php echo htmlspecialchars($ad['title']); ?></h3>
                    <p><?php echo htmlspecialchars($ad['description']); ?></p>
                    <p><strong>Price:</strong> $<?php echo htmlspecialchars($ad['price']); ?></p>
                    <?php if (!empty($ad['image_path'])): ?>
                        <img src="../../../public<?php echo htmlspecialchars($ad['image_path']); ?>" alt="Ad Image" style="max-width: 200px;">
                    <?php endif; ?>
                    <p>Posted by: <?php echo htmlspecialchars($ad['username']); ?> on <?php echo htmlspecialchars($ad['created_at']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</body>

</html>