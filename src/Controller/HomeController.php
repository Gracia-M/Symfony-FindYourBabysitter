<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Babysitter;
use App\Repository\BabysitterRepository;
use App\Repository\LanguageRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(BabysitterRepository $babysitterRepository)
    {
        $babysitters = $babysitterRepository->findBy(
            ['isAvailable' => true],
            
        );

        return $this->render('home/index.html.twig', ['babysitters' => $babysitters]);

    }

    #[Route('/admin', name: 'app_admin')]
    public function admin(BabysitterRepository $babysitterRepository, LanguageRepository $languageRepository, UserRepository $userRepository)
    {
        $babysitters = $babysitterRepository->findBy(
            [],
            ['isAvailable' => 'DESC']
        );

        $languages = $languageRepository->findAll();

        $users = $userRepository->findAll();

        return $this->render('/admin/index.html.twig', [
            'babysitters' => $babysitters,
            'languages' => $languages,
            'users' => $users
        ]);
    }
}
