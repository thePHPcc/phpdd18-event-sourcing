<?php

use Slim\Http\Request;
use Slim\Http\Response;

$sessionId = new \Eventsourcing\SessionId($_COOKIE['checkout_demo_session']);
$factory = new \Eventsourcing\Factory($sessionId);

// Routes
$app->get('/checkout/address', function (Request $request, Response $response) use ($factory) {
    $query = $factory->createAddressPageQuery();

    return $query->execute($response);
});

$app->get('/checkout/confirm', function (Request $request, Response $response) use ($factory) {
    $query = $factory->createConfirmationPageQuery();

    return $query->execute($response);
});

$app->post('/addBillingAddress', function (Request $request, Response $response) use ($factory) {
    $command = $factory->createAddBillingAddressCommand();
    $command->execute($request);

    return $response->withRedirect('/checkout/confirm', 303);
});

$app->post('/startCheckout', function (Request $request, Response $response) use ($factory) {
    $command = $factory->createStartCheckoutCommand();
    $command->execute();

    return $response->withRedirect('/checkout/address', 303);
});

$app->post('/placeOrder', function (Request $request, Response $response) use ($factory) {
    $command = $factory->createPlaceOrderCOmmand();
    $command->execute();

    return $response->withRedirect('/thankyou.html', 303);
});

$app->get('/', function (Request $request, Response $response, array $args) {
    $response->getBody()->write('404');
});
