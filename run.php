<?php

require __DIR__ . '/vendor/autoload.php';

$sessionId = new \Eventsourcing\SessionId('has4t1glskcktjh4ujs9eet26u');

$_SESSION = [
    'checkout_id' => '9B0B64CA-7DB7-404B-9AE2-12E2164873E1'
];

$factory = new \Eventsourcing\Factory($sessionId);

$cartItems = $factory->createCartService()->getCartItems($sessionId);

$checkout = $factory->createCheckout();
$checkout->startCheckout($cartItems);

$eventLog = $checkout->getRecordedEvents();

$writer = $factory->createEventLogWriter();
$writer->write($eventLog);

$factory->createEventListener()->handle($eventLog);

