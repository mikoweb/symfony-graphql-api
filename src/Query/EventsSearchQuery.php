<?php
/*
 * Copyright (c) Rafał Mikołajun 2021.
 */

namespace App\Query;

use App\Repository\EventRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use function Doctrine\ORM\QueryBuilder;

final class EventsSearchQuery
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

    public function query(string $phrase, ?int $limit, ?int $page = 1): array
    {
        $qb = $this->repository->createQueryBuilder('e');
        $qb = $qb
            ->where($qb->expr()->like('e.name', ':like_name'))
            ->setParameter('like_name', "%$phrase%")
            ->orderBy('e.createdAt', 'DESC')
        ;

        $pagination = $this->paginator->paginate(
            $qb,
            $page ?? 1,
            $limit ?? $this->params->get('api_items_per_page')
        );

        return (array)$pagination->getItems();
    }
}
