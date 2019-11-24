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
            $academy->setAcademyName('Super Academy');
            $academy->setAcademyEmail('info@nfq.com');
            $academy->setAcademyUrl('https://www.nfq.lt/apie-akademija');
            $academy->setAcademyLogo('https://e-komercija.eu/wp-content/uploads/2018/03/nfq-logo.jpg');
            $academy->setAcademyDescription('Some awesome description');
            $manager->persist($academy);
        }
        $manager->flush();
    }
}
