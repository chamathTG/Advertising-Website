<html>

<head>
    <title>Create Ad</title>
    <link rel="stylesheet" type="text/css" href="/dse/C-W/Advertising-Website/public/assets/css/ads/create_ad.css">
</head>

<body>

    <div class="create-ad-container">
        <a href="/dse/C-W/Advertising-Website/public/index.php" class="close-btn">&times;</a>
        <h2>Create a New Advertisement</h2>



        <form method="POST" action="../../controllers/AdController.php?action=create" enctype="multipart/form-data">
            <label for="title">Advertisement Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" required>

            <label for="image">Upload Image:</label>
            <input type="file" id="image" name="image" accept="image/*">

            <button type="submit">Create Ad</button>
            <button type="reset">Clear</button>
        </form>
    </div>

    <?php include __DIR__ . '/../layout/popup_alert.php'; ?>
</body>

</html>