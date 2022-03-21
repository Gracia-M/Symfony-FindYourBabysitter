<?php

namespace App\Controller;

use App\Entity\Babysitter;
use App\Form\BabysitterType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BabysitterController extends AbstractController
{
    #[Route('/babysitter', name: 'app_babysitter')]
    public function babySitterProfile()
    {
        return $this->render('babysitter/show.html.twig');
    }

    #[Route('/babysitter{language}', name: 'app_babysitter')]
    public function listByLanguage($languages = null): Response
    {

        return $this->render('babysitter/list_language.html.twig', $languages);
    }

    #[Route('/babysitter/formulaire', name: 'app_babysitter')]
    public function addBabysitter(Request $req, ManagerRegistry $doctrine)
    {
        $babysitter = new Babysitter();
        $formulaireBabysitter = $this->createForm(BabysitterType::class, $babysitter);

        $formulaireBabysitter->handleRequest($req);

        if($formulaireBabysitter->isSubmitted() && $formulaireBabysitter->isValid()) {
            
            $file = $babysitter->getPicture();

            $fileServerName = md5(uniqid()).".".$file->guessExtension();

            $file->move("filesFolder", $fileServerName);

            $babysitter->setPicture($fileServerName);

            $em = $doctrine->getManager();
            $em->persist($babysitter);
            $em->flush();

            return new Response("Fichier enregistré et Base de Données mis à jour");
        }
        else {
            $vars = ['formBabysitter' => $formulaireBabysitter->createView()];
            return $this->render('/babysitter/formulaire.html.twig', $vars);

        }

        
    }
}
