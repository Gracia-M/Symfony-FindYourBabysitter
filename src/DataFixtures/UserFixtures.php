<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
         $this->passwordHasher = $passwordHasher;
    }
    
    public function load(ObjectManager $manager): void
    {
            $user1 = new User();
            $user1->setEmail("gracia@msn.com");
            $user1->setPassword($this->passwordHasher->hashPassword(
                $user1,
                'ilyana'));
            $user1->setUsername('Gracia1');
            $user1->setRoles(['ROLE_ADMIN']);
            $manager->persist($user1);
            
            $user2 = new User();
            $user2->setEmail("gracia@gmail.com");
            $user2->setPassword($this->passwordHasher->hashPassword(
                $user2,
                'ilyana'));
            $user2->setUsername('Gracia2');
            $user1->setRoles(['ROLE_ADMIN']);
            $manager->persist($user2);

    $manager->flush();
    
    }
}