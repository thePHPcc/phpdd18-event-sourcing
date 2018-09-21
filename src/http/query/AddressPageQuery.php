<?php declare(strict_types=1);

namespace Eventsourcing\Http;

use Eventsourcing\Session;
use Slim\Http\Response;

class AddressPageQuery
{
    /**
      * @var Session
      */
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function execute(Response $response)
    {
        if (!$this->session->hasCheckoutId()) {
            return $response->withRedirect('/');
        }

        $id = $this->session->getCheckoutId();
        $renderer = new \Slim\Views\PhpRenderer(__DIR__ . '/../templates');
        $data = [
            'cartItemList' => file_get_contents(__DIR__ . '/../../../var/projections/cart-items_' . $id->asString() . '.html')
        ];
        return $renderer->render($response, 'address.phtml', $data);
    }
}
