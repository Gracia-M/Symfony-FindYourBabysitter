<?php

namespace App\DataFixtures;

use App\Entity\Language;
use App\Entity\Babysitter;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker;

class BabysitterFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        for ($i=0; $i < 5; $i++) {
            $language = new Language( [
                'label'=> $faker->langLabel,
                'name'=> $faker->langName
            ]);
            $manager->persist($language);   
        }
        $manager->flush();
        
        $languages = $manager->getRepository(Babysitter::class)->findAll();

        for ($i = 0; $i < 10; $i++) {
            $babysitter = new Babysitter(
                ['picture'=>$faker->photo,
                'firstname'=>$faker->prenom,
                'lastname'=>$faker->nom,
                'gender'=>$faker->genre,
                'location'=>$faker->lieu,
                'description'=>$faker->realText,
                'isAvailable'=>$faker->checkdate,   
            ]);
            $babysitter->addLanguage($languages[array_rand($languages)]);

            $manager->persist($babysitter);
        }
        $manager->flush();
    }
}
