<!DOCTYPE html>
<html>

<head>
    <title>View Ads</title>
    <link rel="stylesheet" type="text/css" href="..\..\..\public\assets\css\ads\view_ads.css">
</head>

<body>

    <div class="head">
        <div class="logo">
            <a href="..\..\views\ads\view_ads.php"><img src="..\..\..\public\assets\images\BuySelLogo.png" alt="Home"
                    class="home-icon"></a>
        </div>
        <div class="name">
            <a href="..\..\views\ads\view_ads.php"><h1>BuySel.lk</h1></a>
        </div>
        <div class="nav">
            <!--a href="..\..\views\users\view_profile.php">Profile</a-->
            <a href="..\..\views\ads\create_ad.php">Create Ad</a>
            <!--a href="..\..\views\ads\view_ads.php" class="active">View Ads</a-->
            <a href="..\..\views/auth/login.php">Logout</a>
        </div>

    </div>
    <h2>View Ads</h2>

    <div class="ad-list">
        <?php
        // Sample data for ads
        $ads = [
            ['title' => 'iPhone 12 for Sale', 'description' => 'A slightly used iPhone 12 in good condition.', 'price' => '$600'],
            ['title' => 'Mountain Bike', 'description' => 'A sturdy mountain bike suitable for all terrains.', 'price' => '$300'],
            ['title' => 'Gaming Laptop', 'description' => 'High-performance laptop for gaming and work.', 'price' => '$1200'],
        ];

        // Display each ad
        foreach ($ads as $ad) {
            echo '<div class="ad-item">';
            echo '<h3>' . htmlspecialchars($ad['title']) . '</h3>';
            echo '<p>' . htmlspecialchars($ad['description']) . '</p>';
            echo '<p class="price">' . htmlspecialchars($ad['price']) . '</p>';
            echo '</div>';
        }
        ?>
    </div>
    <div class="footer">
        <p>&copy; 2024 BuySel. All rights reserved.</p>
    </div>
    <div class="scroll-top">
        <a href="#top"><img src="..\..\assets\images\up-arrow.png" alt="Scroll to Top" class="up-arrow-icon"></a>
    </div>
</body>

</html>