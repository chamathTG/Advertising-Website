<!DOCTYPE html>
<html>

<head>
    <title>Manage Reports</title>
    <link rel="stylesheet" href="\dse\C-W\Advertising-Website\public\assets\css\admin\reports_view.css">
</head>

<body>

    <div class="sidebar">
        <h2>BuySel Admin</h2>
        <a href="dashboard.php">Dashboard</a>
        <a href="manage_ads.php">All Ads</a>
        <a href="users.php">Manage Users</a>
        <a href="reports.php" style="color: white; font-weight: bold;">Reports</a>
        <a href="/dse/C-W/Advertising-Website/public/index.php">Back to Site</a>
        <a href="/dse/C-W/Advertising-Website/app/views/auth/logout.php">Logout</a>
    </div>

    <div class="main-content">
        <h1>Reported Ads</h1>

        <table style="margin-top: 24px;">
            <thead>
                <tr>
                    <th>Report ID</th>
                    <th>Ad Title</th>
                    <th>Reported User</th>
                    <th>Reason</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($reports)): ?>
                    <?php foreach ($reports as $report): ?>
                        <tr>
                            <td>#<?php echo $report['id']; ?></td>
                            <td>
                                <a href="/dse/C-W/Advertising-Website/app/views/ads/view_ad.php?id=<?php echo $report['ad_id']; ?>"
                                    target="_blank">
                                    <?php echo htmlspecialchars($report['ad_title']); ?>
                                </a>
                            </td>
                            <td><?php echo htmlspecialchars($report['username']); ?></td>
                            <td><?php echo htmlspecialchars($report['reason']); ?></td>
                            <td>
                                <form method="POST"
                                    action="/dse/C-W/Advertising-Website/app/controllers/AdminController.php?action=deleteAd&id=<?php echo $report['ad_id']; ?>&report_id=<?php echo $report['id']; ?>"
                                    style="display:inline;">
                                    <button type="submit" class="btn btn-delete">Delete Ad</button>
                                </form>
                                <form method="POST"
                                    action="/dse/C-W/Advertising-Website/app/controllers/AdminController.php?action=dismissReport&id=<?php echo $report['id']; ?>"
                                    style="display:inline;">
                                    <button type="submit" class="btn btn-dismiss">Dismiss</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No pending reports.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>

</html>