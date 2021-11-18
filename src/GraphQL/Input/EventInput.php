<?php
/*
 * Copyright (c) Rafał Mikołajun 2021.
 */

namespace App\GraphQL\Input;

use Overblog\GraphQLBundle\Annotation as GQL;
use DateTimeInterface;

/**
 * @GQL\Input
 */
class EventInput
{
    /**
     * @GQL\Field(name="name", type="String!")
     * @GQL\Description("Event name")
     */
    protected string $name;

    /**
     * @GQL\Field(name="streetAddress", type="String!")
     * @GQL\Description("Event address")
     */
    protected string $streetAddress;

    /**
     * @GQL\Field(name="country", type="String!")
     * @GQL\Description("Event country")
     */
    protected string $country;

    /**
     * @GQL\Field(name="city", type="String!")
     * @GQL\Description("Event city")
     */
    protected string $city;

    /**
     * @GQL\Field(name="zipcode", type="String!")
     * @GQL\Description("Event zipcode")
     */
    protected string $zipcode;

    /**
     * @GQL\Field(name="email", type="String!")
     * @GQL\Description("Contact email")
     */
    protected string $email;

    /**
     * @GQL\Field(name="dateFrom", type="DateTime!")
     * @GQL\Description("Event date from")
     */
    protected DateTimeInterface $dateFrom;

    /**
     * @GQL\Field(name="dateTo", type="DateTime!")
     * @GQL\Description("Event date to")
     */
    protected DateTimeInterface $dateTo;
}
