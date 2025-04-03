<?php

namespace App\Controllers\Users;

use App\Models\Users;

class Users_Form
{
    public function handleRequest()
    {
        $usersModel = new Users();
        $editing = false;
        $user = ['id' => '', 'name' => '', 'email' => '', 'password' => ''];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = isset($_POST['id']) && !empty($_POST['id']) ? 'update' : 'create';
            $data = [
                'id' => $_POST['id'] ?? null,
                'name' => $_POST['name'] ?? '',
                'email' => $_POST['email'] ?? '',
                'password' => password_hash($_POST['password'] ?? '', PASSWORD_BCRYPT),
            ];

            $result = $usersModel->handleAction($action, $data);

            // Redirect or display a message based on the result
            header('Location: ../index.php?page=users&message=' . urlencode($result['message']));
            exit;
        }

        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $editing = true;
            $user = $usersModel->getById((int)$_GET['id']);
        }
        ?>

        <div class="container mt-5">
            <h2 class="mb-4 text-center"><?= $editing ? 'Modifier' : 'Ajouter' ?> un utilisateur</h2>

            <form action="" method="POST">
                <?php if ($editing): ?>
                    <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">
                <?php endif; ?>

                <div class="mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control" <?= $editing ? '' : 'required' ?>>
                </div>

                <button type="submit" class="btn btn-<?= $editing ? 'primary' : 'success' ?>">
                    <?= $editing ? 'Mettre à jour' : 'Ajouter' ?>
                </button>
                <a href="../index.php?page=users" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
        <?php
    }
}
