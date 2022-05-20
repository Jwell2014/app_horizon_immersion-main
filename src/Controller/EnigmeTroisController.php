<?php

namespace App\Controller;

use App\Entity\EnigmeTrois;
use App\Form\EnigmeTroisType;
use App\Repository\ChronoRepository;
use App\Repository\EnigmeTroisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/enigmeTrois')]
class EnigmeTroisController extends AbstractController
{
    #[Route('/', name: 'app_enigme_trois_index', methods: ['GET'])]
    public function index(EnigmeTroisRepository $enigmeTroisRepository, ChronoRepository $chronoRepository): Response
    {
        return $this->render('admin_interface/enigme_trois/index.html.twig', [
            'enigmes3' => $enigmeTroisRepository->findAll(),
            'chronos' => $chronoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_enigme_trois_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EnigmeTroisRepository $enigmeTroisRepository): Response
    {
        $enigmeTroi = new EnigmeTrois();
        $form = $this->createForm(EnigmeTroisType::class, $enigmeTroi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $enigmeTroisRepository->add($enigmeTroi);
            return $this->redirectToRoute('app_enigme_trois_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_interface/enigme_trois/new.html.twig', [
            'enigme_troi' => $enigmeTroi,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_enigme_trois_show', methods: ['GET'])]
    public function show(EnigmeTrois $enigmeTrois): Response
    {
        return $this->render('admin_interface/enigme_trois/show.html.twig', [
            'enigme_trois' => $enigmeTrois,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_enigme_trois_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EnigmeTrois $enigmeTrois, EnigmeTroisRepository $EnigmeTroisRepository): Response
    {
        $form = $this->createForm(EnigmeTroisType::class, $enigmeTrois);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $EnigmeTroisRepository->add($enigmeTrois);
            return $this->redirectToRoute('app_enigme_trois_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_interface/enigme_trois/edit.html.twig', [
            'enigme_trois' => $enigmeTrois,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_enigme_trois_delete', methods: ['POST'])]
    public function delete(Request $request, EnigmeTrois $enigmeTrois, EnigmeTroisRepository $EnigmeTroisRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$enigmeTrois->getId(), $request->request->get('_token'))) {
            $EnigmeTroisRepository->remove($enigmeTrois);
        }

        return $this->redirectToRoute('app_enigme_trois_index', [], Response::HTTP_SEE_OTHER);
    }
}
