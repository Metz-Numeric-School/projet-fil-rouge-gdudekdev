document.addEventListener("DOMContentLoaded", function () {
      const divisionsSelect = document.getElementById("divisions");
      const entrepriseSelect = document.getElementById("account_entreprises");
    
      function populateDivisions(entrepriseId) {
        // Vider les options existantes
        divisionsSelect.innerHTML = "";
    
        // Filtrer les divisions par entreprise
        const filtered = allDivisions.filter(
          (div) => div.entreprises_id == entrepriseId
        );
    
        // Ajouter les options
        filtered.forEach((div) => {
          const option = document.createElement("option");
          option.value = div.divisions_id;
          option.textContent = div.divisions_name;
          divisionsSelect.appendChild(option);
        });
      }
    
      // Initialisation avec division déjà enregistrée
      populateDivisions(entrepriseSelect.value);
    
      // Mettre à jour quand l'entreprise change
      entrepriseSelect.addEventListener("change", function () {
        populateDivisions(this.value);
      });
    });
    