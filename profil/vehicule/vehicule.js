document.addEventListener("DOMContentLoaded", function () {
      const forms = document.querySelectorAll('.form__etape');
      const backButton = document.querySelector('.navbar__back-cta');
      const recapStep = document.getElementById("recap");
      const recapContent = document.querySelector(".form__recap-content");
      const submitButton = document.querySelector(".form__submit");
  
      let currentStepIndex = 0;
  
      function showStep(index) {
          forms.forEach((form, i) => {
              form.style.display = i === index ? "block" : "none";
          });
          currentStepIndex = index;
      }
  
      showStep(0);
  
      forms.forEach((form, index) => {
          if (form.id !== "recap") {
              const choix = form.querySelectorAll(".form__choix");
  
              choix.forEach((item) => {
                  item.addEventListener("click", () => {
                      const choixValue = item.querySelector("p").innerText;
  
                      let hiddenInput = form.querySelector(`input[type="hidden"][name="${form.id}"]`);
                      if (!hiddenInput) {
                          hiddenInput = document.createElement("input");
                          hiddenInput.type = "hidden";
                          hiddenInput.name = form.id;
                          form.appendChild(hiddenInput);
                      }
  
                      hiddenInput.value = choixValue;
  
                      if (index < forms.length - 2) {
                          showStep(index + 1);
                      } else {
                          fillRecap();
                          showStep(forms.length - 1);
                      }
                  });
              });
          }
      });
  
      backButton.addEventListener("click", (event) => {
          event.preventDefault();
          if (currentStepIndex > 0) {
              showStep(currentStepIndex - 1);
          } else {
              window.location.href = "/profil.php";
          }
      });
  
      function fillRecap() {
          recapContent.innerHTML = "";
          forms.forEach((form) => {
              if (form.id !== "recap") {
                  let hiddenInput = form.querySelector(`input[type="hidden"][name="${form.id}"]`);
                  if (hiddenInput) {
                      let recapItem = document.createElement("p");
                      recapItem.innerHTML = `<strong>${form.id} :</strong> ${hiddenInput.value}`;
                      recapContent.appendChild(recapItem);
                  }
              }
          });
      }
  
      // 🚀 Rediriger vers le menu après validation
      submitButton.addEventListener("click", (event) => {
          event.preventDefault(); // Empêche l'envoi réel du formulaire
          window.location.href = "/profil.php"; // Redirige vers le menu
      });
  });
  