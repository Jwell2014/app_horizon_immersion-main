<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeliciousKangarooController extends AbstractController
{
    #[Route('/dk', name: 'app_delicious_kangaroo')]
    public function index(): Response
    {
        return $this->render('delicious_kangaroo/index.html.twig', [
            'controller_name' => 'DeliciousKangarooController',
        ]);
    }
}
