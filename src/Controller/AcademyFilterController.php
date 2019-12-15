<?php

namespace App\Controller;

use App\Dto\FiltersData;
use App\Entity\Academy;
use App\Entity\Program;
use App\Repository\AcademyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AcademyFilterController
 * @package App\Controller
 */
class AcademyFilterController extends AbstractController
{
    /** @var AcademyRepository */
    private $academyRepository;
    public function __construct(AcademyRepository $academyRepository)
    {
        $this->academyRepository = $academyRepository;
    }
    /**
     * @Route("/api/v1/filter", name="filter")
     * @param Request $request
     * @return JsonResponse
     */
    public function filter(Request $request): JsonResponse
    {
        $program = $request->get('Program');
        $city = $request->get('City');
        $price = $request->get('Price');

        $filtersData = new FiltersData();

        $filtersData->setProgramName($program);
        $filtersData->setCity($city);
        $filtersData->setProgramPrice($price);

        /** @var Academy[] $academies */
        $academies = $this->academyRepository->filterAcademies($filtersData);

        $academiesArray = array();

        foreach ($academies as $academy) {
            $minProgramPriceByAcademy = $this
                ->getDoctrine()
                ->getRepository(Program::class)
                ->findMinPriceByAcademy($academy->getId());

            $academiesArray[] = array(
                'academy_id' => $academy->getId(),
                'academy_name' => $academy->getAcademyName(),
                'academy_email' => $academy->getAcademyEmail(),
                'academy_url' => $academy->getAcademyUrl(),
                'academy_logo' => $academy->getAcademyLogo(),
                'academy_description' => $academy->getAcademyDescription(),
                'academy_price' => $minProgramPriceByAcademy[0],
            );
        }
        return new JsonResponse($academiesArray);
    }
}
