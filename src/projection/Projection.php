<?php declare(strict_types=1);

namespace Eventsourcing;

interface Projection
{
    public function getType(): string;

    public function getBody(): string;
}
