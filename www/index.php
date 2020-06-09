<?php
require 'vendor/autoload.php';

use Slim\Views\PhpRenderer;

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
    $renderer = new PhpRenderer('public/');

    $params = $request->getParams();
    $params = json_encode($params, JSON_PRETTY_PRINT);

    $args['data'] = $params;
    $args['quote_id'] = $request->getParam('quoteId');
    $args['sku'] = $request->getParam('sku');
    return $renderer->render($response, "cart.php", $args);
 });



 $app->get('/creative-project/add', function($request, $response, $args){
    
    $qty = $request->getParam('qty');
    $quoteId = $request->getParam('quote_id');
    $sku = $request->getParam('sku');

    /** Params to add to cart */
    $productData = [
        'cart_item' => [
            'quote_id' => $quoteId,
            'sku' => $sku,
            'qty' => $qty,
            'extension_attributes' => [
                "creative_id" => 2,
                "additional_data" => "Custom information for SKU ".$sku
            ]
        ]
    ];
    $ch = curl_init("https://dev.magento.digitalphoto.dev/rest/V1/phoenix/carts/mine/items");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($productData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer a9uwug8sslqbon2wtm2099xzxof7g4ln"));
    
    $result = curl_exec($ch);
    return $result;
 });

$app->run();