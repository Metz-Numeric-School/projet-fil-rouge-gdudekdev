<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="vehicule.css">
    <title>Couleur</title>
</head>

<body>
    <nav class="navbar">
        <div class="navbar__header">
            <div class="navbar__back">
                <a href="modele.php" class="navbar__back-cta">
                    <img src="/img/profil/cta/right-arrow.svg" alt="Flèche gauche" style="transform: rotate(180deg);">
                </a>
            </div>
        </div>
    </nav>
    <main>
        <form id="colorForm" action="motorisation.php" method="POST">
            <h2>Quelle est la couleur de votre véhicule ?</h2>
            <input type="hidden" name="marque" value="<?php echo htmlspecialchars($_POST['marque']); ?>">
            <input type="hidden" name="modele" value="<?php echo htmlspecialchars($_POST['modele']); ?>">
            <button type="submit" id="couleur" style="display: none;">Soumettre</button>
            <div class="color-option" onclick="selectChoice('Rouge', 'motorisation.php')">
                <div class="color-square" style="background-color: red;"></div>
                <span>Rouge</span>
            </div>
            <div class="color-option" onclick="selectChoice('Bleu', 'motorisation.php')">
                <div class="color-square" style="background-color: blue;"></div>
                <span>Bleu</span>
            </div>
            <div class="color-option" onclick="selectChoice('Vert', 'motorisation.php')">
                <div class="color-square" style="background-color: green;"></div>
                <span>Vert</span>
            </div>
            <div class="color-option" onclick="selectChoice('Noir', 'motorisation.php')">
                <div class="color-square" style="background-color: black;"></div>
                <span>Noir</span>
            </div>
            <div class="color-option" onclick="selectChoice('Blanc', 'motorisation.php')">
                <div class="color-square" style="background-color: white; border: 1px solid #ccc;"></div>
                <span>Blanc</span>
            </div>
        </form>
    </main>
    <script src="vehicule.js"></script>
</body>

</html>
