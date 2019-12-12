<?php

namespace App\Controller;

use App\Entity\Academy;
use App\Repository\AcademyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AcademyController extends AbstractController
{
    /**
     * @Route("/academy/{id}", name="academy_page")
     */
    public function academy($id, AcademyRepository $academyRepository)
    {
        /** @var Academy $academy */
        $academy = $academyRepository->find($id);

        return $this->render('academy.html.twig', [
            'academy' => $academy,
        ]);
    }
}