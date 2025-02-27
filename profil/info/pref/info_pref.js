let isToggled = false; // État initial du toggle

function goBack(event) {
    event.preventDefault(); // Empêche l'envoi du formulaire
    history.back(); // Revient à la page précédente
}

function toggleSwitch() {
    const container = document.querySelector('.pref__toggle-container');
    container.classList.toggle('active');
    
    // Mettre à jour l'état du toggle
    isToggled = !isToggled;
    const toggleStateInput = document.getElementById('toggleState');
    toggleStateInput.value = isToggled ? 'on' : 'off'; // Met à jour la valeur du champ caché
}
