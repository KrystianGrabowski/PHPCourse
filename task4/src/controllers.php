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
});

$app->get('/products', function () use ($app) {
    try
    {
        $products = $app['storage']->fetchAll();
    }
    catch (Exception $e)
    {
        throw new Exception("Something went wrong! [GET /products]");
    }
    return json_encode($products);
});

$app->post('/products', function () use ($app) {
    try
    {
        $input = file_get_contents("php://input");
        $data = json_decode($input, true);
    
        $id = $data['id'];
        $name = $data['name'];
        $amount = $data['amount'];
        $currency = $data['currency'];
    
        $newProduct = new Product($id, $name, new Money($amount, new Currency($currency)));
        $app['storage']->insert($newProduct);
    }
    catch (Exception $e)
    {
        return new Response("Something went wrong! [POST /products]", 400);
    }
    return new Response('Created', 201);
});

$app->get('/products/{id}', function ($id) use ($app) {
    try
    {
        $product = $app['storage']->fetch($id);
    }
    catch (Exception $e)
    {
        return new Response("Something went wrong! [GET /products/{id}]", 400);
    }
    return json_encode($product);
});

$app->put('/products/{id}', function ($id) use ($app) {
    try
    {
        $input = file_get_contents("php://input");
        $data = json_decode($input, true);
    
        $app['storage']->edit($id, $data);
    }
    catch (Exception $e)
    {
        return new Response("Something went wrong! [PUT /products/{id}]", 400);
    }
    return new Response('Updated', 201);
});

$app->delete('/products/{id}', function ($id) use ($app) {
    try
    {
        $app['storage']->delete($id);
    }
    catch (Exception $e)
    {
        return new Response("Something went wrong! [DELETE /products/{id}]", 400);
    }
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
