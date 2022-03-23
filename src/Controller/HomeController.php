<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Babysitter;
use App\Repository\BabysitterRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(BabysitterRepository $babysitterRepository)
    {
        $babysitters = $babysitterRepository->findBy(
            ['isAvailable' => true],
            
        );

        return $this->render('home/index.html.twig', ['babysitters' => $babysitters]);

    }

    #[Route('/admin', name: 'app_admin')]
    public function admin()
    {
        $babysitters = $this->getDoctrine()->getRepository(Babysitter::class)->findBy(
            [],
            ['isAvailable' => 'DESC']
        );

        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('home/admin.html.twig', [
            'babysitters' => $babysitters,
            'users' => $users
        ]);
    }
}
