<?php

namespace App\Controller;

use App\Entity\City;
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
                        'program_review'    => $this->getReviews(),
                        'program_locations' => $this->getLocations(),
                        'program_dates'     => $this->getDates(),
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

    protected function getReviews(): array
    {
        $reviews = $this->getDoctrine()
            ->getRepository(Review::class)
            ->findAll();

        foreach ($reviews as $review) {
            return [
                'review_stars'       => $review->getReviewStars(),
                'review_comment'     => $review->getReviewComment(),
            ];
        }
    }

    protected function getLocations(): array
    {
        $locations = $this->getDoctrine()
            ->getRepository(City::class)
            ->findAll();

        foreach ($locations as $location) {
            return [
                'program_locations' => [
                    'program_city'        => $location->getCity(),
                    'program_address'     => $location->getCityAddress(),
                ]
            ];
        }
    }

    protected function getDates(): array
    {
        $dates = $this->getDoctrine()
            ->getRepository(ProgramEvent::class)
            ->findAll();

        foreach ($dates as $date) {
            return [
                'program_dates' => [
                    'program_start_date'      => $date->getProgramStart()->format('Y-m-d'),
                    'program_end_date'        => $date->getProgramEnd()->format('Y-m-d'),
                ]
            ];
        }
    }
}
