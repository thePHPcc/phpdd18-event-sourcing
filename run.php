<?php

require __DIR__ . '/vendor/autoload.php';

$cartItems = new \Eventsourcing\CartItemCollection();

$checkout = new \Eventsourcing\Checkout();
$checkout->startCheckout($cartItems);

$eventLog = $checkout->getRecordedEvents();

$writer = new \Eventsourcing\EventLogWriter();
$writer->write($eventLog);
