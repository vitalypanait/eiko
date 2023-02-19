<?php

declare(strict_types=1);

namespace App\Module\Common\Infrastructure\Response;

use App\Module\Common\Infrastructure\Model\RequestExceptionResponseModel;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiResponse extends JsonResponse
{
    public function __construct(RequestExceptionResponseModel $model, int $status = self::HTTP_OK)
    {
        parent::__construct($this->prepareData($model, $status), $status);
    }

    private function prepareData(RequestExceptionResponseModel $model, int $status): array
    {
        return [
            'code' => $status,
            'data' => [
                'message' => $model->getMessage(),
                'errors' => $model->getErrors()
            ],
        ];
    }
}
