<?php

namespace App\Module\ChatBox;

use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[GetCollection(
    normalizationContext: ['groups' => ['chat-box:read']],
    mercure: true
)]
#[Post(
    normalizationContext: ['groups' => ['chat-box:read']],
    denormalizationContext: ['groups' => ['chat-box:write']],
    processor: ChatBoxProcessor::class
)]
class ChatBox
{
    public function __construct(
        #[ORM\Id, ORM\Column, ORM\GeneratedValue]
        #[Groups(['chat-box:read'])]
        public ?int $id = null,

        #[ORM\Column]
        #[Groups(['chat-box:read', 'chat-box:write'])]
        #[Assert\NotBlank]
        public ?string $content = null,

        #[ORM\Column]
        #[Groups(['chat-box:read'])]
        public ?ChatBoxRole $role = null,
    )
    {
    }
}
