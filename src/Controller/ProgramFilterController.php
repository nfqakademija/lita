<?php
namespace App\Controller;

use App\Dto\FiltersData;
use App\Entity\Academy;
use App\Repository\AcademyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ProgramFilterController
 * @package App\Controller
 */
class ProgramFilterController extends AbstractController
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
            $academiesArray[] = array(
                'academy_id' => $academy->getId(),
                'academy_name' => $academy->getAcademyName(),
                'academy_email' => $academy->getAcademyEmail(),
                'academy_url' => $academy->getAcademyUrl(),
                'academy_logo' => $academy->getAcademyLogo(),
            );
        }

        return new JsonResponse($academiesArray);
    }
}
