<?php
/*
 * Copyright (c) Rafał Mikołajun 2021.
 */

namespace App\GraphQL\Mutation;

use App\Entity\Event;
use App\GraphQL\InputValidator\EventValidator;
use App\Message\CreateEventMessage;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;
use Overblog\GraphQLBundle\Validator\Exception\ArgumentsValidationException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;


class EventCreateMutation implements MutationInterface, AliasedInterface
{
    private MessageBusInterface $bus;
    private EventValidator $validator;

    public function __construct(MessageBusInterface $bus, EventValidator $validator)
    {
        $this->bus = $bus;
        $this->validator = $validator;
    }

    /**
     * @param array $data
     * @return Event
     * @throws ArgumentsValidationException
     */
    public function create(array $data): Event
    {
        $this->validator->validate($data);
        $result = $this->bus->dispatch(new CreateEventMessage($data));

        return $result->last(HandledStamp::class)->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            'create' => 'EventCreate'
        ];
    }
}
