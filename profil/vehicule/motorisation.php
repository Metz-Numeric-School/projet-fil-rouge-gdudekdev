<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="vehicule.css">
    <title>Motorisation</title>
</head>

<body>
    <nav class="navbar">
        <div class="navbar__header">
            <div class="navbar__back">
                <a href="couleur.php" class="navbar__back-cta">
                    <img src="/img/profil/cta/right-arrow.svg" alt="Flèche gauche" style="transform: rotate(180deg);">
                </a>
            </div>
        </div>
    </nav>
    <main>
        <form action="immatriculation.php" method="POST">
            <h2>Quelle est la motorisation de votre véhicule ?</h2>
            <input type="hidden" name="marque" value="<?php echo htmlspecialchars($_POST['marque']); ?>">
            <input type="hidden" name="modele" value="<?php echo htmlspecialchars($_POST['modele']); ?>">
            <input type="hidden" name="couleur" value="<?php echo htmlspecialchars($_POST['couleur']); ?>">
            <div>
                <label><input type="radio" name="motorisation" value="Essence" onclick="selectChoice('Essence', 'immatriculation.php')"> Essence</label>
                <label><input type="radio" name="motorisation" value="Diesel" onclick="selectChoice('Diesel', 'immatriculation.php')"> Diesel</label>
                <label><input type="radio" name="motorisation" value="Hybride" onclick="selectChoice('Hybride', 'immatriculation.php')"> Hybride</label>
                <label><input type="radio" name="motorisation" value="Électrique" onclick="selectChoice('Électrique', 'immatriculation.php')"> Électrique</label>
            </div>
        </form>
    </main>
    <script src="vehicule.js"></script>
</body>

</html>
