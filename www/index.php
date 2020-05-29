<?php
require 'vendor/autoload.php';

$app = new \Slim\App();

/**
 * Simulate request into phoenix to get my creative project
 */
$app->get('/phoenix/mine/project', function ($request, $response, $args) {

    $id = $request->getParam('id') ? $request->getParam('id') : null;
    if (is_null($id)) {
        return $response
                ->withHeader('Content-type', 'application/json')
                ->withJson(["data" => []]);
    }
    
    $stock = $request->getParam('stock') ? $request->getParam('stock') : 100;
    $price = $request->getParam('price') ? $request->getParam('price') : 9.95;
    $data = [
        'id' => $id,
        'stock' => intval($stock),
        'price' => floatval($price),
        'attributes' => ['type' => 'taille', 'value' => 'Magnet M 5.6x5.6 cm'],
        'active' => true
    ];
    return $response
                ->withHeader('Content-type', 'application/json')
                ->withJson(["data" => $data]);
});


$app->run();