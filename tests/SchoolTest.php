<?php

namespace App\Tests\Entity;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\School;
use App\DataFixtures\AppFixtures;

class SchoolTest extends WebTestCase
{
    private static $client;
    private static $school;
    private static $entityManager;

    public static function setUpBeforeClass(): void
    {
        // Create client, which boots the kernel
        self::$client = static::createClient();
        
        // Access the entity manager via the client
        self::$entityManager = self::$client->getContainer()->get('doctrine')->getManager();

        self::$school = new School();
        self::$school->setName('3WA');
        self::$school->setDescription('Ecole dans le 18 eme ');

       	self::$entityManager->persist(self::$school);
       	self::$entityManager->flush();
    }

    public static function tearDownAfterClass(): void
    {
    	/*
    	self::$entityManager->remove(self::$school);
       	self::$entityManager->flush();
        self::$entityManager->close();
        self::$entityManager = null;*/
    }

    public function testSchoolEntity()
    {
        $school = new School();
        $school->setName('3WA');
        $school->setDescription('Ecole dans le 18 eme ');

        $this->assertEquals('3WA', $school->getName());
        $this->assertEquals('Ecole dans le 18 eme ', $school->getDescription());
    }
/*
    public function testSchoolRoute()
    {
        $crawler = self::$client->request('GET', '/schools');
        $response = self::$client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());

        // Check that all trainings are listed
        $this->assertCount(1, $crawler->filter('h1'));
    }*/
/*
    public function testListWithNoModulesSelected()
    {
        $crawler = $this->client->request('GET', '/search_training');
        $response = $this->client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());

        // Check that all trainings are listed
        $this->assertSelectorExists('ul');
        $this->assertCount(6, $crawler->filter('ul li'));
    }*/


}
