<?php
session_start();
$error = $_SESSION['error'] ?? null;
unset($_SESSION['error']);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="..\..\..\public\assets\css\auth\register.css">
</head>

<body>

    <?php if ($error): ?>
        <div id="popupOverlay">
            <div id="popupBox">

                <?php if ($error === "username_taken"): ?>
                    <h3>Registration Failed</h3>
                    <p>Username is already taken.</p>
                <?php elseif ($error === "empty_fields"): ?>
                    <h3>Missing Information</h3>
                    <p>Please fill in all fields.</p>
                <?php elseif ($error === "username_too_short"): ?>
                    <h3>Username Too Short</h3>
                    <p>Username must be at least 5 characters long.</p>
                <?php elseif ($error === "password_too_short"): ?>
                    <h3>Password Too Short</h3>
                    <p>Password must be at least 8 characters long.</p>
                <?php elseif ($error === "invalid_email"): ?>
                    <h3>Invalid Email</h3>
                    <p>Invalid email format.</p>
                <?php endif; ?>

                <button onclick="closePopup()">OK</button>
            </div>
        </div>
    <?php endif; ?>

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
    <script>
        function closePopup() {
            document.getElementById("popupOverlay").style.display = "none";
        }
    </script>
</body>

</html>