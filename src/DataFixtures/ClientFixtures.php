<?php

namespace App\DataFixtures;

use App\Factory\ClientFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Client;

class ClientFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $client = new Client();
        $client->setEmail('test@tes.tes');
        $client->setAdresse('sueper sadress');
        $client->setNom('jean');
        $manager->persist($client);
        $manager->flush();
        ClientFactory::createMany(10);

    }
}
