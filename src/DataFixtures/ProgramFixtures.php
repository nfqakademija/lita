<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Program;

class ProgramFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 8; $i++) {
            $program = new Program();

            $program->setProgramName('PHP');
            $program->setProgramUrl('www.google.com/php');
            $program->setProgramPrice('500');
            $program->setProgramDescription('Lorem ipsum dolor sit amet, consectetur adipiscing ' .
                'elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.Sed dui lorem, ' .
                'adipiscing in adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis ' .
                'placerat, felis enim.');
            $manager->persist($program);
            $manager->flush();
        }
    }
}
