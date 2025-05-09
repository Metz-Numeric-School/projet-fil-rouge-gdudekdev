document.addEventListener("DOMContentLoaded", function () {
      const divisionsSelect = document.getElementById("divisions");
      const entrepriseSelect = document.getElementById("account_entreprises");
    
      function populateDivisions(entrepriseId, selectedDivisionId = null) {
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
          if (div.divisions_id == selectedDivisionId) {
            option.selected = true;
          }
          divisionsSelect.appendChild(option);
        });
      }
    
      // Initialisation avec division déjà enregistrée
      populateDivisions(entrepriseSelect.value, savedDivisionId);
    
      // Mettre à jour quand l'entreprise change
      entrepriseSelect.addEventListener("change", function () {
        populateDivisions(this.value);
      });
    });
console.log('test');
