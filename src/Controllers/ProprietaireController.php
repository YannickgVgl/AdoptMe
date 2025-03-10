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
 * Class ProprietaireController
 * @package Yannickvgl\AdoptMe\Controllers
 * This class is used to manage the owners
 */
class ProprietaireController
{
    /**
     * This function is used to show the owners page
     * @param Request $request
     * @param Response $response
     * @param array $args
     */
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

    /**
     * This function is used to show the adopted animals of an owner
     * @param Request $request
     * @param Response $response
     * @param array $args
     */
    // This function is not used in the project but it can be used in another project, so i can see why i wanted this function
    public function showAdoptedAnimals(Request $request, Response $response, array $args): Response
    {
        $adoptedAnimals = AdoptionModel::getAllWithAdoption();

        $phpView = new PhpRenderer(__DIR__ . '/../../views');
        return $phpView->render($response, 'owners.php', [
            'adoptedAnimals' => $adoptedAnimals
        ]);
    }

    /**
     * This function is used to add an owner
     * @param Request $request
     * @param Response $response
     * @param array $args
     */
    public function addProprietaire(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        ProprietaireModel::add($data['nom'], $data['prenom'], $data['email'], $data['numeroTelephone']);
        return $response->withHeader('Location', '/owners')->withStatus(302);
    }

    /**
     * This function is used to delete an owner
     * @param Request $request
     * @param Response $response
     * @param array $args
     */
    public function deleteProprietaire(Request $request, Response $response, array $args): Response
    {
        ProprietaireModel::delete($args['id']);
        return $response->withHeader('Location', '/owners')->withStatus(302);
    }

    /**
     * This function is used to update an owner
     * @param Request $request
     * @param Response $response
     * @param array $args
     */
    public function updateProprietaire(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        ProprietaireModel::update($args['id'], $data['nom'], $data['prenom'], $data['email'], $data['numeroTelephone']);
        return $response->withHeader('Location', '/owners')->withStatus(302);
    }
}
