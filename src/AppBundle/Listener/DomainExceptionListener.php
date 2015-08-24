<?php

namespace AppBundle\Listener;

use CoreDomain\Exception\AccessDeniedException;
use CoreDomain\Exception\DomainException;
use CoreDomain\Exception\EntityNotFoundException;
use CoreDomain\Exception\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class DomainExceptionListener
{
    public function onDomainException(GetResponseForExceptionEvent $event)
    {
        $e = $event->getException();

        if (!($e instanceof DomainException)) {
            return;
        }

        if ($e instanceof ValidationException) {
            $response = new JsonResponse($e->getErrors(), 400);
        } elseif ($e instanceof AccessDeniedException) {
            $response = new JsonResponse($e->getMessage(), 403);
        } elseif ($e instanceof EntityNotFoundException) {
            $response = new JsonResponse($e->getMessage(), 404);
        } else {
            $response = new JsonResponse(null, 500);
        }

        $event->setResponse($response);
    }
}
