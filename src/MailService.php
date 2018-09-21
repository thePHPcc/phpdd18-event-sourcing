<?php declare(strict_types=1);

namespace Eventsourcing;

class MailService
{
    public function send(Mail $mail)
    {
        echo sprintf("Sending mail with subject '%s' to %s... \n", $mail->getSubject(), $mail->getRecipientAddress());
        sleep(2);
        echo sprintf("Mail sent to %s. \n", $mail->getRecipientAddress());
    }
}
