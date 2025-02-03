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
        <h1 class="text-center">Liste des Animaux du Refuge</h1>
        <div class="text-end mb-3">
            <!-- Bouton pour ouvrir la modale d'ajout d'un animal -->
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddAnimal">Ajouter un animal</button>
        </div>
        <!-- Tableau affichant la liste des animaux -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Date de Naissance</th>
                    <th>Sexe</th>
                    <th>Espèce</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($animals as $animal): ?>
                <tr>
                    <td><?= htmlspecialchars($animal->idAnimal) ?></td>
                    <td><?= htmlspecialchars($animal->nom) ?></td>
                    <td><?= htmlspecialchars($animal->dateNaissance) ?></td>
                    <td><?= htmlspecialchars($animal->sexe) ?></td>
                    <td><?= htmlspecialchars($animal->nomEspece) ?></td>
                    <td>
                        <!-- Bouton pour ouvrir la modale de modification -->
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditAnimal<?= $animal->idAnimal ?>">Modifier</button>
                        <!-- Bouton pour supprimer un animal -->
                        <a href="/animals/delete/<?= $animal->idAnimal ?>" class="btn btn-danger btn-sm">Supprimer</a>
                        <!-- Bouton pour enregistrer une adoption -->
                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalAdoptAnimal<?= $animal->idAnimal ?>">Adoption</button>
                    </td>
                </tr>

                <!-- Modale de modification -->
                <div class="modal fade" id="modalEditAnimal<?= $animal->idAnimal ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="post" action="/animals/update/<?= $animal->idAnimal ?>">
                                <div class="modal-header">
                                    <h5 class="modal-title">Modifier l'animal</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="nom<?= $animal->idAnimal ?>" class="form-label">Nom</label>
                                        <input type="text" class="form-control" id="nom<?= $animal->idAnimal ?>" name="nom" value="<?= htmlspecialchars($animal->nom) ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="dateNaissance<?= $animal->idAnimal ?>" class="form-label">Date de Naissance</label>
                                        <input type="date" class="form-control" id="dateNaissance<?= $animal->idAnimal ?>" name="dateNaissance" value="<?= htmlspecialchars($animal->dateNaissance) ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="sexe<?= $animal->idAnimal ?>" class="form-label">Sexe</label>
                                        <select class="form-select" id="sexe<?= $animal->idAnimal ?>" name="sexe" required>
                                            <option value="M" <?= $animal->sexe === 'M' ? 'selected' : '' ?>>Mâle</option>
                                            <option value="F" <?= $animal->sexe === 'F' ? 'selected' : '' ?>>Femelle</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="idEspece<?= $animal->idAnimal ?>" class="form-label">Espèce</label>
                                        <select class="form-select" id="idEspece<?= $animal->idAnimal ?>" name="idEspece" required>
                                            <?php foreach ($species as $espece): ?>
                                            <option value="<?= $espece->idEspece ?>" <?= $animal->idEspece === $espece->idEspece ? 'selected' : '' ?>><?= htmlspecialchars($espece->nom) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modale d'adoption -->
                <div class="modal fade" id="modalAdoptAnimal<?= $animal->idAnimal ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="post" action="adoption/add">
                                <div class="modal-header">
                                    <h5 class="modal-title">Enregistrer une adoption</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="idAnimal" value="<?= $animal->idAnimal ?>">
                                    <div class="mb-3">
                                        <label for="idProprietaire<?= $animal->idAnimal ?>" class="form-label">Propriétaire</label>
                                        <select class="form-select" id="idProprietaire<?= $animal->idAnimal ?>" name="idProprietaire" required>
                                            <option value="">-- Sélectionner un propriétaire --</option>
                                            <?php foreach ($proprietaires as $proprietaire): ?>
                                            <option value="<?= $proprietaire->idProprietaire ?>"><?= htmlspecialchars($proprietaire->nom . ' ' . $proprietaire->prenom) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="dateAdoption<?= $animal->idAnimal ?>" class="form-label">Date d'adoption</label>
                                        <input type="date" class="form-control" id="dateAdoption<?= $animal->idAnimal ?>" name="dateAdoption" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Enregistrer l'adoption</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modale d'ajout d'animal -->
    <div class="modal fade" id="modalAddAnimal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="/animals/add">
                    <div class="modal-header">
                        <h5 class="modal-title">Ajouter un animal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="dateNaissance" class="form-label">Date de Naissance</label>
                            <input type="date" class="form-control" id="dateNaissance" name="dateNaissance" required>
                        </div>
                        <div class="mb-3">
                            <label for="sexe" class="form-label">Sexe</label>
                            <select class="form-select" id="sexe" name="sexe" required>
                                <option value="M">Mâle</option>
                                <option value="F">Femelle</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="idEspece" class="form-label">Espèce</label>
                            <select class="form-select" id="idEspece" name="idEspece" required>
                                <?php foreach ($species as $espece): ?>
                                    <option value="<?= htmlspecialchars($espece->idEspece) ?>"><?= htmlspecialchars($espece->nom) ?></option>
                                <?php endforeach; ?>
                            </select>
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

