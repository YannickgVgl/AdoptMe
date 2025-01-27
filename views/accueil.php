<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdoptMe - Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Fenêtre d'accueil -->
    <div class="container mt-5">
        <div class="text-center mb-4">
            <img src="./img/logo-transparentSVG.svg" alt="Logo AdoptMe" style="width: 500px;">
            <p class="text-muted">Connectez-vous pour accéder à votre espace employé.</p>
        </div>

        <!-- Formulaire de connexion -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Connexion</h2>
                        
                        <form action="/" method="POST">
                            <div class="mb-3">
                                <label for="nomUtilisateur" class="form-label">Nom d'utilisateur</label>
                                <input type="text" class="form-control" id="nomUtilisateur" name="nomUtilisateur">
                            </div>
                            <div class="mb-3">
                                <label for="motDePasse" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="motDePasse" name="motDePasse">
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Se connecter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
