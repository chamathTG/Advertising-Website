<!DOCTYPE html>
<html>

<head>
    <title>Header</title>
    <link rel="stylesheet" type="text/css" href="\dse\C-W\Advertising-Website\public\assets\css\layout\header.css">
</head>

<body>
    <?php session_start(); ?>
    <div class="head">
        <div class="logo">
            <a href="\dse\C-W\Advertising-Website\public\index.php"><img
                    src="\dse\C-W\Advertising-Website\public\assets\images\BuySelLogo.png" alt="Home"
                    class="home-icon"></a>

        </div>
        <div class="name">
            <a href="\dse\C-W\Advertising-Website\public\index.php">
                <h1>BuySel.lk</h1>
            </a>
        </div>



        <div class="nav">
            <?php if (isset($_SESSION['username'])): ?>
                <span>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
            <?php endif; ?>
            <!--a href="..\..\views\users\view_profile.php">Profile</a-->
            <a href="\dse\C-W\Advertising-Website\app\views\ads\create_ad.php">Create Ad</a>
            <!--a href="..\..\views\ads\view_ads.php" class="active">View Ads</a-->
            <a href="\dse\C-W\Advertising-Website\app\views\auth\login.php">Logout</a>
        </div>



    </div>
</body>

</html>