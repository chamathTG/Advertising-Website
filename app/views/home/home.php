<div class="hero-section">

    <div class="hero-blob blob-1"></div>
    <div class="hero-blob blob-2"></div>

    <div class="hero-content">

        <h1 class="hero-title">Discover Amazing Deals Near You</h1>
        <p class="hero-subtitle">The smartest way to buy and sell electronics, vehicles and more. Simple, fast, and secure.</p>

        <div class="hero-search-container">

            <form action="<?php echo URLROOT; ?>/index.php" method="GET" style="display: flex; width: 100%; margin: 0;">

                <input type="text" name="query" class="hero-search-input" placeholder="What are you looking for today?">
                <button type="submit" class="hero-search-btn">Search</button>

            </form>

        </div>

    </div>

</div>

<div class="container">

    <?php

        require_once APPROOT . '/Views/ads/ad_list_component.php'; 

    ?>

</div>
