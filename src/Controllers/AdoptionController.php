<?php

namespace Yannickvgl\AdoptMe\Controllers;

use Slim\Views\PhpRenderer;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Yannickvgl\AdoptMe\Models\AdoptionModel;
use Yannickvgl\AdoptMe\Models\ProprietaireModel;
use Yannickvgl\AdoptMe\Models\AnimalModel;
use Yannickvgl\AdoptMe\Models\EmployeModel;

class AdoptionController
{
    
    //this function is useless now but i still let it here for some reason
    public function showAdoption(Request $request, Response $response, array $args): Response
    {
        $proprietaires = ProprietaireModel::getAll();
        $adoptions = AdoptionModel::getAll();
        $animals = AnimalModel::getAll();
        $employes = EmployeModel::getEmploye();

        $phpView = new PhpRenderer(__DIR__ . '/../../views');
        return $phpView->render($response, 'animals.php', [
            'animals' => $animals,
            'proprietaires' => $proprietaires,
            'adoptions' => $adoptions,
            'employes' => $employes,
            'species' => AnimalModel::getAllSpecies()
        ]);
    }

    public function addAdoption(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();

        AdoptionModel::add($data['dateAdoption'], $data['idEmploye'], $data['idAnimal'], $data['idProprietaire']);

        return $response->withHeader('Location', '/animals')->withStatus(302);
    }
}
