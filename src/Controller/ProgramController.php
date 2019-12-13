<?php
namespace App\Controller;

use App\Entity\Academy;
use App\Entity\City;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Program;

class ProgramController extends AbstractController
{
    /**
     * @return Academy[]|Program[]|object[]|JsonResponse
     */
    public function getProgramEntityInfo()
    {
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findAll();
        if ($programs === null) {
            return new JsonResponse("We could not find any programs", Response::HTTP_NOT_FOUND);
        }
        return array_unique($programs);
    }
    /**
     * @return Academy[]|City[]|object[]|JsonResponse
     */
    public function getCityEntityInfo()
    {
        $cities = $this->getDoctrine()
            ->getRepository(City::class)
            ->findAll();
        if ($cities === null) {
            return new JsonResponse("We could not find any programs", Response::HTTP_NOT_FOUND);
        }
        return array_unique($cities);
    }
    /**
     * Returns list of programs.
     *
     * @return JsonResponse
     *
     * @Route(
     *     "/api/v1/programs",
     *     name="programs",
     *     methods={"GET"}
     * )
     */
    public function getPrograms()
    {
        $programsArray = array();
        foreach ($this->getProgramEntityInfo() as $program) {
            $programsArray[] = array(
                'program_id' => $program->getId(),
                'program_name' => $program->getProgramName(),
                'program_url' => $program->getProgramUrl(),
                'program_price' => $program->getProgramPrice(),
            );
        }
        return new JsonResponse(
            $programsArray,
            JsonResponse::HTTP_OK
        );
    }
    /**
     * Returns names of all programs.
     *
     * @return JsonResponse
     *
     * @Route(
     *     "/api/v1/programOptions",
     *     name="program_names",
     *     methods={"GET"}
     * )
     */
    public function getProgramName()
    {
        $programNamesArray = array();
        foreach ($this->getProgramEntityInfo() as $name) {
            $programNamesArray[] = $name->getProgramName();
        }
        return new JsonResponse(
            array (
                'program_names' => $programNamesArray,
            ),
            JsonResponse::HTTP_OK
        );
    }
    /**
     * Returns all cities.
     *
     * @return JsonResponse
     *
     * @Route(
     *     "/api/v1/cityOptions",
     *     name="cities",
     *     methods={"GET"}
     * )
     */
    public function getCities()
    {
        $citiesArray = array();
        foreach ($this->getCityEntityInfo() as $city) {
            $citiesArray[] = $city->getCity();
        }
        return new JsonResponse(
            array (
                'cities' => $citiesArray
            ),
            JsonResponse::HTTP_OK
        );
    }
}