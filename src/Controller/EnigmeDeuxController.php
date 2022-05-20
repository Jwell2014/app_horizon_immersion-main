<?php

namespace App\Controller;

use App\Entity\EnigmeDeux;
use App\Form\EnigmeDeuxType;
use App\Repository\ChronoRepository;
use App\Repository\EnigmeDeuxRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/enigmeDeux')]
class EnigmeDeuxController extends AbstractController
{
    #[Route('/', name: 'app_enigme_deux_index', methods: ['GET'])]
    public function index(EnigmeDeuxRepository $enigmeDeuxRepository, ChronoRepository $chronoRepository): Response
    {
        return $this->render('admin_interface/enigme_deux/index.html.twig', [
            'enigmes2' => $enigmeDeuxRepository->findAll(),
            'chronos' => $chronoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_enigme_deux_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EnigmeDeuxRepository $enigmeDeuxRepository): Response
    {
        $enigmeDeux = new EnigmeDeux();
        $form = $this->createForm(EnigmeDeuxType::class, $enigmeDeux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $enigmeDeuxRepository->add($enigmeDeux);
            return $this->redirectToRoute('app_enigme_deux_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_interface/enigme_deux/new.html.twig', [
            'enigme_deux' => $enigmeDeux,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_enigme_deux_show', methods: ['GET'])]
    public function show(EnigmeDeux $enigmeDeux): Response
    {
        return $this->render('admin_interface/enigme_deux/show.html.twig', [
            'enigme_deux' => $enigmeDeux,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_enigme_deux_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EnigmeDeux $enigmeDeux, EnigmeDeuxRepository $enigmeDeuxRepository): Response
    {
        $form = $this->createForm(EnigmeDeuxType::class, $enigmeDeux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $enigmeDeuxRepository->add($enigmeDeux);
            return $this->redirectToRoute('app_enigme_deux_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_interface/enigme_deux/edit.html.twig', [
            'enigme_deux' => $enigmeDeux,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_enigme_deux_delete', methods: ['POST'])]
    public function delete(Request $request, EnigmeDeux $enigmeDeux, EnigmeDeuxRepository $enigmeDeuxRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$enigmeDeux->getId(), $request->request->get('_token'))) {
            $enigmeDeuxRepository->remove($enigmeDeux);
        }

        return $this->redirectToRoute('app_enigme_deux_index', [], Response::HTTP_SEE_OTHER);
    }
}
