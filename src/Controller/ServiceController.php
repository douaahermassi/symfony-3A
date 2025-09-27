<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ServiceController extends AbstractController
{
    #[Route('/service', name: 'app_service')]
    public function index(): Response
    {
        return $this->render('service/index.html.twig', [
            'controller_name' => 'ServiceController',
        ]);
    }
    #[Route('/service/{name}', name: 'app_service')]
    public function showService($name): Response
    {
        return $this->render('service/show.html.twig', [
            'name' => $name,
        ]);
    }
    
    #[Route('/service', name: 'app_service_go_home')]
    public function goToIndex(): Response
    {
        return $this->render('service/index.html.twig', [
            'controller_name' => 'ServiceController',
             ]);
    }
}

