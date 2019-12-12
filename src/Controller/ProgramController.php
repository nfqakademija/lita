<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Program;

class ProgramController extends AbstractController
{
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
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findAll();

        if ($programs === null) {
            return new JsonResponse("We could not find any programs", Response::HTTP_NOT_FOUND);
        }

        $programsArray = array();

        foreach ($programs as $program) {
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
     * Returns program selected by the id.
     *
     * @param $id
     * @return JsonResponse
     *
     * @Route(
     *     "/api/v1/program/{id}",
     *     name="program",
     *     methods={"GET"},
     *     requirements={"id"="\d+"}
     * )
     */
    public function getProgram(int $id)
    {
        /** @var Program $program */
        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->find($id);

        if ($program === null) {
            return new JsonResponse("There is no programs with id of: " . $id, Response::HTTP_NOT_FOUND);
        }

        $reviewsArray = array();
        foreach ($program->getReviews() as $review) {
            $reviewsArray[] = $review->getReviewStars();
        }

        $startDatesArray = array();
        $endDatesArray = array();
        foreach ($program->getEvents() as $review) {
            $startDatesArray[] = $review->getProgramStart();
            $endDatesArray[] = $review->getProgramEnd();
        }

        return new JsonResponse(
            array(
                'program_id' => $program->getId(),
                'program_name' => $program->getProgramName(),
                'program_url' => $program->getProgramUrl(),
                'program_price' => $program->getProgramPrice(),
                'program_reviews' => $reviewsArray,
                'program_start' => $startDatesArray,
                'program_end' => $endDatesArray,
            ),
            JsonResponse::HTTP_OK
        );
    }
}
