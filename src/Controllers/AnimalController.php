<?php

namespace Yannickvgl\AdoptMe\Controllers;

use Slim\Views\PhpRenderer;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Yannickvgl\AdoptMe\Models\AnimalModel;
use Yannickvgl\AdoptMe\Models\ProprietaireModel;
use Yannickvgl\AdoptMe\Models\AdoptionModel;
use Yannickvgl\AdoptMe\Models\EmployeModel;

/**
 * Class AnimalController
 * @package Yannickvgl\AdoptMe\Controllers
 * This class is used to manage the animals
 */
class AnimalController
{
    /**
     * This function is used to show the animals page
     * @param Request $request
     * @param Response $response
     * @param array $args
     */
    public function showAnimals(Request $request, Response $response, array $args): Response
    {
        $animals = AnimalModel::getAll();
        $adoptedAnimals = AdoptionModel::getAllWithAdoption();
        $species = AnimalModel::getAllSpecies();
        $proprietaires = ProprietaireModel::getAll();
        $adoptions = AdoptionModel::getAll();
        $employes = EmployeModel::getAll();
        // Construire la structure de la page
        $dataLayout = ['title' => 'AdoptMe'];
        $phpView = new PhpRenderer(__DIR__ . '/../../views', $dataLayout);
        $phpView->setLayout("layout.php");
    
        // Passer toutes les données nécessaires à la vue
        return $phpView->render($response, 'animals.php', [
            'animals' => $animals,
            'species' => $species,
            'proprietaires' => $proprietaires,
            'adoptions' => $adoptions,  
            'employes' => $employes,
            'adoptedAnimals' => $adoptedAnimals  
        ]);
    }
    
    /**
     * This function is used to add an animal
     * @param Request $request
     * @param Response $response
     * @param array $args
     */
    public function addAnimal(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        AnimalModel::add($data['nom'], $data['dateNaissance'], $data['sexe'], $data['idEspece']);
        return $response->withHeader('Location', '/animals')->withStatus(302);
    }

    /**
     * This function is used to delete an animal
     * @param Request $request
     * @param Response $response
     * @param array $args
     */
    public function deleteAnimal(Request $request, Response $response, array $args): Response
    {
        AnimalModel::delete($args['id']);
        return $response->withHeader('Location', '/animals')->withStatus(302);
    }

    /**
     * This function is used to update an animal
     * @param Request $request
     * @param Response $response
     * @param array $args
     */
    public function updateAnimal(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        AnimalModel::update($args['id'], $data['nom'], $data['dateNaissance'], $data['sexe'], $data['idEspece']);
        return $response->withHeader('Location', '/animals')->withStatus(302);
    }
}
