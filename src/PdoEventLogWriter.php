<?php declare(strict_types=1);

namespace Eventsourcing;

class PdoEventLogWriter implements EventLogWriter
{
    /**
     * @var \PDO
     */
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function write(EventLog $eventLog): void
    {
        foreach ($eventLog as $event) {
            /** @var Event $event */
            $this->writeEvent($event);
        }
    }

    private function writeEvent(Event $event): void
    {
        $statement = $this->pdo->prepare(
            'INSERT INTO events (emitter_id, occured_at, topic, data) VALUES (:emitterId, :occuredAt, :topic, :data)'
        );
        $statement->bindValue('emitterId', $event->getEmitterId()->asString());
        $statement->bindValue('occuredAt', $event->getOccurredAt()->format(DATE_ATOM));
        $statement->bindValue('topic', $event->getTopic()->asString());
        $statement->bindValue('data', serialize($event));

        $statement->execute();
    }
}
