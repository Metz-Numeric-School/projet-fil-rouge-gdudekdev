const passagerTab = document.querySelector(".navbar__tab-passager");
const conducteurTab = document.querySelector(".navbar__tab-conducteur");
const historiqueContent = document.querySelector(".historique__content p");


passagerTab.addEventListener("click", () => {
  // Vérifie si l'onglet Passager n'est pas déjà actif
  if (!passagerTab.classList.contains("active")) {
    // Change la classe active
    passagerTab.classList.add("active");
    conducteurTab.classList.remove("active");
    // Met à jour le contenu
    historiqueContent.textContent = "Historique des trajets pour le passager.";
  }
});

conducteurTab.addEventListener("click", () => {
  // Vérifie si l'onglet Conducteur n'est pas déjà actif
  if (!conducteurTab.classList.contains("active")) {
    // Change la classe active
    conducteurTab.classList.add("active");
    passagerTab.classList.remove("active");
    // Met à jour le contenu
    historiqueContent.textContent =
      "Historique des trajets pour le conducteur.";
  }
});
