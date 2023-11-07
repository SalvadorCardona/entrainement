<?php

namespace App\Module\Validation;

use ApiPlatform\Metadata\Post;
use App\Module\Reponse\Reponse;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity]
#[Post(normalizationContext: ['groups' => ['reponse_validation:read']], denormalizationContext: ['groups' => ['reponse_validation:create']])]
class Validation
{
    #[ORM\OneToMany(mappedBy: 'validation', targetEntity: Reponse::class, cascade: ['persist'])]
    #[Groups(['reponse_validation:create', 'reponse_validation:read'])]
    public Collection $reponses;

    public function __construct(
        #[ORM\Id]
        #[ORM\GeneratedValue]
        #[ORM\Column]
        #[Groups(['depot:read', 'reponse_validation:read'])]
        public ?int $id = null,

        #[ORM\Column(length: 255, nullable: true)]
        #[Groups(['depot:read', 'reponse_validation:create', 'reponse_validation:read'])]
        public ?string $description = null,

        #[ORM\Column(type: Types::DATE_IMMUTABLE)]
        #[Groups(['depot:read'])]
        public ?\DateTimeImmutable $dateCreation = new \DateTimeImmutable(),
    )
    {
        $this->reponses = new ArrayCollection();
    }

    public function addReponse(Reponse $reponse): static
    {
        if (!$this->reponses->contains($reponse)) {
            $this->reponses->add($reponse);
            $reponse->validation = $this;
        }

        return $this;
    }

    public function removeReponse(Reponse $reponse): static
    {
        if ($this->reponses->removeElement($reponse)) {
            // set the owning side to null (unless already changed)
            if ($reponse->validation === $this) {
                $reponse->validation = $this;
            }
        }

        return $this;
    }
}
