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
        <?php echo htmlspecialchars($ad['title']); ?> - BuySel.lk
    </title>
    <!-- Use existing styles if available or add inline for speed -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: #1e293b;
            margin: 0;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .ad-header {
            position: relative;
            height: 400px;
            overflow: hidden;
        }

        .ad-header img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .ad-content {
            padding: 40px;
        }

        .ad-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 10px;
        }

        .ad-meta {
            font-size: 1rem;
            color: #64748b;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .ad-price {
            font-size: 2rem;
            font-weight: 700;
            color: #2563eb;
        }

        .ad-description {
            font-size: 1.125rem;
            line-height: 1.75;
            color: #334155;
            margin-bottom: 40px;
            border-top: 1px solid #e2e8f0;
            padding-top: 20px;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            color: #1e293b;
        }

        .comments-section {
            margin-top: 40px;
            padding-top: 40px;
            border-top: 1px solid #e2e8f0;
        }

        .comment-list {
            list-style: none;
            padding: 0;
        }

        .comment-item {
            margin-bottom: 20px;
            padding: 15px;
            background: #f1f5f9;
            border-radius: 8px;
        }

        .comment-user {
            font-weight: 600;
            font-size: 0.9rem;
            color: #475569;
            margin-bottom: 5px;
        }

        .comment-text {
            color: #1e293b;
        }

        .comment-form textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-family: inherit;
            margin-bottom: 10px;
            resize: vertical;
            min-height: 100px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
        }

        .report-section {
            margin-top: 20px;
            text-align: right;
        }

        .report-link {
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.875rem;
            cursor: pointer;
        }

        .report-link:hover {
            color: #ef4444;
            text-decoration: underline;
        }

        /* Modal for report */
        .modal {
            display: none;
            position: fixed;
            z-index: 100;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 30px;
            border: 1px solid #888;
            width: 500px;
            border-radius: 12px;
            position: relative;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: black;
        }

        .modal textarea {
            width: 100%;
            padding: 10px;
            margin: 15px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
    </style>
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
        var modal = document.getElementById("reportModal");
        var btn = document.getElementById("reportBtn");
        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function () {
            <?php if (!isset($_SESSION['user_id'])): ?>
                window.location.href = "/dse/C-W/Advertising-Website/app/views/auth/login.php";
            <?php else: ?>
                modal.style.display = "block";
            <?php endif; ?>
        }

        span.onclick = function () {
            modal.style.display = "none";
        }

        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>

</html>