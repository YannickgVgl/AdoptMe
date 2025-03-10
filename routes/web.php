<?php
use Slim\Routing\RouteCollectorProxy;
use Yannickvgl\AdoptMe\Controllers\LoginController;
use Yannickvgl\AdoptMe\Controllers\AnimalController;
use Yannickvgl\AdoptMe\Controllers\ProprietaireController;
use Yannickvgl\AdoptMe\Controllers\AdoptionController;

/**
 * This file is used to define the routes of the application
 * @var \Slim\App $app
 * @var RouteCollectorProxy $app
 */

//Login
$app->get('/', [LoginController::class, 'login']);
$app->post('/', [LoginController::class, 'validateLogin']);
$app->get('/logout', [LoginController::class, 'logout']);

// Animals
$app->get('/animals', [AnimalController::class, 'showAnimals']);
$app->post('/animals/add', [AnimalController::class, 'addAnimal']);
$app->get('/animals/delete/{id}', [AnimalController::class, 'deleteAnimal']);
$app->post('/animals/update/{id}', [AnimalController::class, 'updateAnimal']);
$app->post('/adoption/add',  [AdoptionController::class, 'addAdoption']);

// Owners
$app->get('/owners', [ProprietaireController::class, 'showOwners']);

// i let this route (owners/adoptedAnimals/{id}) here because it can be used in another project so i can see why i wanted this route
$app->get('/owners/adoptedAnimals/{id}', [ProprietaireController::class, 'showAdoptedAnimals']);
$app->post('/owners/add', [ProprietaireController::class, 'addProprietaire']);
$app->get('/owners/delete/{id}', [ProprietaireController::class, 'deleteProprietaire']);
$app->post('/owners/update/{id}', [ProprietaireController::class, 'updateProprietaire']);