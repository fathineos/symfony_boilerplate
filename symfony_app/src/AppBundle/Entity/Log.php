<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="log")
 */
class Log
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @ORM\Column(name="api_key", type="string", length=100)
     */
    private $apiKey;

    /**
     * @param string $apiKey
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey(string $apiKey): void
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return [
            'id' => $this->getId(),
            'api_key' => $this->getApiKey(),
            'user_id' => $this->getUserId(),
        ];
    }
}
