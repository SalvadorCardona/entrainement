<?php

namespace App\Module\Depot;

use App\DataFixtures\AppFixtures;

class DepotFixtures extends AppFixtures
{

    public static function factory(): Depot
    {
        return new Depot(
            titre: self::faker()->text(20),
            description: self::faker()->text(50),
            dateCreation: new \DateTimeImmutable(self::faker()->dateTimeThisYear()->format('Y-m-d H:i:s')),
        );
    }
}
