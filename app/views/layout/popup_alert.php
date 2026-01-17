<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$error = $_SESSION['error'] ?? null;
$success = $_SESSION['success'] ?? null;
unset($_SESSION['error']);
unset($_SESSION['success']);
?>
<link rel="stylesheet" href="/dse/C-W/Advertising-Website/public/assets/css/popup.css">
<script src="/dse/C-W/Advertising-Website/public/assets/js/popup.js"></script>
<script src="/dse/C-W/Advertising-Website/public/assets/js/generic.js"></script>
<script>
    window.authConfig = {
        error: "<?php echo $error; ?>",
        success: "<?php echo $success; ?>"
    };
</script>