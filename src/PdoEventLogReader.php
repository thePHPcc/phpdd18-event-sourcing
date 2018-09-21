<?php declare(strict_types=1);

namespace Eventsourcing;

class PdoEventLogReader implements EventLogReader
{
    /**
     * @var Session
     */
    private $session;

    /**
     * @var \PDO
     */
    private $pdo;

    public function __construct(Session $session, \PDO $pdo)
    {
        $this->session = $session;
        $this->pdo = $pdo;
    }

    /**
     * @throws NoCheckoutIdFoundException
     */
    public function read(): EventLog
    {
        $eventLog = new EventLog();

        if (!$this->session->hasCheckoutId()) {
            return $eventLog;
        }

        $statement = $this->pdo->prepare('SELECT data FROM events WHERE emitter_id = :emitterId ORDER BY id ASC');
        $statement->bindValue('emitterId', $this->session->getCheckoutId()->asString());
        $statement->execute();

        while ($data = $statement->fetchColumn(0)) {
            $eventLog->append(unserialize($data));
        }

        return $eventLog;
    }
}
