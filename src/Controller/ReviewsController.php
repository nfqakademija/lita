<?php

namespace App\Controller;

use App\Entity\Program;
use App\Entity\Review;
use App\Form\Type\ReviewType;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReviewsController extends AbstractController
{
    /**
     * @Route("/api/v1/program/{id}/review",
     *     name="review",
     *     methods={"GET","POST"},
     *     requirements={"id"="\d+"})
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function createReview(Request $request, $id): JsonResponse
    {
        $review = new Review();

        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);

        //Get program_id from Repository
        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->find($id);

        //Check if program_id exists
        if (empty($program)) {
            return new JsonResponse(['message' => 'Program not found'], Response::HTTP_NOT_FOUND);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $review = $form->getData();

            //Post data to DB
            $em = $this->getDoctrine()->getManager();
            $em->persist($review);
            $em->flush();

            //Return 201 HTTP response
            return new JsonResponse(
                'Review left successfully',
                JsonResponse::HTTP_CREATED
            );
        }
    }
}
