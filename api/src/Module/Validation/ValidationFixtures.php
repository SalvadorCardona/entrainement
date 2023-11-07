<?php

namespace App\Module\Validation;

use App\DataFixtures\AppFixtures;

class ValidationFixtures extends AppFixtures
{
    public static function factory(): Validation
    {
        return new Validation(
            description: self::faker()->text(50),
            dateCreation: new \DateTimeImmutable(self::faker()->dateTimeThisYear()->format('Y-m-d H:i:s')),
        );
    }
}
