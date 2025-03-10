<?php

namespace Yannickvgl\AdoptMe\Controllers;

use Slim\Views\PhpRenderer;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Yannickvgl\AdoptMe\Models\EmployeModel;

/**
 * Class LoginController
 * @package Yannickvgl\AdoptMe\Controllers
 * This class is used to manage the login
 */
class LoginController
{

    /**
     * This function is used to show the login page
     * @param Request $request
     * @param Response $response
     * @param array $args
     */
    public function login(Request $request, Response $response, array $args): Response
    {
        $dataLayout = ['title' => 'AdoptMe'];
        $phpView = new PhpRenderer(__DIR__ . '/../../views', $dataLayout);
        $phpView->setLayout("layout.php");
        return $phpView->render($response, 'accueil.php');
    }

    /**
     * This function is used to logout
     * @param Request $request
     * @param Response $response
     * @param array $args
     */
    public function logout(Request $request, Response $response, array $args): Response
    {
        session_destroy();
    
        $dataLayout = ['title' => 'AdoptMe'];
        $phpView = new PhpRenderer(__DIR__ . '/../../views', $dataLayout);
        $phpView->setLayout("layout.php");
        return $phpView->render($response, 'logout.php');
    }


    /**
     * This function is used to check if the user is logged in so he can access the other pages
     * @param Request $request
     * @param Response $response
     * @param callable $next
     */
    // im not using this function but i let it here incase i use it in another project (the callable param is for the next middleware)
    public function notLoggedIn(Request $request, Response $response, callable $next): Response
    {
        if (!isset($_SESSION['idEmploye'])) 
        {
            return $response->withHeader('Location', '/')->withStatus(302);
        }
    
        return $next($request, $response);
    }

    /**
     * This function is used to validate the login
     * @param Request $request
     * @param Response $response
     * @param array $args
     */
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
    
        //if there is an error it displays the error message and the user input
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
        if ($employe) 
        {
            //vérifie si le mot de passe est encore en brut
            if ($employe->motDePasse === $motDePasse) 
            {
                //hache le mot de passe brut
                $motDePasseHache = password_hash($motDePasse, PASSWORD_DEFAULT);
    
                //met à jour le mot de passe dans la base de données
                EmployeModel::updatePassword($employe->idEmploye, $motDePasseHache);
    
                //si le mot de passe est haché il redirige vers la page des animaux
                if (password_verify($motDePasse, $motDePasseHache)) 
                {
                    $_SESSION['idEmploye'] = $employe->idEmploye;
                    $_SESSION['nomUtilisateur'] = $employe->nomUtilisateur;
    
                    return $response->withHeader('Location', '/animals')->withStatus(302);
                }
            }
            
            //si le mot de passe est deja haché il redirige vers la page des animaux
            elseif (password_verify($motDePasse, $employe->motDePasse)) 
            {
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