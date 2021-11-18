<?php
/*
 * Copyright (c) Rafał Mikołajun 2021.
 */

namespace App\Query;

use Elastica\Util;
use FOS\ElasticaBundle\Finder\PaginatedFinderInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

final class EventsSearchQuery
{
    private ParameterBagInterface $params;
    private PaginatedFinderInterface $eventsFinder;

    public function __construct(ParameterBagInterface $params, PaginatedFinderInterface $eventsFinder)
    {
        $this->params = $params;
        $this->eventsFinder = $eventsFinder;
    }

    public function query(string $phrase, ?int $limit, ?int $page = 1): array
    {
        return $this->eventsFinder->find(
            Util::escapeTerm($phrase),
            $limit ?? $this->params->get('api_items_per_page')
        );
    }
}
