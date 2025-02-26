<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="vehicule.css">
    <title>Immatriculation</title>
</head>

<body>
    <nav class="navbar">
        <div class="navbar__header">
            <div class="navbar__back">
                <a href="motorisation.php" class="navbar__back-cta">
                    <img src="/img/profil/cta/right-arrow.svg" alt="Flèche gauche" style="transform: rotate(180deg);">
                </a>
            </div>
        </div>
    </nav>
    <main>
        <form id="immatriculationForm" action="confirmation.php" method="POST">
            <h2>Entrez votre plaque d'immatriculation</h2>
            <input type="hidden" name="marque" value="<?php echo htmlspecialchars($_POST['marque']); ?>">
            <input type="hidden" name="modele" value="<?php echo htmlspecialchars($_POST['modele']); ?>">
            <input type="hidden" name="couleur" value="<?php echo htmlspecialchars($_POST['couleur']); ?>">
            <input type="hidden" name="motorisation" value="<?php echo htmlspecialchars($_POST['motorisation']); ?>">
            <input type="text" name="immatriculation" placeholder="Plaque d'immatriculation (facultatif)">
            <button type="submit">Suivant</button>
            <button type="button" onclick="skipStep()">Passer</button>
        </form>
    </main>
    <script src="vehicule.js"></script>
</body>

</html>
