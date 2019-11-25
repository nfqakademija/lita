<?php

namespace App\Controller;

use App\Entity\City;
use App\Entity\ProgramEvent;
use App\Repository\AcademyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Academy;

class AcademiesController extends AbstractController
{
    /**
     * Returns list of academies.
     *
     * @return JsonResponse
     *
     * @Route(
     *     "/api/v1/academies",
     *     name="academies",
     *     methods={"GET"}
     * )
     */
    public function getAcademies()
    {
        $academies = $this->getDoctrine()
            ->getRepository(Academy::class)
            ->findAll();

        if ($academies === null) {
            return new JsonResponse("We could not find any academies", Response::HTTP_NOT_FOUND);
        }

        $academiesArray = array();

        foreach ($academies as $academy) {
            $academiesArray[] = array(
                'academy_id'          => $academy->getId(),
                'academy_name'        => $academy->getAcademyName(),
                'academy_email'       => $academy->getAcademyEmail(),
                'academy_url'         => $academy->getAcademyUrl(),
                'academy_logo'        => $academy->getAcademyLogo(),
                'academy_description' => $academy->getAcademyDescription(),
            );
        }

        return new JsonResponse(
            $academiesArray,
            JsonResponse::HTTP_OK
        );
    }

    /**
     * Returns academy selected by the id.
     *
     * @param $id
     * @return JsonResponse
     *
     * @Route(
     *     "/api/v1/academy/{id}",
     *     name="academy",
     *     methods={"GET"},
     *     requirements={"id"="\d+"}
     * )
     */
    public function getAcademy(int $id)
    {
        $academy = $this->getDoctrine()
            ->getRepository(Academy::class)
            ->find($id);

        if ($academy === null) {
            return new JsonResponse("There is no academy with id of: " . $id, Response::HTTP_NOT_FOUND);
        }

        $programsArray = [];

        foreach ($academy->getPrograms() as $program) {
                $programsArray[] = [
                    'academy_program' => [
                        'program_name'      => $program->getProgramName(),
                        'program_price'     => $program->getProgramPrice(),
//                        'program_locations' => $this->formatCitiesToArray($program->getCities()),
//                        'program_events'    => $this->formatEventsToArray($program->getEvents()),
                    ]
                ];
        }

        return new JsonResponse(
            array(
                'academy_id'          => $academy->getId(),
                'academy_name'        => $academy->getAcademyName(),
                'academy_email'       => $academy->getAcademyEmail(),
                'academy_url'         => $academy->getAcademyUrl(),
                'academy_logo'        => $academy->getAcademyLogo(),
                'academy_description' => $academy->getAcademyDescription(),
                'academy_programs'    => $programsArray,
            ),
            JsonResponse::HTTP_OK
        );
    }

    protected function formatCitiesToArray(City $city)
    {
        $citiesAddressArray = [];

        $citiesAddressArray['city'] = $city->getCity();
        $citiesAddressArray['address'] = $city->getCityAddress();

        return $citiesAddressArray;
    }

    protected function formatEventsToArray(ProgramEvent $event): array
    {
        return [
            'start_date' => $event->getProgramStart()->format('Y-m-d'),
            'end_date' => $event->getProgramEnd()->format('Y-m-d'),
        ];
    }
}
