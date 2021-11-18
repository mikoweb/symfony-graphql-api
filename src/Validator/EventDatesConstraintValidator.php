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
     * @param EventDatesAvareInterface $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint): void
    {
        if ($value->getDateTo() < $value->getDateFrom()) {
            $this->context->buildViolation('dateTo must be greather than dateFrom')
                ->atPath('dateFrom')
                ->addViolation()
            ;
        }

        $interval = $value->getDateFrom()->diff($value->getDateTo());

        if ($interval->days < 7) {
            $this->context->buildViolation('dateTo must be greather than dateFrom by 7 days')
                ->atPath('dateFrom')
                ->addViolation()
            ;
        }
    }
}
