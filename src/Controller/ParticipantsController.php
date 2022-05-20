<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\ChronoRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/participants')]
class ParticipantsController extends AbstractController
{
    #[Route('/', name: 'app_participants_index', methods: ['GET'])]
    public function index(UserRepository $userRepository, ChronoRepository $chronoRepository): Response
    {
        return $this->render('admin_interface/participants/index.html.twig', [
            'controller_name' => 'ParticipantsController',
            'participants' => $userRepository->findAll(),
            'users' => $userRepository->findUserBySession(),
            'chronos' => $chronoRepository->findAll(),
        ]);
    }


    #[Route('/new', name: 'app_participants_new', methods: ['GET', 'POST'])]
    public function new(Request $request,  EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_participants_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_interface/participants/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }


    #[Route('/{id}', name: 'app_participants_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('admin_interface/participants/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_participants_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user);
            return $this->redirectToRoute('app_participants_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_interface/participants/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }


    #[Route('/{id}', name: 'app_participants_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_participants_index', [], Response::HTTP_SEE_OTHER);
    }
}
