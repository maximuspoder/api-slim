<?php
require 'vendor/autoload.php';

$app = new \Slim\App();

/**
 * Simulate request into phoenix to get my creative project
 */
$app->get('/phoenix/mine/projects', function ($request, $response, $args) {
    $id = $request->getParam('id') ? $request->getParam('id') : 100;
    $stock = $request->getParam('stock') ? $request->getParam('stock') : 100;
    $price = $request->getParam('price') ? $request->getParam('price') : 9.95;
    $data = [
        'creative_project_id' => $id,
        'stock' => intval($stock),
        'price' => floatval($price)
    ];
    return $response
                ->withHeader('Content-type', 'application/json')
                ->withJson($data);
});

$app->run();