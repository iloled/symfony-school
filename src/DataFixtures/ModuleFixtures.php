<?php

namespace App\DataFixtures;

use App\Entity\School;
use App\Entity\Training;
use App\Entity\Module;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory as FakerFactory;

class ModuleFixtures extends Fixture
{
    private $createdEntities = [];

    public function load(ObjectManager $manager)
    {
        $faker = FakerFactory::create(); // Initialize Faker

        $modules = [];
        $trainings = [];
        $schools = [];

        $this->createdEntities = [];

        // Create 3 schools with random data
        for ($i = 1; $i <= 3; $i++) {
            $school = new School();
            $school->setName($faker->company()); // Random company name for school
            $school->setDescription($faker->catchPhrase()); // Random catch phrase for description

            $manager->persist($school);
            $schools[] = $school;

            $this->createdEntities[] = $school;
        }

        // Create 6 modules with random names and descriptions
        for ($i = 1; $i <= 6; $i++) {
            $module = new Module();
            $module->setName($faker->word()); // Random word for module name
            $module->setDescription($faker->sentence()); // Random sentence for description
            $manager->persist($module);
            $modules[] = $module;
            $this->createdEntities[] = $module;
        }

        // Create 6 trainings, each with 3 random modules and assign a random school
        for ($i = 1; $i <= 6; $i++) {
            $training = new Training();
            $training->setName($faker->jobTitle()); // Random job title for training name
            $training->setDescription($faker->paragraph()); // Random paragraph for description

            // Assign 3 random modules to each training
            $assignedModules = $this->getRandomItems($modules, 3);
            foreach ($assignedModules as $module) {
                $training->addModule($module);
            }

            // Assign a random school to each training
            $randomSchool = $this->getRandomItems($schools, 1)[0];
            $training->setSchool($randomSchool);

            $manager->persist($training);
            $trainings[] = $training;
            $this->createdEntities[] = $training;
        }

        $manager->flush();
    }

    /**
     * Helper function to get a random subset of items from an array.
     *
     * @param array $items
     * @param int $count
     * @return array
     */
    private function getRandomItems(array $items, int $count): array
    {
        shuffle($items);
        return array_slice($items, 0, $count);
    }

    public function getCreatedEntities(): array
    {
        return $this->createdEntities;
    }
}