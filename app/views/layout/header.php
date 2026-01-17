<!DOCTYPE html>
<html>

<head>
    <title>Header</title>
    <link rel="stylesheet" type="text/css" href="/dse/C-W/Advertising-Website/public/assets/css/layout/header.css">
</head>

<body>
    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    ?>
    <div class="head">
        <a href="/dse/C-W/Advertising-Website/public/index.php" class="logo-section">
            <img src="/dse/C-W/Advertising-Website/public/assets/images/BuySelLogo.png" alt="BuySel.lk"
                class="home-icon">
            <h1 class="brand-name">BuySel.lk</h1>
        </a>

        <div class="nav">
            <?php if (isset($_SESSION['username'])): ?>
                <span>Hi, <?php echo htmlspecialchars($_SESSION['username']); ?></span>

                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 1): ?>
                    <a href="/dse/C-W/Advertising-Website/app/views/admin/dashboard.php" class="btn-admin">Admin Panel</a>
                <?php endif; ?>

                <a href="/dse/C-W/Advertising-Website/app/views/ads/create_ad.php" class="btn-cta">Create Ad</a>
                <a href="/dse/C-W/Advertising-Website/app/views/auth/logout.php">Logout</a>
            <?php else: ?>
                <a href="/dse/C-W/Advertising-Website/app/views/auth/login.php">Login</a>
                <a href="/dse/C-W/Advertising-Website/app/views/auth/register.php" class="btn-cta">Register</a>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>