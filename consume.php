<?php

require __DIR__ . '/vendor/autoload.php';

$factory = new \Eventsourcing\ConsumeFactory();
$stream = $factory->createEventStream(
    new \Eventsourcing\OrderPlacedTopic(),
    new \Eventsourcing\StreamIdentifier('order-confirmation-mails')
);

$eventHandlerRegistry = $factory->createAsyncEventHandlerRegistry();

while (true) {
    $event = $stream->getNext();
    foreach ($eventHandlerRegistry->get($event->getTopic()) as $eventHandler) {
        $eventHandler->handle($event);
    }
}
