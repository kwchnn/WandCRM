<?php

namespace App\Api\v1;
use App\Api\v1\Adapter\RegisterUserInterface;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterUser implements RegisterUserInterface
{
    public function __construct(private ManagerRegistry $manager_registry, private UserPasswordHasherInterface $user_password_hasher)
    {

    }

    public function register(string $json_data): bool
    {
        $get_user = $this->manager_registry->getManager();
        $user_email = json_decode($json_data);
        if (!$get_user->getRepository(User::class)->findOneBy(['email' => $user_email->username]))
        {
           
            $user = new User();
            $plain_password = $user_email->password;
            $hashed_password = $this->user_password_hasher->hashPassword(
                $user,
                $plain_password
            );
            $user->setEmail($user_email->username)
                ->setPassword($hashed_password)
                ->setRoles(["ROLE_USER"]);
            $get_user->persist($user);
            $get_user->flush();
            return true;
        }
        return false;
    }
}