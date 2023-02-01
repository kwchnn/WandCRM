<?php

namespace App\Controller\v1;

use App\Api\v1\Adapter\ReadUserInformationInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class UserDataController extends AbstractController
{
    public function __construct(private TokenStorageInterface $token_storage_interface, private ReadUserInformationInterface $read_user_information)
    {

    }
    
    #[Route('/api/v1/me', name: 'user_data', methods: ['POST', 'OPTIONS'])]
    public function getUserData(Request $request): Response
    {
        $get_user_information_object = $this->read_user_information;
        $jwt_token = $this->token_storage_interface->getToken();
        $user_data = $get_user_information_object->getUserInformation($jwt_token->getUser());
        return new JsonResponse($user_data, 200);
    }

    #[Route('/api/v1/sites', name: 'user_sites', methods: ['POST', 'OPTIONS'])]
    public function getUserSites(Request $request): Response
    {
        $get_user_information_object = $this->read_user_information;
        $jwt_token = $this->token_storage_interface->getToken();
        $user_data_sites = $get_user_information_object->getUserSitesInformation($jwt_token->getUser());
        return new JsonResponse($user_data_sites, 200);
    }
}
