<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HelloController extends AbstractController
{
    #[Route('/hello', name: 'app_hello', methods: ["GET"])]
    public function index(): Response
    {
        return $this->render('hello/index.html.twig', [
            'controller_name' => 'HelloController',
        ]);
    }

    #[Route('/args/{id}', name: 'app_args', methods: ["GET"])]
    public function withArgs(int $id): Response 
    {
        return JsonResponse::fromJsonString("{id:$id, message:'OK'}");
    }
}
