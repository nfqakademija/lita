<?php

namespace App\Controller;

use App\Entity\Consumer;
use App\Entity\Program;
use App\Entity\Review;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReviewsController extends AbstractController
{
    /**
     * @Route("/api/v1/program/{program_id}/consumers/{googleId}/review",
     *     name="review",
     *     methods={"POST", "GET"},
     *     requirements={"program_id"="\d+", "googleId"="\d+"})
     * @param int $program_id
     * @param int $googleId
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function createReview(Request $request, $program_id, $googleId): JsonResponse
    {
        $review = new Review();

        $review_stars = $request->get('review_stars');
        $review_comment = $request->get('review_comment');
        $review_data = new \DateTime("now");

        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->find($program_id);

        $user = $this->getDoctrine()
            ->getRepository(Consumer::class)
            ->find($googleId);

        $userId = $user->getGoogleId();

        //If there is consumer with specified google_id
        if ($userId != null) {
            //If consumer did not yet leave review
            if ($user->getReviews()->count() == 0) {
                $review->setReviewStars($review_stars);
                $review->setReviewComment($review_comment);
                $review->setReviewData($review_data);
                $review->setProgram($program);
                $review->setConsumer($user);

                $em = $this->getDoctrine()->getManager();
                $em->persist($review);
                $em->flush();
            } else {
                return new JsonResponse(
                    "You already left one review for that program",
                    Response::HTTP_METHOD_NOT_ALLOWED
                );
            }
            return new JsonResponse(
                'Review left successfully',
                JsonResponse::HTTP_CREATED
            );
        } else {
            return new JsonResponse("Please login with Google to leave a review", Response::HTTP_NOT_FOUND);
        }
    }
}
