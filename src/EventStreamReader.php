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

    /**
     * @var StreamIdentifier
     */
    private $streamIdentifier;

    public function __construct(\PDO $pdo, StreamIdentifier $streamIdentifier, Topic $topic)
    {
        $this->pdo = $pdo;
        $this->topic = $topic;
        $this->streamIdentifier = $streamIdentifier;
    }

    public function hasEvents(): bool
    {
        $statement = $this->pdo->prepare('SELECT id FROM events WHERE id > IFNULL((SELECT last_id FROM event_streams WHERE identifier = :identifier), 0) AND topic = :topic LIMIT 1');
        $statement->bindValue('identifier', $this->streamIdentifier->asString());
        $statement->bindValue('topic', $this->topic->asString());
        $statement->execute();
        return $statement->fetchColumn(0) !== false;
    }

    public function read(): Event
    {
        $statement = $this->pdo->prepare('SELECT id, data FROM events WHERE id > IFNULL((SELECT last_id FROM event_streams WHERE identifier = :identifier), 0) AND topic = :topic LIMIT 1');
        $statement->bindValue('identifier', $this->streamIdentifier->asString());
        $statement->bindValue('topic', $this->topic->asString());
        $statement->execute();

        $row = $statement->fetch(\PDO::FETCH_ASSOC);

        $this->storeLastId((int)$row['id']);

        return unserialize($row['data']);
    }

    private function storeLastId(int $id)
    {
        $statement = $this->pdo->prepare('REPLACE INTO event_streams (identifier, last_id) VALUES (:identifier, :lastId)');
        $statement->bindValue('identifier', $this->streamIdentifier->asString());
        $statement->bindValue('lastId', $id);
        $statement->execute();
    }
}
