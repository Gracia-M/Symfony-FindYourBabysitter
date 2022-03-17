<?php

namespace App\Controller;

use App\Entity\Babysitter;
use App\Form\BabysitterType;
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
    public function addBabysitter()
    {
        $babysitter = new Babysitter();
        $formulaireBabysitter = $this->createForm(BabysitterType::class, $babysitter);

        $vars = ['formBabysitter' => $formulaireBabysitter->createView()];

        return $this->render('/babysitter/formulaire.html.twig', $vars);
    }
}
