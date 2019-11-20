<?php

namespace App\DataFixtures;

use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\ProgramEvent;

class ProgramEventFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $programEvent = new ProgramEvent();

        $programEvent->setProgramStart(DateTime::createFromFormat('U', time()));
        $programEvent->setProgramEnd(DateTime::createFromFormat('U', time()));
        $programEvent->setProgramLocation('Vilnius');
        $manager->persist($programEvent);
        $manager->flush();
    }
}
