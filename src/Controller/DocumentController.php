<?php

namespace App\Controller;

use App\Entity\Document;
use App\Form\DocumentType;
use App\Repository\DocumentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
#[isGranted("ROLE_ADMIN")]
#[Route('/document')]
class DocumentController extends AbstractController
{
    #[Route('/all', name: 'document_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $documents = $entityManager
            ->getRepository(Document::class)
            ->findAll();

        return $this->render('document/index.html.twig', [
            'documents' => $documents,
        ]);
    }

    #[Route('/new', name: 'document_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,SluggerInterface  $slugger): Response
    {
        $document = new Document();
        $form = $this->createForm(DocumentType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $contenu = $form->get('contenu')->getData();

            $originalFilename = pathinfo($contenu->getClientOriginalName(), PATHINFO_FILENAME);

            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$contenu->guessExtension();

            // Move the file to the directory where the contents are stored.

            $contenu->move(
                $this->getParameter('document_image'),
                $newFilename
            );

            $document->setContenu($newFilename);

            $entityManager->persist($document);
            $entityManager->flush();

            return $this->redirectToRoute('document_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('document/new.html.twig', [
            'document' => $document,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'document_show', methods: ['GET'],requirements: ["id"=> '\d+'])]
    public function show(Document $document): Response
    {
        return $this->render('document/show.html.twig', [
            'document' => $document,
        ]);
    }

    #[Route('/{id}/edit', name: 'document_edit', methods: ['GET', 'POST'], requirements: ["id"=> '\d+'])]
    public function edit(Request $request, Document $document, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(DocumentType::class, $document);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //on récupère notre contenu dans la requete contenu correspondant au nom du champ dans notre formulaire
            $contenu = $form->get('contenu')->getData();

            if ($contenu){
                //Génération d'un nouveau nom sécurisé et unique
                $originalFilename = pathinfo($contenu->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$contenu->guessExtension();

                // j'upload le fichier dans le dossier contenu dans services.yaml qui a la clé document.image
                // Je l'upload avec son  nouveau nom
                $contenu->move(
                    $this->getParameter('document_image'),
                    $newFilename
                );
                //Dans ma BDD j'ajoute un nom unique du fichier pour le trouver
                $document->setContenu($newFilename);
            }

            $entityManager->flush();

            return $this->redirectToRoute('document_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('document/edit.html.twig', [
            'document' => $document,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'document_delete', methods: ['POST'], requirements: ["id"=> '\d+'])]
    public function delete(Request $request, Document $document, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$document->getId(), $request->request->get('_token'))) {
            $entityManager->remove($document);
            $entityManager->flush();
        }

        return $this->redirectToRoute('document_index', [], Response::HTTP_SEE_OTHER);
    }
}
