<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Advertisement.php';

$con = Database::connect();
$currentUserId = $_SESSION['user_id'] ?? null;
$ads = [];
if ($currentUserId) {

    $userRole = $_SESSION['user_role'] ?? 0;
    $ads = Advertisement::getOthersAds($con, $currentUserId, $userRole);
} else {
    $userRole = 0;
    $currentUserId = 0;
    $ads = Advertisement::getOthersAds($con, $currentUserId, $userRole);
}
?>

<div class="content" style="background: transparent; border: none; padding: 0; margin-bottom: 30px;">
    <p>Welcome to BuySel.lk! Browse and find amazing deals on a variety of products.</p>
</div>

<div class="ad-list">
    <?php if (empty($ads)): ?>
        <p>No advertisements available (Log in to see tailored ads).</p>
    <?php else: ?>
        <?php foreach ($ads as $ad): ?>
            <div class="ad-item">
                <h3>
                    <a href="/dse/C-W/Advertising-Website/app/views/ads/view_ad.php?id=<?php echo $ad['id']; ?>" style="text-decoration: none; color: inherit;">
                        <?php echo htmlspecialchars($ad['title']); ?>
                    </a>
                </h3>
                <p>
                    <?php echo htmlspecialchars($ad['description']); ?>
                </p>
                <p><strong>Price:</strong> Rs:
                    <?php echo htmlspecialchars($ad['price']); ?>
                </p>
                <?php if (!empty($ad['image_path'])): ?>
                    <a href="/dse/C-W/Advertising-Website/app/views/ads/view_ad.php?id=<?php echo $ad['id']; ?>">
                        <img src="/dse/C-W/Advertising-Website/public/<?php echo htmlspecialchars($ad['image_path']); ?>"
                            alt="Ad Image">
                    </a>
                <?php endif; ?>
                <p>Posted by:
                    <?php echo htmlspecialchars($ad['username']); ?> on
                    <?php echo htmlspecialchars($ad['created_at']); ?>
                </p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>