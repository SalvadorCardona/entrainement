<?php

namespace App\Module\Depot;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Module\Reponse\Reponse;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name: 'demande_clinique_depots')]
#[ORM\Entity]
#[GetCollection(normalizationContext: ['groups' => ['depot:read']])]
#[Get(normalizationContext: ['groups' => ['depot:read']])]
class Depot
{
    public function __construct(
        #[ORM\Id, ORM\Column, ORM\GeneratedValue]
        #[Groups(['depot:read'])]
        public ?int $id = null,

        #[ORM\Column(length: 255)]
        #[Groups(['depot:read'])]
        #[Assert\NotBlank]
        public ?string $titre = null,

        #[ORM\Column]
        #[Groups(['depot:read'])]
        #[Assert\NotBlank]
        public ?string $description = null,

        #[Groups(['depot:read'])]
        #[ORM\Column]
        public ?\DateTimeImmutable  $dateCreation = null,

        #[ORM\OneToMany(mappedBy: 'depot', targetEntity: Reponse::class, cascade: ['persist'])]
        #[Groups(['depot:read'])]
        /** @var Reponse[] $reponses */
        public iterable $reponses = new ArrayCollection()
    )
    {}

    public function addReponse(Reponse $reponse): self
    {
        if (!$this->reponses->contains($reponse)) {
            $this->reponses[] = $reponse;
            $reponse->depot = $this;
        }

        return $this;
    }

    public function removeReponse(Reponse $reponse): self
    {
        if ($this->reponses->removeElement($reponse)) {
            // set the owning side to null (unless already changed)
            if ($reponse->depot === $this) {
                $reponse->depot = null;
            }
        }

        return $this;
    }
}
