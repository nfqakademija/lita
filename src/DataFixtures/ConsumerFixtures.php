<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Consumer;

class ConsumerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 8; $i++) {
            $consumer = new Consumer();

            $consumer->setConsumerName('Petras');
            $consumer->setConsumerLastname('Petrauskas');
            $consumer->setConsumerEmail('email@email.com');
            $consumer->setPassword('testas');
            $manager->persist($consumer);
            $manager->flush();
        }
    }
}
