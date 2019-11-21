<?php

namespace App\DataFixtures;

use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Review;

class ReviewFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $review = new Review();

        $review->setReviewStars('5');
        $review->setReviewComment('Amazing course');
        $review->setReviewData(DateTime::createFromFormat('U', time()));
        $manager->persist($review);
        $manager->flush();
    }
}
