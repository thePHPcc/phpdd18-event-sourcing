<?php declare(strict_types=1);

namespace Eventsourcing;

class ProjectionWriter
{
    /**
     * @var SessionId
     */
    private $sessionId;

    public function __construct(SessionId $sessionId)
    {
        $this->sessionId = $sessionId;
    }

    public function write(Projection $projection)
    {
        $filename = sprintf(__DIR__ . '/../../var/projections/%s_%s', $projection->getType(), $this->sessionId->asString());
        file_put_contents($filename, $projection->getBody());
    }
}
