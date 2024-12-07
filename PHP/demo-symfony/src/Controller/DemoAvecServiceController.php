<?php

namespace App\Controller;

use App\Service\DemoInterface;
use App\Service\DemoService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DemoAvecServiceController extends AbstractController
{
    

    public function __construct(private DemoInterface $service)
    {
        
    }

    #[Route('/demo/avec/service', name: 'app_demo_avec_service')]
    public function index(): Response
    {
        return $this->render('demo_avec_service/index.html.twig', [
            'information' => $this->service->getInfo(),
        ]);
    }
}
