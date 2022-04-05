<?php

namespace App\Controller;

use App\Entity\Babysitter;
use App\Form\BabysitterType;
use App\Repository\BabysitterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;

#[Route('/babysitter')]
class BabysitterController extends AbstractController
{
    #[Route('/', name: 'app_babysitter_index', methods: ['GET'])]
    public function index(BabysitterRepository $babysitterRepository): Response
    {
        $babysitters = $babysitterRepository->findBy(
            ['isAvailable' => true],  
        );
        return $this->render('babysitter/index.html.twig', ['babysitters' => $babysitters]);
    }

    #[Route('/new', name: 'app_babysitter_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, BabysitterRepository $babysitterRepository):Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        
        $babysitter = new Babysitter();
        $form = $this->createForm(BabysitterType::class, $babysitter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $babysitterRepository->add($babysitter);
            if ($babysitter->getPicture() != null) {
                $file = $form->get('picture')->getData();
                $fileName =  uniqid().'.'.$file->guessExtension();

                $file->move('uploads/', $fileName);

                $babysitter->setPicture($fileName);
            }

            $entityManager->persist($babysitter);
            $entityManager->flush();

            // return $this->redirectToRoute('app_babysitter_index', [], Response::HTTP_SEE_OTHER);
            return $this->redirectToRoute('app_admin');
        }
        return $this->renderForm('babysitter/new.html.twig', [
            'babysitter' => $babysitter,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_babysitter_show', methods: ['GET'])]
    public function show(Babysitter $babysitter): Response
    {
        return $this->render('babysitter/show.html.twig', [
            'babysitter' => $babysitter,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_babysitter_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Babysitter $babysitter, EntityManagerInterface $entityManager, BabysitterRepository $babysitterRepository): Response
    {
        $oldPicture = $babysitter->getPicture();
        $form = $this->createForm(BabysitterType::class, $babysitter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $babysitterRepository->add($babysitter);
            if ($babysitter->getPicture() != null && $babysitter->getPicture() != $oldPicture) {
                $file = $form->get('picture')->getData();
                $fileName =  uniqid().'.'.$file->guessExtension();

                $file->move('uploads/', $fileName);

                $babysitter->setPicture($fileName);

            } else {
                $babysitter->setPicture($oldPicture);
            }

            $entityManager->persist($babysitter);
            $entityManager->flush();
            // return $this->redirectToRoute('app_babysitter_index', [], Response::HTTP_SEE_OTHER);
            return $this->redirectToRoute('app_admin');
        }

        return $this->renderForm('babysitter/edit.html.twig', [
            'babysitter' => $babysitter,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_babysitter_delete', methods: ['GET','POST'])]
    public function delete(Request $request, Babysitter $babysitter, BabysitterRepository $babysitterRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        if ($this->isCsrfTokenValid('delete'.$babysitter->getId(), $request->request->get('_token'))) {
            $babysitterRepository->remove($babysitter);
        }

        // return $this->redirectToRoute('app_babysitter_index', [], Response::HTTP_SEE_OTHER);
        return $this->renderForm('babysitter/_delete_form.html.twig', [
        'babysitter' => $babysitter,
        ]);
        
    }
}
