<?php

namespace App\Controller\v1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class UserDataController extends AbstractController
{
    public function __construct(private TokenStorageInterface $token_storage_interface)
    {

    }
    
    #[Route('/api/v1/me', name: 'user_data', methods: ['POST', 'OPTIONS'])]
    public function getUserData(Request $request): Response
    {
        $jwt_token = $this->token_storage_interface->getToken();
        $user_data = $jwt_token->getUser();
        $array[] = $user_data->getUserIdentifier();
        return new JsonResponse($array, 200);
    }
}
