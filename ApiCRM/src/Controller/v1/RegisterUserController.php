<?php

namespace App\Controller\v1;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Api\v1\Adapter\RegisterUserInterface;

class RegisterUserController extends AbstractController
{
    public function __construct(private RegisterUserInterface $register_user)
    {

    }

    #[Route('/api/v1/register', name: 'register', methods: ['POST', 'OPTIONS'])]
    public function __invoke(Request $request): Response
    {
            if ($this->register_user->register($request->getContent()))
            {
                return new JsonResponse(['message' => 'user is create'], 201);
            }
                return new JsonResponse(['message' => 'user is exist'], 400);
        }
}