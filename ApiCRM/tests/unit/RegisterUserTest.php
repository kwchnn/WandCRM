<?php

namespace App\Tests;

use Doctrine\Persistence\ManagerRegistry;
use PHPUnit\Framework\TestCase;
use App\Api\v1\RegisterUser;
use Doctrine\Persistence\ObjectRepository;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;

class RegisterUserTest extends TestCase
{
    public function test_register_user_is_exist(): void
    {
        $user_register = new User;
        $user_register->setEmail('test@mail.ru');
        $user_register->setPassword('$2y$13$gcjaH5LMwSAbg7w94lvF5epCMQdWJSUfI4fC/rVbyfRamEgkuRGIe');
        $user_register->setRoles(["ROLE_USER"]);
        
        $user_register_method = $this->createMock(ObjectRepository::class);
        $user_register_method
        ->expects($this->any())
        ->method('findOneBy')
        ->with(
            $this->equalTo(['email' => 'test@mail.ru'])
        )
        ->willReturn($user_register);

        $user_register_repository = $this->createMock(ManagerRegistry::class);
        $user_register_repository
        ->expects($this->any())
        ->method('getRepository')
        ->willReturn($user_register_method);

        $user_register_manager = $this->createMock(ManagerRegistry::class);
        $user_register_manager
        ->expects($this->any())
        ->method('getManager')
        ->willReturn($user_register_repository);

        $password_hasher_mock = $this->createMock(UserPasswordHasher::class);

        $register = new RegisterUser($user_register_manager, $password_hasher_mock);
        
        $this->assertEquals(false, $register->register('{"username": "test@mail.ru", "password": "test"}'));
    }

    // public function test_register_user(): void
    // {  
    //     $user_register_method = $this->createMock(ObjectRepository::class);
    //     $user_register_method
    //     ->expects($this->any())
    //     ->method('findOneBy')
    //     ->with(
    //         $this->equalTo(['email' => 'user@mail.ru'])
    //     )
    //     ->willReturn(false);

    //     $user_register_repository = $this->createMock(ManagerRegistry::class);
    //     $user_register_repository
    //     ->expects($this->any())
    //     ->method('getRepository')
    //     ->willReturn($user_register_method);

    //     $user_register_manager = $this->createMock(ManagerRegistry::class);
    //     $user_register_manager
    //     ->expects($this->any())
    //     ->method('getManager')
    //     ->willReturn($user_register_repository);

    //     $password_hasher = $this->createMock(UserPasswordHasherInterface::class);
        

    //     $register = new RegisterUser($user_register_manager, $password_hasher);
        
    //     $this->assertEquals(true, $register->register('{"username": "user@mail.ru", "password": "test"}'));
    // }
}
