<!DOCTYPE html>
<html>

<head>
    <title>Manage Users</title>
    <link rel="stylesheet" href="/dse/C-W/Advertising-Website/public/assets/css/admin/user_view.css">
</head>

<body>

    <div class="sidebar">
        <h2>BuySel Admin</h2>
        <a href="dashboard.php">Dashboard</a>
        <a href="manage_ads.php">All Ads</a>
        <a href="users.php" style="color: white; font-weight: bold;">Manage Users</a>
        <a href="reports.php">Reports</a>
        <a href="/dse/C-W/Advertising-Website/public/index.php">Back to Site</a>
        <a href="javascript:void(0)" onclick="confirmLogout()">Logout</a>
    </div>

    <div class="main-content">
        <h1>Manage Users</h1>

        <table style="margin-top: 24px;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td>#
                                <?php echo $user['id']; ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($user['username']); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($user['email']); ?>
                            </td>
                            <td>
                                <?php echo $user['role'] == 1 ? 'Admin' : 'User'; ?>
                            </td>
                            <td>
                                <span
                                    class="badge <?php echo $user['status'] == 'active' ? 'badge-active' : 'badge-banned'; ?>">
                                    <?php echo ucfirst($user['status']); ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($user['role'] != 1): ?>
                                    <form method="POST"
                                        action="/dse/C-W/Advertising-Website/app/controllers/AdminController.php?action=<?php echo $user['status'] == 'active' ? 'banUser' : 'unbanUser'; ?>&id=<?php echo $user['id']; ?>"
                                        style="display:inline;">
                                        <button type="submit"
                                            class="btn <?php echo $user['status'] == 'active' ? 'btn-ban' : 'btn-unban'; ?>">
                                            <?php echo $user['status'] == 'active' ? 'Ban' : 'Unban'; ?>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No users found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php include __DIR__ . '/../layout/popup_alert.php'; ?>
</body>

</html>