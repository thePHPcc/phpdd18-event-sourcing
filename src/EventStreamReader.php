<?php declare(strict_types=1);

namespace Eventsourcing;

class EventStreamReader
{
    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * @var Topic
     */
    private $topic;

    public function __construct(\PDO $pdo, Topic $topic)
    {
        $this->pdo = $pdo;
        $this->topic = $topic;
    }

    public function hasEvents(): bool
    {
        $statement = $this->pdo->prepare('SELECT id FROM events WHERE topic = :topic LIMIT 1');
        $statement->bindValue('topic', $this->topic->asString());
        $statement->execute();
        return $statement->fetchColumn(0) !== false;
    }

    public function read(): Event
    {
        $statement = $this->pdo->prepare('SELECT data FROM events WHERE topic = :topic LIMIT 1');
        $statement->bindValue('topic', $this->topic->asString());
        $statement->execute();

        return unserialize($statement->fetchColumn(0));
    }
}
