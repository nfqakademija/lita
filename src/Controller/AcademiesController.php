<?php

namespace App\Controller;

use App\Entity\City;
use App\Entity\Program;
use App\Entity\ProgramEvent;
use App\Entity\Review;
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
                        'program_reviews'   => $this->getReviews(),
                        'program_cities'    => $this->getCities(),
                        'program_addresses' => $this->getAddresses(),
                        'program_dates'     => $this->getDates($program->getEvents()),
                    ]
                ];
        }

        return new JsonResponse(
            array (
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

    protected function getProgramPrices()
    {
        $reviews = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findAll();

        $reviewsArray = [];

        foreach ($reviews as $review) {
            $reviewsArray[] = $review->getReviewStars();
        }

        return $reviewsArray;
    }

    protected function getReviews()
    {
        $reviews = $this->getDoctrine()
            ->getRepository(Review::class)
            ->findAll();

        $reviewsArray = [];

        foreach ($reviews as $review) {
            $reviewsArray[] = $review->getReviewStars();
        }

        return $reviewsArray;
    }

    protected function getCities()
    {
        $locations = $this->getDoctrine()
            ->getRepository(City::class)
            ->findAll();

        $citiesArray = [];

        foreach ($locations as $location) {
            $citiesArray[] = $location->getCity();
        }

        return $citiesArray;
    }

    protected function getAddresses()
    {
        $locations = $this->getDoctrine()
            ->getRepository(City::class)
            ->findAll();

        $addressArray = [];

        foreach ($locations as $location) {
            $addressArray[] = $location->getCityAddress();
        }

        return $addressArray;
    }

    protected function getDates(array $programEvents)
    {
        /** @var ProgramEvent $event */
        foreach ($programEvents as $event) {
            return [
                'program_start_date'      => $event->getProgramEnd()->format('Y-m-d'),
                'program_end_date'        => $event->getProgramEnd()->format('Y-m-d'),
            ];
        }
    }
}
