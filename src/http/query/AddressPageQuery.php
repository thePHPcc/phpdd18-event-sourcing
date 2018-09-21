<?php declare(strict_types=1);

namespace Eventsourcing\Http;

use Eventsourcing\Session;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Response;
use Slim\Views\PhpRenderer;

class AddressPageQuery
{
    /**
     * @var Session
     */
    private $session;

    /**
     * @var PhpRenderer
     */
    private $renderer;

    public function __construct(Session $session, PhpRenderer $renderer)
    {
        $this->session = $session;
        $this->renderer = $renderer;
    }

    /**
     * @throws \Eventsourcing\NoCheckoutIdFoundException
     */
    public function execute(Response $response): ResponseInterface
    {
        if (!$this->session->hasCheckoutId()) {
            return $response->withRedirect('/');
        }

        $id = $this->session->getCheckoutId();
        $data = [
            'cartItemList' => file_get_contents(
                __DIR__ . '/../../../var/projections/cart-items_' . $id->asString() . '.html'
            )
        ];

        return $this->renderer->render($response, 'address.phtml', $data);
    }
}
