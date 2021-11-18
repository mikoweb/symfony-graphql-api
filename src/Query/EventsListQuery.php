<?php
/*
 * Copyright (c) Rafał Mikołajun 2021.
 */

namespace App\Query;

use App\Repository\EventRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

final class EventsListQuery
{
    private ParameterBagInterface $params;
    private EventRepository $repository;
    private PaginatorInterface $paginator;

    public function __construct(
        ParameterBagInterface $params,
        EventRepository $repository,
        PaginatorInterface $paginator
    )
    {
        $this->params = $params;
        $this->repository = $repository;
        $this->paginator = $paginator;
    }

    public function query(?int $limit, ?int $page = 1): array
    {
        $pagination = $this->paginator->paginate(
            $this->repository->createQueryBuilder('e')->orderBy('e.createdAt', 'DESC'),
            $page ?? 1,
            $limit ?? $this->params->get('api_items_per_page')
        );

        return (array)$pagination->getItems();
    }
}
