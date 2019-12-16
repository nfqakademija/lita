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
     *     methods={"POST"},
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

        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->find($id);

        if (empty($program)) {
            return new JsonResponse(['message' => 'Program not found'], Response::HTTP_NOT_FOUND);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($review);
            $em->flush();
        }

        return new JsonResponse(
            'Review left successfully',
            JsonResponse::HTTP_CREATED
        );
    }
}
