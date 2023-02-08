<?php

namespace App\functiona\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Entity\User;

class UserRepositoryTest extends KernelTestCase
{
    /**
     * EntityManager
     * @var \Doctrine\ORM\EntityManager
     */
    private $entity_manager;

    public function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entity_manager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function test_search_by_email()
    {
        $user = $this->entity_manager
            ->getRepository(User::class)
            ->findOneBy(['email' => 'test@mail.ru']);
        $this->assertSame('test@mail.ru', $user->getEmail());
    }

    public function test_search_by_id()
    {
        $user = $this->entity_manager
            ->getRepository(User::class)
            ->findOneBy(['id' => 1]);
        $this->assertSame('root', $user->getEmail());
    }

    public function tearDown(): void
    {
        parent::tearDown();

        $this->entity_manager->close();
        $this->entity_manager = null;
    }
}
