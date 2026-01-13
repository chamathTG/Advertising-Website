<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="register.css">
</head>
<body>
    <form method="POST" action="/auth/register">
        <div class="register-container">
            <h2>Register</h2>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required minlength="5">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required minlength="8">

            <button type="submit">Register</button>
            <button type="button" onclick="window.location.href='login.php'">Login</button>
            <button type="reset">Clear</button>
        </div>
    </form>
</body>

</html>