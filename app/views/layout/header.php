<?php

    if (session_status() == PHP_SESSION_NONE)
    {
        session_start();
    }

?>

<div class="head">

    <a href="<?php echo URLROOT; ?>/index.php" class="logo-section">

        <img src="<?php echo URLROOT; ?>/assets/images/BuySelLogo.png" alt="BuySell.lk" class="home-icon">
        <h1 class="brand-name">BuySell.lk</h1>

    </a>

    <div class="nav">

        <?php if (isset($_SESSION['username'])): ?>

            <span>Hi, <?php echo htmlspecialchars($_SESSION['username']); ?></span>

            <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 1): ?>

                <a href="<?php echo URLROOT; ?>/../App/Views/admin/dashboard.php" class="btn-admin">Admin Panel</a>

            <?php endif; ?>

            <a href="<?php echo URLROOT; ?>/../App/Views/ads/create_ad.php" class="btn-cta">Create Ad</a>
            <a href="<?php echo URLROOT; ?>/../App/Views/auth/logout.php">Logout</a>

        <?php else: ?>

            <a href="<?php echo URLROOT; ?>/../App/Views/auth/login.php" class="login-link">Login</a>
            <a href="<?php echo URLROOT; ?>/../App/Views/auth/register.php" class="btn-cta">Register</a>

        <?php endif; ?>

    </div>

</div>