<?php

    require_once '../App/config/config.php';

?>

<!DOCTYPE html>
<html>

    <head>

        <title><?php echo SITENAME; ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/assets/css/home/home.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/assets/css/layout/header.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/assets/css/layout/layout.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/assets/css/layout/footer.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/assets/css/ads/view_ads.css">

    </head>
    
    <body>

        <?php require_once APPROOT . '/Views/layout/header.php'; ?>
        <?php require_once APPROOT . '/Views/home/home.php'; ?>
        <?php require_once APPROOT . '/Views/layout/footer.php'; ?>

    </body>

</html>
