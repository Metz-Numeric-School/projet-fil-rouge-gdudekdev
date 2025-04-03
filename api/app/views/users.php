<?php 
use App\Models\Users;

$users = new Users();
?>
<div class="container mt-5">
    <h2 class="mb-4 text-center">Liste des Utilisateurs</h2>
    
    <div class="text-end mb-3">
        <a href="./app/controllers/users/users_form.php" class="btn btn-success">➕ Ajouter un utilisateur</a>
    </div>

    <table class="table table-bordered table-striped text-center">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Date de création</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users->getAll() as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['id']) ?></td>
                    <td><?= htmlspecialchars($item['name']) ?></td>
                    <td><?= htmlspecialchars($item['email']) ?></td>
                    <td><?= htmlspecialchars($item['created_at']) ?></td>
                    <td>
                        <a href="/app/controllers/users/users_form.php?id=<?= htmlspecialchars($item['id']) ?>" class="btn btn-primary btn-sm">✏️ Modifier</a>
                        
                        <form action="/app/controllers/users/users_delete.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($item['id']) ?>">
                            <button type="submit" onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?')" class="btn btn-danger btn-sm">🗑️ Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
