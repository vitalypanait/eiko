<?php

namespace App\Module\Common\Money;

use Brick\Math\BigDecimal;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class BrickBigDecimalDoctrineType extends Type
{
    private const TYPE = 'BigDecimal';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return $platform->getDecimalTypeDeclarationSQL(
            array_merge(['precision' => 19, 'scale' => 2], $fieldDeclaration)
        );
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?BigDecimal
    {
        return $value === null ? null : BigDecimal::of($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        return null !== $value ? (string) $value : null;
    }

    public function getName(): string
    {
        return self::TYPE;
    }
}
