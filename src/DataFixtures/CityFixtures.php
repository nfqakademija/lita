<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\City;

class CityFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $cities = [
            [
                'city' => 'Vilnius'
            ],
            [
                'city' => 'Kaunas'
            ],
            [
                'city' => 'Klaipėda'
            ],
            [
                'city' => 'Šiauliai'
            ]
        ];

        foreach ($cities as $data) {
            $city = new City();
            $city->setCity($data['city']);
            $manager->persist($city);
            $manager->flush();
        }
    }
}
