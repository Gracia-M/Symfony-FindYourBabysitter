<?php

namespace App\DataFixtures;

use App\Entity\Babysitter;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class BabysitterFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $faker = Faker\Factory::create();
        // for ($i = 0; $i < 10; $i ++) {
        //     $babysitter = new Babysitter(
        //         ['picture'=>faker
        //         'firstname'=>faker
        //         'lastname'=>faker
        //         'gender'=>faker
        //         'location'=>faker
        //         'description'=>faker
        //         'isAvailable'=>
        //         'languages'=>
                
        //         ]
        //     )
        // }
        $manager->flush();
    }
}
