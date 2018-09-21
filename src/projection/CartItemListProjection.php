<?php declare(strict_types=1);

namespace Eventsourcing;

class CartItemListProjection implements Projection
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
        return 'cart-items';
    }

    public function getBody(): string
    {
        return $this->body;
    }
}
