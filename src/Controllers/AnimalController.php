<?php

namespace Yannickvgl\AdoptMe\Controllers;

use Slim\Views\PhpRenderer;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Yannickvgl\AdoptMe\Models\AnimalModel;

class AnimalController
{
    // Vos autres fonctions
    public function showAnimals(Request $request, Response $response, array $args): Response
    {
        $animals = AnimalModel::getAll();
        $species = AnimalModel::getAllSpecies();
        // Construire la structure de la page
        $dataLayout = ['title' => 'AdoptMe'];
        $phpView = new PhpRenderer(__DIR__ . '/../../views', $dataLayout);
        $phpView->setLayout("layout.php");
        // Construire le contenu de la page
        return $phpView->render($response, 'animals.php', ['animals' => $animals, 'species' => $species]); //animals et species sont des variables utilisées dans le fichier animals.php
    }
    public function addAnimal(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        AnimalModel::add($data['nom'], $data['dateNaissance'], $data['sexe'], $data['idEspece']);
        return $response->withHeader('Location', '/animals')->withStatus(302);
    }

    public function deleteAnimal(Request $request, Response $response, array $args): Response
    {
        AnimalModel::delete($args['id']);
        return $response->withHeader('Location', '/animals')->withStatus(302);
    }

    public function updateAnimal(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        AnimalModel::update($args['id'], $data['nom'], $data['dateNaissance'], $data['sexe'], $data['idEspece']);
        return $response->withHeader('Location', '/animals')->withStatus(302);
    }
}
