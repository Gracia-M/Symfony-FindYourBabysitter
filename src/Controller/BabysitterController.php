<?php

namespace App\Controller;

use App\Entity\Babysitter;
use App\Form\Babysitter1Type;
use App\Repository\BabysitterRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/babysitter')]
class BabysitterController extends AbstractController
{
    #[Route('/', name: 'app_babysitter_index', methods: ['GET'])]
    public function index(BabysitterRepository $babysitterRepository): Response
    {
        return $this->render('babysitter/index.html.twig', [
            'babysitters' => $babysitterRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_babysitter_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BabysitterRepository $babysitterRepository): Response
    {
        $babysitter = new Babysitter();
        $form = $this->createForm(Babysitter1Type::class, $babysitter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $babysitterRepository->add($babysitter);
            if ($babysitter->getPicture() !== null) {
                $file = $form->get('picture')->getData();
                $fileName =  md5(uniqid()). '.' .$file->guessExtension();

                try {
                    $file->move(
                        $this->getParameter('images_directory'), // Le dossier dans lequel le fichier va être charger
                        $fileName
                    );
                } catch (FileException $e) {
                    return new Response($e->getMessage());
                }

                $babysitter->setPicture($fileName);
            }
            return $this->redirectToRoute('app_babysitter_index', [], Response::HTTP_SEE_OTHER);
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
    public function edit(Request $request, Babysitter $babysitter, BabysitterRepository $babysitterRepository): Response
    {
        $form = $this->createForm(Babysitter1Type::class, $babysitter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $babysitterRepository->add($babysitter);
            return $this->redirectToRoute('app_babysitter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('babysitter/edit.html.twig', [
            'babysitter' => $babysitter,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_babysitter_delete', methods: ['POST'])]
    public function delete(Request $request, Babysitter $babysitter, BabysitterRepository $babysitterRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$babysitter->getId(), $request->request->get('_token'))) {
            $babysitterRepository->remove($babysitter);
        }

        return $this->redirectToRoute('app_babysitter_index', [], Response::HTTP_SEE_OTHER);
    }
}
