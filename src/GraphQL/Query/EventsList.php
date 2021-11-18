<?php
/*
 * Copyright (c) Rafał Mikołajun 2021.
 */

namespace App\GraphQL\Query;

use Overblog\GraphQLBundle\Annotation as GQL;

/**
 * @GQL\Type
 * @GQL\Description("Events List")
 */
class EventsList
{
    /**
     * @GQL\Field(name="events", type="[Event]")
     * @GQL\Description("Events Array")
     */
    protected array $events;
}
