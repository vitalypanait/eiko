<?php

declare(strict_types=1);

namespace App\Module\Common\Infrastructure\Response;

use App\Module\Common\Infrastructure\Exception\ApiExceptionInterface;
use App\Module\Common\Infrastructure\Exception\HasErrorsApiExceptionInterface;
use App\Module\Common\Infrastructure\Model\RequestExceptionResponseModel;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Throwable;

final class ApiJsonDriver implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            ExceptionEvent::class => ['onKernelException', 100],
        ];
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        /** @var Throwable $exception */
        $exception = $event->getThrowable();

        if (false === ($exception instanceof ApiExceptionInterface)) {
            return;
        }

        $event->allowCustomResponseCode();

        $exceptionResponse = new RequestExceptionResponseModel($exception->getMessage());

        if ($exception instanceof HasErrorsApiExceptionInterface) {
            $exceptionResponse->setErrors($exception->getErrors());
        }

        $code = (int) $exception->getCode();

        $response = new ApiResponse($exceptionResponse, 0 === $code ? 500 : $code);
        $response->setStatusCode($code);

        $event->setResponse($response);
        $event->stopPropagation();
    }
}
