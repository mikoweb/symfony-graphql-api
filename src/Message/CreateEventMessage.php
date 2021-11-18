<?php
/*
 * Copyright (c) Rafał Mikołajun 2021.
 */

namespace App\Message;

class CreateEventMessage
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
