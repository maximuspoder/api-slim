<?php
require 'vendor/autoload.php';

$app = new \Slim\App();

/**
 * Simulate request into phoenix to get my creative project
 */
$app->get('/phoenix/mine/project', function ($request, $response, $args) {
    $active = true;
    $value = 'Magnet M 5.6x5.6 cm';
    $id = $request->getParam('id') ? $request->getParam('id') : null;
    if (is_null($id)) {
        return $response
                ->withHeader('Content-type', 'application/json')
                ->withJson(["data" => []]);
    }
    
    $stock = $request->getParam('stock') ? $request->getParam('stock') : 100;
    $price = $request->getParam('price') ? $request->getParam('price') : 9.95;
    if ($id == '000C-L') {
        $stock = 0;
        $active = false;
        $value = 'Magnet L 7.5x7.5 cm';
    }
        
    $data = [
        'id' => $id,
        'stock' => intval($stock),
        'price' => floatval($price),
        'attributes' => ['type' => 'taille', 'value' => $value],
        'active' => $active
    ];
    return $response
                ->withHeader('Content-type', 'application/json')
                ->withJson(["data" => $data]);
});


$app->get('/creative-project/', function($request, $response, $args){
    $html = "<h1>Welcome to My Creative Project</h1>";
    $html .= "<p>Just a simulation how it's work with Phoenix</p>";
    $html .= "<pre>";
    $params = $request->getParams();
    $params = json_encode($params);
    $html .= $params."</pre>";

    $response
            ->write($html);
    return $response;    
 });


$app->run();