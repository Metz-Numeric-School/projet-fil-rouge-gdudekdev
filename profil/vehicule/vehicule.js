function selectChoice(choice, nextPage) {
  const form = document.createElement('form');
  form.method = 'POST';
  form.action = nextPage;

  // Ajouter les valeurs de marque et modèle si elles existent
  const marqueInput = document.createElement('input');
  marqueInput.type = 'hidden';
  marqueInput.name = 'marque';
  marqueInput.value = document.querySelector('input[name="marque"]') ? document.querySelector('input[name="marque"]').value : '';

  const modeleInput = document.createElement('input');
  modeleInput.type = 'hidden';
  modeleInput.name = 'modele';
  modeleInput.value = document.querySelector('input[name="modele"]') ? document.querySelector('input[name="modele"]').value : '';

  // Ajouter la couleur ou la motorisation sélectionnée
  const choixInput = document.createElement('input');
  choixInput.type = 'hidden';
  choixInput.name = nextPage === 'motorisation.php' ? 'couleur' : 'motorisation';
  choixInput.value = choice;

  // Ajouter les champs au formulaire
  form.appendChild(marqueInput);
  form.appendChild(modeleInput);
  form.appendChild(choixInput);

  // Ajouter le formulaire au document et le soumettre
  document.body.appendChild(form);
  form.submit();
}

function skipStep() {
  const form = document.createElement('form');
  form.method = 'POST';
  form.action = 'confirmation.php';

  // Ajouter les valeurs de marque, modèle, couleur et motorisation
  const marqueInput = document.createElement('input');
  marqueInput.type = 'hidden';
  marqueInput.name = 'marque';
  marqueInput.value = document.querySelector('input[name="marque"]').value;

  const modeleInput = document.createElement('input');
  modeleInput.type = 'hidden';
  modeleInput.name = 'modele';
  modeleInput.value = document.querySelector('input[name="modele"]').value;

  const couleurInput = document.createElement('input');
  couleurInput.type = 'hidden';
  couleurInput.name = 'couleur';
  couleurInput.value = document.querySelector('input[name="couleur"]').value;

  const motorisationInput = document.createElement('input');
  motorisationInput.type = 'hidden';
  motorisationInput.name = 'motorisation';
  motorisationInput.value = document.querySelector('input[name="motorisation"]').value;

  // Ajouter les champs au formulaire
  form.appendChild(marqueInput);
  form.appendChild(modeleInput);
  form.appendChild(couleurInput);
  form.appendChild(motorisationInput);

  // Ajouter le formulaire au document et le soumettre
  document.body.appendChild(form);
  form.submit();
}

function filterChoices(searchId, choicesId) {
  const input = document.getElementById(searchId);
  const filter = input.value.toLowerCase();
  const ul = document.getElementById(choicesId);
  const li = ul.getElementsByTagName('li');

  for (let i = 0; i < li.length; i++) {
      const txtValue = li[i].textContent || li[i].innerText;
      if (txtValue.toLowerCase().indexOf(filter) > -1) {
          li[i].style.display = '';
      } else {
          li[i].style.display = 'none';
      }
  }
}
