<?php

namespace App\Controller;

use App\Repository\DossierRepository;
use App\Repository\ImgSatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class ParticipantInterfaceController extends AbstractController
{
    #[isGranted('ROLE_USER')]
    #[Route('/home/ju', name: 'app_participant_interface')]
    public function index(): Response
    {
        return $this->render('participant_interface/index.html.twig', [
            'controller_name' => 'ParticipantInterfaceController',
        ]);
    }

    #[Route('/whiteboard', name: 'whiteboard')]
    public function whiteboard(ImgSatRepository $imgSatRepository, DossierRepository $dossierRepository): Response
    {


        return $this->render('participant_interface/whiteboard.html.twig', [
            'controller_name' => 'ParticipantInterfaceController',
            'imgsSat'=> $imgSatRepository->findBy(['DossierParent' => 1]),
            'dossiers'=> $dossierRepository->findBy(['id' => 1]),
        ]);
    }
}
