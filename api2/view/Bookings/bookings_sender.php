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

            </div>
            <h4>Rechercher un trajet</h4>
            <div class="crud__main">
                  <table class="crud__table">
                        <tr>
                              <td class=" crud__table-cell crud__table-cell-header ">Demande</td>
                              <td class=" crud__table-cell crud__table-cell-header ">Itinéraire</td>
                              <td class=" crud__table-cell crud__table-cell-header ">Date et Heure</td>
                              <td class=" crud__table-cell crud__table-cell-header ">Conducteur</td>
                        </tr>
                        <?php foreach ($valid_instances as $instance):
                              $driver = $instance['driver'];
                              $receiver_id = htmlspecialchars($instance['instance']['instances_id']);
                              ?>
                              <tr>
                                    <td class="crud__table-cell">
                                          <div class="crud__table-cta">
                                                <form method="POST"
                                                      action="index.php?page=bookings&mode=add&accounts_id=<?= $account_id ?>&instances_id=<?= $instance_id ?>  "
                                                      style="display:inline;">
                                                      <input type="hidden" name="instances_sender_id"
                                                            value="<?= htmlspecialchars($instance_id) ?>">
                                                      <input type="hidden" name="instances_receiver_id"
                                                            value="<?= $receiver_id ?>">
                                                      <button type="submit"
                                                            class="crud__table-btn crud__table-btn--edit">Faire une
                                                            demande</button>
                                                </form>
                                          </div>
                                    </td>
                                    <td class="crud__table-cell">
                                          <?= htmlspecialchars($instance['route']) ?>
                                    </td>
                                    <td class="crud__table-cell">
                                          <?= htmlspecialchars($instance['time']) ?>
                                    </td>
                                    <td class="crud__table-cell">
                                          <?= htmlspecialchars($driver->fullname()) ?>
                                    </td>
                              </tr>
                        <?php endforeach ?>

                  </table>
            </div>
            <h4>Mes Réservations</h4>
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
                                                <a href="index.php?page=bookings&mode=remove&id=<?= $booking->id() ?>&accounts_id=<?= $account_id?>&instances_id=<?= $instance_id?>"
                                                      class="crud__table-btn crud__table-btn--delete">Supprimer</a>
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
      </div>
</body>

</html>