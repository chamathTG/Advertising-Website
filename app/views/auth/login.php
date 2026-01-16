<?php
session_start();
$error = $_SESSION['error'] ?? null;
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="\dse\C-W\Advertising-Website\public\assets\css\auth\login.css">
</head>

<body>
    <?php if ($error): ?>
        <div id="popupOverlay">
            <div id="popupBox">

                <?php if ($error === "invalid_credentials"): ?>
                    <h3>Login Failed</h3>
                    <p>Invalid username or password.</p>
                <?php elseif ($error === "empty_fields"): ?>
                    <h3>Missing Information</h3>
                    <p>Please fill in all fields.</p>
                <?php endif; ?>

                <button onclick="closePopup()">OK</button>
            </div>
        </div>
    <?php endif; ?>


    <form method="POST" action="\dse\C-W\Advertising-Website\app\controllers\AuthController.php?action=login">
        <div class="login-container">
            <div class="logo" align="center">
                <img src="\dse\C-W\Advertising-Website\public\assets\images\BuySelLogo.png" alt="Logo" class="logo-image">
            </div>
            <h2>Login</h2>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username">

            <label for="password">Password:</label>
            <input type="password" id="password" name="password">

            <button type="submit">Login</button>
            <button type="button" onclick="window.location.href='register.php'">Register</button>
            <button type="reset">Clear</button>
        </div>

    </form>


    <script>
        function closePopup() {
            document.getElementById("popupOverlay").style.display = "none";
        }
    </script>


</body>

</html>