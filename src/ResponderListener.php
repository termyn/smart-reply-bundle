<?php

declare(strict_types=1);

namespace Termyn\Bundle\SmartReply;

use Symfony\Component\HttpKernel\Event\ViewEvent;
use Termyn\SmartReply\Responder;
use Termyn\SmartReply\Response\Resource;

final class ResponderListener
{
    public function __construct(
        private Responder $responder,
    ) {
    }

    public function __invoke(ViewEvent $event): void
    {
        $controllerResult = $event->getControllerResult();
        if (! $controllerResult instanceof Resource) {
            return;
        }

        $event->setResponse(
            $this->responder->process($controllerResult)
        );
    }
}
