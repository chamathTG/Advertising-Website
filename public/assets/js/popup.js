function closePopup() {
    const popup = document.getElementById('sucessModel');
    if (popup) {
        popup.style.display = 'none';
    }
}

function showPopup(message) {
    const popup = document.getElementById('sucessModel');
    if (popup) {
        popup.style.display = 'flex';
        const messageBox = popup.querySelector('p');
        if (messageBox && message) {
            messageBox.textContent = message;
        }
    }
    else {
        console.error('Popup element not found');
    }
}