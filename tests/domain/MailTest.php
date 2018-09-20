<?php declare(strict_types=1);

namespace Eventsourcing;
use PHPUnit\Framework\TestCase;

class MailTest extends TestCase
{

    public function testReturnsExpectedSubject()
    {
        $mail = new Mail('some subject', 'jane.doe@example.com');
        $this->assertSame('some subject', $mail->getSubject());
    }
    public function testReturnsExpectedRecipientAddress()
    {
        $mail = new Mail('some subject', 'jane.doe@example.com');
        $this->assertSame('jane.doe@example.com', $mail->getRecipientAddress());
    }

}
