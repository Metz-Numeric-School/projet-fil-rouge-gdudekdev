document.addEventListener("DOMContentLoaded", function () {
      const modelsSelect = document.getElementById("models");
      const brandSelect = document.getElementById("brands");
    
      function populateModels(brandId) {
        // Vider les options existantes
        modelsSelect.innerHTML = "";
    
        // Filtrer les models par brand
        const filtered = allModels.filter(
          (div) => div.car_brands_id == brandId
        );
    
        // Ajouter les options
        filtered.forEach((div) => {
          const option = document.createElement("option");
          option.value = div.car_models_id;
          option.textContent = div.car_models_name;
          modelsSelect.appendChild(option);
        });
      }
    
      // Initialisation avec division déjà enregistrée
      populateModels(brandSelect.value);
    
      // Mettre à jour quand l'brand change
      brandSelect.addEventListener("change", function () {
        populateModels(this.value);
      });
    });
    