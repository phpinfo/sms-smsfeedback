<?php
declare(strict_types=1);

namespace Phpinfo\Sms\Smsfeedback;

use GuzzleHttp\Exception\GuzzleException;
use Phpinfo\Sms\Exception\InvalidAuthorizationException;
use Phpinfo\Sms\Exception\NetworkException;
use Phpinfo\Sms\Exception\RuntimeException;
use Phpinfo\Sms\Message\MessageInterface;
use Phpinfo\Sms\Sender\SenderInterface;
use SmsFeedback\ApiClientInterface;

class SmsFeedbackSender implements SenderInterface
{
    private $client;

    public function __construct(ApiClientInterface $client)
    {
        $this->client = $client;
    }

    public function send(MessageInterface $message): void
    {
        $phone    = (string)$message->getPhone();
        $text     = $message->getText();
        $senderId = $message->getSenderId();

        try {
            $response = $this->client->send($phone, $text, $senderId);
        } catch (GuzzleException $e) {
            if ($e->getCode() === 401) {
                throw new InvalidAuthorizationException('', 0, $e);
            }

            throw new NetworkException('', 0, $e);
        }

        if ($response->isError()) {
            throw new RuntimeException('Transport error occurred: ' . $response->getId());
        }
    }
}
