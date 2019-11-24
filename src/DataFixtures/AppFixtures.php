<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Academy;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 8; $i++) {
            $academy = new Academy();

            $academy->setAcademyName('Super Academy '.$i);
            $academy->setAcademyEmail('academy@email.com');
            $academy->setAcademyUrl('www.academy.com');
            $academy->setAcademyLogo('www.google.com/image.jpg');
            $academy->setAcademyDescription('Some awesome description');
            $manager->persist($academy);
        }
        $manager->flush();
    }
}
