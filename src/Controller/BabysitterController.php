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
    #[Route('/babysitter', name: 'app_babysitter')]
    public function index(): Response
    {
        return $this->render('babysitter/index.html.twig');
    }

    #[Route('/add', name: 'app_add')]
    public function add(Request $req)
    {
        $babysitter = new Babysitter();
        $formulaireBabysitter = $this->createForm(BabysitterType::class, $babysitter);
        $formulaireBabysitter->handleRequest($req);

        if($formulaireBabysitter->isSubmitted() && $formulaireBabysitter->isValid()) {
            $babysitter->setIsAvailable((true));
            if ($babysitter->getPicture() !== null) {
                $file = $formulaireBabysitter->get('picture')->getData();
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
                $babysitter->setContracts(new Contract);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($babysitter);
            $em->flush();


        }
        $vars = ['formBabysitter' => $formulaireBabysitter->createView()];
        
        return $this->render('/babysitter/add.html.twig', $vars);

    }

    public function show(Babysitter $babysitter) {
        return $this->render('/babysitter/show.html.twig', ['babysitter'=>$babysitter]);
    }

}
