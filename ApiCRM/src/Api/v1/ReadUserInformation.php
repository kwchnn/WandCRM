<?php

namespace App\Api\v1;

use App\Api\v1\Adapter\ReadUserInformationInterface;
use App\Repository\SitesRepository;
use App\Repository\UserRepository;

class ReadUserInformation implements ReadUserInformationInterface
{

    public function __construct(private SitesRepository $sites_repository, private UserRepository $user_repository)
    {

    }

    /**
     * return array user email by user token identifier
     */
    public function getUserInformation(object $token): array
    {
        $user_identifier = $token->getUserIdentifier();
        $user_email = $this->user_repository->getUser($user_identifier);
        return [
            'Email' => $user_email->getEmail()
        ];
    }

    /**
     * return user sites by user_id
     */
    public function getUserSitesInformation(object $token): array
    {
        $user_site = $this->sites_repository->getUserSites($token->getId());
        if ($user_site)
        {
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
        return [
            'Message' => 'Sites not found'
        ];
    }
}