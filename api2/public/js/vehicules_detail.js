document.addEventListener("DOMContentLoaded", function () {
      const modelsSelect = document.getElementById("models");
      const brandSelect = document.getElementById("brands");
    
      function populateModels(brandId, selectedmodelId = null) {
        modelsSelect.innerHTML = "";

        const filtered = allModels.filter(
          (div) => div.car_brands_id == brandId
        );
        console.log(brandId)
        // Ajouter les options
        filtered.forEach((div) => {
          const option = document.createElement("option");
          option.value = div.car_models_id;
          option.textContent = div.car_models_name;
          if (div.car_models_id === selectedmodelId) {
            option.selected = true;
          }
          modelsSelect.appendChild(option);
        });
      }
    
      // Initialisation avec model déjà enregistrée
      populateModels(brandSelect.value, savedModelId);
      
      // Mettre à jour quand l'brand change
      brandSelect.addEventListener("change", function () {
        populateModels(this.value);
      });
    });