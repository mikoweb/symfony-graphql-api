<?php
/*
 * Copyright (c) Rafał Mikołajun 2021.
 */

namespace App\GraphQL\Type;

use DateTimeInterface;
use DateTimeImmutable;
use GraphQL\Language\AST\Node;
use Overblog\GraphQLBundle\Annotation as GQL;

/**
 * @GQL\Scalar(name="DateTime")
 * @GQL\Description("DateTime Type")
 */
class DatetimeType
{
    public static function serialize(DateTimeInterface $value): string
    {
        return $value->format('Y-m-d H:i:s');
    }

    public static function parseValue(mixed $value): DateTimeInterface
    {
        return new DateTimeImmutable($value);
    }

    public static function parseLiteral(Node $valueNode): DateTimeInterface
    {
        return new DateTimeImmutable($valueNode->value);
    }
}
