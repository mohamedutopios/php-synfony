<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DemoCookiesController extends AbstractController
{
    #[Route('/demo/cookies', name: 'app_demo_cookies')]
    public function index(): Response
    {
        $reponse = $this->render('demo_cookies/index.html.twig', [
            'controller_name' => 'DemoCookiesController',
        ]);
        $reponse->headers->setCookie(new Cookie("mon_Cookie", "valeur de mon cookie"));
        return $reponse;
    }

    #[Route('/demo/cookies/get', name: 'app_demo_cookies_get')]
    public function get(Request $request): Response
    {
        return JsonResponse::fromJsonString(json_encode($request->cookies->get("mon_Cookie")));
    }
}
