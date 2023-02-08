<?php

namespace App\Api\v1;

use App\Api\v1\Adapter\ReadUserInformationInterface;
use App\Entity\Sites;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\UserRepository;

class ReadUserInformation implements ReadUserInformationInterface
{

    public function __construct(private ManagerRegistry $manager_registry, private UserRepository $user_repository)
    {

    }

    public function getUserInformation(object $token): array
    {
        $user_email = $this->user_repository->getUser($token);
        return [
            'Email' => $user_email->getEmail()
        ];
    }

    public function getUserSitesInformation(object $token): array
    {
        $user_email = $this->user_repository->getUser($token);
        $user_site = $this->manager_registry->getRepository(Sites::class)->findBy(['user_id' => $user_email->getId()]);

        foreach ($user_site as $sites){
            $sites_array[] = [
                'Id' => $sites->getId(),
                'Title' => $sites->getTitle(),
                'Description' => $sites->getDescription(),
                'Icon' => $sites->getIcon(),
                'CreatedAt' => $sites->getCreatedAt(),
                'UpdatedAt' => $sites->getUpdatedAd()
            ];
        }
        return $sites_array;
    }
}