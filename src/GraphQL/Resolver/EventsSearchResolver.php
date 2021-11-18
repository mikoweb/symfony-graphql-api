<?php
/*
 * Copyright (c) Rafał Mikołajun 2021.
 */

namespace App\GraphQL\Resolver;

use App\Query\EventsSearchQuery;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

final class EventsSearchResolver implements ResolverInterface, AliasedInterface
{
    private EventsSearchQuery $query;

    public function __construct(EventsSearchQuery $query)
    {
        $this->query = $query;
    }

    public function resolve(Argument $args): array
    {
        return [
            'events' => $this->query->query(
                $args->offsetGet('phrase'),
                $args->offsetGet('limit'),
                $args->offsetGet('page')
            )
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'EventsSearch'
        ];
    }
}
