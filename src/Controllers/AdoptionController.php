<?php

namespace Yannickvgl\AdoptMe\Controllers;

use Slim\Views\PhpRenderer;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Yannickvgl\AdoptMe\Models\AnimalModel;

class AdoptionControllerController
{
    public function showAdoption(Request $request, Response $response, array $args): Response
    {
        $proprietaires = ProprietaireModel::getAll();


        // Construire la structure de la page
        $dataLayout = ['title' => 'AdoptMe'];
        $phpView = new PhpRenderer(__DIR__ . '/../../views', $dataLayout);
        $phpView->setLayout("layout.php");
        // Construire le contenu de la page
        return $phpView->render($response, 'animals.php', ['animals' => $animals, 'species' => $species, 'proprietaires' => $proprietaires]);  //animals, species et proprietaires sont des variables utilisées dans le fichier animals.php

    }

    //get the name of the owner then get the dâte of the adoption
    public function addAdoption(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        AdoptionModel::add($data['idAnimal'], $data['idProprietaire'], $data['dateAdoption']);

        return $phpView->render($response, 'animals.php', ['proprietaires' => $proprietaires]); 
    }
}