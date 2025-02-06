<?php

namespace Yannickvgl\AdoptMe\Controllers;

use Slim\Views\PhpRenderer;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Yannickvgl\AdoptMe\Models\AdoptionModel;
use Yannickvgl\AdoptMe\Models\ProprietaireModel;
use Yannickvgl\AdoptMe\Models\AnimalModel;
use Yannickvgl\AdoptMe\Models\EmployeModel;

class ProprietaireController
{
    
    //this function is useless now but i still let it here for some reason
    public function showOwners(Request $request, Response $response, array $args): Response
    {
        $proprietaires = ProprietaireModel::getAll();
        $adoptions = AdoptionModel::getAll();
        $animals = AnimalModel::getAll();
        $employes = EmployeModel::getAll();

        $phpView = new PhpRenderer(__DIR__ . '/../../views');
        return $phpView->render($response, 'owners.php', [
            'animals' => $animals,
            'proprietaires' => $proprietaires,
            'adoptions' => $adoptions,
            'employes' => $employes,
            'species' => AnimalModel::getAllSpecies()
        ]);
    }

    public function showAdoptedAnimals(Request $request, Response $response, array $args): Response
    {
        $adoptedAnimals = ProprietaireModel::getAdoptedAnimals();

        $phpView = new PhpRenderer(__DIR__ . '/../../views');
        return $phpView->render($response, 'owners.php', [
            'adoptedAnimals' => $adoptedAnimals
        ]);
    }

    public function addProprietaire(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        ProprietaireModel::add($data['nom'], $data['prenom'], $data['email'], $data['numeroTelephone']);
        return $response->withHeader('Location', '/owners')->withStatus(302);
    }    

    public function deleteProprietaire(Request $request, Response $response, array $args): Response
    {
        ProprietaireModel::delete($args['id']);
        return $response->withHeader('Location', '/owners')->withStatus(302);
    }

    public function updateProprietaire(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        ProprietaireModel::update($args['id'], $data['nom'], $data['prenom'], $data['email'], $data['numeroTelephone']);
        return $response->withHeader('Location', '/owners')->withStatus(302);
    }
}
