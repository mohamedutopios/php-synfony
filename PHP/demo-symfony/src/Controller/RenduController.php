<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RenduController extends AbstractController
{
    #[Route('/rendu', name: 'app_rendu')]
    public function index(): Response
    {
        return $this->render('rendu/index.html.twig', [
            "users" => [
                (object)["firstname" => "ihab", "lastname" => "abadi", "role" => "admin"],
                (object)["firstname" => "titi", "lastname" => "minet", "role" => "user"],
            ]
        ]);
    }

    #[Route('/postrendu', name: 'app_rendu_post', methods:["POST"])]
    public function post(Request $request): Response
    {
        return $this->render('rendu/postrendu.html.twig', [
            "result" => $request->get("f1")
        ]);
    }
}
