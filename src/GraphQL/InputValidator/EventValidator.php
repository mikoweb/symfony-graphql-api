<?php
/*
 * Copyright (c) Rafał Mikołajun 2021.
 */

namespace App\GraphQL\InputValidator;

use App\Validator\EventDatesConstraint;
use DateTimeInterface;
use Overblog\GraphQLBundle\Validator\Exception\ArgumentsValidationException;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use ZipCodeValidator\Constraints\ZipCode as AssertZipCode;

class EventValidator
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param array $data
     * @throws ArgumentsValidationException
     */
    public function validate(array $data): void
    {
        $violations = $this->validator->validate($data, [
            new EventDatesConstraint(),
            new Assert\Collection([
                'fields' => [
                    'name' => new Assert\Required([
                        new Assert\Length(['max' => 50])
                    ]),
                    'streetAddress' => new Assert\Required([
                        new Assert\Length(['max' => 255])
                    ]),
                    'country' => new Assert\Required([
                        new Assert\Length(['max' => 2])
                    ]),
                    'city' => new Assert\Required([
                        new Assert\Length(['max' => 255])
                    ]),
                    'zipcode' => new Assert\Required([
                        new Assert\Length(['max' => 25]),
                        new AssertZipCode(['iso' => $data['country']])
                    ]),
                    'email' => new Assert\Required([
                        new Assert\Length(['max' => 255]),
                        new Assert\Email()
                    ]),
                    'dateFrom' => new Assert\Required([
                        new Assert\Type(['type' => DateTimeInterface::class])
                    ]),
                    'dateTo' => new Assert\Required([
                        new Assert\Type(['type' => DateTimeInterface::class])
                    ]),
                ],
            ])
        ]);

        if (0 !== count($violations)) {
            throw new ArgumentsValidationException($violations);
        }
    }
}
