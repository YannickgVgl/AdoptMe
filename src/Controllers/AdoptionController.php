<?php

namespace Yannickvgl\AdoptMe\Controllers;

use Slim\Views\PhpRenderer;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Yannickvgl\AdoptMe\Models\AdoptionModel;
use Yannickvgl\AdoptMe\Models\ProprietaireModel;
use Yannickvgl\AdoptMe\Models\AnimalModel;
use Yannickvgl\AdoptMe\Models\EmployeModel;


/**
 * Class AdoptionController
 * @package Yannickvgl\AdoptMe\Controllers
 * This class is used to manage the adoptions
 */
class AdoptionController
{
    /**
     * This function is used to show the adoption page
     * @param Request $request
     * @param Response $response
     * @param array $args
     */
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

    /**
     * This function is used to add an adoption
     * @param Request $request
     * @param Response $response
     * @param array $args
     */
    public function addAdoption(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();

        AdoptionModel::add($data['dateAdoption'], $data['idEmploye'], $data['idAnimal'], $data['idProprietaire']);

        return $response->withHeader('Location', '/animals')->withStatus(302);
    }
}
