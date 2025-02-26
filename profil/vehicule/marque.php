<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="vehicule.css">
    <title>Marque</title>
</head>

<body>
    <nav class="navbar">
        <div class="navbar__header">
            <div class="navbar__back">
                <a href="/profil.php" class="navbar__back-cta">
                    <img src="/img/profil/cta/right-arrow.svg" alt="Flèche gauche" style="transform: rotate(180deg);">
                </a>
            </div>
        </div>
    </nav>
    <main>
        <form action="modele.php" method="POST">
            <h2>Quelle est la marque de votre véhicule ?</h2>
            <input type="text" id="search1" placeholder="Recherchez une marque..." oninput="filterChoices('search1', 'choices1')" />
            <ul id="choices1" class="choices">
                <li onclick="selectChoice('CITROEN', 'modele.php')">CITROEN</li>
                <li onclick="selectChoice('FORD', 'modele.php')">FORD</li>
                <li onclick="selectChoice('PEUGEOT', 'modele.php')">PEUGEOT</li>
            </ul>
            <button type="submit" id="marque" style="display: none;">Suivant</button>
        </form>
    </main>
    <script src="vehicule.js"></script>
</body>

</html>
