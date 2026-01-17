<!DOCTYPE html>
<html>

<head>
    <title>Manage Ads</title>
    <link rel="stylesheet" href="\dse\C-W\Advertising-Website\public\assets\css\admin\manages_ads_view.css">
</head>

<body>

    <div class="sidebar">
        <h2>BuySel Admin</h2>
        <a href="dashboard.php">Dashboard</a>
        <a href="manage_ads.php" style="color: white; font-weight: bold;">All Ads</a>
        <a href="users.php">Manage Users</a>
        <a href="reports.php">Reports</a>
        <a href="/dse/C-W/Advertising-Website/public/index.php">Back to Site</a>
        <a href="/dse/C-W/Advertising-Website/app/views/auth/logout.php">Logout</a>
    </div>

    <div class="main-content">
        <h1>All Advertisements</h1>

        <table style="margin-top: 24px;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>User</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($ads)): ?>
                    <?php foreach ($ads as $ad): ?>
                        <tr>
                            <td>#<?php echo $ad['id']; ?></td>
                            <td>
                                <a href="/dse/C-W/Advertising-Website/app/views/ads/view_ad.php?id=<?php echo $ad['id']; ?>"
                                    target="_blank">
                                    <?php echo htmlspecialchars($ad['title']); ?>
                                </a>
                            </td>
                            <td><?php echo htmlspecialchars($ad['username']); ?></td>
                            <td><?php echo htmlspecialchars($ad['price']); ?></td>
                            <td>
                                <?php
                                $statusClass = 'badge-pending';
                                $statusText = 'Pending (0)';
                                if ($ad['status'] == 1) {
                                    $statusClass = 'badge-active';
                                    $statusText = 'Active';
                                } elseif ($ad['status'] == 0) {
                                    $statusClass = 'badge-pending';
                                    $statusText = 'Pending';
                                } else {
                                    $statusClass = 'badge-disabled';
                                    $statusText = 'Disabled/Other';
                                }
                                ?>
                                <span class="badge <?php echo $statusClass; ?>">
                                    <?php echo $statusText; ?>
                                </span>
                            </td>
                            <td>
                                <form method="POST"
                                    action="/dse/C-W/Advertising-Website/app/controllers/AdminController.php?action=toggleAdStatus&id=<?php echo $ad['id']; ?>&status=<?php echo $ad['status'] == 1 ? 0 : 1; ?>"
                                    style="display:inline;">
                                    <button type="submit"
                                        class="btn <?php echo $ad['status'] == 1 ? 'btn-disable' : 'btn-activate'; ?>">
                                        <?php echo $ad['status'] == 1 ? 'Disable' : 'Activate'; ?>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No ads found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>

</html>