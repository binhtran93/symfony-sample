<?php


namespace App\EventListener;


use App\Response\ApiResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {

        $exception = $event->getThrowable();
        $request   = $event->getRequest();

        $response = $this->createApiResponse($exception);
        $event->setResponse($response);
    }

    private function createApiResponse(\Throwable $exception)
    {
        $statusCode = $exception instanceof HttpExceptionInterface ? $exception->getStatusCode() : Response::HTTP_INTERNAL_SERVER_ERROR;
        $errors     = [];

        return new ApiResponse($exception->getMessage(), null, $errors, $statusCode);
    }
}