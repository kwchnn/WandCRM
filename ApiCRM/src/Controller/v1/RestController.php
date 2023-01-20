<?php

namespace App\Controller\v1;

use phpDocumentor\Reflection\DocBlock\Tags\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RestController extends AbstractController
{
    #[Route('/rest/{id}', name: 'app_rest', methods: 'GET')]
    public function index(int $id): Response
    {
        $json_response = new Response();
        $json_response->setContent(json_encode([
            'id' => $id,
            'name' => 'name'.$id,
            'email' => 'example@email'.$id.'.com',
            'amount' => '12'.$id
        ]));
        $json_response->headers->set('Content-Type', 'application/json');
        return $json_response;
    }
}
