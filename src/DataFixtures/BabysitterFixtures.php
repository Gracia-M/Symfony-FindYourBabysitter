<?php

namespace App\DataFixtures;

use App\Entity\Babysitter;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class BabysitterFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $babysitter = new Babysitter(
                ['picture'=>$faker->photo . "Babysitter",
                'firstname'=>$faker->prenom,
                'lastname'=>$faker->nom,
                'gender'=>$faker->genre,
                'location'=>$faker->lieu,
                'description'=>$faker->realText,
                'isAvailable'=>$faker->checkdate,
                'languages'=>$faker->    
            ]);

            $manager->persist($babysitter);
        }
        $manager->flush();
    }
}
