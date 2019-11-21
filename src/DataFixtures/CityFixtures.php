<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\City;

class CityFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $city = new City();

        $city->setCity('Vilnius');
        $manager->persist($city);
        $manager->flush();
    }
}
