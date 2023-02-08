<?php

namespace App\functional\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Entity\Sites;

class SitesRepositoryTest extends KernelTestCase
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

    public function test_get_site_by_user_id(): void
    {
        $sites_array = $this->entity_manager
            ->getRepository(Sites::class)
            ->findBy(['user_id' => 1]);

        $array = [];
        foreach ($sites_array as $sites)
        {
            $array[] = [
                'Id' => $sites->getId(),
                'Title' => $sites->getTitle(),
                'Description' => $sites->getDescription(),
                'Icon' => $sites->getIcon(),
            ];

        }

        $this->assertSame([
            ['Id'=> 4,
             'Title' => 'vk.com',
             'Description' => 'Соц. сеть для поиска людей',
             'Icon' => 'img/vk.png'
            ],
            ['Id'=> 5,
             'Title' => 'facebook.com',
             'Description' => 'Social network',
             'Icon' => 'img/facbook.png'
            ]
        ], $array);
    }
}
