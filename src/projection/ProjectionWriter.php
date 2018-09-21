<?php declare(strict_types=1);

namespace Eventsourcing;

class ProjectionWriter
{
    public function write(EmitterId $emitterId, Projection $projection)
    {
        $filename = sprintf(
            __DIR__ . '/../../var/projections/%s_%s.html',
            $projection->getType(),
            $emitterId->asString()
        );
        file_put_contents($filename, $projection->getBody());
    }
}
