<?php
require 'vendor/autoload.php';

$app = new \Slim\App();

/**
 * Simulate request into phoenix to get my creative project
 */
$app->get('/phoenix/mine/projects', function ($request, $response, $args) {
    $id = $request->getParam('id') ? $request->getParam('id') : 100;
    $stock = $request->getParam('stock') ? $request->getParam('stock') : 100;
    $available = $request->getParam('available') ? $request->getParam('available') : true;
    $data = [
        'creative_project_id' => intval($id),
        'stock' => intval($stock),
        'options_with_stock' => boolval($available)
    ];
    return $response
                ->withHeader('Content-type', 'application/json')
                ->withJson($data);
});

$app->run();