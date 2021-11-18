<?php
/*
 * Copyright (c) Rafał Mikołajun 2021.
 */

namespace App\Validator;

use DateTimeInterface;

interface EventDatesAvareInterface
{
    public function getDateFrom(): DateTimeInterface;
    public function getDateTo(): DateTimeInterface;
}
