<?php declare(strict_types=1);

namespace Eventsourcing;

class Order
{
    /**
     * @var OrderNumber
     */
    private $orderNumber;

    /**
     * @var BillingAddress
     */
    private $billingAddress;

    /**
     * @var OrderItemCollection
     */
    private $items;

    public function __construct(OrderNumber $orderNumber, BillingAddress $billingAddress, OrderItemCollection $items)
    {
        $this->orderNumber = $orderNumber;
        $this->billingAddress = $billingAddress;
        $this->items = $items;
    }
}
