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
                'academy_email' => 'akademija@nfq.lt',
                'academy_url' => 'https://www.nfq.lt/nfq-academy',
                'academy_logo' => 'https://avatars1.githubusercontent.com/u/5228734?s=200&v=4',
                'academy_description' => 'Tai trijų mėnesių trukmės teorinių ir praktinių žinių akseleratorius, ' .
                    'kuris leis greičiau pradėti karjerą. Tai tiltas tarp universiteto ir ' .
                    'realaus profesionalų pasaulio.',
            ],
            [
                'academy_name' => 'Software development academy',
                'academy_email' => 'info@sdacademy.lt',
                'academy_url' => 'https://sdacademy.lt/',
                'academy_logo' => 'https://sdacademy.lt/vs-assets/uploads/sites/14/2019/05/sda-logo.png',
                'academy_description' => 'Nuo pat savo veiklos pradžios mes bendradarbiaujame su įmonėmis. SDA ' .
                    'sėkmingai įgyvendino daugiau nei 200 mokymo ir samdymo projektų su įvairiais verslo partneriais ' .
                    'Lenkijoje bei kitose šalyse.',
            ],
            [
                'academy_name' => 'Telia“ IT akademija',
                'academy_email' => 'info@telia.com',
                'academy_url' => 'https://www.telia.lt/it-akademija',
                'academy_logo' => 'https://www.telia.lt/_ui/responsive/theme-teo/images/telia-logo.svg',
                'academy_description' => 'Tapk IT profesionalu kartu su „Telia“ IT akademija“. Daugiau nei 4 ' .
                    'mėnesius trunkančios mokymų programos metu tavęs laukia vertingos žinios tiesiai iš ' .
                    'profesionalių dėstytojų-praktikų lūpų, ambicingos realaus darbo užduotys ir apmokama stažuotė.',
            ],
            [
                'academy_name' => 'Baltijos technologijų institutas',
                'academy_email' => 'bit@bit.lt',
                'academy_url' => 'https://bit.lt/',
                'academy_logo' => 'https://bit.lt/wp-content/themes/baltictalents/img/BIT_logo_desktop.svg',
                'academy_description' => 'Mūsų mokymo programos yra lyderiaujančios rinkoje dėl keletos svarbių ' .
                    'priežasčių. Visų pirma - per ilgus metus pirmaujančiose mokslo įstaigose Lietuvoje sukaupėme ' .
                    'patirtį, reikalingą kurti aukščiausios kokybės mokymo programas.',
            ],
            [
                'academy_name' => 'Sourcery academy',
                'academy_email' => 'academy@devbridge.com',
                'academy_url' => 'https://www.devbridge.com/sourcery/academy/',
                'academy_logo' => 'https://www.devbridge.com/Areas/Sourcery/Content/styles/images/logo-sourcery.png',
                'academy_description' => 'Sourcery academy is our free of charge internal education program created ' .
                    'to allow students to improve their skills and prepare for a career in the IT industry. ' .
                    'There are three academies available.',
            ],
            [
                'academy_name' => 'Codebacers akademija',
                'academy_email' => 'info@codebacers.lt',
                'academy_url' => 'https://www.codebakers.lt/',
                'academy_logo' => 'https://www.codebakers.lt/images/logo.png',
                'academy_description' => 'Auginame programuotojų komandas sau bei įmonėms pagal poreikį. ' .
                    'Tikslas yra sukurti saugią aplinką kurioje pradedantieji, mid ir senior lygio programuotojai ' .
                    'gali tobulėti ir dalintis patirtimi.',
            ],
            [
                'academy_name' => 'Vilnius Coding School',
                'academy_email' => 'info@vilniuscoding.lt',
                'academy_url' => 'https://www.vilniuscoding.lt/',
                'academy_logo' => 'https://www.vilniuscoding.lt/wp-content/themes/vcs/assets/img/logo-01.svg',
                'academy_description' => 'Esame vienintelė programavimo mokykla SUAUGUSIEMS, siekiantiems KEISTI ' .
                    'PROFESIJĄ! Siūlome ne tik intensyvius C#, Java, JavaScript, Python kalbų mokymus, bet ' .
                    'ir IT projektų valdymo, Big Data, SQL kursus.',
            ],
            [
                'academy_name' => 'CodeAcademy',
                'academy_email' => 'info@codeacademy.lt',
                'academy_url' => 'https://www.codeacademy.lt/',
                'academy_logo' => 'https://www.codeacademy.lt/wp-content/uploads/2017/05/logo.png',
                'academy_description' => 'CodeAcademy – jau trečius metus IT specialistus ruošianti akademija. ' .
                    'Pas mus dirba virš 60 savo srities specialistų – dėstytojų, dizainerių, programuotojų, ' .
                    'administratorių ir koordinatorių.',
            ],
            [
                'academy_name' => 'Akademija.IT',
                'academy_email' => 'info@akademija.it',
                'academy_url' => 'http://akademija.it/',
                'academy_logo' => 'http://akademija.it/file/2016/11/14/it_akademija.png',
                'academy_description' => 'Įmonės Lietuvoje ieško ne tik programuotojų, bet ir programinės įrangos ' .
                    'testuotojų. Darbuotojų trūkumą jaučia įvairia veikla užsiimančios kompanijos: telekomunikacijų, ' .
                    'transporto, finansų, informacinių technologijų, farmacijos pramonės ir kitos.',
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
