<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="/styles/main.css">
      <link rel="stylesheet" href="relatives.css">
      <title>Membres Bloqués</title>
</head>

<body>
      <nav class="relatives__navbar">
            <div class="relatives__navbar-header">
                  <div class="relatives__navbar-back">
                        <a href="/index.php" class="relatives__navbar-back-cta">
                              <img src="/img/profil/cta/right-arrow.svg" alt="Fleche gauche"
                                    style="transform: rotate(180deg);">
                        </a>
                  </div>
            </div>
      </nav>

      <div class="relatives">
            <h2>Contacts</h2>
            <input type="text" id="searchInput" placeholder="Rechercher par numéro de téléphone...">
            <div id="contactsList">
                  <div class="contact-item">
                        <img src="/img/contacts/john.jpg" alt="John Doe">
                        <div class="contact-info">
                              <div class="contact-name">John Doe</div>
                              <div class="contact-phone">1234567890</div>
                        </div>
                  </div>
                  <div class="contact-item">
                        <img src="/img/contacts/jane.jpg" alt="Jane Smith">
                        <div class="contact-info">
                              <div class="contact-name">Jane Smith</div>
                              <div class="contact-phone">0987654321</div>
                        </div>
                  </div>
                  <!-- Add more dummy contacts as needed -->
            </div>
      </div>
      <script src="relatives.js"></script>
</body>
</html>
