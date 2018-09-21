<?php declare(strict_types=1);

namespace Eventsourcing;

class BillingAddressProjection implements Projection
{
    /**
     * @var string
     */
    private $body;

    public function __construct(string $body)
    {
        $this->body = $body;
    }

    public function getType(): string
    {
        return 'billing-address';
    }

    public function getBody(): string
    {
        return $this->body;
    }
}
