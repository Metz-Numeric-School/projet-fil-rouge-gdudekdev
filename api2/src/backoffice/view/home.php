<?php
$title = "Page d'accueil";
include_once __DIR__ . "/../../../template/header_template.php";

const TABLE_GROUP = [
      'users' => [
            'accounts',
            'companies',
            'plannings',
            'preferences',
            'routes'
      ],
      'rides' => [
            'rides',
            'bookings',

      ],
      'chats' => [
            'chats',
            'messages'
      ],
      'car' => [
            'vehicules',
            'car_brands',
            'car_colors',
            'car_models'
      ],
      'others' => [
            'ratings'
      ]
];
const TABLE_GROUP_NAME = [
      'users' => 'Utilisateurs',
      'rides' => 'Trajets',
      'chats' => 'Conversations',
      'car' => 'Vehicules',
      'others' => 'Autres',
];

const TABLE_CONFIG = [
      'accounts' => 'Utilisateurs',
      'rides' => 'Trajets',
      'chats' => 'Conversations',
      'messages' => 'Messages',
      'bookings' => 'Réservations',
      'vehicules' => 'Véhicules',
      'companies' => 'Entreprises',
      'routes' => 'Itineraires',
      'ratings' => 'Notes',
      'preferences' => 'Préférences',
      'plannings' => 'Plannings',
      'car_brands' => 'Marques',
      'car_colors' => 'Couleurs',
      'car_models' => 'Modèles',
];

?>

<body>
      <div class="container">
            <div class="accueil__header">
                  <h1>Accueil du Back-office Carpool</h1>
                  <div class="accueil__header-links">

                        <a href="index.php?page=logout" class="accueil__header-link">
                              <p>Se déconnecter</p>
                        </a>
                        <a href="/test.php" class="accueil__header-link">
                              <p>Test</p>
                        </a>
                  </div>

            </div>
            <div class="accueil__action">
                  <ul class="accueil__group-list">
                        <?php foreach (TABLE_GROUP as $key => $value) : ?> <li>
                                    <ul class="accueil__group-item">
                                          <h3><?= TABLE_GROUP_NAME[$key] ?></h3>
                                          <?php foreach ($value as $table): ?>
                                                <li><?= "<a href='/index.php?page=crud&table=" . $table . "'>" . TABLE_CONFIG[$table] . "</a>" ?></li>
                                          <?php endforeach ?>
                                    </ul>
                              </li>
                        <?php endforeach ?>
                  </ul>


            </div>
      </div>
</body>

</html>