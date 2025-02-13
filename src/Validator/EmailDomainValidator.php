<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class EmailDomainValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        /* @var EmailDomain $constraint */

        if (null === $value || '' === $value) {
            return;
        }

        $domain = substr(strrchr($value, "@"), 1);

        // TODO: implement the validation here
        if (!checkdnsrr($domain, "MX")) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}
