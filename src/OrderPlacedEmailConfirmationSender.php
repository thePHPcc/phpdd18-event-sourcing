<?php declare(strict_types=1);

namespace Eventsourcing;

class OrderPlacedEmailConfirmationSender implements EventHandler
{

    /**
     * @var MailService
     */
    private $mailService;

    public function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
    }

    public function handle(Event $event): void
    {
        /** @var OrderPlacedEvent $event */
        $mail = new Mail('Order Confirmation', $event->getOrder()->getBillingAddress()->getEmail());
        $this->mailService->send($mail);
    }
}
