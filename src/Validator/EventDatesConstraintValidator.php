<?php
/*
 * Copyright (c) Rafał Mikołajun 2021.
 */

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

final class EventDatesConstraintValidator extends ConstraintValidator
{
    /**
     * @param EventDatesAvareInterface|array $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint): void
    {
        $dateFrom = is_array($value) ? $value['dateFrom'] : $value->getDateFrom();
        $dateTo = is_array($value) ? $value['dateTo'] : $value->getDateTo();

        if ($dateTo < $dateFrom) {
            $this->context->buildViolation('dateTo must be greather than dateFrom')
                ->atPath('dateFrom')
                ->addViolation()
            ;
        }

        $interval = $dateFrom->diff($dateTo);

        if ($interval->days < 7) {
            $this->context->buildViolation('dateTo must be greather than dateFrom by 7 days')
                ->atPath('dateFrom')
                ->addViolation()
            ;
        }
    }
}
