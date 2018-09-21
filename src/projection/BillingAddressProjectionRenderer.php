<?php declare(strict_types=1);

namespace Eventsourcing;

class BillingAddressProjectionRenderer
{
    public function render(BillingAddress $billingAddress): BillingAddressProjection
    {
        $template = file_get_contents(__DIR__ . '/templates/billingAddress.html');
        return new BillingAddressProjection(
            str_replace(
                [
                    '%%NAME%%',
                    '%%STREET%%',
                    '%%ZIP%%',
                    '%%CITY%%'
                ],
                [
                    $billingAddress->getName(),
                    $billingAddress->getStreet(),
                    $billingAddress->getZip(),
                    $billingAddress->getCity()
                ],
                $template
            )
        );
    }
}
