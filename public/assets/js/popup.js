
const errorMessages = {
    "invalid_credentials": {
        title: "Login Failed",
        message: "Invalid username or password.",
        type: "error"
    },
    "empty_fields": {
        title: "Missing Information",
        message: "Please fill in all fields.",
        type: "error"
    },
    "username_taken": {
        title: "Registration Failed",
        message: "Username is already taken.",
        type: "error"
    },
    "username_too_short": {
        title: "Username Too Short",
        message: "Username must be at least 5 characters long.",
        type: "error"
    },
    "password_too_short": {
        title: "Password Too Short",
        message: "Password must be at least 8 characters long.",
        type: "error"
    },
    "invalid_email": {
        title: "Invalid Email",
        message: "Invalid email format.",
        type: "error"
    },
    "default_error": {
        title: "Error",
        message: "An unknown error occurred.",
        type: "error"
    },
    "registration_success": {
        title: "Success",
        message: "Registration successful. Please login.",
        type: "success"
    }
};

function createPopupHTML() {
    if (document.getElementById("popupOverlay")) return;

    const overlay = document.createElement("div");
    overlay.id = "popupOverlay";
    overlay.style.display = "none";

    const box = document.createElement("div");
    box.id = "popupBox";

    const title = document.createElement("h3");
    title.id = "popupTitle";

    const message = document.createElement("p");
    message.id = "popupMessage";

    const button = document.createElement("button");
    button.textContent = "OK";
    button.className = "ok-btn";
    button.onclick = closePopup;

    box.appendChild(title);
    box.appendChild(message);
    box.appendChild(button);
    overlay.appendChild(box);
    document.body.appendChild(overlay);
}

function showPopup(titleText, messageText, type = "error") {
    createPopupHTML();

    const overlay = document.getElementById("popupOverlay");
    const title = document.getElementById("popupTitle");
    const message = document.getElementById("popupMessage");
    const box = document.getElementById("popupBox");
    const okBtn = box.querySelector("button.ok-btn");


    const existingActions = box.querySelector(".popup-actions");
    if (existingActions) existingActions.remove();

    if (overlay && title && message) {
        title.textContent = titleText;
        message.textContent = messageText;


        if (!okBtn) {
            const newOkBtn = document.createElement("button");
            newOkBtn.textContent = "OK";
            newOkBtn.className = "ok-btn";
            newOkBtn.onclick = closePopup;
            box.appendChild(newOkBtn);
        } else {
            okBtn.style.display = "inline-block";
        }

        if (type === "success") {
            title.style.color = "#4CAF50";
            box.querySelector("button").style.backgroundColor = "#4CAF50";
        } else {
            title.style.color = "#d32f2f";
            box.querySelector("button").style.backgroundColor = "#d32f2f";
        }

        overlay.style.display = "flex";
    }
}

function showConfirm(titleText, messageText, onYes) {
    createPopupHTML();

    const overlay = document.getElementById("popupOverlay");
    const title = document.getElementById("popupTitle");
    const message = document.getElementById("popupMessage");
    const box = document.getElementById("popupBox");


    const okBtn = box.querySelector("button.ok-btn") || box.querySelector("button");
    if (okBtn) okBtn.style.display = "none";


    const existingActions = box.querySelector(".popup-actions");
    if (existingActions) existingActions.remove();

    if (overlay && title && message) {
        title.textContent = titleText;
        message.textContent = messageText;
        title.style.color = "#333";

        const actionsDiv = document.createElement("div");
        actionsDiv.className = "popup-actions";
        actionsDiv.style.marginTop = "20px";
        actionsDiv.style.display = "flex";
        actionsDiv.style.justifyContent = "center";
        actionsDiv.style.gap = "10px";

        const yesBtn = document.createElement("button");
        yesBtn.textContent = "Yes";
        yesBtn.style.backgroundColor = "#d32f2f";
        yesBtn.onclick = function () {
            closePopup();
            onYes();
        };

        const cancelBtn = document.createElement("button");
        cancelBtn.textContent = "Cancel";
        cancelBtn.style.backgroundColor = "#9e9e9e";
        cancelBtn.onclick = closePopup;

        actionsDiv.appendChild(yesBtn);
        actionsDiv.appendChild(cancelBtn);
        box.appendChild(actionsDiv);

        overlay.style.display = "flex";
    }
}

function closePopup() {
    const overlay = document.getElementById("popupOverlay");
    if (overlay) {
        overlay.style.display = "none";
    }
}

function handleAuthErrors(errorCode, successMessage = null) {
    if (successMessage) {
        showPopup("Success", successMessage, "success");
        return;
    }

    if (errorCode) {
        const error = errorMessages[errorCode] || errorMessages["default_error"];
        showPopup(error.title, error.message, error.type);
    }
}

document.addEventListener("DOMContentLoaded", () => {
    if (window.authConfig) {
        handleAuthErrors(window.authConfig.error, window.authConfig.success);
    }
});