<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Academy;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $academies = [
            [
                'academy_name' => 'NFQ',
                'academy_email' => 'info@nfq.com',
                'academy_url' => 'https://nfqacademy.lt/',
                'academy_logo' => 'https://www.nfq.lt/apie-akademija',
                'academy_description' => 'Some awesome description',
            ],
            [
                'academy_name' => 'Software development academy',
                'academy_email' => 'https://sdacademy.lt/',
                'academy_url' => 'https://sdacademy.lt/vs-assets/uploads/sites/14/2019/05/sda-logo.png',
                'academy_logo' => 'https://www.nfq.lt/apie-akademija',
                'academy_description' => 'Some awesome description',
            ],
            [
                'academy_name' => '„Telia“ IT akademija',
                'academy_email' => 'info@nfq.com',
                'academy_url' => 'https://www.telia.lt/it-akademija',
                'academy_logo' => 'https://www.telia.lt/_ui/responsive/theme-teo/images/telia-logo.svg',
                'academy_description' => 'Some awesome description',
            ],
            [
                'academy_name' => 'Baltijos technologijų institutas',
                'academy_email' => 'bit@bit.lt',
                'academy_url' => 'https://bit.lt/',
                'academy_logo' => 'https://bit.lt/wp-content/themes/baltictalents/img/BIT_logo_desktop.svg',
                'academy_description' => 'Some awesome description',
            ],
        ];

        foreach ($academies as $data) {
            $academy = new Academy();
            $academy->setAcademyName($data['academy_name']);
            $academy->setAcademyEmail($data['academy_email']);
            $academy->setAcademyUrl($data['academy_url']);
            $academy->setAcademyLogo($data['academy_logo']);
            $academy->setAcademyDescription($data['academy_description']);
            $manager->persist($academy);
            $manager->flush();
        }
    }
}
