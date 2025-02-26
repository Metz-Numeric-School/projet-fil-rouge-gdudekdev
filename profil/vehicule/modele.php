<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="vehicule.css">
    <title>Modèle</title>
</head>

<body>
    <nav class="navbar">
        <div class="navbar__header">
            <div class="navbar__back">
                <a href="marque.php" class="navbar__back-cta">
                    <img src="/img/profil/cta/right-arrow.svg" alt="Flèche gauche" style="transform: rotate(180deg);">
                </a>
            </div>
        </div>
    </nav>
    <main>
        <form action="couleur.php" method="POST">
            <h2>Quel est le modèle de votre véhicule ?</h2>
            <input type="hidden" name="marque" value="<?php echo htmlspecialchars($_POST['marque']); ?>">
            <input type="text" id="search2" placeholder="Recherchez un modèle..." oninput="filterChoices('search2', 'choices2')" />
            <ul id="choices2" class="choices">
                <li onclick="selectChoice('C3', 'couleur.php')">C3</li>
                <li onclick="selectChoice('FOCUS', 'couleur.php')">FOCUS</li>
                <li onclick="selectChoice('208', 'couleur.php')">208</li>
            </ul>
            <button type="submit" id="modele" style="display: none;">Suivant</button>
        </form>
    </main>
    <script src="vehicule.js"></script>
</body>

</html>
