<?php
define('BASE_URL', 'http://localhost/dse/C-W/Advertising-Website/public/');
define('APPROOT', dirname(__DIR__));
?>

<!DOCTYPE html>
<html>
<head>
    <title>BuySel.lk</title>

    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/header.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/footer.css">
</head>
<body>

<?php require_once APPROOT . '/app/views/layout/header.php'; ?>

<div class="content">
    <h2>Content</h2>
</div>

<?php require_once APPROOT . '/app/views/layout/footer.php'; ?>

</body>
</html>
