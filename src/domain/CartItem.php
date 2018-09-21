<?php declare(strict_types=1);

namespace Eventsourcing;

class CartItem
{
    /**
     * @var string
     */
    private $description;

    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $price;

    public function __construct(int $id, string $description, int $price)
    {
        $this->description = $description;
        $this->id = $id;
        $this->price = $price;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPrice(): int
    {
        return $this->price;
    }
}
