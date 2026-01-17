document.addEventListener("DOMContentLoaded", function () {
    var modal = document.getElementById("reportModal");
    var btn = document.getElementById("reportBtn");
    var span = document.getElementsByClassName("close")[0];

    if (btn && modal) {
        btn.onclick = function () {
            if (!window.isLoggedIn) {
                window.location.href = "/dse/C-W/Advertising-Website/app/views/auth/login.php";
            } else {
                modal.style.display = "block";
            }
        }
    }

    if (span && modal) {
        span.onclick = function () {
            modal.style.display = "none";
        }
    }

    if (modal) {
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    }
});
