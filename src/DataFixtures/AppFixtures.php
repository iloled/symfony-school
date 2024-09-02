<?php

namespace App\DataFixtures;

use App\Entity\School;
use App\Entity\Training;
use App\Entity\Module;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
    	$faker = FakerFactory::create(); // Initialize Faker
    	
        $school = new School();
        $school->setName($faker->company()); // Random company name for school
        $school->setDescription($faker->catchPhrase()); // Random catch phrase for description

        $manager->persist($school);

        $manager->flush();
    }
}
