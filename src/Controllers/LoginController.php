<?php

namespace Yannickvgl\AdoptMe\Controllers;

use Slim\Views\PhpRenderer;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Yannickvgl\AdoptMe\Models\EmployeModel;

class LoginController
{
    public function login(Request $request, Response $response, array $args): Response
    {
        $dataLayout = ['title' => 'AdoptMe'];
        $phpView = new PhpRenderer(__DIR__ . '/../../views', $dataLayout);
        $phpView->setLayout("layout.php");
        return $phpView->render($response, 'accueil.php');
    }
    public function logout(Request $request, Response $response, array $args): Response
    {
        session_destroy();
    
        $dataLayout = ['title' => 'AdoptMe'];
        $phpView = new PhpRenderer(__DIR__ . '/../../views', $dataLayout);
        $phpView->setLayout("layout.php");
        return $phpView->render($response, 'logout.php');
    }

    //if the user is not logged in, he cannot go anywhere else than the login page
    public function notLoggedIn(Request $request, Response $response, callable $next): Response
    {
        if (!isset($_SESSION['idEmploye'])) {
            return $response->withHeader('Location', '/')->withStatus(302);
        }
    
        return $next($request, $response);
    }

    public function validateLogin(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $nomUtilisateur = $data['nomUtilisateur'] ?? '';
        $motDePasse = $data['motDePasse'] ?? '';
    
        $errors = [];
    
        if ($nomUtilisateur == '') {
            $errors['nomUtilisateur'] = 'Le nom d\'utilisateur est obligatoire';
        }
        if ($motDePasse == '') {
            $errors['motDePasse'] = 'Le mot de passe est obligatoire';
        }
    
        if (!empty($errors)) {
            $dataLayout = ['title' => 'AdoptMe'];
            $phpView = new PhpRenderer(__DIR__ . '/../../views', $dataLayout);
            $phpView->setLayout("layout.php");
    
            return $phpView->render($response, 'accueil.php', [
                'errors' => $errors,
                'nomUtilisateur' => $nomUtilisateur,
                'motDePasse' => $motDePasse
            ]);
        }
    
        $employe = EmployeModel::getEmploye($nomUtilisateur);
    
        if ($employe) {
            //vérifie si le mot de passe est encore en brut
            if ($employe->motDePasse === $motDePasse) {
                //hache le mot de passe brut
                $motDePasseHache = password_hash($motDePasse, PASSWORD_DEFAULT);
    
                //met à jour le mot de passe dans la base de données
                EmployeModel::updatePassword($employe->idEmploye, $motDePasseHache);
    
                //si le mot de passe est haché il redirige vers la page des animaux
                if (password_verify($motDePasse, $motDePasseHache)) {
                    $_SESSION['idEmploye'] = $employe->idEmploye;
                    $_SESSION['nomUtilisateur'] = $employe->nomUtilisateur;
    
                    return $response->withHeader('Location', '/animals')->withStatus(302);
                }
            } elseif (password_verify($motDePasse, $employe->motDePasse)) {
                //si le mot de passe est deja haché il redirige vers la page des animaux
                $_SESSION['idEmploye'] = $employe->idEmploye;
                $_SESSION['nomUtilisateur'] = $employe->nomUtilisateur;
    
                return $response->withHeader('Location', '/animals')->withStatus(302);
            }
        }
    
        //si le nom d'utilisateur ou le mot de passe est incorrect il affiche un message d'erreur et redirige vers la page d'accueil
        $errors['login'] = 'Nom d\'utilisateur ou mot de passe incorrect';
    
        $dataLayout = ['title' => 'AdoptMe'];
        $phpView = new PhpRenderer(__DIR__ . '/../../views', $dataLayout);
        $phpView->setLayout("layout.php");
    
        return $phpView->render($response, 'accueil.php', [
            'errors' => $errors,
            'nomUtilisateur' => $nomUtilisateur,
            'motDePasse' => $motDePasse
        ]);
    }
    
}