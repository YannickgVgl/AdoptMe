<?php
use Slim\Routing\RouteCollectorProxy;
use Yannickvgl\AdoptMe\Controllers\LoginController;
use Yannickvgl\AdoptMe\Controllers\AnimalController;

$app->get('/', [LoginController::class, 'login']);
$app->post('/', [LoginController::class, 'validateLogin']);
$app->get('/animals', [AnimalController::class, 'showAnimals']);
$app->post('/animals/add', [AnimalController::class, 'addAnimal']);
$app->get('/animals/delete/{id}', [AnimalController::class, 'deleteAnimal']);
$app->post('/animals/update/{id}', [AnimalController::class, 'updateAnimal']);
$app->get('/logout', [LoginController::class, 'logout']);