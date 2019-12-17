<?php

namespace App\Controller;

use App\Entity\Program;
use App\Entity\Review;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ReviewsController extends AbstractController
{
    /**
     * @Route("/api/v1/reviews/create",
     *     name="reviews",
     *     methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function createReview(Request $request): JsonResponse
    {
        $user = $this->getUser();

        if ($user == null) {
            throw new AccessDeniedException();
        }

        $review = new Review();
        $data = json_decode($request->getContent(), true);

        $program_id = $data['program_id'];
        $review_stars = $data['review_stars'];
        $review_comment = $data['review_comment'];
        $review_data = new \DateTime('now');

        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->find($program_id);

        $userReviews = $this->getDoctrine()
            ->getRepository(Review::class)
            ->findBy([
                'consumer' => $user,
                'program' => $program_id,
            ]);

        $userReviewsCount = count($userReviews);

        if ($userReviewsCount > 0) {
            return new JsonResponse(
                'Atsiliepimą apie programą galima palikti tik vieną kartą',
                JsonResponse::HTTP_NOT_ACCEPTABLE
            );
        }

        $review->setReviewStars($review_stars);
        $review->setReviewComment($review_comment);
        $review->setReviewData($review_data);
        $review->setProgram($program);
        $review->setConsumer($user);

        $em = $this->getDoctrine()->getManager();
        $em->persist($review);
        $em->flush();

        return new JsonResponse(
            'Atsiliepimas sėkmingai paliktas',
            JsonResponse::HTTP_CREATED
        );
    }
}
