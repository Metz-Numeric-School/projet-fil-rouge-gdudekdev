<?php

use Src\Entity\Accounts;
use Src\Entity\Entreprises;
use Src\Entity\Roles;

$title = "Page de détail du compte n° " . $account->id();
include_once ROOT . "/view/template/header_template.php";
?>

<body>
	<script>
		const allDivisions = <?= json_encode($divisions) ?>;
		let entrepriseId = <?= $division_entreprises['entreprises_id'] ?>;
		const savedDivisionId = <?= $account->divisions_id() ?>;
	</script>
	<div class="container">
		<div class="crud__header">
			<div class="crud__header-cta">
				<a href="index.php?page=accounts" class="crud__table-btn">
					<\Retour </a>
						<a href="index.php?page=accounts&mode=remove&id=<?= $account->id() ?>"
							class="crud__table-btn crud__table-btn--delete">Supprimer</a>
			</div>
			<h2><?= ucfirst($title) ?></h2>
			<a href="index.php?page=vehicules&accounts_id=<?= $account->id() ?>" class='crud__table-btn'>Voir
				les
				véhicules de l'utilisateur</a>
			<a href="index.php?page=routes&accounts_id=<?= $account->id() ?>" class='crud__table-btn'>Voir
				les
				itinéraires de l'utilisateur</a>
			<a href="index.php?page=rides&accounts_id=<?= $account->id() ?>" class='crud__table-btn'>Voir
				les trajets de
				l'utilisateur</a>
		</div>
		<div class="form__main">
			<form method="post" action="index.php?page=accounts&mode=up">
				<?php foreach (Accounts::$array_accepted_key as $key => $value): ?>
					<?= $value['detail_show'] ? "<h5>" . $value['title'] . "</h5>" : '' ?>
					<div class="form-group">
						<input type="<?= $value['detail_show'] ? ($value['type'] ?? "text") : "hidden" ?>"
							name="<?= 'accounts_' . $key ?>" id="<?= $key ?>" value="<?= $account->{$key}() ?>"
							class="form-control" <?= $value['readonly'] ? "readonly='readonly'" : "" ?>>
					</div>
				<?php endforeach ?>
				<h5>Roles</h5>
				<div class="form-group">
					<select name="roles_id" id="roles" class="form-control">
						<?php foreach ($roles as $raw):
							$role = new Roles($raw);
							?>
							<option value="<?= $role->id() ?>" <?= $role->id() === $account->roles_id() ? 'selected' : '' ?>>
								<?= $role->name() ?>
							</option>
						<?php endforeach; ?>

					</select>
				</div>
				<h5>Entreprises</h5>
				<div class="form-group">
					<select id="account_entreprises" class="form-control">
						<?php foreach ($entreprises as $raw):
							$entreprise = new Entreprises($raw);
							?>
							<option value="<?= $entreprise->id() ?>"
								<?= $entreprise->id() == $division_entreprises['entreprises_id'] ? 'selected' : '' ?>>
								<?= $entreprise->name() ?>
							</option>
						<?php endforeach; ?>
					</select>
				</div>
				<h5>Divisions</h5>
				<div class="form-group">
					<select name="divisions_id" id="divisions" class="form-control" required></select>
				</div>
				<h5>Preferences</h5>
				<div class="form-group">
					<?php foreach ($preferences as $preference): ?>
						<div>
							<input type="checkbox" id="<?= $preference['preferences_id'] ?>"
								name="preferences[]" value="<?= $preference['preferences_id'] ?>"
								<?= in_array($preference['preferences_id'], $account_preferences) ? 'checked' : '' ?> />
							<label
								for="<?= $preference['preferences_id'] ?>"><?= $preference['preferences_name'] ?></label>
						</div>
					<?php endforeach; ?>
				</div>
				<input type="submit" value="Mettre à jour" />
			</form>
		</div>
	</div>
	</div>
	</div>
</body>
<script src="/js/accounts_detail.js"></script>

</html>