<?php

use Money\Currency;
use Money\Money;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

//Request::setTrustedProxies(array('127.0.0.1'));

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig', array());
})
->bind('homepage')
;

$app->get('/products', function () use ($app) {
    $products = $app['storage']->fetchAll();
    return json_encode($products);
});

$app->post('/products', function () use ($app) {
    $input = file_get_contents("php://input");
    $data = json_decode($input, true);

    $id = $data['id'];
    $name = $data['name'];
    $amount = $data['amount'];
    $currency = $data['currency'];

    $newProduct = new Product($id, $name, new Money($amount, new Currency($currency)));
    $app['storage']->insert($newProduct);
    return new Response('Created', 201);
});

$app->get('/products/{id}', function ($id) use ($app) {
    $product = $app['storage']->fetch($id);
    return json_encode($product);
});

$app->put('/products/{id}', function ($id) use ($app) {
    $input = file_get_contents("php://input");
    $data = json_decode($input, true);

    $app['storage']->edit($id, $data);
    return new Response('Updated', 201);
});

$app->delete('/products/{id}', function ($id) use ($app) {
    $app['storage']->delete($id);
    return new Response('Deleted', 201);
});


$app->error(function (\Exception $e, Request $request, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = array(
        'errors/'.$code.'.html.twig',
        'errors/'.substr($code, 0, 2).'x.html.twig',
        'errors/'.substr($code, 0, 1).'xx.html.twig',
        'errors/default.html.twig',
    );

    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});
