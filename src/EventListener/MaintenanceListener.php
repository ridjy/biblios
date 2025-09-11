<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Twig\Environment;

final class MaintenanceListener
{
    public const IS_MAINTENANCE = false;
    public function __construct(private readonly Environment $twig) {

    }

    #[AsEventListener(event: 'kernel.request', priority: 2000)]
    public function onRequestEvent(RequestEvent $event): void
    {
        if (self::IS_MAINTENANCE) {
            $response = new Response($this->twig->render('maintenance.html.twig'));
            $event->setResponse($response);
        }
    }
}
