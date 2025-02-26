<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="vehicule.css">
    <title>Confirmation</title>
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
        <h2>Récapitulatif de votre choix</h2>
        <ul>
            <li><strong>Marque :</strong> <?php echo htmlspecialchars($_POST['marque']); ?></li>
            <li><strong>Modèle :</strong> <?php echo htmlspecialchars($_POST['modele']); ?></li>
            <li><strong>Couleur :</strong> <?php echo htmlspecialchars($_POST['couleur']); ?></li>
            <li><strong>Motorisation :</strong> <?php echo htmlspecialchars($_POST['motorisation']); ?></li>
            <li><strong>Immatriculation :</strong> <?php echo htmlspecialchars($_POST['immatriculation'] ?? 'Non spécifiée'); ?></li>
        </ul>
        <a href="/profil.php" class="button">Retour au profil</a>
    </main>
</body>

</html>
