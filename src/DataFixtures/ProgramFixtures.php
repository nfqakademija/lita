<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Program;

class ProgramFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $program = new Program();

        $program->setProgramName('PHP');
        $program->setProgramUrl('www.google.com/php');
        $program->setProgramPrice('500');
        $manager->persist($program);
        $manager->flush();
    }
}
