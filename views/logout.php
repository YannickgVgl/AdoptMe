<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Déconnexion - AdoptMe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <div class="text-center">
            <img src="./img/logo-transparentSVG.svg" alt="Logo AdoptMe" style="width: 500px;">
            <h1 class="mt-4">Merci de votre visite !</h1>
            <p class="text-muted">Vous avez été déconnecté avec succès.</p>
            <a href="/" class="btn btn-primary mt-3">Retour à l'accueil</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>