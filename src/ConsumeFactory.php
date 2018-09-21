<?php declare(strict_types=1);

namespace Eventsourcing;

class ConsumeFactory
{
    public function createAsyncEventHandlerRegistry(): AsyncEventHandlerRegistry
    {
        return new AsyncEventHandlerRegistry($this);
    }

    public function createEventStream(Topic $topic): EventStream
    {
        return new EventStream($this->createEventStreamReader($topic));
    }

    public function createOrderPlacedEmailConfirmationSender(): OrderPlacedEmailConfirmationSender
    {
        return new OrderPlacedEmailConfirmationSender($this->createMailService());
    }

    private function createEventStreamReader(Topic $topic): EventStreamReader
    {
        return new EventStreamReader($this->createPdo(), $topic);
    }

    private function createMailService(): MailService
    {
        return new MailService();
    }

    private function createPdo(): \PDO
    {
        return new \PDO('sqlite:' . __DIR__ . '/../var/events.db');
    }
}
