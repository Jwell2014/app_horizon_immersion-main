<?php

namespace App\Controller;

use App\Entity\Fichier;
use App\Form\FichierType;
use App\Repository\ChronoRepository;
use App\Repository\FichierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/img/sat')]
class FichierController extends AbstractController
{
    #[Route('/', name: 'app_fichier_index', methods: ['GET'])]
    public function index(FichierRepository $fichierRepository, ChronoRepository $chronoRepository): Response
    {
        return $this->render('fichier/index.html.twig', [
            'fichiers' => $fichierRepository->findAll(),
            'chronos' => $chronoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_fichier_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FichierRepository $fichierRepository): Response
    {
        $fichier = new Fichier();
        $form = $this->createForm(FichierType::class, $fichier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fichierRepository->add($fichier);
            return $this->redirectToRoute('app_fichier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('fichier/new.html.twig', [
            'fichier' => $fichier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_fichier_show', methods: ['GET'])]
    public function show(Fichier $fichier): Response
    {
        return $this->render('fichier/show.html.twig', [
            'fichier' => $fichier,
        ]);
    }


    #[Route('/{id}/edit', name: 'app_fichier_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Fichier $fichier, FichierRepository $fichierRepository, ChronoRepository $chronoRepository): Response
    {
        $form = $this->createForm(FichierType::class, $fichier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fichierRepository->add($fichier);
            return $this->redirectToRoute('app_fichier_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('fichier/edit.html.twig', [
            'fichiers' => $fichierRepository->findAll(),
            'form' => $form,
            'chronos' => $chronoRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_fichier_delete', methods: ['POST'])]
    public function delete(Request $request, Fichier $fichier, FichierRepository $imgSatRepofichierRepositoryitory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fichier->getId(), $request->request->get('_token'))) {
            $imgSatRepofichierRepositoryitory->remove($fichier);
        }

        return $this->redirectToRoute('app_fichier_index', [], Response::HTTP_SEE_OTHER);
    }
}
