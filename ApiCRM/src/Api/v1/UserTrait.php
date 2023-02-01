<?php

namespace App\Api\v1;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\User;

trait UserTrait
{
    public function __construct(private ManagerRegistry $manager_registry)
    {

    }

    /**
     *  Get User Object
     * @param mixed $token
     * @return object
     */
    public function getUser($token): ?object
    {
        $user_manager = $this->manager_registry->getManager();
        $user = $user_manager->getRepository(User::class)->findOneBy(['email' => $token->getUserIdentifier()]);
        if ($user) {
            return $user;
        }
        return null;

    }
}