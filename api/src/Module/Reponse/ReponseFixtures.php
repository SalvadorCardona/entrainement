<?php

namespace App\Module\Reponse;

use App\DataFixtures\AppFixtures;
use App\Module\Depot\DepotFixtures;
use App\Module\Validation\ValidationFixtures;
use Doctrine\Persistence\ObjectManager;

class ReponseFixtures extends AppFixtures
{
    public function load(ObjectManager $manager): void
    {
        foreach (range(1, 10) as $depotIteration) {
            $depot = DepotFixtures::factory();

            foreach (range(1, 10) as $reponseIteration) {
                $reponse = self::factory($depot);
                $depot->addReponse($reponse);

                if ($reponseIteration % 3 === 0) {
                    $validation = ValidationFixtures::factory();
                    $validation->addReponse($reponse);
                }
            }

            $manager->persist($depot);
        }

        $manager->flush();
    }

    public static function factory(): Reponse
    {
        return new Reponse(
            titre: self::faker()->text(20),
            description: self::faker()->text(100),
            dateCreation: new \DateTimeImmutable(self::faker()->dateTimeThisYear()->format('Y-m-d H:i:s')),
            type: self::faker()->randomElement(ReponseType::getAll())
        );
    }
}
