<?php declare(strict_types=1);

namespace Eventsourcing;

class BillingAddressProjectionRenderer
{
    public function render(BillingAddress $billingAddress): Projection
    {
        $output = 'Billing Address:';
        $output .= $billingAddress->getName() . "\n";
        $output .= $billingAddress->getStreet() . "\n";
        $output .= $billingAddress->getCity() . "\n";

        return new BillingAddressProjection($output);
    }
}
