<?php
/*
 * Copyright (c) Rafał Mikołajun 2021.
 */

namespace App\GraphQL\Resolver;

use App\Query\EventsListQuery;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

final class EventsListResolver implements ResolverInterface, AliasedInterface
{
    private EventsListQuery $eventsListQuery;

    public function __construct(EventsListQuery $eventsListQuery)
    {
        $this->eventsListQuery = $eventsListQuery;
    }

    public function resolve(Argument $args): array
    {
        return [
            'events' => $this->eventsListQuery->query($args->offsetGet('limit'), $args->offsetGet('page'))
        ];
    }

    public static function getAliases(): array
    {
        return [
            'resolve' => 'EventsList'
        ];
    }
}
