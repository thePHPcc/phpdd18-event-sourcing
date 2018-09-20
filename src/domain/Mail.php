<?php declare(strict_types=1);

namespace Eventsourcing;

class Mail
{
    /**
     * @var string
     */
    private $subject;

    /**
     * @var string
     */
    private $recipientAddress;

    public function __construct(string $subject, string $recipientAddress)
    {
        $this->subject = $subject;
        $this->recipientAddress = $recipientAddress;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getRecipientAddress(): string
    {
        return $this->recipientAddress;
    }
}
