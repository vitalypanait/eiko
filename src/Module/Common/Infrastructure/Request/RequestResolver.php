<?php

namespace App\Module\Common\Infrastructure\Request;

use App\Module\Common\Infrastructure\Exception\BadRequestException;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RequestResolver implements ValueResolverInterface
{
    protected ValidatorInterface $validator;
    protected SerializerInterface $serializer;

    public function __construct(ValidatorInterface $validator, SerializerInterface $serializer)
    {
        $this->validator = $validator;
        $this->serializer = $serializer;
    }

    /**
     * @throws BadRequestException
     */
    public function resolve(Request $request, ArgumentMetadata $argument): array
    {
        $argumentType = $argument->getType();

        if (!$argumentType || !is_subclass_of($argumentType, IdentifierInterface::class)) {
            return [];
        }

        if ($request->getContentTypeFormat() !== 'json') {
            throw new BadRequestException('Invalid Content-type');
        }

        try {
            $object = $this->serializer->deserialize(
                $request->getContent(),
                $argument->getType(),
                'json',
                [AbstractObjectNormalizer::DISABLE_TYPE_ENFORCEMENT => true]
            );
        } catch (NotEncodableValueException $e) {
            throw new BadRequestException('Error in json body: ' . $e->getMessage());
        } catch (Exception $e) {
            throw new BadRequestException('Invalid request data: ' . $e->getMessage());
        }

        $errors = $this->validator->validate($object);

        if (count($errors) > 0) {
            $exception = new BadRequestException();

            foreach ($errors as $error) {
                $exception->addError($error->getMessage(), $error->getCode());
            }

            throw $exception;
        }

        return [$object];
    }
}
