function confirmLogout() {
    showConfirm("Confirm Logout", "Are you sure you want to log out?", function () {
        window.location.href = "/dse/C-W/Advertising-Website/app/views/auth/logout.php";
    });
}
