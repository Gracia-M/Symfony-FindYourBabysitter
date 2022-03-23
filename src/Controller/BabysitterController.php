<?php

namespace App\Controller;

use App\Entity\Contract;
use App\Entity\Babysitter;
use App\Form\BabysitterType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class BabysitterController extends AbstractController
{
    #[Route('/add', name: 'app_add')]
    public function add(Request $req)
    {
        $babysitter = new Babysitter();
        $formBabysitter = $this->createForm(BabysitterType::class, $babysitter);
        $formBabysitter->handleRequest($req);

        if($formBabysitter->isSubmitted() && $formBabysitter->isValid()) {
            $babysitter->setIsAvailable((true));
            
            if ($babysitter->getPicture() !== null) {
                $file = $formBabysitter->get('picture')->getData();
                $fileName =  uniqid(). '.' .$file->guessExtension();

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
            if($babysitter->getIsAvailable()) {
                $babysitter->getContracts(new Contract);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($babysitter);
            $em->flush();

        }
        return $this->render('/babysitter/add.html.twig', [
            'formBabysitter' => $formBabysitter->createView()]);

    }

    #[Route('/show/{url}', name: 'app_show')]
    public function show(Babysitter $babysitter) {
        return $this->render('/babysitter/show.html.twig', [
            'babysitter'=>$babysitter]);
    }

    #[Route('/edit/{id}', name: 'app_edit')]
    public function edit(Babysitter $babysitter, Request $req)
    {
        $oldPicture = $babysitter->getPicture();

        $formBabysitter = $this->createForm(BabysitterType::class, $babysitter);
        $formBabysitter->handleRequest($req);

        if ($formBabysitter->isSubmitted() && $formBabysitter->isValid()) {
            $babysitter->setIsAvailable((true));

            if (!$babysitter->getIsAvailable()) {
                $babysitter->setContracts($this->generateSlug($babysitter->getTitle()));
            }

            if ($babysitter->getIsPublished()) {
                $babysitter->setPublicationDate(new \DateTime());
            }

            if ($babysitter->getPicture() !== null && $babysitter->getPicture() !== $oldPicture) {
                $file = $formBabysitter->get('picture')->getData();
                $fileName = uniqid(). '.' .$file->guessExtension();

                try {
                    $file->move(
                        $this->getParameter('images_directory'),
                        $fileName
                    );
                } catch (FileException $e) {
                    return new Response($e->getMessage());
                }

                $babysitter->setPicture($fileName);
            } else {
                $babysitter->setPicture($oldPicture);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($babysitter);
            $em->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('babysitter/edit.html.twig', [
            'babysitter' => $babysitter,
            'formBabysitter' => $formBabysitter->createView()
        ]);
    }

    #[Route('/remove/{id}', name: 'app_remove')]
    public function remove(Babysitter $babysitter)
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($babysitter);
        $em->flush();

        return $this->redirectToRoute('admin');
    }

}
