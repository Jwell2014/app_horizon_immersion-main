<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ANController extends AbstractController
{
    #[Route('/an', name: 'app_a_n')]
    public function index(): Response
    {
        return $this->render('an/index.html.twig', [
            'controller_name' => 'ANController',
        ]);
    }
}
