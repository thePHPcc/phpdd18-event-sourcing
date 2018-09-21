<?php declare(strict_types=1);

namespace Eventsourcing;

interface EventHandler
{
    public function handle(Event $event): void;
}
