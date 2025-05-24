<?php

use Src\Entity\Bookings;
include_once ROOT . "/view/template/header_template.php";
?>

<body>
      <div class="container">

            <div class="crud__header">
                  <div class="crud__header-cta">
                        <a href="index.php?page=instances&accounts_id=<?= $account_id ?>" class="crud__table-btn">
                              <\Retour </a>

                  </div>
                  <h2><?= ucfirst($title) ?></h2>
                  <h3>Nombre de place restantes : <strong><?= $remaining_seats?></strong></h3>

            </div>
            <h4>Réservations validés pour ce trajet</h4>
            <div class="crud__main">
                  <table class="crud__table">
                        <tr>
                              <td class=" crud__table-cell crud__table-cell-header ">Actions</td>
                              <td class=" crud__table-cell crud__table-cell-header ">Date et Heure</td>
                              <td class=" crud__table-cell crud__table-cell-header ">Conducteur</td>
                        </tr>
                        <?php foreach ($accepted_bookings as $booking):
                              $sender = $booking['sender'];
                              ?>
                              <tr>
                                    <td class="crud__table-cell">
                                          <div class="crud__table-cta">
                                                <a href="index.php?page=bookings&id=<?= htmlspecialchars($booking['booking']['bookings_id']) ?>&status=refused&accounts_id=<?= $account_id ?>&instances_id=<?= $instance_id ?>"
                                                      class="crud__table-btn crud__table-btn--delete">Supprimer</a>
                                          </div>
                                    </td>
                                    <td class="crud__table-cell">
                                          <?= htmlspecialchars($booking['time']) ?>
                                    </td>
                                    <td class="crud__table-cell">
                                          <?= htmlspecialchars($sender->fullname()) ?>
                                    </td>
                              </tr>
                        <?php endforeach ?>

                  </table>
            </div>
            <div class="crud__main">
                  <table class="crud__table">
                        <tr>
                              <td class=" crud__table-cell crud__table-cell-header ">Actions</td>
                              <?php foreach (Bookings::$array_accepted_key as $field):
                                    if ($field['crud_show']) { ?>
                                          <td class=" crud__table-cell crud__table-cell-header "> <?= $field['title'] ?></td>
                                    <?php } ?>
                              <?php endforeach ?>
                        </tr>
                        <?php foreach ($bookings as $booking):
                              $booking = new Bookings($booking) ?>

                              <tr>
                                    <td class="crud__table-cell">
                                          <div class="crud__table-cta">
                                                <a href="index.php?page=bookings&id=<?= $booking->id() ?>&status=accepted&accounts_id=<?= $account_id ?>&instances_id=<?= $instance_id ?>"
                                                      class="crud__table-btn crud__table-btn--edit">Accepter</a>
                                                <a href="index.php?page=bookings&id=<?= $booking->id() ?>&status=refused&accounts_id=<?= $account_id ?>&instances_id=<?= $instance_id ?>"
                                                      class="crud__table-btn crud__table-btn--delete">Refuser</a>
                                          </div>
                                    </td>
                                    <?php foreach (Bookings::$array_accepted_key as $key => $value):
                                          if ($value['crud_show']) {
                                                $method = str_replace('bookings_', '', $key) ?>
                                                <td class="crud__table-cell"><?= $booking->$method() ?></td>
                                          <?php } ?>
                                    <?php endforeach ?>
                              </tr>
                        <?php endforeach ?>
                  </table>
            </div>
            <h4>Réservations refusées pour ce trajet</h4>
            <div class="crud__main">
                  <table class="crud__table">
                        <tr>
                              <td class=" crud__table-cell crud__table-cell-header ">Actions</td>
                              <td class=" crud__table-cell crud__table-cell-header ">Date et Heure</td>
                              <td class=" crud__table-cell crud__table-cell-header ">Conducteur</td>
                        </tr>
                        <?php foreach ($refused_bookings as $booking):
                              $sender = $booking['sender'];
                              ?>
                              <tr>
                                    <td class="crud__table-cell">
                                          <div class="crud__table-cta">
                                                <a href="index.php?page=bookings&id=<?= htmlspecialchars($booking['booking']['bookings_id']) ?>&status=accepted&accounts_id=<?= $account_id ?>&instances_id=<?= $instance_id ?>"
                                                      class="crud__table-btn crud__table-btn--edit">Accepter</a>
                                          </div>
                                    </td>
                                    <td class="crud__table-cell">
                                          <?= htmlspecialchars($booking['time']) ?>
                                    </td>
                                    <td class="crud__table-cell">
                                          <?= htmlspecialchars($sender->fullname()) ?>
                                    </td>
                              </tr>
                        <?php endforeach ?>

                  </table>
            </div>
      </div>
</body>

</html>