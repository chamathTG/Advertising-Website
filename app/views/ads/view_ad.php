<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../models/Advertisement.php';
require_once __DIR__ . '/../../config/database.php';

$con = Database::connect();
$adId = isset($_GET['id']) ? $_GET['id'] : null;

if (!$adId) {
    echo "Invalid Ad ID";
    exit;
}

$ad = Advertisement::getAdById($con, $adId);
if (!$ad) {
    echo "Ad not found or removed.";
    exit;
}

$comments = Advertisement::getComments($con, $adId);
?>

<!DOCTYPE html>
<html>

<head>
    <title>
        <?php echo htmlspecialchars($ad['title']); ?> - BuySell.lk
    </title>
    <link rel="stylesheet" href="/dse/C-W/Advertising-Website/public/assets/css/ads/view_ad.css">
</head>

<body>

    <?php include __DIR__ . '/../layout/header.php'; ?>

    <div class="container">
        <div class="ad-header">
            <img src="/dse/C-W/Advertising-Website/public/<?php echo htmlspecialchars($ad['image_path']); ?>"
                alt="<?php echo htmlspecialchars($ad['title']); ?>">
        </div>

        <div class="ad-content">
            <div class="ad-meta">
                <span>Posted by <strong>
                        <?php echo htmlspecialchars($ad['username']); ?>
                    </strong> on
                    <?php echo $ad['created_at']; ?>
                </span>
                <?php if (isset($_GET['reported'])): ?>
                    <span style="color: #10b981; font-weight: bold;">Report submitted. Thank you.</span>
                <?php endif; ?>
            </div>

            <h1 class="ad-title">
                <?php echo htmlspecialchars($ad['title']); ?>
            </h1>
            <div class="ad-price">Rs
                <?php echo number_format($ad['price'], 2); ?>
            </div>

            <div class="ad-description">
                <?php echo nl2br(htmlspecialchars($ad['description'])); ?>
            </div>

            <div class="report-section">
                <span id="reportBtn" class="report-link">Report this Ad</span>
            </div>

            <div class="comments-section">
                <h3 class="section-title">Comments</h3>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <form
                        action="/dse/C-W/Advertising-Website/app/controllers/AdInteractionController.php?action=addComment"
                        method="POST" class="comment-form">
                        <input type="hidden" name="ad_id" value="<?php echo $ad['id']; ?>">
                        <textarea name="comment" placeholder="Write a comment..." required></textarea>
                        <button type="submit" class="btn btn-primary">Post Comment</button>
                    </form>
                <?php else: ?>
                    <p><a href="/dse/C-W/Advertising-Website/app/views/auth/login.php">Login</a> to post a comment.</p>
                <?php endif; ?>

                <ul class="comment-list">
                    <?php if (!empty($comments)): ?>
                        <?php foreach ($comments as $comment): ?>
                            <li class="comment-item">
                                <div class="comment-user">
                                    <?php echo htmlspecialchars($comment['username']); ?> <span
                                        style="font-weight: normal; color: #94a3b8; font-size: 0.8em;">•
                                        <?php echo $comment['created_at']; ?>
                                    </span>
                                </div>
                                <div class="comment-text">
                                    <?php echo nl2br(htmlspecialchars($comment['comment'])); ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p style="color: #94a3b8;">No comments yet.</p>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- Report Modal -->
    <div id="reportModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Report Advertisement</h2>
            <form action="/dse/C-W/Advertising-Website/app/controllers/AdInteractionController.php?action=reportAd"
                method="POST">
                <input type="hidden" name="ad_id" value="<?php echo $ad['id']; ?>">
                <label>Reason for reporting:</label>
                <textarea name="reason" rows="4" required placeholder="Describe the issue..."></textarea>
                <button type="submit" class="btn btn-danger">Submit Report</button>
            </form>
        </div>
    </div>

    <?php include __DIR__ . '/../layout/footer.php'; ?>

    <script>
        window.isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
    </script>
    <script src="/dse/C-W/Advertising-Website/public/assets/js/report_modal.js"></script>

</body>

</html>