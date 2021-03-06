<?php

namespace App\Controller;

use App\Entity\Program;
use App\Entity\ProgramEvent;
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
    public function index()
    {
        $academies = $this->getDoctrine()
            ->getRepository(Academy::class)
            ->findAll();

        if ($academies === null) {
            return new JsonResponse("We could not find any academies", Response::HTTP_NOT_FOUND);
        }

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
                'academy_cities' => []
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
            $reviews = [];
            foreach ($program->getReviews() as $review) {
                $consumer = $review->getConsumer();
                $consumerName = null;
                if ($consumer !== null) {
                    $consumerName = $consumer->getConsumerName();
                }
                $reviews[] = [
                    'id' => $review->getId(),
                    'comment' => $review->getReviewComment(),
                    'rating' => $review->getReviewStars(),
                    'date' => $review->getReviewData(),
                    'consumer' => $consumerName
                ];
            }


            $programsArray[] = [
                'program_id' => $program->getId(),
                'program_name' => $program->getProgramName(),
                'program_price' => $program->getProgramPrice(),
                'program_description' => $program->getProgramDescription(),
                'program_locations' => $this->getProgramLocations($program->getEvents()),
                'program_address ' => $this->getProgramAddress($program->getEvents()),
                'program_reviews' => $reviews,
                'program_dates' => $this->getDates($program->getEvents()),
            ];
        }

        return new JsonResponse(
            array(
                'academy_id' => $academy->getId(),
                'academy_name' => $academy->getAcademyName(),
                'academy_email' => $academy->getAcademyEmail(),
                'academy_url' => $academy->getAcademyUrl(),
                'academy_logo' => $academy->getAcademyLogo(),
                'academy_description' => $academy->getAcademyDescription(),
                'academy_programs' => $programsArray,
            ),
            JsonResponse::HTTP_OK
        );
    }

    protected function getDates(Collection $programEvents): array
    {
        /** @var ProgramEvent $event */
        $datesArray = [];

        foreach ($programEvents as $event) {
            $datesArray[] = [
                'program_start_date' => $event->getProgramStart()->format('Y-m-d'),
                'program_end_date' => $event->getProgramEnd()->format('Y-m-d'),
            ];
        }

        return $datesArray;
    }

    protected function getProgramLocations(Collection $programEvents): array
    {
        /** @var ProgramEvent $location */
        $locationsArray = [];

        foreach ($programEvents as $location) {
            $locationsArray[] = $location->getProgramLocation();
        }

        return $locationsArray;
    }

    protected function getProgramAddress(Collection $programEvents): array
    {
        /** @var ProgramEvent $address */
        $addressArray = [];

        foreach ($programEvents as $address) {
            $addressArray[] = $address->getProgramAddress();
        }

        return $addressArray;
    }
}
