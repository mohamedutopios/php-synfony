<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DemoSessionController extends AbstractController
{
    

    #[Route('/demo/session/{element}', name: 'app_demo_session_add')]
    public function add(string $element, Request $request): Response
    {
        //Ajouter une données dans notre session
        $request->getSession()->set('element',["val" => $element]);
        return $this->render('demo_session/index.html.twig', [
            'controller_name' => 'DemoSessionController',
        ]);
    }

    #[Route('/demo/session', name: 'app_demo_session_get')]
    public function get(Request $request): Response
    {
        //Récupérer une données dans notre session
        $session = $request->getSession();
        $val = json_encode($session->get("element"));
        return JsonResponse::fromJsonString("{'val': '$val'}");
    }
}
