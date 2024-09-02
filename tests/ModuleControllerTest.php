<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\ORM\EntityManagerInterface;
use App\DataFixtures\ModuleFixtures;

class ModuleControllerTest extends WebTestCase
{
    private $client;
    private $entityManager;
    private $createdEntities;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->entityManager = self::$kernel->getContainer()->get('doctrine')->getManager();
    }
}
