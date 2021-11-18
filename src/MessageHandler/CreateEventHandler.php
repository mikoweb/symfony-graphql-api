<?php
/*
 * Copyright (c) Rafał Mikołajun 2021.
 */

namespace App\MessageHandler;

use App\Entity\Event;
use App\Message\CreateEventMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Exception\ValidationFailedException;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateEventHandler implements MessageHandlerInterface
{
    private EntityManagerInterface $entityManager;
    private ValidatorInterface $validator;

    public function __construct(EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        $this->entityManager = $entityManager;
        $this->validator = $validator;
    }

    public function __invoke(CreateEventMessage $message): Event
    {
        $data = $message->getData();

        $event = new Event(
            $data['name'],
            $data['streetAddress'],
            $data['country'],
            $data['city'],
            $data['zipcode'],
            $data['email'],
            $data['dateFrom'],
            $data['dateTo']
        );

        $violations = $this->validator->validate($event);

        if (0 !== count($violations)) {
            throw new ValidationFailedException($event, $violations);
        }

        $this->entityManager->persist($event);
        $this->entityManager->flush();

        return $event;
    }
}
