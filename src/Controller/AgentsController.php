<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AgentsType;
use App\Repository\ChronoRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/agents')]
class AgentsController extends AbstractController
{
    #[Route('/', name: 'app_agents_index', methods: ['GET'])]
    public function index(UserRepository $userRepository, ChronoRepository $chronoRepository): Response
    {
        return $this->render('admin_interface/agents/index.html.twig', [
//            'users' => $userRepository->findAll(),
            'users' => $userRepository->findByRoleAgent("ROLE_AGENT"),
            'chronos' => $chronoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_agents_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(AgentsType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user);
            return $this->redirectToRoute('app_agents_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_interface/agents/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_agents_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('admin_interface/agents/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_agents_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository, ChronoRepository $chronoRepository): Response
    {
        $form = $this->createForm(AgentsType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user);
            return $this->redirectToRoute('app_agents_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_interface/agents/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_agents_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user);
        }

        return $this->redirectToRoute('app_agents_index', [], Response::HTTP_SEE_OTHER);
    }
}
