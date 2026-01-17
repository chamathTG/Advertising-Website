<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="..\..\..\public\assets\css\auth\register.css">
</head>

<body>



    <form method="POST" action="../../controllers/AuthController.php?action=register">
        <div class="register-container">
            <div class="logo" align="center">
                <img src="..\..\..\public\assets\images\BuySelLogo.png" alt="Logo" class="logo-image">
            </div>
            <h2>Register</h2>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email">

            <label for="password">Password:</label>
            <input type="password" id="password" name="password">

            <button type="submit">Register</button>
            <button type="button" onclick="window.location.href='login.php'">Login</button>
            <button type="reset">Clear</button>
        </div>
    </form>

    <?php include __DIR__ . '/../layout/popup_alert.php'; ?>
</body>

</html>