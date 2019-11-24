<?php

namespace App\Controller;

use App\Repository\AcademyRepository;
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
                'academy_id' => $academy->getId(),
                'academy_name' => $academy->getAcademyName(),
                'academy_email' => $academy->getAcademyEmail(),
                'academy_url' => $academy->getAcademyUrl(),
                'academy_logo' => $academy->getAcademyLogo(),
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

        //Academies Info
        $programsArray = array();
        foreach ($academy->getPrograms() as $program) {
            $programsArray[] = $program->getProgramName();
        }

        $priceArray = array();
        foreach ($academy->getPrograms() as $price) {
            $priceArray[] = $price->getProgramPrice();
        }

        $programs = new \stdClass();
        $programs->academy_programs = $programsArray;
        $programs->program_prices = $priceArray;

        //Cities Info
        $citiesArray = array();
        foreach ($academy->getCities() as $city) {
            $citiesArray[] = $city->getCity();
        }

        $addressArray = array();
        foreach ($academy->getCities() as $address) {
            $addressArray[] = $address->getCityAddress();
        }

        $cities = new \stdClass();
        $cities->cities = $citiesArray;
        $cities->addresses = $addressArray;

        return new JsonResponse(
            array(
                'academy_id' => $academy->getId(),
                'academy_name' => $academy->getAcademyName(),
                'academy_email' => $academy->getAcademyEmail(),
                'academy_url' => $academy->getAcademyUrl(),
                'academy_logo' => $academy->getAcademyLogo(),
                'academy_description' => $academy->getAcademyDescription(),
                'academy_programs' => $programs,
                'academy_cities' => $cities,
            ),
            JsonResponse::HTTP_OK
        );
    }
}
