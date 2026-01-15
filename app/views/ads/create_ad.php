<html>
    <head>
        <title>Create Ad</title>
        <link rel="stylesheet" type="text/css" href="\dse\C-W\Advertising-Website\public\assets\css\ads\create_ad.css">
    </head>
    <body>
        <?php session_start(); ?>
        <?php include '../layout/header.php'; ?>

        <div class="create-ad-container">
            <h2>Create a New Advertisement</h2>

            <?php if (isset($_SESSION['error'])): ?>
                <p style="color: red;"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></p>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <p style="color: green;"><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></p>
            <?php endif; ?>

        <form method="POST" action="..\..\controllers\AdController.php?action=create" enctype="multipart/form-data">
            <label for="title">Advertisement Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" required>

            <label for="image">Upload Image:</label>
            <input type="file" id="image" name="image" accept="image/*">

            <button type="submit">Create Ad</button>
        </form>
        </div>
    </body>

</html>