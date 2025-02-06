<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Animaux</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
<?php
 //if the user is not logged in, redirect to the home page
if (!isset($_SESSION['idEmploye'])) {
    header('Location: /');
    exit;
}
?>


    <div class="container mt-5">
    <div class="text-end mb-3">
            <a href="/logout" class="btn btn-outline-danger">Se déconnecter</a>
        </div>
    <img src="./img/logo-transparentSVG.svg" alt="Logo AdoptMe" style="width: 500px; display: block; margin: auto;">
    <div class="text-center mb-4">
    <a href="/animals" class="btn btn-primary">Voir la liste des animaux</a>
    <a href="/owners" class="btn btn-secondary">Voir la liste des propriétaires</a>
    </div>
    <h1 class="text-center">Liste des Propriétaires</h1>
    <div class="text-end mb-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddOwner">Ajouter un propriétaire</button>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Numero de téléphone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($proprietaires as $owner): ?>
            <tr>
                <td><?= htmlspecialchars($owner->idProprietaire) ?></td>
                <td><?= htmlspecialchars($owner->nom) ?></td>
                <td><?= htmlspecialchars($owner->prenom) ?></td>
                <td><?= htmlspecialchars($owner->email) ?></td>
                <td><?= htmlspecialchars($owner->numeroTelephone) ?></td>
                <td>
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditOwner<?= $owner->idProprietaire ?>">Modifier</button>
                    <a href="/owners/delete/<?= $owner->idProprietaire ?>" class="btn btn-danger btn-sm">Supprimer</a>
                </td>
            </tr>

            <div class="modal fade" id="modalEditOwner<?= $owner->idProprietaire ?>" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post" action="/owners/update/<?= $owner->idProprietaire ?>">
                            <div class="modal-header">
                                <h5 class="modal-title">Modifier le propriétaire</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Nom</label>
                                    <input type="text" class="form-control" name="nom" value="<?= htmlspecialchars($owner->nom) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Prénom</label>
                                    <input type="text" class="form-control" name="prenom" value="<?= htmlspecialchars($owner->prenom) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($owner->email) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Numero de téléphone</label>
                                    <input type="text" class="form-control" name="numeroTelephone" value="<?= htmlspecialchars($owner->numeroTelephone) ?>" required>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="modalAddOwner" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
        <form method="post" action="/owners/add">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un propriétaire</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nom</label>
                    <input type="text" class="form-control" name="nom" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Prénom</label>
                    <input type="text" class="form-control" name="prenom" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Numéro de téléphone</label>
                    <input type="text" class="form-control" name="numeroTelephone" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
        </form>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
