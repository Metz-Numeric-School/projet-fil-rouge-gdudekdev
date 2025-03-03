document.addEventListener('DOMContentLoaded', function () {
    let unblockButtons = document.getElementsByClassName('block__unblock-button');
    for (let i = 0; i < unblockButtons.length; i++) {
        unblockButtons[i].addEventListener('click', function () {
            let memberItem = this.closest('.block__main-item');
            memberItem.style.display = 'none';
            // Add AJAX request here to update the server about the unblock action
        });
    }
});
