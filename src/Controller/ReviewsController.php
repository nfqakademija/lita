<?php

namespace App\Controller;

use App\Entity\Program;
use App\Entity\Review;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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

        $review_stars = $request->get('review_stars');
        $review_comment = $request->get('review_comment');
        $review_data = new \DateTime("now");

        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->find($id);

        $review->setReviewStars($review_stars);
        $review->setReviewComment($review_comment);
        $review->setReviewData($review_data);
        $review->setProgram($program);

        $em = $this->getDoctrine()->getManager();
        $em->persist($review);
        $em->flush();

        return new JsonResponse(
            'Review left successfully',
            JsonResponse::HTTP_CREATED
        );
    }
}
