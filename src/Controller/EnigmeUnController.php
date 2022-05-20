<?php

namespace App\Controller;

use App\Entity\EnigmeUn;
use App\Form\EnigmeUnType;
use App\Repository\ChronoRepository;
use App\Repository\DocumentRepository;
use App\Repository\EnigmeUnRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/enigmeUn')]
class EnigmeUnController extends AbstractController
{
    #[Route('/', name: 'app_enigme_un_index', methods: ['GET'])]
    public function index(EnigmeUnRepository $enigmeUnRepository, ChronoRepository $chronoRepository, DocumentRepository $documentRepository): Response
    {
        return $this->render('admin_interface/enigme_un/index.html.twig', [
            'enigmes1' => $enigmeUnRepository->findAll(),
            'chronos' => $chronoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_enigme_un_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EnigmeUnRepository $enigmeUnRepository): Response
    {
        $enigmeUn = new EnigmeUn();
        $form = $this->createForm(EnigmeUnType::class, $enigmeUn);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $enigmeUnRepository->add($enigmeUn);
            return $this->redirectToRoute('app_enigme_un_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_interface/enigme_un/new.html.twig', [
            'enigme_un' => $enigmeUn,
            'form' => $form,
        ]);
    }


    #[Route('/{id}/edit', name: 'app_enigme_un_edit', methods: ['GET', 'POST'], requirements: ["id"=> '\d+'])]
    public function edit(Request $request, EnigmeUn $enigmeUn, EnigmeUnRepository $enigmeUnRepository): Response
    {
        $form = $this->createForm(EnigmeUnType::class, $enigmeUn);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $enigmeUnRepository->add($enigmeUn);
            return $this->redirectToRoute('app_enigme_un_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_interface/enigme_un/edit.html.twig', [
            'enigme_un' => $enigmeUn,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_enigme_un_delete', methods: ['POST'], requirements: ["id"=> '\d+'])]
    public function delete(Request $request, EnigmeUn $enigmeUn, EnigmeUnRepository $enigmeUnRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$enigmeUn->getId(), $request->request->get('_token'))) {
            $enigmeUnRepository->remove($enigmeUn);
        }

        return $this->redirectToRoute('app_enigme_un_index', [], Response::HTTP_SEE_OTHER);
    }
}
