<?php
/*
 * Copyright (c) Rafał Mikołajun 2021.
 */

namespace App\GraphQL\Resolver;

use App\Entity\Event;
use App\Repository\EventRepository;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;
use DateTimeInterface;

final class EventResolver implements ResolverInterface, AliasedInterface
{
    private EventRepository $repository;

    public function __construct(EventRepository $repository)
    {
        $this->repository = $repository;
    }

    public function resolve(Argument $args): ?Event
    {
        return $this->repository->find($args->offsetGet('id'));
    }

    public function getDateFrom(Event $event): DateTimeInterface
    {
        return $event->getDateFrom();
    }

    public function getDateTo(Event $event): DateTimeInterface
    {
        return $event->getDateTo();
    }

    public static function getAliases(): array
    {
        return [
            'resolve' => 'Event',
            'getDateFrom' => 'Event_getDateFrom',
            'getDateTo' => 'Event_getDateTo',
        ];
    }
}
