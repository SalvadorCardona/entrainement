<?php

namespace App\Module\ChatBox;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Serializer\SerializerInterface;


readonly class ChatBoxProcessor implements ProcessorInterface
{
    public function __construct(
        public EntityManagerInterface $entityManager,
        public EventDispatcherInterface $eventDispatcher,
        public HubInterface $hub,
        public SerializerInterface $serializer,
    )
    {
    }

    /**
     * @param ChatBox $data
     */
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        $data->role = ChatBoxRole::Guest;

        $response = new ChatBox(
            content: Factory::create()->text,
            role: ChatBoxRole::Admin
        );

        $this->entityManager->persist($data);
        $this->entityManager->persist($response);
        $this->entityManager->flush();

        $update = new Update(
            'chat_box',
            $this->serializer->serialize($response, 'json', ['groups' => ['chat-box:read']])
        );

        $this->hub->publish($update);

        return $data;
    }
}
