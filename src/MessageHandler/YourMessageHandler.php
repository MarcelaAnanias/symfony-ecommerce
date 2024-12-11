<?php

namespace App\MessageHandler;

use App\Message\YourMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class YourMessageHandler
{
    public function __invoke(YourMessage $message): void
    {
        // do something with your message
    }
}
