<?php declare(strict_types=1);
namespace Eventsourcing;

$pdo = new \PDO('sqlite:' . __DIR__ . '/var/events.db');
$pdo->exec(
    'CREATE TABLE IF NOT EXISTS events (
      id INTEGER PRIMARY KEY, 
      emitter_id VARCHAR(36),
      occured_at TIMESTAMP,
      topic VARCHAR(50),
      data TEXT 
    )'
);
/*
$pdo->exec(
    'CREATE TABLE IF NOT EXISTS event_streams (
      identifier VARCHAR(25) PRIMARY KEY ,
      last_id INTEGER 
    )'
);
*/
