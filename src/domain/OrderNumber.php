<?php declare(strict_types=1);

namespace Eventsourcing;

class OrderNumber
{
    /**
     * @var string
     */
    private $value;

    public function __construct(string $value = null)
    {
        if ($value === null) {
            exec('uuidgen', $output);
            $value = trim($output[0]);
        }
        $this->value = $value;
    }

    public function asString(): string
    {
        return $this->value;
    }
}
