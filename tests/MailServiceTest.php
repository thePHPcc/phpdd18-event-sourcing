<?php declare(strict_types=1);

namespace Eventsourcing;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class MailServiceTest extends TestCase
{
    public function testWritesExpectedOutput()
    {
        $mail = $this->createMailMock();
        $mail->method('getSubject')->willReturn('some subject');
        $mail->method('getRecipientAddress')->willReturn('jane.doe@example.com');
        $service = new MailService();

        $expectedOutput = "Sending mail with subject 'some subject' to jane.doe@example.com... \n";
        $expectedOutput .= "Mail sent. \n";
        $this->expectOutputString($expectedOutput);
        $service->send($mail);
    }

    /**
     * @return MockObject|Mail
     */
    private function createMailMock()
    {
        return $this->createMock(Mail::class);
    }
}
