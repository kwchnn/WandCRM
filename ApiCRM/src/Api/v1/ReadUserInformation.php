<?php

namespace App\Api\v1;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;


class RegisterUser
{
    public function __construct(private ManagerRegistry $manager_registry)
    {

    }

    /**
     * Доделать функцию выбора сайтов по email пользователя
     */
    // public function getUserDataFromEmail(string $token): bool
    // {
    //     $
    // }
}