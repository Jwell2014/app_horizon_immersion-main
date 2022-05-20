<?php

namespace App\Controller;

use App\Entity\ImgSat;
use App\Form\ImgSatType;
use App\Repository\ChronoRepository;
use App\Repository\ImgSatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/img/sat')]
class ImgSatController extends AbstractController
{
    #[Route('/', name: 'app_img_sat_index', methods: ['GET'])]
    public function index(ImgSatRepository $imgSatRepository, ChronoRepository $chronoRepository): Response
    {
        return $this->render('img_sat/index.html.twig', [
            'img_sats' => $imgSatRepository->findAll(),
            'chronos' => $chronoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_img_sat_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ImgSatRepository $imgSatRepository): Response
    {
        $imgSat = new ImgSat();
        $form = $this->createForm(ImgSatType::class, $imgSat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imgSatRepository->add($imgSat);
            return $this->redirectToRoute('app_img_sat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('img_sat/new.html.twig', [
            'img_sat' => $imgSat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_img_sat_show', methods: ['GET'])]
    public function show(ImgSat $imgSat): Response
    {
        return $this->render('img_sat/show.html.twig', [
            'img_sat' => $imgSat,
        ]);
    }

    #[Route('/toggleAll', name: 'app_img_sat_toggle_all', methods: ['POST'])]
    public function toggleAll(ImgSat $imgSat, ImgSatRepository $imgSatRepository): Response
    {
        return $this->render('admin_interface/chrono/index.html.twig', [
            'img_sat' => $imgSatRepository->toggleAll($imgSat),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_img_sat_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ImgSat $imgSat, ImgSatRepository $imgSatRepository, ChronoRepository $chronoRepository): Response
    {
        $form = $this->createForm(ImgSatType::class, $imgSat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imgSatRepository->add($imgSat);
            return $this->redirectToRoute('app_img_sat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('img_sat/edit.html.twig', [
            'imgsSat' => $imgSatRepository->findAll(),
            'form' => $form,
            'chronos' => $chronoRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_img_sat_delete', methods: ['POST'])]
    public function delete(Request $request, ImgSat $imgSat, ImgSatRepository $imgSatRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$imgSat->getId(), $request->request->get('_token'))) {
            $imgSatRepository->remove($imgSat);
        }

        return $this->redirectToRoute('app_img_sat_index', [], Response::HTTP_SEE_OTHER);
    }
}
