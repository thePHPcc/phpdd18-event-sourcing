<?php declare(strict_types=1);

namespace Eventsourcing;

use PHPUnit\Framework\TestCase;

class CartServiceTest extends TestCase
{
    /**
     * @var CartService
     */
    private $service;

    protected function setUp()
    {
        $this->service = new CartService();
    }

    public function testThrowsExceptionIfSessionIdIsNotKnown()
    {
        $this->expectException(CartNotFoundException::class);
        $this->service->getCartItems();
    }

    /**
     * @dataProvider sessionIdProvider
     *
     * @param SessionId $sessionId
     * @param int $expectedCount
     * @throws CartNotFoundException
     */
    public function testReturnsCartItemCollectionWithExpectedAmountOfItems(SessionId $sessionId, int $expectedCount)
    {
        $collection = $this->service->getCartItems();
        $this->assertCount($expectedCount, $collection);
    }

    public function sessionIdProvider(): array
    {
        return [
            [new SessionId('ihgorhmtcvo3qmd5as2oi7thpf'), 1],
            [new SessionId('has4t1glskcktjh4ujs9eet26u'), 5],
            [new SessionId('10603jjdasv8vpid64t214762l'), 25],
        ];
    }
}
