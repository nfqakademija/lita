<?php

namespace App\Form\Type;

use App\Entity\Review;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('review_stars')
            ->add('review_comment')
            ->add('review_data')
//            ->add('consumer_id')
            ->add('program')
        ;
    }
}
