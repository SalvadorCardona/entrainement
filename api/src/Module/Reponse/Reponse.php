<?php

namespace App\Module\Reponse;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use App\Module\Depot\Depot;
use App\Module\Validation\Validation;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Table(name: 'demande_clinique_reponses')]
#[ORM\Entity]
#[Post(denormalizationContext: ['groups' => ['reponse:create']])]
#[Get(normalizationContext: ['groups' => ['depot:read']])]
class Reponse
{
    public function __construct(
        #[ORM\Id, ORM\Column, ORM\GeneratedValue]
        #[Groups(['depot:read'])]
        public ?int $id = null,

        #[ORM\Column(length: 255)]
        #[Groups(['depot:read', 'reponse:create'])]
        public ?string $titre = null,

        #[ORM\Column]
        #[Groups(['depot:read', 'reponse:create'])]
        public ?string $description = null,

        #[Groups(['depot:read'])]
        #[ORM\Column]
        public ?\DateTimeImmutable $dateCreation = new \DateTimeImmutable(),

        #[ORM\ManyToOne(targetEntity: Depot::class, inversedBy: 'reponses')]
        #[Groups(['reponse:create'])]
        public ?Depot $depot = null,

        #[Groups(['depot:read', 'reponse:create'])]
        #[ORM\Column]
        public ?int $type = null,


        #[ORM\ManyToOne(cascade: ['persist'], inversedBy: 'reponses')]
        #[Groups(['depot:read'])]
        public ?Validation $validation = null
    )
    {}
}

